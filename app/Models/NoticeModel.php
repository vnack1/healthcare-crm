<?php 
namespace App\Models;

use CodeIgniter\Model;

class NoticeModel extends Model
{
    protected $table = 'notice'; //테이블 명 설정 
    protected $primaryKey = 'notice_idx'; // 테이블 인덱스 설정 
    protected $allowedFields = ['title', 'content', 'write_name', 'create_at', 'update_at']; // 허용 필드

    
 
    // 타임스탬프 자동 관리 활성화
    protected $useTimestamps = true;
    protected $createdField = 'create_at';
    protected $updatedField = 'update_at';


    // 데이터베이스에서 공지사항 리스트를 가져오는 메서드
    public function getNotices()
    {
        return $this->orderBy('create_at', 'DESC')->findAll();
    }

    // 특정 공지사항을 가져오는 메서드
    public function getNotice($id)
    {
        return $this->find($id);
    }
    
    public function getRecentNotices($limit = 3)
    {
        return $this->orderBy('created_at', 'DESC')
                    ->limit($limit)
                    ->findAll();
    }   
}

?>