<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Services\UserService;
use CodeIgniter\Controller;


class Auth extends Controller
{
    protected $userModel;
    protected $userService;

    public function __construct()
    {
        $this->userModel = new UserModel(); // UserModel 초기화
        $this->userService = new UserService();
    }

    // 랜딩페이지 표시 
    public function landing()
    {
        return view('auth/landing');
    }

    // 로그인 페이지 표시
    public function login()
    {
        return view('auth/login');
    }

    public function authenticate()
    {
        $userId = $this->request->getPost('user_id');
        $password = $this->request->getPost('password');

        // 유효성 검사
        if (empty($userId)) {
            return redirect()->back()->with('error', '아이디를 입력해주세요.');
        }

        if (empty($password)) {
            return redirect()->back()->with('error', '비밀번호를 입력해주세요.');
        }

        // 사용자 인증 로직
        $user = $this->userModel->where('user_id', $userId)->first();

        if (!$user) {
            return redirect()->back()->with('error', '아이디 또는 비밀번호가 잘못되었습니다.');
        }

        if ($user && password_verify($password, $user['password'])) {
            // 세션에 사용자 정보 저장
            session()->set([
                'user_idx' => $user['user_idx'],
                'user_id' => $user['user_id'],
                'member_code' => $user['member_code'],
                'user_name' => $user['user_name'],
                'grade' => (int) $user['grade'],
                'logged_in' => true
            ]);


            // 리디렉션
            return redirect()->to('/dashboard');
        } else {
            return redirect()->back()->with('error', '아이디 또는 비밀번호가 잘못되었습니다.');
        }
    }

    // 로그아웃 처리
    public function logout()
    {

        // 로그인 페이지로 리다이렉트
        return redirect()->to('/login')->with('message', '로그아웃되었습니다.');
    }

    // 문자인증
    public function getCertNum(): string
    {
        $data = json_decode($this->request->getBody(), associative: true);
        $resp = "";
        if (isset($data['phoneNumber'])) {
            $resp = $this->userService->sendCertNum($data['phoneNumber']);
        }
        return $resp;
    }
    public function checkCertNum(): string
    {
        $data = json_decode($this->request->getBody(), associative: true);
        $resp = "";
        if (isset($data['inputedCertNum']) && isset($data['chi'])) {
            $resp = $this->userService->checkCertNum($data['inputedCertNum'], $data['chi']);
        }
        return $resp;
    }
}