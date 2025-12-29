<?php

namespace App\Models;

use CodeIgniter\Model;

class CertModel extends Model
{
  protected $table = "cert_history";
  protected $primaryKey = "cert_hist_idx";

  protected $allowedFields = ["receiver", "cert_num", "msg_id", "result_code", "creted_at", "update_at"];

  public function selectResultCode($inputedCertNum, $chi)
  {
    $builder = $this->db->table($this->table);
    return $builder->select('result_code')->where('cert_num', $inputedCertNum)->where('cert_hist_idx', $chi)->get()->getRow();
  }

  public function updateCertCompleted($chi)
  {
    $builder = $this->db->table($this->table);
    return $builder->where('cert_hist_idx', $chi)->update(['cert_completed' => 1]);
  }
}