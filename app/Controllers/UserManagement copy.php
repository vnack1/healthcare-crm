<?php

namespace App\Controllers;

use App\Services\UserService;
use App\Models\UserModel;
use CodeIgniter\Controller;

class UserManagement extends Controller
{
    protected $userModel;
    protected $userService;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->userService = new UserService();

    }

    // 회원정보 마스킹 처리
    // 이름 마스킹
    private function maskName($name)
    {
        $length = mb_strlen($name, 'UTF-8');
        if ($length <= 1) {
            return $name; // 한 글자는 그대로 반환
        } elseif ($length === 2) {
            return mb_substr($name, 0, 1, 'UTF-8') . '*'; // 두 글자는 마지막 글자만 마스킹
        } elseif ($length === 3) {
            return mb_substr($name, 0, 1, 'UTF-8') . '*' . mb_substr($name, -1, 1, 'UTF-8'); // 중간 글자만 마스킹
        } else {
            return mb_substr($name, 0, 1, 'UTF-8') . str_repeat('*', $length - 2) . mb_substr($name, -1, 1, 'UTF-8');
        }
    }
    // 휴대폰 번호 마스킹
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

 // 총판의 수 집계
 protected function getDistributorCount()
{
    return $this->userModel->where('grade', 1)->countAllResults();
}

// 대리점 수 집계 
protected function getAgentCount($parent_idx = null)
{
    if ($parent_idx) {
        return $this->userModel->where('parent_idx', $parent_idx)->where('grade', 2)->countAllResults();
    }
    return $this->userModel->where('grade', 2)->countAllResults();
}
// 회원 수 집계
protected function getUserCount($parent_idx = null)
{
    if ($parent_idx) {
        return $this->userModel->where('parent_idx', $parent_idx)->where('grade', 3)->countAllResults();
    }
    return $this->userModel->where('grade', 3)->countAllResults();
}

// 최근 가입회원 집계 
protected function getRecentUsers($parent_idx = null)
{
    $oneMonthAgo = date('Y-m-d H:i:s', strtotime('-1 month'));
    if ($parent_idx) {
        return $this->userModel->getRecentUsersByParent($parent_idx, $oneMonthAgo);
    }
    return $this->userModel->getRecentUsers($oneMonthAgo);
}


    //대시보드 데이터 수집 메서드 

    protected function getDashboardData($grade, $user_idx = null)
    {
        $data = [];
    
        if ($grade === 0) { // 슈퍼 어드민
            $data['distributerCount'] = $this->getDistributorCount();
            $data['agentCount'] = $this->getAgentCount();
            $data['memberCount'] = $this->getUserCount();
            $recentUsers = $this->getRecentUsers();
            $data['recentUsers'] = $recentUsers;
            $data['recentUserCount'] = count($recentUsers); // 최근 가입 회원 수
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
    
            $data['recentUserCount'] = count($data['recentUsers']); // 최근 가입 회원 수
        } elseif ($grade === 2) { // 대리점
            $data['memberCount'] = $this->getUserCount($user_idx);
            $recentUsers = $this->getRecentUsers($user_idx);
            $data['recentUsers'] = $recentUsers;
            $data['recentUserCount'] = count($recentUsers); // 최근 가입 회원 수
        }
    
        return $data;
    }
    

    // 대시보드
    public function dashboard()
    {
        $user_idx = session()->get('user_idx');
        $grade = session()->get('grade');
        $data = $this->getDashboardData($grade, $user_idx);
    
        // 등급에 따른 데이터 전달
        $data['grade'] = $grade;
    
        return view('home/dashboard', $data); // 하나의 뷰 파일 사용
    }
 

   // 총판 리스트 보기 (슈퍼 어드민만 접근 가능)
   public function distributerList()
   {

    $user_idx= session()->get('user_idx');
    $grade= session()->get('grade');

       // 접근 제한: 슈퍼 어드민만 접근 가능
   if ($grade !== 0) {
       return redirect()->to('/')->with('error', 'You do not have permission to view this page.');
   }

   // 검색 조건 가져오기
   $searchConditions = [
       'user_name' => $this->request->getGet('user_name'),
       'gender' => $this->request->getGet('gender') !== '' ? $this->request->getGet('gender') : null,
       'phone' => $this->request->getGet('phone'),
       'birth_date' => $this->request->getGet('birth_date'),
       'user_id' => $this->request->getGet('user_id'),
       'start_date' => $this->request->getGet('start_date'),
       'end_date' => $this->request->getGet('end_date'),
   ];

    
   // grade가 1인 사용자 수 가져오기
   $gradeOneCount = $this->userModel->where('grade', 1)->countAllResults();

    
    $perPage = 20; // 한 페이지에 표시할 항목 수
    $currentPage = $this->request->getGet('page') ?? 1; // 현재 페이지 가져오기
    $offset = ($currentPage - 1) * $perPage;

    // 모델에서 검색 조건을 적용해 데이터 가져오기
    //    $distributers = $this->userModel->getUsersByCriteria(1, $user_idx, $searchConditions);
    

      // 전체 데이터 개수 가져오기
    $query = $this->userModel->getUsersByCriteria(1, $user_idx, $searchConditions);
    $totalRecords = count($query);// 전체 데이터 수
    $totalPages = ceil($totalRecords / $perPage); // 전체 페이지 수

    // 페이지네이션을 위한 데이터 가져오기
    $pagedData = array_slice($query, $offset, $perPage); // 현재 페이지 데이터

    $pageQuery = http_build_query(array_merge($searchConditions, ['page' => $currentPage]));

    
   // 마스킹 처리
    foreach ($pagedData as &$distributer) {
        $distributer['user_name'] = $this->maskName($distributer['user_name']);
        $distributer['phone'] = $this->maskPhoneNumber($distributer['phone']);
        $distributer['birth_date'] = $this->maskBirthDate($distributer['birth_date']);
    }

        // $pagedData를 $distributers에 매핑
        $distributers = $pagedData;

        return view('user_management/distributer/distributer_list', [
            'distributers' => $pagedData,
            'currentPage' => $currentPage,
            'totalPages' => $totalPages,
            'perPage' => $perPage,
            'totalRecords' => $totalRecords,
            'gradeOneCount' => $totalRecords,
            'pageQuery' => $pageQuery, // 검색 조건과 페이지 정보 포함 쿼리
        ]);
    }

    // 총판 등록 폼을 보여주는 메서드
    public function registerdistributerForm()
    {
            // 세션에서 grade 값 가져오기
        $grade = session()->get('grade');

             // grade가 1이 아닌 경우
    if ($grade !== 0) {
        // 에러 메시지 세션에 설정
        session()->setFlashdata('error', '총판은 최고 관리자만 등록이 가능합니다.');

        // 이전 페이지로 리다이렉트
        return redirect()->back();
    }
 

        return view('user_management/distributer/register_distributer');
    }


    // 총판 등록 처리 메서드
    public function registerdistributer()
    {
        $user_idx = session()->get('user_idx');
        $data = $this->request->getPost();

// 도메인 값 결정 (select에서 선택되었는지, custom 도메인 입력인지 확인)
$domain = $data['domain'] === 'custom' ? $data['customDomain'] : $data['domain'];

// 도메인 검증
if ($domain === 'custom' || !$domain) {
    return $this->response->setJSON(['status' => 'error', 'message' => '유효한 도메인을 입력해주세요.']);
}

// 이메일 형식으로 조합
$fullEmail = $data['email'] . '@' . $domain;

// 검증: 이메일 형식인지 확인
if (!filter_var($fullEmail, FILTER_VALIDATE_EMAIL)) {
    return $this->response->setJSON(['status' => 'error', 'message' => '유효한 이메일 주소를 입력해주세요.']);
}

        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        
        // 슈퍼 어드민인 경우, 자신의 user_idx를 parent_idx로 설정
        if (session()->get('grade') === 0) {
            $data['parent_idx'] = $user_idx;
        }

    // 멤버 코드 확인 및 추가 유효성 검사
    $prefix = strtoupper($this->request->getPost('member_code')); 

    if (!$prefix || strlen($prefix) !== 5) {
        return $this->response->setJSON([
            'status' => 'error',
            'message' => '멤버 코드는 정확히 5자리를 입력해야 합니다.'
        ]);
    }
    // 중복 체크
    $existingDistributer = $this->userModel->where('member_code', $prefix)->first();
    if ($existingDistributer) {
        return $this->response->setJSON([
            'status' => 'error',
            'message' => '이미 존재하는 멤버 코드입니다.'
        ]);
    }

        $insertData = [
                'user_id' => $data['user_id'],
                'password' => $data['password'],
                'user_name' => $data['user_name'],
                'gender' => $data['gender'],
                'birth_date' => $data['birth_date'],
                'phone' => $data['phone'],
                'email' => $fullEmail ?? null,
                'postcode' => $data['postcode'],
                'address' => $data['address'],
                'address_detail' => $data['address_detail'],
                'notes' => $data['notes'],
                'member_code' => $prefix, // 5자리 코드
                'grade' => 1,
                'parent_idx' => $user_idx
        ];
        
        if ($this->userModel->save($insertData)) {
            // 등록 성공 시 JSON 응답
            return $this->response->setJSON([
                'status' => 'success',
                'message' => '총판 등록이 성공적으로 완료되었습니다.'
            ]);
        } else {
            // 등록 실패 시 JSON 응답
            return $this->response->setJSON([
                'status' => 'error',
                'message' => '총판 등록 중 문제가 발생했습니다.'
            ]);
        }
    }


    // 총판 상세 정보 보기
    public function distributerDetail($member_code)
    {
        $distributer = $this->userModel->where('member_code', $member_code)->first();

        if (!$distributer) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('distributer not found');
        }
        // 하위 대리점 리스트 조회
        $agents = $this->userModel
        ->where('parent_idx', $distributer['user_idx']) // 총판의 user_idx를 parent_idx로 사용하는 대리점
        ->where('grade', 2) // grade가 2인 대리점만
        ->findAll();
        
        // 하위 대리점 리스트에서 이름과 핸드폰 번호 마스킹
        foreach ($agents as &$agent) {
            $agent['user_name'] = $this->maskName($agent['user_name']); // 이름 마스킹
            $agent['phone'] = $this->maskPhoneNumber($agent['phone']); // 핸드폰 번호 마스킹
        }
        // 하위 대리점 수 계산
        $agentCount = count($agents);

        return view('user_management/distributer/distributer_detail', [
        'distributer' => $distributer,
        'agents' => $agents, // 하위 대리점 리스트 전달
        'agentCount' => $agentCount // 하위 대리점 수 전달
        ]);
    }

    // 총판 수정페이지
    public function distributerEdit($member_code)
    {
    $distributer = $this->userModel->where('member_code', $member_code)->first();

    if (!$distributer) {
        throw new \CodeIgniter\Exceptions\PageNotFoundException('Distributer not found');
    }

    return view('user_management/distributer/distributer_edit', [
        'distributer' => $distributer
    ]);
    }
    
    public function updatedistributer($member_code)
    {
        $data = $this->request->getPost();
        $distributer = $this->userModel->where('member_code', $member_code)->first();
    
        if (!$distributer) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Distributer not found');
        }
    
        try {
            // 비밀번호 처리 로직
            if (!empty($data['password'])) {
                if (is_string($data['password'])) {
                    $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
                } else {
                    throw new \RuntimeException('Invalid password format');
                }
            } else {
                unset($data['password']); // 변경하지 않음
            }
    
            // 멤버코드 수정 권한 검사
            if (session()->get('grade') !== 0) {
                unset($data['member_code']); // 슈퍼어드민이 아니면 멤버코드 변경 불가
            }
    
            // 멤버코드 중복 검사 (수정된 경우만)
            if (isset($data['member_code']) && $data['member_code'] !== $member_code) {
                $existingCode = $this->userModel->where('member_code', $data['member_code'])->first();
                if ($existingCode) {
                    session()->setFlashdata('error', '멤버코드가 중복됩니다.');
                    return redirect()->back()->withInput();
                }
            }
    
            // 데이터 업데이트 시도
            if (!$this->userModel->update($distributer['user_idx'], $data)) {
                // 업데이트 실패 처리
                session()->setFlashdata('error', '총판 정보 수정에 실패했습니다. 다시 시도해주세요.');
                log_message('error', 'Failed to update distributer with data: ' . json_encode($data));
                return redirect()->back()->withInput();
            }
    
            // 성공 처리
            session()->setFlashdata('success', '총판 정보 수정이 완료되었습니다!');
            return redirect()->to('/user-management/distributer/distributerlist/' . $member_code);
        } catch (\Exception $e) {
            // 예외 처리
            session()->setFlashdata('error', '오류가 발생했습니다: ' . $e->getMessage());
            log_message('error', 'Exception occurred while updating distributer: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }
    


    // 대리점 리스트 보기 (슈퍼 어드민 및 총판만 접근 가능)
    public function agentList()
    {

    // grade가 2인 사용자들만 조회하기
    $agents = $this->userModel->where('grade', 2)->findAll();
      
    // grade가 2인 사용자 수 가져오기
    $gradeTwoCount = $this->userModel->where('grade', 2)->countAllResults();

        $user_idx = session()->get('user_idx');
        $grade = session() -> get('grade');

        // 접근 제한: 슈퍼 어드민과 총판만 접근 가능
        if ($grade !== 0 && $grade !== 1) {
            return redirect()->to('/')->with('error', 'You do not have permission to view this page.');
             }

    // 검색 조건 가져오기
    $searchConditions = [
        'user_name' => $this->request->getGet('user_name'),
        'gender' => $this->request->getGet('gender'),
        'phone' => $this->request->getGet('phone'),
        'birth_date' => $this->request->getGet('birth_date'),
        'user_id' => $this->request->getGet('user_id'),
        'start_date' => $this->request->getGet('start_date'),
        'end_date' => $this->request->getGet('end_date'),
    ];


    
    if ($grade === 1) {
        $searchConditions['parent_idx'] = $user_idx;
    }
       // 한 페이지에 표시할 항목 수
       $perPage = 20;
       $currentPage = $this->request->getGet('page') ?? 1; // 현재 페이지
       $offset = ($currentPage - 1) * $perPage;

   // 모델에서 데이터 가져오기
    $query = $this->userModel->getUsersByCriteria(2, $user_idx, $searchConditions);
    $totalRecords = count($query); // 전체 데이터 수
    $totalPages = ceil($totalRecords / $perPage); // 전체 페이지 수

    // 현재 페이지 데이터 가져오기
    $pagedData = array_slice($query, $offset, $perPage);

    // 기존 검색 조건에 페이지 정보 추가
    $pageQuery = http_build_query($searchConditions) . "&page=" . $currentPage;

    // 각 대리점의 상위 총판 이름 추가
    foreach ($pagedData as &$agent) {
        $parentDistributor = $this->userModel->getParentName($agent['user_idx']);
        $agent['parent_distributor_name'] = $parentDistributor ? $parentDistributor['user_name'] : '';
    }
    
    // 마스킹 처리
    foreach ($pagedData as &$agent) {
        $agent['parent_distributor_name'] = $this->maskName($agent['parent_distributor_name']);
        $agent['user_name'] = $this->maskName($agent['user_name']);
        $agent['phone'] = $this->maskPhoneNumber($agent['phone']);
        $agent['birth_date'] = $this->maskBirthDate($agent['birth_date']);
    }

     
    // 뷰에 전달
    return view('user_management/agent/agent_list', [
        'agents' => $pagedData,
        'currentPage' => $currentPage,
        'totalPages' => $totalPages,
        'perPage' => $perPage,
        'totalRecords' => $totalRecords,
        'gradeTwoCount' => $totalRecords,
        'pageQuery' => $pageQuery,
    ]);

    }

    // 대리점 등록 폼을 보여주는 메서드
    public function registerAgentForm()
    {
        // 세션에서 grade 값 가져오기
        $grade = session()->get('grade');

        // // grade가 1이 아닌 경우
        // if ($grade !== 1) {
        // // 에러 메시지 세션에 설정
        // session()->setFlashdata('error', '대리점은 총판만 등록이 가능합니다.');
                   
        // // 이전 페이지로 리다이렉트
        // return redirect()->back();
        //                }
                   
        return view('user_management/agent/register_agent');
    }

    // 대리점 등록 처리 메서드
    public function registerAgent()
    {
        $data = $this->request->getPost();
        $user_idx = session()->get('user_idx');
         // 이메일 조합
         $email = $data['email']; // 이메일 아이디
         $domain = ($data['domain'] === 'custom') ? $data['domain_custom'] : $data['domain']; // 직접 입력 값 우선
         $fullEmail = $email . '@' . $domain;
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);

          // 총판의 정보를 가져오기 (현재 로그인한 사용자가 총판)
        $parentDistributer = $this->userModel->find($user_idx);

        if (session()->get('grade') === 1) {
            $data['parent_idx'] = $user_idx;
        }

        // 총판의 `member_code` 가져오기
        $distributerCode = $parentDistributer['member_code'];

        // 대리점의 마지막 멤버 코드 가져오기
        $lastAgent = $this->userModel
            ->where('parent_idx', $user_idx)
            ->where('grade', 2)
            ->orderBy('member_code', 'DESC')
            ->first();

        // 대리점 코드 생성
        $lastAgentCode = $lastAgent ? substr($lastAgent['member_code'], -3) : '000';
        $newAgentCode = str_pad((int)$lastAgentCode + 1, 3, '0', STR_PAD_LEFT);

        // 최종 대리점 멤버 코드
        $memberCode = $distributerCode . $newAgentCode;

        $insertData =[
            'user_id' => $data['user_id'],
            'password' => $data['password'],
            'user_name' => $data['user_name'],
            'gender' => $data['gender'],
            'birth_date' => $data['birth_date'],
            'phone' => $data['phone'],
            'email' => $fullEmail ?? null,
            'postcode' => $data['postcode'],
            'address' => $data['address'],
            'address_detail' => $data['address_detail'],
            'notes' => $data['notes'],
            'member_code' => $memberCode, // 생성된 대리점 코드
            'grade' => 2,
            'parent_idx' => $user_idx
        ];


        if ($this->userModel->save($insertData)) {
            return redirect()->to('/user-management/agent/agentlist')->with('message', '대리점이 성공적으로 등록되었습니다.');
        }

    }

    // 대리점 상세 정보 보기
    public function agentDetail($member_code)
    {
        $agent = $this->userModel->where('member_code', $member_code)->first();

        if (!$agent) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Agent not found');
        }
        // 하위 회원 리스트 조회
        $users = $this->userModel
        ->where('parent_idx', $agent['user_idx']) // 총판의 user_idx를 parent_idx로 사용하는 대리점
        ->where('grade', 3) // grade가 2인 대리점만
        ->findAll();
        // 하위 대리점 리스트에서 이름과 핸드폰 번호 마스킹
        foreach ($users as &$user) {
            $user['user_name'] = $this->maskName($user['user_name']); // 이름 마스킹
            $user['phone'] = $this->maskPhoneNumber($user['phone']); // 핸드폰 번호 마스킹
        }
        // 하위 회원 수 계산
        $userCount = count($users);
        return view('user_management/agent/agent_detail', [
        'agent' => $agent,
        'users' => $users, // 하위 대리점 리스트 전달
        'userCount' => $userCount // 하위 대리점 수 전달
        ]);
    }
    // 대리점 수정페이지
    public function agentEdit($member_code)
    {
        // 대리점 정보 조회
        $agent = $this->userModel->where('member_code', $member_code)->first();

        if (!$agent) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Agent not found');
        }

        // 대리점 수정 뷰로 데이터 전달
        return view('user_management/agent/agent_edit', [
            'agent' => $agent
        ]);
    }
    public function updateAgent($member_code)
    {
        $data = $this->request->getPost();
    
        try {
            // 비밀번호 처리 로직
            if (!empty($data['password'])) {
                $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
            } else {
                unset($data['password']); // 비밀번호 변경하지 않음
            }
    
            // 이메일 병합
            $emailId = $data['email_id'] ?? '';
            $emailDomain = $data['email_domain'] ?? '';
            $data['email'] = $emailId . '@' . $emailDomain;
    
            unset($data['email_id'], $data['email_domain']); // 병합 후 개별 필드는 제거
    
            // 대리점 정보 업데이트
            $agent = $this->userModel->where('member_code', $member_code)->first();
            if (!$agent) {
                throw new \CodeIgniter\Exceptions\PageNotFoundException('Agent not found');
            }
    
            if ($this->userModel->update($agent['user_idx'], $data)) {
                session()->setFlashdata('success', '대리점 정보 수정이 완료되었습니다!');
                return redirect()->to('/user-management/agent/agentlist/' . esc($member_code));
            } else {
                throw new \RuntimeException('Failed to update agent information.');
            }
        } catch (\Exception $e) {
            // 예외 처리
            session()->setFlashdata('error', '오류가 발생했습니다: ' . $e->getMessage());
            log_message('error', 'Exception occurred while updating agent: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }
    
    // 회원 리스트 보기
    public function userList()
    {
        $user_idx = session()->get('user_idx');
        $grade = session()->get('grade');
    
        // 검색 조건 가져오기
        $searchConditions = [
            'user_name' => $this->request->getGet('user_name'),
            'gender' => $this->request->getGet('gender') !== '' ? $this->request->getGet('gender') : null,
            'phone' => $this->request->getGet('phone'),
            'birth_date' => $this->request->getGet('birth_date'),
            'start_date' => $this->request->getGet('start_date'),
            'end_date' => $this->request->getGet('end_date'),
        ];
    
    // grade에 따라 조건 설정
    $query = []; // 초기화
    if ($grade === 0) { // 슈퍼 어드민
        $query = $this->userModel->getUsersByCriteria(3, null, $searchConditions); // grade가 3인 모든 사용자
    } elseif ($grade === 1) { // 총판
        // 총판이 자신의 하위 대리점(agent)의 하위 유저(user) 조회
        $agents = $this->userModel->getUsersByCriteria(2, $user_idx); // 자신의 하위 대리점 가져오기
        $agentIds = array_column($agents, 'user_idx'); // 하위 대리점 ID 배열로 추출
        $query = $this->userModel
            ->whereIn('parent_idx', $agentIds) // 하위 대리점의 회원
            ->where('grade', 3) // grade가 3인 회원
            ->getUsersByCriteria(3, null, $searchConditions); // 조건 적용
    } elseif ($grade === 2) { // 대리점
        // 대리점이 자신의 하위 유저 조회
        $query = $this->userModel->getUsersByCriteria(3, $user_idx, $searchConditions);
    } else {
        $query = []; // 그 외 등급은 빈 데이터 반환
    }

    // grade가 3인 사용자 수 가져오기
    $gradeThreeCount = count($query);
    
    // 페이지네이션 설정
    $perPage = 20; // 한 페이지에 표시할 항목 수
    $currentPage = $this->request->getGet('page') ?? 1; // 현재 페이지
    $offset = ($currentPage - 1) * $perPage;
        // 총 페이지 수 계산
    $totalRecords = $gradeThreeCount; // 총 사용자 수
    $totalPages = ceil($totalRecords / $perPage);

    // 현재 페이지 데이터 가져오기
    $pagedData = array_slice($query, $offset, $perPage);

    // 기존 검색 조건에 페이지 정보 추가
    $pageQuery = http_build_query($searchConditions) . "&page=" . $currentPage;
    
    // 각 회원의 상위 대리점 이름 추가
    foreach ($pagedData as &$user) {
        $parentAgent = $this->userModel->getParentName($user['user_idx']);
        $user['parent_agent_name'] = $parentAgent ? $parentAgent['user_name'] : '';
    }
    // 마스킹 처리
    foreach ($pagedData as &$user) {
        $user['parent_agent_name'] = $this->maskName($user['parent_agent_name']);
        $user['user_name'] = $this->maskName($user['user_name']);
        $user['phone'] = $this->maskPhoneNumber($user['phone']);
        $user['birth_date'] = $this->maskBirthDate($user['birth_date']);
    }
    
    return view('user_management/user/user_list', [
        'users' => $pagedData,
        'currentPage' => $currentPage,
        'totalPages' => $totalPages,
        'perPage' => $perPage,
        'totalRecords' => $totalRecords,
        'gradeThreeCount' => $totalRecords,
        'pageQuery' => $pageQuery,
    ]);
    }

    // 회원 등록 폼을 보여주는 메서드
    public function registerForm()
    {
                // 세션에서 grade 값 가져오기
        $grade = session()->get('grade');

     // grade가 1이 아닌 경우
        if ($grade !== 2) {
        // 에러 메시지 세션에 설정
        session()->setFlashdata('error', '회원은 대리점만 등록이 가능합니다.');

        // 이전 페이지로 리다이렉트
        return redirect()->back();
    }

        return view('user_management/user/register_form');

    }

    // 회원 등록 처리 메서드
    public function registerUser()
    {
        $data = $this->request->getPost();
        $user_idx = session()->get('user_idx');
        // 이메일 조합
        $email = $data['email']; // 이메일 아이디
        $domain = ($data['domain'] === 'custom') ? $data['domain_custom'] : $data['domain']; // 직접 입력 값 우선
        $fullEmail = $email . '@' . $domain;

    // 대리점 정보 가져오기 (현재 로그인한 사용자가 대리점이어야 함)
    $parentAgent = $this->userModel->where('user_idx', $user_idx)->where('grade', 2)->first();

    if (!$parentAgent) {
        return redirect()->back()->with('error', '대리점 정보가 없거나 권한이 없습니다.');
         }

    // 대리점의 `member_code` 가져오기
    $agentCode = $parentAgent['member_code'];

    // 회원의 마지막 멤버 코드 가져오기
    $lastUser = $this->userModel
        ->where('parent_idx', $user_idx)
        ->where('grade', 3)
        ->orderBy('member_code', 'DESC')
        ->first();

    // 회원 코드 생성
    $lastUserCode = $lastUser ? substr($lastUser['member_code'], -4) : '0000';
    $newUserCode = str_pad((int)$lastUserCode + 1, 4, '0', STR_PAD_LEFT);

    // 최종 회원 멤버 코드
    $memberCode = $agentCode . $newUserCode;

        $insertData = [
        'user_name' => $data['user_name'],
        'gender' => $data['gender'],
        'birth_date' => $data['birth_date'],
        'phone' => $data['phone'],
        'email' => $fullEmail ?? null,
        'postcode' => $data['postcode'],
        'address' => $data['address'],
        'address_detail' => $data['address_detail'],
        'notes' => $data['notes'],
        'member_code' => $memberCode, // 대리점 코드와 연결된 고유 회원 코드
        'grade' => 3, // 회원 등급
        'parent_idx' => $user_idx // 상위 대리점 ID
    ];

    if ($this->userModel->save($insertData)) {
        // db insert 성공
        return redirect()->to('/user-management/user/list')->with('message', '회원이 성공적으로 등록되었습니다.');
    } else {
        // db insert 실패 
        return redirect()->to('/user-management/user/list')->with('error', '회원 등록 실패.');
    }
}

    // 최근 가입한(30일 이내) 회원 목록
    public function recentUsers()
    {
        $user_idx = session()->get('user_idx');
        $oneWeekAgo = date('Y-m-d H:i:s', strtotime('-1 week'));

       // 현재 페이지와 페이지당 데이터 수 가져오기
       $currentPage = $this->request->getGet('page') ?? 1; // 현재 페이지 (기본값: 1)
       $perPage = 20; // 한 페이지당 데이터 수
       $offset = ($currentPage - 1) * $perPage;
   


        // 사용자 데이터 가져오기
        $recentUsers = [];

        if (session()->get('grade') === 0) { // 슈퍼 어드민
            $recentUsers = $this->userModel->getRecentUsers($oneWeekAgo);
        } elseif (session()->get('grade') === 1 || session()->get('grade') === 2) { // 총판 또는 대리점
            $recentUsers = $this->userModel->getRecentUsersByParent($user_idx, $oneWeekAgo);
        }

        // 총 데이터 개수 계산
        $totalRecords = count($recentUsers); // $recentUsers 사용
        $totalPages = ceil($totalRecords / $perPage);

        // 페이지 데이터 추출
        $pagedUsers = $totalRecords > 0 ? array_slice($recentUsers, $offset, $perPage) : []; // 안전하게 빈 배열로 초기화


        // 마스킹 처리
        foreach ($pagedUsers as &$user) {
        $user['user_name'] = $this->maskName($user['user_name']);
        $user['phone'] = $this->maskPhoneNumber($user['phone']);
        $user['birth_date'] = $this->maskBirthDate($user['birth_date']);
        }

        // 페이지네이션 쿼리 구성
        $queryParams = $this->request->getGet();
        unset($queryParams['page']);
        $pageQuery = http_build_query($queryParams);

    // 뷰로 데이터 전달
    return view('user_management/user/recent_users', [
        'recentUsers' => $pagedUsers,
        'totalRecords' => $totalRecords,
        'totalPages' => $totalPages,
        'currentPage' => $currentPage,
        'perPage' => $perPage, // 추가
        'pageQuery' => $pageQuery,
    ]);

    }

    // 회원 상세 정보 보기
    public function userDetail($member_code)
    {
        $user = $this->userModel->where('member_code', $member_code)->first();
        if (!$user) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('User not found');
        }
        return view('user_management/user/user_detail', ['user' => $user]);
    }

    // 회원 수정페이지
    public function userEdit($member_code)
    {
        // 회원 정보 조회
        $user = $this->userModel->where('member_code', $member_code)->first();

        if (!$user) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Agent not found');
        }

        // 대리점 수정 뷰로 데이터 전달
        return view('user_management/user/user_edit', [
            'user' => $user
        ]);
    }

    // 회원 정보 업데이트 처리 
    public function updateUser($member_code)
    {
    $data = $this->request->getPost();

    // 이메일 병합
    $emailId = $data['email_id'] ?? '';
    $emailDomain = $data['email_domain'] ?? '';
    $data['email'] = $emailId . '@' . $emailDomain;

    unset($data['email_id'], $data['email_domain']); // 병합 후 개별 필드는 제거

    $user = $this->userModel->where('member_code', $member_code)->first();

    if ($user) {
        $this->userModel->update($user['user_idx'], $data);
        session()->setFlashdata('success', '회원 정보 수정이 완료되었습니다!');
        return redirect()->to('/user-management/user/detail/' . esc($member_code));
    } else {
        session()->setFlashdata('error', '회원 정보를 찾을 수 없습니다.');
        return redirect()->back()->withInput();
    }
    }

//아이디 중복처리 
public function checkDuplicate()
{
    $userModel = new UserModel();
    $data = json_decode($this->request->getBody(), true);
    
    $response = [];

    if (isset($data['user_id'])) {
        // 아이디 중복 확인
        $existingUser = $userModel->where('user_id', $data['user_id'])->first();
        if ($existingUser) {
            $response = [
                'status' => 'error',
                'message' => '이미 사용 중인 아이디입니다.'
            ];
        } else {
            $response = [
                'status' => 'success',
                'message' => '사용 가능한 아이디입니다.'
            ];
        }
    }
    return $this->response->setJSON($response);
}

//이메일 중복 처리 
public function checkDuplicateEmail()
{
$input = $this->request->getJSON();
$email = $input->email ?? '';

$userModel = new UserModel();
$exists = $userModel->where('email', $email)->first();

if ($exists) {
    return $this->response->setJSON([
        'status' => 'error',
        'message' => '이미 사용 중인 이메일입니다.'
    ]);
} else {
    return $this->response->setJSON([
        'status' => 'success',
        'message' => '사용 가능한 이메일입니다.'
    ]);
}
}
    // 마이페이지 상세 정보 보기
    public function mypageDetail()
    {
        $grade = session()->get('grade'); // 현재 사용자의 등급
        $memberCode = session()->get('member_code'); // 현재 사용자의 멤버 코드
    
        if (!$memberCode) {
            // 멤버 코드가 없으면 로그인 화면으로 리다이렉트
            return redirect()->to('/login')->with('error', '세션 정보가 없습니다. 다시 로그인해주세요.');
        }
    
        if ($grade === 1) { // 총판
            $distributer = $this->userModel->where('member_code', $memberCode)->first();
            if (!$distributer) {
                throw new \CodeIgniter\Exceptions\PageNotFoundException('Distributer not found');
            }
            // 총판 뷰 호출
            return view('mypage/mypage_detail', ['data' => $distributer]);
        } elseif ($grade === 2) { // 대리점
            $agent = $this->userModel->where('member_code', $memberCode)->first();
            if (!$agent) {
                throw new \CodeIgniter\Exceptions\PageNotFoundException('Agent not found');
            }
            // 대리점 뷰 호출
            return view('mypage/mypage_detail', ['data' => $agent]);
        }
    
        // 그 외 등급은 접근 불가
        return redirect()->to('/login')->with('error', '잘못된 접근입니다.');
    }

// 마이페이지 수정 페이지
public function mypageEdit()
{
    $grade = session()->get('grade');
    $memberCode = session()->get('member_code');

    if (!$memberCode) {
        // 멤버 코드가 없으면 로그인 화면으로 리다이렉트
        return redirect()->to('/login')->with('error', '세션 정보가 없습니다. 다시 로그인해주세요.');
    }
    
    if ($grade === 1) { // 총판
        $distributer = $this->userModel->where('member_code', $memberCode)->first();
        if (!$distributer) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Distributer not found');
        }
        return view('mypage/mypage_edit', ['data' => $distributer]);
    } elseif ($grade === 2) { // 대리점
        $agent = $this->userModel->where('member_code', $memberCode)->first();
        if (!$agent) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Agent not found');
        }
        return view('mypage/mypage_edit', ['data' => $agent]);
    }

    return redirect()->to('/login')->with('error', '잘못된 접근입니다.');
}

// 마이페이지 수정 처리
public function mypageUpdate()
{
    $memberCode = session()->get('member_code');
    $data = $this->request->getPost(); // POST 데이터 가져오기

    // 세션에서 사용자 확인
    if (!$memberCode) {
        return redirect()->to('/login')->with('error', '세션 정보가 없습니다. 다시 로그인해주세요.');
    }

    try {
        // 사용자의 현재 데이터 가져오기
        $user = $this->userModel->where('member_code', $memberCode)->first();

        if (!$user) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('사용자 정보를 찾을 수 없습니다.');
        }

        // 비밀번호 처리 (수정하지 않을 경우 비밀번호 제외)
        if (!empty($data['password'])) {
            if (strlen($data['password']) >= 8) {
                $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
            } else {
                return redirect()->back()->with('error', '비밀번호는 최소 8자리 이상이어야 합니다.')->withInput();
            }
        } else {
            unset($data['password']); // 비밀번호는 업데이트하지 않음
        }

        // 이메일 합치기 및 검증
        $email = $data['email'] . '@' . $data['domain'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return redirect()->back()->with('error', '올바른 이메일 주소를 입력하세요.')->withInput();
        }
        $data['email'] = $email;

        // 수정 불가 필드 제거
        unset($data['member_code']); // 멤버코드는 수정 불가

       // 데이터 업데이트
       if ($this->userModel->update($user['user_idx'], $data)) {
        // user_name 변경 시에만 세션 업데이트
        if ($user['user_name'] !== $data['user_name']) {
            session()->set('user_name', $data['user_name']);
        }
        return redirect()->to('/mypage/detail')->with('success', '정보가 성공적으로 업데이트되었습니다.');
    } else {
        throw new \RuntimeException('데이터 업데이트 중 문제가 발생했습니다.');
    }
    } catch (\Exception $e) {
        log_message('error', 'mypageUpdate() 오류: ' . $e->getMessage());
        return redirect()->back()->with('error', '오류가 발생했습니다. 다시 시도해주세요.')->withInput();
    }
}
    // public function exportExcel()
    // {
    //     // 선택된 사용자 데이터 가져오기
    //     $selectedUsers = $this->request->getPost('selected');
    //     if (empty($selectedUsers)) {
    //         return redirect()->back()->with('error', '엑셀로 내보낼 데이터를 선택하세요.');
    //     }

    //     // 데이터베이스에서 선택된 사용자 정보 가져오기
    //     $userModel = new \App\Models\UserModel();
    //     $users = $userModel->whereIn('member_code', $selectedUsers)->findAll();

    //     // 엑셀 생성
    //     $spreadsheet = new Spreadsheet();
    //     $sheet = $spreadsheet->getActiveSheet();

    //     // 헤더 설정
    //     $sheet->setCellValue('A1', '번호');
    //     $sheet->setCellValue('B1', '이름');
    //     $sheet->setCellValue('C1', '성별');
    //     $sheet->setCellValue('D1', '전화번호');
    //     $sheet->setCellValue('E1', '생년월일');
    //     $sheet->setCellValue('F1', '아이디');
    //     $sheet->setCellValue('G1', '가입일시');

    //     // 사용자 데이터 추가
    //     $row = 2; // 데이터는 2번째 줄부터 시작
    //     $rowIndex = 1; // 순서 번호 시작
    //     foreach ($users as $user) {
    //         $sheet->setCellValue('A' . $row, $rowIndex);
    //         $sheet->setCellValue('B' . $row, $user['user_name']);
    //         $sheet->setCellValue('C' . $row, $user['gender'] == 0 ? '남성' : '여성');
    //         $sheet->setCellValue('D' . $row, $user['phone']);
    //         $sheet->setCellValue('E' . $row, $user['birth_date']);
    //         $sheet->setCellValue('F' . $row, $user['user_id']);
    //         $sheet->setCellValue('G' . $row, $user['create_at']);
    //         $row++;
    //         $rowIndex++;
    //     }

    //     // 엑셀 파일 다운로드
    //     $writer = new Xlsx($spreadsheet);
    //     $filename = 'distributer_data_' . date('YmdHis') . '.xlsx';

    //     // 파일 다운로드를 위한 헤더 설정
    //     header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    //     header('Content-Disposition: attachment;filename="' . $filename . '"');
    //     header('Cache-Control: max-age=0');

    //     $writer->save('php://output');
    //     exit;
    // }

}



    

    