<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class CheckRememberMe implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // 세션이 없고 remember_token 쿠키가 있는 경우 자동 로그인 처리
        if (!session()->has('logged_in') && isset($_COOKIE['remember_token'])) {
            $token = $_COOKIE['remember_token'];
            $userModel = model('App\Models\UserModel'); // UserModel 초기화

            // 데이터베이스에서 토큰 확인
            $user = $userModel->where('remember_token', $token)->first();

            if ($user) {
                // 세션 설정
                session()->set([
                    'user_idx' => $user['user_idx'],
                    'user_id' => $user['user_id'],
                    'user_name' => $user['user_name'],
                    'logged_in' => true
                ]);

                // 로그인 성공 시 리다이렉트
                return redirect()->to('/dashboard');
            }
        }

        // 로그인 상태가 아니고 remember_token이 없으면 계속 진행
        return null;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // After 필터는 필요하지 않으므로 비워둡니다.
    }
}
