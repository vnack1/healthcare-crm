<?php

namespace App\Models;

use CodeIgniter\Model;

class MelosiraModel extends Model
{
    protected $table = 'melosira'; // 멜로시라 테이블
    protected $primaryKey = 'melo_idx'; // 기본 키
    protected $allowedFields = [
        'user_idx', 'start_date', 'week_progress', 'frequency', 'status', 'notes', 'create_at', 'update_at'
    ];

    // 특정 사용자의 멜로시라 데이터 가져오기 (최신 데이터 기준)
    public function getMelosiraByUserId($user_idx)
    {
        return $this->where('user_idx', $user_idx)
                    ->orderBy('create_at', 'DESC') // 최신 데이터를 가져옴
                    ->first();
    }
    public function getMelosiraAll($user_idx = null, $searchConditions = [])
{
    // 서브쿼리: 사용자별 최신 주차 데이터 가져오기
    $subQuery = $this->db->table('melosira')
                         ->select('user_idx, MAX(week_progress) as latest_week_progress')
                         ->groupBy('user_idx');

    // 메인 쿼리: 모든 사용자 포함 (멜로시라 데이터가 없는 사용자 포함)
    $query = $this->db->table('user')
                      ->select('user.*, melosira.start_date, melosira.week_progress, melosira.status, melosira.frequency')
                      ->join('(' . $subQuery->getCompiledSelect() . ') latest_melosira', 'user.user_idx = latest_melosira.user_idx', 'left')
                      ->join('melosira', 'user.user_idx = melosira.user_idx AND melosira.week_progress = latest_melosira.latest_week_progress', 'left')
                      ->where('user.grade', 3); // 회원만 조회

    // 계층적 조건 설정
    if ($user_idx !== null) {
        if (session()->get('grade') === 1) { // 총판
            $query->whereIn('user.parent_idx', function ($subQuery) use ($user_idx) {
                return $subQuery->select('user_idx')
                                ->from('user')
                                ->where('parent_idx', $user_idx)
                                ->where('grade', 2); // 총판의 하위 대리점만 가져오기
            });
        } elseif (session()->get('grade') === 2) { // 대리점
            $query->where('user.parent_idx', $user_idx); // 대리점의 하위 회원만 가져오기
        }
    }

    // 검색 조건 추가
    foreach ($searchConditions as $field => $value) {
        if (!empty($value) || $value === '0') {
            if (in_array($field, ['user_name', 'phone', 'birth_date'])) {
                $query->like('user.' . $field, $value);
            } elseif ($field === 'gender') {
                $query->where('user.gender', $value);
            } elseif ($field === 'start_date') {
                $query->where('melosira.start_date', $value);
            } elseif ($field === 'week_progress') {
                $query->where('melosira.week_progress', $value);
            } elseif ($field === 'status') {
                if ($value === '0') {
                    $query->groupStart()
                          ->where('melosira.status', 0)
                          ->orWhere('melosira.status IS NULL')
                          ->groupEnd();
                } else {
                    $query->where('melosira.status', $value);
                }
            }
        }
    }

    $query->orderBy('user.create_at', 'DESC');

    return $query->get()->getResultArray();
}

    // 특정 회원과 주차의 데이터 가져오기
    public function getLatestLog($user_idx, $week_progress)
    {
        return $this->where('user_idx', $user_idx)
                    ->where('week_progress', $week_progress)
                    ->orderBy('create_at', 'DESC') // 최신 데이터를 가져옴
                    ->first();
    }

    // 멜로시라 데이터 삽입 또는 업데이트
    public function saveMelosira($data)
    {
        // user_idx와 week_progress로 기존 데이터 확인
        $existing = $this->where('user_idx', $data['user_idx'])
                         ->where('week_progress', $data['week_progress'])
                         ->first();

        if ($existing) {
            // 기존 데이터가 있으면 업데이트
            return $this->update($existing['melo_idx'], $data);
        } else {
            // 없으면 새로운 데이터 삽입
            return $this->insert($data);
        }
    }

    // 주차별 상태 업데이트
    public function updateStatus($user_idx, $week, $status)
    {
        return $this->where('user_idx', $user_idx)
                    ->where('week_progress', $week)
                    ->update(['status' => $status]);
    }

 // 주차별로 값에 따른 출력하기 
 public function getStatusCountByWeekProgress($grade, $userIdx)
 {
     // 서브쿼리: 각 user_idx에 대해 최신 주차 데이터를 가져오기
     $subQuery = $this->db->table($this->table)
                          ->select('user_idx, MAX(week_progress) as latest_week_progress')
                          ->groupBy('user_idx');
 
     $builder = $this->db->table($this->table);
     $builder->select('melosira.week_progress, melosira.status, COUNT(*) as count');
     $builder->join('user', 'user.user_idx = melosira.user_idx', 'inner');
     $builder->join("({$subQuery->getCompiledSelect()}) as latest", 'melosira.user_idx = latest.user_idx AND melosira.week_progress = latest.latest_week_progress', 'inner');
 
     // 등급별 필터링
     if ($grade == 1) {
         // 총판의 하위 대리점
         $builder->whereIn('user.parent_idx', function ($query) use ($userIdx) {
             return $query->select('user_idx')
                          ->from('user')
                          ->where('grade', 2)
                          ->where('parent_idx', $userIdx);
         });
     } elseif ($grade == 2) {
         // 대리점의 하위 사용자
         $builder->where('user.parent_idx', $userIdx);
     }
 
     // 주차별 상태별로 그룹화
     $builder->groupBy(['melosira.week_progress', 'melosira.status']);
 
     // 쿼리 실행 및 결과 반환
     return $builder->get()->getResultArray();
 }
// status 상태에 의한 출력하기 
public function getUserCountByStatus($grade, $userIdx, $status = null)
{
    $builder = $this->db->table('user');
    $builder->select('COUNT(DISTINCT user.user_idx) as count'); // DISTINCT 추가로 고유 사용자만 카운트
    $builder->join('melosira', 'user.user_idx = melosira.user_idx', 'left'); // LEFT JOIN으로 미등록 사용자도 포함

    if ($status === 0) {
        // `status`가 NULL이거나 0인 경우
        $builder->groupStart()
                ->where('melosira.status', 0)
                ->orWhere('melosira.status IS NULL')
                ->groupEnd();
    } elseif ($status !== null) {
        // 특정 `status` 값만 필터링
        $builder->where('melosira.status', $status);
    }

    // 등급에 따른 필터링
    if ($grade == 1) {
        // distributor: 하위 에이전트들의 사용자 데이터 가져오기
        $builder->whereIn('user.parent_idx', function ($query) use ($userIdx) {
            return $query->select('user_idx')
                         ->from('user')
                         ->where('grade', 2)
                         ->where('parent_idx', $userIdx);
        });
    } elseif ($grade == 2) {
        // agent: 자신의 사용자만 가져오기
        $builder->where('user.parent_idx', $userIdx);
    } else {
        // superadmin: 모든 사용자 가져오기 (grade가 3인 사용자)
        $builder->where('user.grade', 3);
    }

    return $builder->get()->getRow()->count;
}
    // 멜로시라 모델
    public function getCountByAlertStatus($alertStatus, $userIdx)
    {
        $builder = $this->db->table('user');
        $builder->select('COUNT(DISTINCT user.user_idx) as count'); // 고유 사용자만 카운트
        $builder->join('melosira', 'user.user_idx = melosira.user_idx', 'left'); // LEFT JOIN으로 멜로시라 데이터 포함

        // 현재 날짜
        $currentDate = date('Y-m-d');

        // alert_status 조건에 따른 필터링
        if ($alertStatus === '전화예정 D-1') {
            // 시작일이 5일 전인 데이터
            $builder->where("DATEDIFF('$currentDate', melosira.start_date)", 5);
            $builder->where('melosira.status', 1); // 진행중 상태만
        } elseif ($alertStatus === '전화대상자') {
            // 시작일이 6일 이상 지난 데이터
            $builder->where("DATEDIFF('$currentDate', melosira.start_date) >=", 6);
            $builder->where('melosira.status', 1); // 진행중 상태만
        }
        // 자신의 하위 회원만 필터링
        $builder->where('user.parent_idx', $userIdx);
        
        return $builder->get()->getRow()->count; // 카운트 반환
    }
}