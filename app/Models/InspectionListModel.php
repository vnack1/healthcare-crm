<?php

namespace App\Models;

use CodeIgniter\Model;

class InspectionListModel extends Model
{
    protected $table = 'inspection_list'; // 테이블 이름
    protected $primaryKey = 'inspect_idx'; // 기본 키
    protected $allowedFields = ['inspect_idx', 'inspection_name', 'create_at', 'update_at']; // 허용된 필드

    // 모든 검사항목 가져오기
    public function getAllInspections()
    {
        return $this->findAll();
    }

    // 특정 검사항목 가져오기
    public function getInspectionById($id)
    {
        return $this->find($id);
    }
}