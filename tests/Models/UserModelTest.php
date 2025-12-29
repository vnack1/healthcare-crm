<?php

use CodeIgniter\Test\CIUnitTestCase;
use App\Models\UserModel;

class UserModelTest extends CIUnitTestCase
{
    public function testCanGetAllUsers()
    {
        $userModel = new UserModel();
        $users = $userModel->findAll();

        $this->assertIsArray($users); // 데이터가 배열인지 확인
    }
}