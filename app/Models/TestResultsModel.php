<?php

namespace App\Models;

use CodeIgniter\Model;

class TestResultsModel extends Model
{
    protected $table = 'test_results'; // 테이블 이름
    protected $primaryKey = 'test_idx'; // 기본 키
    protected $allowedFields = ['icu_idx', 'inspect_idx', 'assessment', 'create_at', 'update_at']; // 허용된 필드

    // 특정 ICU와 연결된 검사 결과 가져오기
    public function getResultsByIcu($icuIdx)
    {
        return $this->where('icu_idx', $icuIdx)->findAll();
    }

    // 특정 검사 항목에 대한 결과 가져오기
    public function getResultsByInspection($inspectIdx)
    {
        return $this->where('inspect_idx', $inspectIdx)->findAll();
    }

    // 검사 결과 저장 또는 업데이트
    public function saveTestResult($data)
    {
        return $this->save($data); // CodeIgniter의 save 메서드를 사용하여 데이터 저장/업데이트
    }
}