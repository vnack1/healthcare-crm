<?php

use App\Controllers\Dashboard;
use App\Controllers\UserController;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//랜딩 페이지 
$routes->get('/','Auth::landing');

// 로그인/로그아웃 처리 
$routes->get('/login', 'Auth::login' ); // 로그인 페이지
$routes->post('/login', 'Auth::authenticate'); // 로그인 처리
$routes->post('/logout', 'Auth::logout'); // 로그아웃

// 통합 대시보드 
$routes->get('/dashboard', 'DashboardController::dashboard',);

// 총판 관리
$routes->get('user-management/distributer/distributerlist', 'UserManagement::distributerList'); // 총판 리스트
$routes->get('user-management/distributer/distributer-detail/(:any)', 'UserManagement::distributerDetail/$1'); // 총판 상세 정보 보기
$routes->post('user-management/distributer/update/(:any)', 'UserManagement::updateDistributer/$1'); // 총판 수정 처리
$routes->get('/user-management/distributer/distributer-edit/(:any)', 'UserManagement::distributerEdit/$1'); // 수정 화면
$routes->get('user-management/distributer/enroll', 'UserManagement::registerDistributerForm'); // 총판 등록 페이지
$routes->post('user-management/distributer/enroll', 'UserManagement::registerDistributer'); // 총판 등록 처리

// 대리점 관리
$routes->get('user-management/agent/agentlist', 'UserManagement::agentList'); // 대리점 리스트
$routes->get('user-management/agent/agent-detail/(:any)', 'UserManagement::agentDetail/$1'); // 대리점 상세 정보 보기
$routes->post('user-management/agent/update/(:any)', 'UserManagement::updateAgent/$1'); // 대리점 수정 처리
$routes->get('user-management/agent/agent-edit/(:any)', 'UserManagement::agentEdit/$1'); // 대리점 수정 화면
$routes->get('user-management/agent/enroll', 'UserManagement::registerAgentForm'); // 대리점 등록 페이지
$routes->post('user-management/agent/enroll', 'UserManagement::registerAgent'); // 대리점 등록 처리


// 회원 관리
$routes->get('user-management/user/list', 'UserManagement::userList'); // 회원 리스트
$routes->get('user-management/user/detail/(:segment)', 'UserManagement::userDetail/$1'); // 회원 상세 정보 보기
$routes->post('user-management/user/update/(:segment)', 'UserManagement::updateUser/$1'); // 회원정보 수정 처리하기
$routes->get('user-management/user/user-edit/(:segment)', 'UserManagement::userEdit/$1'); // 회원 수정 화면
$routes->get('user-management/user/enroll', 'UserManagement::registerForm'); // 회원 등록 페이지
$routes->post('user-management/user/enroll', 'UserManagement::registerUser'); // 회원 등록 처리
$routes->get('user-management/user/recent', 'UserManagement::recentUsers'); // 최근 가입 회원 페이지

// 마이페이지
$routes->get('/mypage/detail', 'UserManagement::mypageDetail'); // 마이페이지 상세 정보 보기
$routes->get('/mypage/edit', 'UserManagement::mypageEdit'); // 마이페이지 수정 화면
$routes->post('/mypage/update', 'UserManagement::mypageUpdate'); // 마이페이지 수정 처리하기

// 중복처리 
$routes->post('user/check-duplicate','UserManagement::checkDuplicate'); // 아이디 중복 확인
$routes->post('user/check-duplicate-email','UserManagement::checkDuplicateEmail'); // 이메일 중복 확인
$routes->post('user-management/check-member-code', 'UserManagement::checkMemberCode'); // 멤버코드 중복 확인

//건강관리 대시보드
$routes-> get('healthcare_management/dashboard', 'DashboardController::healthcareDashboard');

// 멜로시라
$routes->get('melosira-management/all_list', 'MelosiraController::allList'); // 멜로시라 전체리스트 및 조회
$routes->get('melosira-management/melosira-detail/(:any)', 'MelosiraController::melosiraDetail/$1'); // 멜로시라 상세 정보 보기
$routes->get('melosira-management/melosira/enroll', 'MelosiraController::registerMelosiraForm'); // 멜로시라 섭취 정보 등록 페이지
$routes->post('melosira-management/melosira/enroll', 'MelosiraController::registerMelosira'); // 멜로시라 섭취 정보 등록 처리
$routes->post('updateStatus', 'MelosiraController::updateStatus'); // 주차별 상태 변경
$routes->get('melosira-management/melosira-detail/(:any)', 'MelosiraController::updateMelosira/$1'); // 멜로시라 수정 처리
$routes->get('melosira-management/complete_list', 'MelosiraController::completeList'); // 멜로시라 완료 리스트 

// I SEE YOU
$routes->get('healthcare_management/icu/iculist', 'IcuController::icuList');// 아이시유 리스트보기 
$routes->get('healthcare_management/icu/icu-detail/(:any)', 'IcuController::icuDetail/$1'); // 특정 회원 조회
$routes->get('healthcare_management/icu/icusuccesslist', 'IcuController::icuSuccessList'); // 완료 리스트
$routes->get('healthcare_management/icu/session-input/(:alphanum)/(:num)', 'IcuController::sessionInput/$1/$2'); // 회차 정보 입력 페이지
$routes->post('healthcare_management/icu/session-save/(:any)/(:any)', 'IcuController::sessionSave/$1/$2'); // 검사 정보 저장

// 공지사항
//공지사항 리스트 페이지 
$routes->get('notice/notice-list', 'NoticeController::list');
// 공지사항 상세 보기
$routes->get('notice/notice-detail/(:num)', 'NoticeController::detail/$1');
 // GET 요청만 허용
$routes->get('notice/notice-write', 'NoticeController::enroll');
$routes->post('notice/store', 'NoticeController::store'); //글 작성 데이터 처리 
$routes->get('notice/notice-modify/(:num)', 'NoticeController::modify/$1'); //공지사항 수정 페이지 
$routes->post('notice/update/(:num)', 'NoticeController::update/$1'); // 공지사항 수정 처리 
$routes->get('notice/delete/(:num)', 'NoticeController::delete/$1'); // 공지사항 삭제 처리 

// 이용약관
$routes->get('terms', 'Pages::view/terms');
$routes->get('privacy', 'Pages::view/privacy');
$routes->get('modal-content/(:segment)', 'Pages::getModalContent/$1');

// UserController 경로 추가
$routes->resource('users', ['NoticeController' => 'UserController']);
// index(), create(), show(), delete()을 각각 GET, POST, PUT, DELETE 요청에 매핑된다.

// 문자인증
$routes->post('/auth/get-cert-num','Auth::getCertNum');
$routes->post('/auth/check-cert-num','Auth::checkCertNum');