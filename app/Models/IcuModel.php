<?php

namespace App\Models;

use CodeIgniter\Model;

class IcuModel extends Model
{
    protected $table = 'icu'; // 테이블 이름
    protected $primaryKey = 'icu_idx'; // 기본 키
    protected $allowedFields = ['user_idx', 'progress_time', 'test_date', 'notes', 'create_at', 'update_at']; // 허용된 필드

    // 특정 총판의 사용자 데이터 가져오기
    public function getUsersByDistributor($distributorCode)
    {
        return $this->select('icu.*')
                    ->join('user', 'user.user_idx = icu.user_idx')
                    ->where('user.parent_idx', $distributorCode)
                    ->findAll();
    }

    // 특정 대리점의 사용자 데이터 가져오기
    public function getUsersByAgent($agentCode)
    {
        return $this->select('icu.*')
                    ->join('user', 'user.user_idx = icu.user_idx')
                    ->where('user.parent_idx', $agentCode)
                    ->findAll();
    }

    // 회차별 데이터 저장 메서드 (검사 결과)
    public function saveSessionData($userIdx, $session, $inputData)
    {
        $data = [
            'user_idx' => $userIdx,
            'progress_time' => $session,
            'test_date' => $inputData['test_date'],
            'notes' => $inputData['notes'] ?? null
        ];
        
        return $this->save($data);
    }

    public function filterIcuUsers($grade, $userIdx, $searchConditions = [])
    {
    // 서브쿼리: 사용자별 최신 진행 회차 데이터 가져오기
    $subQuery = $this->db->table('icu')
                         ->select('user_idx, MAX(progress_time) as latest_progress_time')
                         ->groupBy('user_idx');

    // 메인 쿼리: 사용자와 ICU 데이터 조합
    $query = $this->db->table('user')
                      ->select('user.*, icu.test_date, icu.progress_time, icu.notes')
                      ->join('(' . $subQuery->getCompiledSelect() . ') latest_icu', 'user.user_idx = latest_icu.user_idx', 'left')
                      ->join('icu', 'user.user_idx = icu.user_idx AND icu.progress_time = latest_icu.latest_progress_time', 'left')
                      ->where('user.grade', 3); // 회원만 조회

    // 사용자 계층 조건
    if ($grade === 1 && !empty($userIdx)) { // 총판
        $query->whereIn('user.parent_idx', $userIdx); // 대리점 ID 배열
    } elseif ($grade === 2 && !empty($userIdx)) { // 대리점
        $query->where('user.parent_idx', $userIdx); // 단일 ID
    }

    // 검색 조건 추가
    foreach ($searchConditions as $field => $value) {
        if (!empty($value) || $value === '0') { // 값이 비어있지 않을 경우만 적용
            if (in_array($field, ['user_name', 'phone', 'birth_date'])) {
                $query->like('user.' . $field, $value);
            } elseif ($field === 'gender') {
                $query->where('user.gender', $value);
            } elseif ($field === 'test_date') {
                $query->where('icu.test_date', $value);
            } elseif ($field === 'progress_time') {
                if ($value === '0') {
                    // 미등록 상태 (progress_time이 NULL 또는 0인 경우)
                    $query->groupStart()
                          ->where('icu.progress_time', 0)
                          ->orWhere('icu.progress_time IS NULL')
                          ->groupEnd();
                } else {
                    $query->where('icu.progress_time', $value);
                }
            }
        }
    }

    $query->orderBy('user.create_at', 'DESC');

    return $query->get()->getResultArray();
    }

    // Method to get user count grouped by progress_time based on grade and parent relationship
    public function getUserCountByProgressTime($grade, $userIdx)
    {
        // 서브쿼리: 각 user_idx에 대해 최신 progress_time 가져오기
        $subQuery = $this->db->table($this->table)
                            ->select('user_idx, MAX(progress_time) as latest_progress_time')
                            ->groupBy('user_idx');
        
        $builder = $this->db->table('icu');
        $builder->select('icu.progress_time, COUNT(*) as count');
        $builder->join('user', 'user.user_idx = icu.user_idx', 'inner');
        $builder->join("({$subQuery->getCompiledSelect()}) as latest_icu", 
                    'icu.user_idx = latest_icu.user_idx AND icu.progress_time = latest_icu.latest_progress_time', 
                    'inner');
        
        // 등급에 따른 필터링
        if ($grade == 1) {
            // Distributor: 하위 에이전트들의 사용자 데이터 가져오기
            $builder->whereIn('user.parent_idx', function ($query) use ($userIdx) {
                return $query->select('user_idx')
                            ->from('user')
                            ->where('grade', 2)
                            ->where('parent_idx', $userIdx);
            });
        } elseif ($grade == 2) {
            // Agent: 자신의 사용자만 가져오기
            $builder->where('user.parent_idx', $userIdx);
        }

        // `progress_time`별 그룹화
        $builder->groupBy('icu.progress_time');
        return $builder->get()->getResultArray();
    }
}


    