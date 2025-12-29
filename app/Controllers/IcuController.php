<?php

namespace App\Controllers;

use CodeIgniter\Controller;

use App\Models\IcuModel;
use App\Models\UserModel;
use App\Models\TestResultsModel;
use App\Models\InspectionListModel;


class IcuController extends Controller
{
    protected $icuModel;
    protected $userModel;
    protected $testResultsModel;
    protected $inspectionListModel;

    public function __construct()
    {
        $this->icuModel = new IcuModel();
        $this->userModel = new UserModel();
        $this->testResultsModel = new TestResultsModel();
        $this->inspectionListModel = new InspectionListModel();
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

    
    public function icuList()
    {
        // 세션 정보 가져오기
        $grade = session()->get('grade');
        $userIdx = session()->get('user_idx');
    
        // 검색 조건 가져오기
        $searchConditions = [
            'user_name' => $this->request->getGet('user_name'),
            'gender' => $this->request->getGet('gender') !== '' ? $this->request->getGet('gender') : null,
            'phone' => $this->request->getGet('phone'),
            'birth_date' => $this->request->getGet('birth_date'),
            'test_date' => $this->request->getGet('test_date'), // 검사일
            'progress_time' => $this->request->getGet('progress_time'), // 진행 회차
        ];
    
        // ICU 사용자 리스트 조회
        $filteredUsers = [];
    
        // 사용자 등급에 따른 데이터 필터링
        if ($grade === 0) { // 슈퍼 어드민: 모든 회원(grade=3)을 조회
            $filteredUsers = $this->icuModel->filterIcuUsers(0, null, $searchConditions);
        } elseif ($grade === 1) { // 총판: 자신의 대리점(grade=2) 아래 회원(grade=3) 조회
            // 대리점 리스트 가져오기
            $agentIds = $this->userModel->select('user_idx')
                                        ->where('parent_idx', $userIdx)
                                        ->where('grade', 2)
                                        ->get()
                                        ->getResultArray();
    
            // 대리점 ID 배열로 변환
            $agentIds = array_column($agentIds, 'user_idx');
            if (!empty($agentIds)) {
                $filteredUsers = $this->icuModel->filterIcuUsers(1, $agentIds, $searchConditions);
            }
        } elseif ($grade === 2) { // 대리점: 자신의 회원(grade=3)만 조회
            $filteredUsers = $this->icuModel->filterIcuUsers(2, $userIdx, $searchConditions);
        }
        
         // 3회차 진행 제외 처리
        $filteredUsers = array_filter($filteredUsers, function ($user) {
            return $user['progress_time'] !== '3'; // 'progress_time'이 3이 아닌 사용자만 포함
            });
        
         // 사용자 정보 마스킹 처리
        foreach ($filteredUsers as &$user) {
            $user['user_name'] = $this->maskName($user['user_name']);
            $user['phone'] = $this->maskPhoneNumber($user['phone']);
            $user['birth_date'] = $this->maskBirthDate($user['birth_date']);
        }


// 페이지네이션 설정
    $perPage = 20; // 한 페이지에 표시할 항목 수
    $currentPage = $this->request->getGet('page') ?? 1; // 현재 페이지
    $offset = ($currentPage - 1) * $perPage;

    // 총 데이터 개수 및 페이징 처리
    $totalRecords = count($filteredUsers);
    $totalPages = ceil($totalRecords / $perPage);
    $pagedData = array_slice($filteredUsers, $offset, $perPage);

    // 기존 검색 조건에 페이지 정보 추가
    $pageQuery = http_build_query($searchConditions) . "&page=" . $currentPage;

    // View로 데이터 전달
    return view('healthcare_management/icu/icu_list', [
        'icuUsers' => $pagedData,
        'currentPage' => $currentPage,
        'totalPages' => $totalPages,
        'perPage' => $perPage,
        'totalRecords' => $totalRecords,
        'pageQuery' => $pageQuery,
    ]);
}
    


    //특정 사용자 정보 보기
    public function icuDetail($member_code)
    {
   // 사용자 정보 가져오기
   $user = $this->userModel->where('member_code', $member_code)->first();

   if (!$user) {
       throw new \CodeIgniter\Exceptions\PageNotFoundException('User not found');
   }

      // ICU와 user 정보를 가져오는 부분
      $icuInfo = $this->icuModel
      ->where('user_idx', $user['user_idx'])
      ->orderBy('progress_time', 'DESC')
      ->first(); // 가장 큰 progress_time을 가진 레코드 하나만 가져옴

    // 검사 항목에 대한 결과를 가져오기
    $testResults = [];
    if ($icuInfo) {
        $testResults = $this->testResultsModel
            ->select('test_results.assessment, inspection_list.inspection_name, icu.progress_time, icu.test_date, icu.notes, test_results.inspect_idx')
            ->join('icu', 'icu.icu_idx = test_results.icu_idx')
            ->join('inspection_list', 'inspection_list.inspect_idx = test_results.inspect_idx')
            ->where('icu.user_idx', $user['user_idx'])
            ->orderBy('icu.progress_time', 'DESC')
            ->findAll(); // 모든 검사 결과를 가져옴
    }

        // View로 데이터 전달
        return view('healthcare_management/icu/icu_detail', [
            'user' => $user,
            'icuInfo' => $icuInfo,
            'testResults' => $testResults
        ]);
}

public function icuSuccessList()
{
    // 세션 정보 가져오기
    $grade = session()->get('grade');
    $userIdx = session()->get('user_idx');

    // 검색 조건 가져오기
    $searchConditions = [
        'user_name' => $this->request->getGet('user_name'),
        'gender' => $this->request->getGet('gender') !== '' ? $this->request->getGet('gender') : null,
        'phone' => $this->request->getGet('phone'),
        'birth_date' => $this->request->getGet('birth_date'),
        'test_date' => $this->request->getGet('test_date'),
        'progress_time' => 3, // 완료 항목만 필터링

    ];

    // ICU 사용자 리스트 조회
    $filteredUsers = [];

 // 사용자 등급에 따른 데이터 필터링
    if ($grade === 0) { // 슈퍼 어드민
        $filteredUsers = $this->icuModel->filterIcuUsers(0, null, $searchConditions);
    } elseif ($grade === 1) { // 총판
        $agentIds = $this->userModel->select('user_idx')
                                    ->where('parent_idx', $userIdx)
                                    ->where('grade', 2)
                                    ->get()
                                    ->getResultArray();
        $agentIds = array_column($agentIds, 'user_idx');
        if (!empty($agentIds)) {
            $filteredUsers = $this->icuModel->filterIcuUsers(1, $agentIds, $searchConditions);
        }
    } elseif ($grade === 2) { // 대리점
        $filteredUsers = $this->icuModel->filterIcuUsers(2, $userIdx, $searchConditions);
    } else {
        return redirect()->to('/')->with('error', '잘못된 접근입니다.');
    }

    // 사용자 정보 마스킹 처리
    foreach ($filteredUsers as &$user) {
        $user['user_name'] = $this->maskName($user['user_name']);
        $user['phone'] = $this->maskPhoneNumber($user['phone']);
        $user['birth_date'] = $this->maskBirthDate($user['birth_date']);
    }

    // 페이지네이션 설정
    $perPage = 20; // 한 페이지에 표시할 항목 수
    $currentPage = $this->request->getGet('page') ?? 1;
    $offset = ($currentPage - 1) * $perPage;

    // 총 데이터 개수 및 페이징 처리
    $totalRecords = count($filteredUsers);
    $totalPages = ceil($totalRecords / $perPage);
    $pagedData = array_slice($filteredUsers, $offset, $perPage);

    // 기존 검색 조건에 페이지 정보 추가
    $pageQuery = http_build_query($searchConditions) . "&page=" . $currentPage;

    // View로 데이터 전달
    return view('healthcare_management/icu/icu_success_list', [
        'icuUsers' => $pagedData,
        'currentPage' => $currentPage,
        'totalPages' => $totalPages,
        'perPage' => $perPage,
        'totalRecords' => $totalRecords,
        'pageQuery' => $pageQuery,
    ]);
}


    // 특정 회차 검사 정보 입력 페이지
    public function sessionInput($memberCode, $progressTime)
    {
        // 사용자 정보 가져오기
        $user = $this->userModel->where('member_code', $memberCode)->first();
    
        if (!$user) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('User not found');
        }
    
        // 해당 사용자와 회차 정보를 기반으로 ICU 데이터 가져오기
        $icuData = $this->icuModel
            ->where('user_idx', $user['user_idx'])
            ->where('progress_time', $progressTime)
            ->first(); // 진행 회차에 해당하는 데이터 가져오기 (없을 경우 null 반환)
            
        $testResults = $this->testResultsModel
            ->where('icu_idx', $icuData['icu_idx'] ?? 0)
            ->findAll();

        // 모든 inspection_list 데이터 가져오기
        $inspectionNames = $this->inspectionListModel->findAll();
    
        // 뷰로 데이터 전달
        return view('healthcare_management/icu/icu_session_input', [
            'user' => $user,
            'progressTime' => $progressTime,
            'icuData' => $icuData,
            'testResults' => $testResults,
            'inspectionNames' => $inspectionNames,
        ]);

  }

  

  public function sessionSave($userIdx, $progressTime)
  {
      $testDate = $this->request->getPost('test_date');
      $notes = $this->request->getPost('notes');
      $inspectionIds = $this->request->getPost('inspection_ids');
      $inspectionResults = $this->request->getPost('inspection_results');
       // POST로 전달된 ref 값 확인
       $refIcu = $this->request->getPost('ref_icu') ?? 'all';

    // 유효성 검사
    if (!$testDate || !$inspectionIds || !$inspectionResults || count($inspectionIds) !== count($inspectionResults)) {
        return redirect()->back()->with('error', '입력 데이터가 올바르지 않습니다.');
    }

        // 모델 중심 트랜잭션 처리
        $this->icuModel->transStart();

      // 진행 회차에 대한 기존 ICU 데이터가 있는지 확인
      $existingIcu = $this->icuModel
          ->where('user_idx', $userIdx)
          ->where('progress_time', $progressTime)
          ->first();
  
      $icuData = [
          'user_idx' => $userIdx,
          'progress_time' => $progressTime,
          'test_date' => $testDate,
          'notes' => $notes,
      ];
  
      if ($existingIcu) {
          // 기존 데이터가 있으면 업데이트
          $this->icuModel->update($existingIcu['icu_idx'], $icuData);
          $icuIdx = $existingIcu['icu_idx'];
      } else {
          // 기존 데이터가 없으면 새로 저장
          $this->icuModel->insert($icuData);
          $icuIdx = $this->icuModel->insertID();
      }
  

      // 검사 결과 저장 (기존 검사 결과는 삭제하고 새로 저장)
      $this->testResultsModel->where('icu_idx', $icuIdx)->delete();
  
      $testResults = [];
      foreach ($inspectionIds as $key => $inspectIdx) {
        if (!isset($inspectionResults[$inspectIdx])) {
            continue;
        }
          $testResults[] = [
              'icu_idx' => $icuIdx,
              'inspect_idx' => $inspectIdx,
              'assessment' => $inspectionResults[$inspectIdx], // 올바른 키 사용
            ];
      }
  
      if (!empty($testResults)) {
        $this->testResultsModel->insertBatch($testResults);
    }

    // 트랜잭션 완료
    $this->icuModel->transComplete();

     // 트랜잭션 실패 시 처리
     if ($this->icuModel->transStatus() === false) {
        return redirect()->back()->with('error', '데이터 저장 중 오류가 발생했습니다.');
    }

     // 사용자 정보 확인 및 리디렉션
    $user = $this->userModel->find($userIdx);
    if (!$user) {
        throw new \CodeIgniter\Exceptions\PageNotFoundException('User not found');
    }

    return redirect()->to('/healthcare_management/icu/icu-detail/' . $user['member_code'] . '?ref_icu=' . $refIcu)
                     ->with('success', '데이터가 성공적으로 저장되었습니다.');
}
}