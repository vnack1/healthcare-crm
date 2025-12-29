<?php

namespace App\Controllers;

use CodeIgniter\Exceptions\PageNotFoundException;

class Pages extends BaseController
{
    public function index(): string
    {
        return view('welcome_message'); // 기본 환영 페이지
    }

    // 특정 페이지를 동적으로 렌더링
    public function view($page = 'home')
    {
        $viewPath = APPPATH . 'Views/pages/' . $page . '.php';

        // 뷰 파일이 없으면 404 에러
        if (!is_file($viewPath)) {
            throw new PageNotFoundException($page);
        }

        $data['title'] = ucfirst($page); // 페이지 제목 (첫 글자를 대문자로)

        return view('templates/header', $data)
             . view('pages/' . $page);
    }

    public function getModalContent($page)
    {
        $allowedPages = ['terms', 'privacy']; // 허용된 페이지 리스트
        if (!in_array($page, $allowedPages)) {
            return $this->response->setStatusCode(403, 'Unauthorized access');
        }
    
        // 파일 경로 지정
        $filePath = APPPATH . "Views/pages/{$page}.php";
    
        if (!file_exists($filePath)) {
            return $this->response->setStatusCode(404, 'Page not found');
        }
    
        // 파일 내용을 가져옴
        $content = file_get_contents($filePath);
    
        // `main` 태그 포함된 모든 내용 제거
        $content = preg_replace('/<div id="main">.*?<header class="mb-3">/s', '', $content); // `main` 태그 이전 부분 제거
        $content = preg_replace('/<\/section>\s*<\/div>\s*<\/div>/s', '', $content); // `main` 태그 이후 부분 제거
    
        // 필요 없는 `header`, `sidebar`, `footer`를 추가로 제거
        $content = preg_replace('/<\?=\s*\$this->include\(\'templates\/header\'\)\s*\?>/i', '', $content);
$content = preg_replace('/<\?=\s*\$this->include\(\'templates\/sidebar\'\)\s*\?>/i', '', $content);
    $content = preg_replace('/<\?=\s*\$this->include\(\'templates\/footer\'\)\s*\?>/i', '', $content);

        // 결과 반환
        return $this->response->setBody($content);
        }
        }