<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user'; // 테이블 이름
    protected $primaryKey = 'user_idx'; // 기본 키

    // 데이터 삽입/업데이트 시 허용할 필드 목록
    protected $allowedFields = [
        'user_id', 'password', 'user_name', 'gender', 'birth_date', 'postcode',
        'phone', 'email', 'address', 'address_detail', 'notes', 'member_code', 
        'grade', 'parent_idx', 'create_at', 'update_at','remember_token',
        'remember_token_created_at'
    ];

    // 특정 총판의 사용자 가져오기
    public function getDistributers()
    {
        return $this->where('grade', 1)->findAll(); // 총판 등급의 사용자 반환
    }

    // 특정 대리점의 사용자 가져오기
    public function getAgents()
    {
        return $this->where('grade', 2)->findAll(); // 대리점 등급의 사용자 반환
    }

    // 특정 parent_idx로 사용자를 가져오는 메서드
    public function getUsersByParent($parentCode)
    {
        return $this->where('parent_idx', $parentCode)->findAll();
    }

    // member_code로 사용자 찾기
    public function getUserByMemberCode($memberCode)
    {
        return $this->where('member_code', $memberCode)->first();
    }

    // 현재 날짜 기준 2주 이내에 가입한 grade가 3인 회원 가져오기
    public function getRecentUsers()
    {
        $twoWeeksAgo = date('Y-m-d H:i:s', strtotime('-2 weeks'));
        return $this->where('create_at >=', $twoWeeksAgo)
                    ->where('grade', 3)
                    ->orderBy('create_at', 'DESC')
                    ->findAll();
    }
    // 최근 가입 여부 확인
    public function isRecentUser($createAt)
    {
        $twoWeeksAgo = date('Y-m-d H:i:s', strtotime('-2 weeks'));
        return $createAt >= $twoWeeksAgo;
    }
    // 특정 parent_idx와 2주 이내에 가입한 회원 가져오기
    public function getRecentUsersByParent($parentIdx)
    {
        $twoWeeksAgo = date('Y-m-d H:i:s', strtotime('-2 weeks'));
        return $this->where('parent_idx', $parentIdx)
                    ->where('create_at >=', $twoWeeksAgo)
                    ->orderBy('create_at', 'DESC')
                    ->findAll();
    }

    // 총판, 대리점, 회원 리스트 조회 메서드
    public function getUsersByCriteria($grade, $user_idx = null, $searchConditions = [])
{
    $query = $this->where('grade', $grade); // 특정 등급만 불러옴

    if ($user_idx !== null) {
        if (session()->get('grade') === 0) {
            // 슈퍼어드민은 모든 사용자 조회 가능
        } elseif (session()->get('grade') === 1) {
            if ($grade === 2) {
                // 총판이 대리점 리스트를 가져올 때
                $query->where('parent_idx', $user_idx);
            } elseif ($grade === 3) {
                // 총판이 하위 대리점의 회원 리스트를 가져올 때
                $query->whereIn('parent_idx', function($subQuery) use ($user_idx) {
                    return $subQuery->select('user_idx')
                                    ->from('user')
                                    ->where('parent_idx', $user_idx)
                                    ->where('grade', 2); // 하위 대리점만 가져오기
                });
            }
        } elseif (session()->get('grade') === 2) {
            // 대리점의 경우, 자신의 하위 회원만 가져옴
            $query->where('parent_idx', $user_idx);
        }
    }

   // 검색 조건 적용
foreach ($searchConditions as $field => $value) {
    if (!empty($value) || $value === '0') { // '0'도 유효한 값으로 처리
        if ($field === 'user_name' || $field === 'phone' || $field === 'user_id') {
            $query->like($field, $value); // 부분 일치 검색
        } elseif ($field === 'gender') {
            if ($value === '0' || $value === '1') {
                $query->where($field, $value); // 남자(0) 또는 여자(1)만 조회
            }
        } elseif ($field === 'birth_date') {
            $query->where($field, $value); // 정확한 날짜 검색
        }
    }
}

    // gender 값이 아예 없으면 전체 조회 (0, 1 포함)
    if (!isset($searchConditions['gender']) || $searchConditions['gender'] === null) {
    $query->whereIn('gender', [0, 1]);
}

    if (!empty($searchConditions['start_date']) && !empty($searchConditions['end_date'])) {
        $query->where("DATE_FORMAT(create_at, '%Y-%m-%d') BETWEEN '{$searchConditions['start_date']}' AND '{$searchConditions['end_date']}'");
    }
    $query->orderBy('create_at', 'DESC');
    return $query->findAll();
}

   // 아이디 중복 확인 메서드
   public function isUserIdExists($userId)
   {
       return $this->where('user_id', $userId)->first() !== null;
   }

      // 이메일 중복 확인 메서드
      public function isEmailExists($email)
      {
          return $this->where('email', $email)->first() !== null;
      }

    // 상위 사용자의 이름 불러오기
    public function getParentName($userIdx)
    {
        return $this->select('user_name')
                    ->where('user_idx', function ($query) use ($userIdx) {
                        $query->select('parent_idx')
                            ->from('user')
                            ->where('user_idx', $userIdx);
                    })
                    ->first();
    }

  }