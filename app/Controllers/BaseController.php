<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Models\UserModel; // UserModel 네임스페이스 추가

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    protected $userModel;
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var list<string>
     */
    protected $helpers = [];

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    // protected $session;

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {

        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = \Config\Services::session();
                // UserModel 초기화
                // $this->userModel = new UserModel();

                // 자동 로그인 로직 실행
                // $this->autoLogin();

    }
 /**
     * 자동 로그인 로직
     *
     * @return void
     */
    // protected function autoLogin()
    // {
    //     // 세션이 없고 remember_token 쿠키가 있는 경우
    //     if (!session()->has('logged_in') && isset($_COOKIE['remember_token'])) {
    //         $token = $_COOKIE['remember_token'];

    //         // 데이터베이스에서 토큰 확인
    //         $user = $this->userModel->where('remember_token', $token)->first();

    //         if ($user) {
    //             // 세션 설정
    //             session()->set([
    //                 'user_idx' => $user['user_idx'],
    //                 'user_id' => $user['user_id'],
    //                 'user_name' => $user['user_name'],
    //                 'grade' => $user['grade'],
    //                 'logged_in' => true,
    //             ]);
    //         } else {
    //             // 유효하지 않은 토큰일 경우 쿠키 삭제
    //             setcookie('remember_token', '', time() - 3600, '/');
    //         }
    //     }
    // }
}
