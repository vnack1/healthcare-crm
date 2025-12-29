<?php

namespace App\Controllers;


use App\Models\NoticeModel;
use CodeIgniter\Controller;

class NoticeController extends Controller
{
    protected $noticeModel;

    public function __construct()
    {
        $this->noticeModel = new NoticeModel();
    }

    // 공지사항 리스트 페이지
    public function list()
    {
        $notices = $this->noticeModel->findAll();
        $user_idx = session()->get('user_idx');
        $grade = session()->get('grade');

        // 페이지네이션 설정
        $perPage = 10; // 한 페이지에 표시할 공지사항 수
        $currentPage = $this->request->getGet('page') ?? 1; // 현재 페이지 가져오기
        $offset = ($currentPage - 1) * $perPage;

        // 전체 공지사항 개수
        $totalRecords = $this->noticeModel->countAllResults();

        // 현재 페이지 공지사항 가져오기
        $notices = $this->noticeModel->orderBy('create_at', 'DESC')
            ->findAll($perPage, $offset);

        // 총 페이지 수 계산
        $totalPages = ceil($totalRecords / $perPage);

        // 기존 쿼리 스트링 유지 (검색 조건 등)
        $pageQuery = http_build_query($this->request->getGet()) . "&page=" . $currentPage;

        // 뷰에 데이터 전달
        return view('notice/notice_list', [
            'notices' => $notices, // 현재 페이지 공지사항 데이터
            'user' => $user_idx, // 사용자 ID
            'grade' => $grade, // 사용자 등급
            'currentPage' => $currentPage, // 현재 페이지 번호
            'totalPages' => $totalPages, // 총 페이지 수
            'perPage' => $perPage, // 한 페이지당 공지사항 수
            'totalRecords' => $totalRecords, // 전체 공지사항 수
            'pageQuery' => $pageQuery, // 쿼리 스트링
        ]);

    }

    // 공지사항 세부 내역 페이지
    public function detail($noticeIdx)
    {
        $notice = $this->noticeModel->find($noticeIdx);

        if (!$notice) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Notice not found');
        }
        // 이전 공지사항 가져오기
        $previousNotice = $this->noticeModel
        ->where('notice_idx <', $notice['notice_idx'])
        ->orderBy('notice_idx', 'DESC')
        ->first();

        // 다음 공지사항 가져오기
        $nextNotice = $this->noticeModel
        ->where('notice_idx >', $notice['notice_idx'])
        ->orderBy('notice_idx', 'ASC')
        ->first();

        // 뷰로 데이터 전달
        return view('notice/notice_detail', [
        'notice' => $notice,
        'previousNotice' => $previousNotice,
        'nextNotice' => $nextNotice,
        ]);
            }

    // 공지사항 등록 페이지 (슈퍼 어드민만 접근 가능)
    public function enroll()
    {
    $grade = session()->get('grade'); // 사용자 등급 가져오기

        if ($grade !== 0) {
            return redirect()->to('/notice/notice-list')->with('error', 'You do not have permission to access this page.');
        }

        return view('notice/notice_write');
    }

    // 공지사항 등록 처리 (슈퍼 어드민만 가능)
    public function store()
    {
        $grade = session()->get('grade');
        $user_name = session()->get('user_name'); // 작성자 이름 가져오기

        // ref_menu와 ref 파라미터 유지
        $refMenu = $data['ref_menu'] ?? '';
        
        if ($grade !== 0) {
            return redirect()->to('/notice/notice-list')->with('error', 'You do not have permission to perform this action.');
        }
        

        $data = [
            'title' => $this->request->getPost('title'),
            'content' => $this->request->getPost('content'),
            'write_name' => $user_name,
            'create_at' => date('Y-m-d H:i:s')
        ];

        if ($this->noticeModel->insert($data)) {
            echo "<script>alert('공지사항이 등록되었습니다!');
            window.location.href = '/notice/notice-list';
            </script>";
        } else {
            return redirect()->to(base_url('notice/notice-list') . '?ref_menu=' . $refMenu)->with('error', '글 작성에 실패');
        }
    }
    
    // 공지사항 수정 페이지 (슈퍼 어드민만)
    public function modify($noticeIdx)
    {
        $grade = session()->get('grade');

        if ($grade !== 0) {
            return redirect()->to('/notice/notice-list')->with('error', '접근 권한이 없습니다.');
        }

        $notice = $this->noticeModel->find($noticeIdx);

        if (!$notice) {
            return redirect()->to('/notice/notice-list')->with('error', '공지사항을 찾을 수 없습니다.');
        }

        $data = ['notice' => $notice];

        return view('notice/notice_modify', $data);
    }

    // 공지사항 수정 처리
    public function update($noticeIdx)
    {
        $grade = session()->get('grade');
        
        // ref_menu와 ref 파라미터 유지
        $refMenu = $data['ref_menu'] ?? '';
        
        if ($grade !== 0) {
            return redirect()->to('/notice/notice-list')->with('error', '공지사항 수정 권한이 없습니다.');
        }

        $data = [
            'title' => $this->request->getPost('title'),
            'content' => $this->request->getPost('content'),
            'update_at' => date('Y-m-d H:i:s')
        ];

        if ($this->noticeModel->update($noticeIdx, $data)) {
            echo "<script>alert('수정이 완료되었습니다!');
            window.location.href = '/notice/notice-list';
            </script>";
            exit();
        } else {
            return redirect()->back()->withInput()->with('error', '공지사항을 수정하는 도중 오류가 발생했습니다.');
        }
    }

    // 공지사항 삭제 (슈퍼 어드민만)
    public function delete($noticeIdx)
    {
        $grade = session()->get('grade');

        if ($grade !== 0) {
            return redirect()->to('/notice/notice-list')->with('error', '공지사항 삭제 권한이 없습니다.');
        }

        if ($this->noticeModel->delete($noticeIdx)) {
            echo "<script>alert('삭제가 완료되었습니다!');
            window.location.href = '/notice/notice-list';
            </script>";
            exit();
        } else {
            return redirect()->to('/notice/notice-list')->with('error', '공지사항을 삭제하는 도중 오류가 발생했습니다.');
        }
    }
}