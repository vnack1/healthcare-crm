<?php

namespace App\Controllers;
use App\Models\UserModel;

class UserController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        // UserModel 인스턴스를 생성하여 $userModel 속성에 저장.
        $this->userModel = new UserModel();
    }

    // 모든 사용자 조회
    public function index()
    {
        // UserModel을 사용하여 모든 사용자 데이터를 조회
        $users = $this->userModel->findAll();

        // 조회한 사용자 데이터를 JSON 형식으로 반환
        return $this->response->setJSON($users);
    }

    // 새로운 사용자 생성
    public function create()
    {
        $data = $this->request->getPost();
        $user_idx = session()->get('user_idx'); // 현재 로그인한 사용자 가져오기

        // 현재 사용자가 총판이나 대리점이라면 그 사용자의 user_idx를 parent_idx로 설정
        if (session()->get('grade') === 1 || session()->get('grade') === 2) {
            $data['parent_idx'] = $user_idx;
        }

        // 새로운 사용자 데이터 저장
        $this->userModel->save($data);

        // 사용자 생성 성공 메시지 반환
        return $this->response->setJSON(['message' => 'User created successfully']);
    }

    // 특정 사용자 조회
    public function show($member_code)
    {
        $user = $this->userModel->where('member_code', $member_code)->first();

        if (!$user) {
            return $this->response->setJSON(['error' => 'User not found']);
        }
        // user_detail에 $user 변수를 user라는 키로 전달. 특정 member_code로 조회된 사용자 정보.
        return view('user_management/user_detail', ['user' => $user]);
    }

    // 특정 사용자 업데이트
    public function update($member_code)
    {
        $data = $this->request->getPost();
        $user = $this->userModel->where('member_code', $member_code)->first();

        if ($user) {
            $this->userModel->update($user['user_idx'], $data);
            return redirect()->to("/user-management/user-detail/$member_code")->with('message', '회원 정보가 성공적으로 수정되었습니다.');
        } else {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('User not found');
        }
    }

    // 특정 사용자 삭제
    public function delete($member_code)
    {
        $user = $this->userModel->where('member_code', $member_code)->first();

        if ($user) {
            $this->userModel->delete($user['user_idx']);
            return $this->response->setJSON(['message' => 'User deleted successfully']);
        } else {
            return $this->response->setJSON(['error' => 'User not found']);
        }
    }
}