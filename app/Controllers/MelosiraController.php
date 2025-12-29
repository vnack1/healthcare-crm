<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\MelosiraModel;
use CodeIgniter\Controller;

class MelosiraController extends Controller
{
    protected $userModel;
    protected $melosiraModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->melosiraModel = new MelosiraModel();
    }

        // 공통 마스킹 처리 메서드
    private function maskUserData(&$user)
    {
        if (isset($user['user_name'])) {
            $user['user_name'] = $this->maskName($user['user_name']);
        }
        if (isset($user['phone'])) {
            $user['phone'] = $this->maskPhoneNumber($user['phone']);
        }
        if (isset($user['birth_date'])) {
            $user['birth_date'] = $this->maskBirthDate($user['birth_date']);
        }
    }

    // 이름 마스킹
    private function maskName($name)
    {
        $length = mb_strlen($name, 'UTF-8');
        if ($length <= 1) {
            return $name;
        } elseif ($length === 2) {
            return mb_substr($name, 0, 1, 'UTF-8') . '*';
        } elseif ($length === 3) {
            return mb_substr($name, 0, 1, 'UTF-8') . '*' . mb_substr($name, -1, 1, 'UTF-8');
        } else {
            return mb_substr($name, 0, 1, 'UTF-8') . str_repeat('*', $length - 2) . mb_substr($name, -1, 1, 'UTF-8');
        }
    }

    // 핸드폰 번호 마스킹
    private function maskPhoneNumber($phoneNumber)
    {
        if (!str_contains($phoneNumber, '-')) {
            if (preg_match('/^01[016789]\d{7,8}$/', $phoneNumber)) {
                $phoneNumber = preg_replace('/(\d{3})(\d{4})(\d{4})/', '$1-$2-$3', $phoneNumber);
            } elseif (preg_match('/^0\d{1,2}\d{7,8}$/', $phoneNumber)) {
                $phoneNumber = preg_replace('/(0\d{1,2})(\d{3,4})(\d{4})/', '$1-$2-$3', $phoneNumber);
            }
        }
        if (preg_match('/^01[016789]-\d{4}-\d{4}$/', $phoneNumber)) {
            return preg_replace('/(\d{3})-\d{4}-(\d{4})/', '$1-****-$2', $phoneNumber);
        } elseif (preg_match('/^0\d{1,2}-\d{3,4}-\d{4}$/', $phoneNumber)) {
            return preg_replace('/(0\d{1,2})-(\d{3,4})-(\d{4})/', '$1-***-$3', $phoneNumber);
        }
        return $phoneNumber;
    }

    // 생년월일 마스킹
    private function maskBirthDate($birthDate)
    {
        return preg_replace('/(\d{2})(\d{2})-(\d{2})-(\d{2})/', '$1**-$3-$4', $birthDate);
    }

    // 멜로시라 전체 리스트 보기
    public function allList()
    {
    $user_idx = session()->get('user_idx');
    $grade = session()->get('grade');

    // 검색 조건 가져오기
    $searchConditions = [
        'user_name' => $this->request->getGet('user_name'),
        'gender' => $this->request->getGet('gender') !== '' ? $this->request->getGet('gender') : null,
        'phone' => $this->request->getGet('phone'),
        'birth_date' => $this->request->getGet('birth_date'),
        'start_date' => $this->request->getGet('start_date'), // 시작일
        'week_progress' => $this->request->getGet('week_progress'), // 진행 주차
        'status' => $this->request->getGet('status'), // 진행 주차
        'alert_status' => $this->request->getGet('alert_status'), // 상태별 알림
    ];

        // 멜로시라 회원 리스트 조회
        $userList = [];
        if ($grade === 0) { // 슈퍼 어드민
            $userList = $this->melosiraModel->getMelosiraAll(null, $searchConditions);
        } elseif ($grade === 1) { // 총판
            $userList = $this->melosiraModel->getMelosiraAll($user_idx, $searchConditions);
        } elseif ($grade === 2) { // 대리점
            $userList = $this->melosiraModel->getMelosiraAll($user_idx, $searchConditions);
        }

    // 멜로시라 데이터를 조합 (LEFT JOIN)
        $allListUsers = [];
        foreach ($userList as &$user) {
            $melosira = $this->melosiraModel->getMelosiraByUserId($user['user_idx']);
            $user['start_date'] = $melosira['start_date'] ?? null;
            $user['week_progress'] = $melosira['week_progress'] ?? null;
            $user['frequency'] = $melosira['frequency'] ?? null;
            $user['status'] = $melosira['status'] ?? null;

            // 마스킹 처리
            $this->maskUserData($user);

            // 상태별 알림 설정
            $currentDate = date('Y-m-d');
            $alertText = "멜로시라 정보 입력";
            $alertColor = "background-color: #F8F9FA; color: #495057;";

            if (!empty($user['start_date'])) {
                $daysElapsed = (strtotime($currentDate) - strtotime($user['start_date'])) / (60 * 60 * 24);
                if ($user['status'] == 2) { // 상태가 '완료'인 경우
                    $alertText = "다음 회차를 진행해주세요.";
                    $alertColor = "background-color: #CCE5FF; color: #004085;";
                } elseif ($daysElapsed == 5) {
                    $alertText = "전화예정 D-1";
                    $alertColor = "background-color: #FFF3CD; color: #856404;";
                } elseif ($daysElapsed >= 6) {
                    $alertText = "전화대상자";
                    $alertColor = "background-color: #F8D7DA; color: #721C24;";
                } else {
                    $alertText = "섭취진행중";
                    $alertColor = "background-color: #D4EDDA; color: #155724;";
                }
            }

            $user['alert_text'] = $alertText;
            $user['alert_color'] = $alertColor;

            // 12주차 완료 상태 제외
            if (!($user['week_progress'] == 12 && $user['status'] == 2)) {
                $allListUsers[] = $user;
            }
        }
            // 상태별 알림 필터링
            if (!empty($searchConditions['alert_status'])) {
                $allListUsers = array_filter($allListUsers, function ($user) use ($searchConditions) {
                    return isset($user['alert_text']) && $user['alert_text'] === $searchConditions['alert_status'];
                });
            }
    // 페이지네이션 설정
    $perPage = 20; // 한 페이지에 표시할 항목 수
    $currentPage = $this->request->getGet('page') ?? 1; // 현재 페이지
    $offset = ($currentPage - 1) * $perPage;

    // 총 데이터 개수 및 페이징 처리
    $totalRecords = count($allListUsers);
    $totalPages = ceil($totalRecords / $perPage);
    $pagedData = array_slice($allListUsers, $offset, $perPage);

    // 기존 검색 조건에 페이지 정보 추가
    $pageQuery = http_build_query($searchConditions) . "&page=" . $currentPage;

    // NO 값 설정 (역순)
    $no = $totalRecords - $offset;
    foreach ($pagedData as &$user) {
        $user['no'] = $no--;
    }
    // all_list 뷰로 데이터 전달
    return view('/melosira_management/all_list', [
        'userList' => $pagedData,
        'currentPage' => $currentPage,
        'totalPages' => $totalPages,
        'perPage' => $perPage,
        'totalRecords' => $totalRecords,
        'pageQuery' => $pageQuery,
    ]);
    }


    // 완료리스트 조회
    public function completeList()
    {
    $user_idx = session()->get('user_idx');
    $grade = session()->get('grade');

    // 검색 조건 가져오기
    $searchConditions = [
        'user_name' => $this->request->getGet('user_name'),
        'gender' => $this->request->getGet('gender') !== '' ? $this->request->getGet('gender') : null,
        'phone' => $this->request->getGet('phone'),
        'birth_date' => $this->request->getGet('birth_date'),
        'start_date' => $this->request->getGet('start_date'), // 시작일
        'week_progress' => $this->request->getGet('week_progress'), // 진행 주차
        'status' => $this->request->getGet('status'), // 진행 주차
    ];

    // 멜로시라 회원 리스트 조회
    $userList = [];
    if ($grade === 0) { // 슈퍼 어드민
        $userList = $this->melosiraModel->getMelosiraAll(null, $searchConditions);
    } elseif ($grade === 1) { // 총판
        $userList = $this->melosiraModel->getMelosiraAll($user_idx, $searchConditions);
    } elseif ($grade === 2) { // 대리점
        $userList = $this->melosiraModel->getMelosiraAll($user_idx, $searchConditions);
    }


    // 완료된 데이터만 필터링
    $completeListUsers = [];
    foreach ($userList as &$user) {
        $melosira = $this->melosiraModel->getMelosiraByUserId($user['user_idx']);
        $user['start_date'] = $melosira['start_date'] ?? null;
        $user['week_progress'] = $melosira['week_progress'] ?? null;
        $user['frequency'] = $melosira['frequency'] ?? null;
        $user['status'] = $melosira['status'] ?? null;
        
        // 마스킹 처리
        $this->maskUserData($user);

        if ($user['week_progress'] == 12 && $user['status'] === '2') {
            // 알림 설정
            $user['alert_text'] = "섭취 완료";
            $user['alert_color'] = "background-color: #D4EDDA; color: #155724;"; // 초록색 배경, 어두운 텍스트
            
            $completeListUsers[] = $user; // 12주차 완료된 상태
        }
    }

    // 페이지네이션 설정
    $perPage = 20; // 한 페이지에 표시할 항목 수
    $currentPage = $this->request->getGet('page') ?? 1; // 현재 페이지
    $offset = ($currentPage - 1) * $perPage;

    // 총 데이터 개수 및 페이징 처리
    $totalRecords = count($completeListUsers);
    $totalPages = ceil($totalRecords / $perPage);
    $pagedData = array_slice($completeListUsers, $offset, $perPage);

    // 기존 검색 조건에 페이지 정보 추가
    $pageQuery = http_build_query($searchConditions) . "&page=" . $currentPage;

     // NO 값 설정 (역순)
     $no = $totalRecords - $offset;
     foreach ($pagedData as &$user) {
         $user['no'] = $no--;
     }
     
    // 뷰로 데이터 전달
    return view('melosira_management/complete_list', [
        'userList' => $pagedData,
        'currentPage' => $currentPage,
        'totalPages' => $totalPages,
        'perPage' => $perPage,
        'totalRecords' => $totalRecords,
        'pageQuery' => $pageQuery,
    ]);
    
    }

    public function melosiraDetail($user_idx)
    {
        $user = $this->userModel->find($user_idx);

        // 최신 데이터 가져오기
        $latestData = $this->melosiraModel->where('user_idx', $user_idx)
                                        ->orderBy('week_progress', 'DESC')
                                        ->first();

        // 주차별 데이터 정리
        $melosiraData = $this->melosiraModel->where('user_idx', $user_idx)
                                            ->orderBy('week_progress', 'ASC')
                                            ->findAll();
        $melosiraByWeek = [];
        foreach ($melosiraData as $data) {
            $melosiraByWeek[$data['week_progress']] = $data;
        }

        // 주차 흐름 정의
        $weekFlow = [1, 2, 3, 4, 8, 12]; // 주차 흐름을 명시적으로 정의

        // 각 주차 입력 가능 여부 설정
        $inputAllowed = [];
        foreach ($weekFlow as $index => $week) {
            if ($index === 0) {
                // 첫 주차는 항상 입력 가능
                $inputAllowed[$week] = true;
            } else {
                // 이전 주차가 완료된 경우에만 입력 가능
                $previousWeek = $weekFlow[$index - 1];
                $inputAllowed[$week] = isset($melosiraByWeek[$previousWeek]) && $melosiraByWeek[$previousWeek]['status'] == 2;
            }
        }

        return view('melosira_management/melosira_detail', [
            'user' => $user,
            'latestData' => $latestData,        // 최신 데이터
            'melosiraByWeek' => $melosiraByWeek, // 주차별 데이터
            'inputAllowed' => $inputAllowed, // 입력 가능 여부 전달
        ]);
    }

    // 멜로시라 섭취 정보 등록 페이지
    public function registerMelosiraForm()
    {
        $user_idx = $this->request->getGet('user_idx');
        $week = $this->request->getGet('week'); // 주차 정보
        $user = $this->userModel->find($user_idx);

        // 해당 주차의 멜로시라 데이터 가져오기
        $melosira = $this->melosiraModel->getLatestLog($user_idx, $week);

        return view('melosira_management/melosira_register', [
                'user' => $user,
                'week' => $week,
                'melosira' => $melosira, // 조회된 데이터 전달
    ]);
    }

    // 멜로시라 섭취 정보 등록 처리
    public function registerMelosira()
    {
    $data = $this->request->getPost();

    // 필수 데이터 체크
    if (empty($data['user_idx']) || empty($data['week_progress']) || !isset($data['status'])) {
        return redirect()->back()->with('error', '필수 필드를 입력하세요.');
    }

    $week = $data['week_progress'];

    // 업데이트 데이터 준비
    $updateData = [
        'user_idx' => $data['user_idx'],
        'week_progress' => $week,
        'start_date' => $data['start_date'] ?? null,
        'status' => (int) $data['status'] ?? null,
        'frequency' => isset($data['frequency']) && $data['frequency'] !== '' ? (int)$data['frequency'] : null, // 기본값 NULL
        'notes' => $data['notes'] ?? null,
    ];

    // 기존 주차 데이터 확인
    $existingLog = $this->melosiraModel->getLatestLog($data['user_idx'], $week);

    if ($existingLog) {
        // 기존 데이터 업데이트
        $this->melosiraModel->update($existingLog['melo_idx'], $updateData);
    } else {
        // 데이터가 없으면 삽입
        $this->melosiraModel->insert($updateData);
    }
    // POST로 전달된 ref 값 확인
    $ref = $data['ref'] ?? 'all';
    
    // 디테일 페이지로 리다이렉트하며 ref 값 전달
    return redirect()->to('/melosira-management/melosira-detail/' . $data['user_idx'] . '?ref=' . $ref)
                     ->with('message', "{$week}주차 섭취 정보가 저장되었습니다.");
}
}