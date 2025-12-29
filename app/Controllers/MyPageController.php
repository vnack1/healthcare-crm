<?php

namespace App\Controllers;

class MypageController extends BaseController
{
    public function detail()
    {
        $grade = session()->get('grade');
        $memberCode = session()->get('member_code');

        // 총판인 경우
        if ($grade == 1) {
            return redirect()->to("/user-management/distributer/distributerlist/$memberCode");
        }

        // 대리점인 경우
        if ($grade == 2) {
            return redirect()->to("/user-management/agent/agentlist/$memberCode");
        }

        // 그 외 (잘못된 접근)
        return redirect()->to('/login')->with('error', '잘못된 접근입니다.');
    }

    public function edit()
    {
        $grade = session()->get('grade');
        $memberCode = session()->get('member_code');

        // 총판 수정 페이지
        if ($grade == 1) {
            return redirect()->to("/user-management/distributer/distributer-edit/$memberCode");
        }

        // 대리점 수정 페이지
        if ($grade == 2) {
            return redirect()->to("/user-management/agent/agent-edit/$memberCode");
        }

        // 그 외 (잘못된 접근)
        return redirect()->to('/login')->with('error', '잘못된 접근입니다.');
    }
}