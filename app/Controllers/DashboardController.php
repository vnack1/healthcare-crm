<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\IcuModel;
use App\Models\UserModel;
use App\Models\MelosiraModel;
use App\Models\NoticeModel;


class DashboardController extends UserManagement
{

    public function dashboard()
    {

        $user_idx = session()->get('user_idx');
        $grade = session()->get('grade');
        $data = [];

        // 등급별 데이터 정의
        if ($grade === 0) { // 슈퍼 어드민
            $data['distributerCount'] = $this->getDistributorCount();
            $data['agentCount'] = $this->getAgentCount();
            $data['memberCount'] = $this->getUserCount();
            $recentUsers = $this->getRecentUsers();
            $data['recentUsers'] = $recentUsers;
            $data['recentUserCount'] = count($recentUsers);
        } elseif ($grade === 1) { // 총판
            $data['agentCount'] = $this->getAgentCount($user_idx);
            $data['memberCount'] = 0;
            $data['recentUsers'] = [];
            $data['recentUserCount'] = 0;

            $agentList = $this->userModel->where('parent_idx', $user_idx)->where('grade', 2)->findAll();
            foreach ($agentList as $agent) {
                $data['memberCount'] += $this->getUserCount($agent['user_idx']);
                $recentUsers = $this->getRecentUsers($agent['user_idx']);
                $data['recentUsers'] = array_merge($data['recentUsers'], $recentUsers);
            }

            $data['recentUserCount'] = count($data['recentUsers']);
        } elseif ($grade === 2) { // 대리점
            $data['memberCount'] = $this->getUserCount($user_idx);
            $recentUsers = $this->getRecentUsers($user_idx);
            $data['recentUsers'] = $recentUsers;
            $data['recentUserCount'] = count($recentUsers);
        }

        // Melosira 및 ICU 데이터를 추가
        $melosiraModel = new MelosiraModel();
        $user_idx = session()->get('user_idx'); // 현재 로인한 대리점의 user_idx 호출
        // 주차별 상태 초기화 및 데이터 설정
        $progressCounts = [
            '1' => ['status_1' => 0, 'status_2' => 0],
            '2' => ['status_1' => 0, 'status_2' => 0],
            '3' => ['status_1' => 0, 'status_2' => 0],
            '4' => ['status_1' => 0, 'status_2' => 0],
            '8' => ['status_1' => 0, 'status_2' => 0],
            '12' => ['status_1' => 0],
        ];

        // 최신 주차 상태 데이터 가져오기
        $statusCounts = $melosiraModel->getStatusCountByWeekProgress($grade, $user_idx);

        // 상태 카운트 초기화
        $statusZeroCount = 0; // 미등록
        $statusOneCount = 0; // 진행중
        $statusTwoCount = 0; // 완료

        foreach ($statusCounts as $statusCount) {
            $weekProgress = $statusCount['week_progress'];
            $status = $statusCount['status'];
            $count = $statusCount['count'];

            if ($status == 0) {
                $statusZeroCount += $count;
            } elseif ($status == 1) {
                $statusOneCount += $count;

                // 12주차에서는 status_1만 포함
                if ($weekProgress == 12) {
                    $progressCounts[$weekProgress]['status_1'] = $count;
                } elseif (isset($progressCounts[$weekProgress])) {
                    $progressCounts[$weekProgress]['status_1'] = $count;
                }
            } elseif ($status == 2 && $weekProgress != 12) {
                $statusTwoCount += $count;

                // 12주차는 status_2를 포함하지 않음
                if (isset($progressCounts[$weekProgress])) {
                    $progressCounts[$weekProgress]['status_2'] = $count;
                }
            }
        }

        // progressCounts에서 status_1 데이터를 추출하여 statusOneData 생성
        $statusOneData = array_map(function ($week) {
            return $week['status_1'];
        }, $progressCounts);

        $icuModel = new IcuModel();
        $icuCounts = $icuModel->getUserCountByProgressTime($grade, $user_idx);
        $progressTimeCounts = [
            '1' => 0,
            '2' => 0,
            '3' => 0,
        ];

        foreach ($icuCounts as $icuCount) {
            $progressTime = $icuCount['progress_time'];
            $count = $icuCount['count'];

            if (isset($progressTimeCounts[$progressTime])) {
                $progressTimeCounts[$progressTime] = $count;
            }
        }
        $noticeModel = new NoticeModel();

        // 공지사항 가져오기 (최신 3개만)
        $notices = $noticeModel->orderBy('create_at', 'DESC')
            ->findAll(5); // 최신 3개 공지사항만 가져오기

        // 전화예정 D-1 카운트
        $alertCounts['전화예정 D-1'] = $melosiraModel->getCountByAlertStatus('전화예정 D-1', $user_idx);

        // 전화대상자 카운트
        $alertCounts['전화대상자'] = $melosiraModel->getCountByAlertStatus('전화대상자', $user_idx);

        // 모든 데이터를 포함한 배열을 뷰로 전달
        $data['progressCounts'] = $progressCounts;
        $data['progressTimeCounts'] = $progressTimeCounts;
        $data['statusZeroCount'] = $melosiraModel->getUserCountByStatus($grade, $user_idx, 0); // 미등록
        $data['statusOneCount'] = $statusOneCount;
        $data['statusTwoCount'] = $statusTwoCount;
        $data['statusOneData'] = $statusOneData; // statusOneData를 전달
        $data['grade'] = $grade; // $grade 변수를 추가하여 뷰로 전달

        $data['notices'] = $notices; // 공지사항 데이터 추가
        $data['alertCounts'] = $alertCounts; // TodoList 카운트



        return view('templates/header') . view('templates/sidebar') . view('home/dashboard', $data) . view('templates/footer');
    }


    public function healthcareDashboard()
    {
        // 사용자 인증 확인
        if (!session()->has('user_idx') || !session()->has('grade')) {
            return redirect()->to('/login')->with('error', '로그인 해주세요');
        }

        // 사용자 정보 가져오기
        $user_idx = session()->get('user_idx');
        $grade = session()->get('grade');

        // MelosiraModel 로드
        $melosiraModel = new MelosiraModel();
        $statusCounts = $melosiraModel->getStatusCountByWeekProgress($grade, $user_idx); // grade와 user_idx 전달

        // Initialize default week progress counts for status 1 and 2
        $progressCounts = [
            '1' => ['status_1' => 0, 'status_2' => 0],
            '2' => ['status_1' => 0, 'status_2' => 0],
            '3' => ['status_1' => 0, 'status_2' => 0],
            '4' => ['status_1' => 0, 'status_2' => 0],
            '8' => ['status_1' => 0, 'status_2' => 0],
            '12' => ['status_1' => 0, 'status_2' => 0],
        ];



        // Update progressCounts with actual values from the model result
        foreach ($statusCounts as $statusCount) {
            $weekProgress = $statusCount['week_progress'];
            $status = $statusCount['status'];
            $count = $statusCount['count'];

            if (isset($progressCounts[$weekProgress])) {
                if ($status == 1) {
                    $progressCounts[$weekProgress]['status_1'] = $count; // 진행중
                } elseif ($status == 2) {
                    $progressCounts[$weekProgress]['status_2'] = $count; // 완료
                }
            }
        }

        // ICUModel 로드
        $icuModel = new IcuModel();
        $icuCounts = $icuModel->getUserCountByProgressTime($grade, $user_idx); // grade와 user_idx 전달

        // ICU 진행 시간 초기화 (1, 2, 3)
        $progressTimeCounts = [
            '1' => 0,
            '2' => 0,
            '3' => 0,
        ];

        // 실제 데이터로 업데이트
        foreach ($icuCounts as $icuCount) {
            $progressTime = $icuCount['progress_time'];
            $count = $icuCount['count'];
            if (isset($progressTimeCounts[$progressTime])) {
                $progressTimeCounts[$progressTime] = $count;
            }
        }

        // 뷰로 전달할 데이터 준비
        $data = [
            'progressCounts' => $progressCounts,
            'progressTimeCounts' => $progressTimeCounts,
        ];
        return view('healthcare_management/healthcare_dashboard', $data);
    }
}
?>