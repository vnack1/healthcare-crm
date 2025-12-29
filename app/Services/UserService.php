<?php

namespace App\Services;

use App\Models\UserModel;
use App\Models\CertModel;

class UserService
{
    protected $userModel;
    protected $certModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->certModel = new CertModel();
    }

    // 아이디 중복 확인 메서드
    public function isUserIdExists($userId)
    {
        return $this->userModel->where('user_id', $userId)->first() !== null;
    }

    // 이메일 중복 확인 메서드
    public function isEmailExists($email)
    {
        return $this->userModel->where('email', $email)->first() !== null;
    }
    
    // 문자인증
    // curl -X POST "https://apis.aligo.in/send/" --data-urlencode "key=rv2utz4m4olm8wsrjy18zpysr6ie47eg" --data-urlencode "user_id=atgpay" --data-urlencode "sender=025152026" --data-urlencode "receiver=01022820822" --data-urlencode "msg=안녕하세요~!~!. API TEST SEND" --data-urlencode "testmode_yn=Y" --data-urlencode "msg_type=SMS"

    public function sendCertNum($phoneNumber) {
        $randCertNum = $this->generateRandomNumber();

        $sms_url = "https://apis.aligo.in/send/";
        $sms['user_id'] = "atgpay";
        $sms['key'] = "rv2utz4m4olm8wsrjy18zpysr6ie47eg";
        $sms['msg'] = "안녕하세요 gsl-agency.com 고객센터 인증 안내입니다. 인증번호는 [ ".$randCertNum." ] 입니다.";
        $sms['receiver'] = str_replace("-", "", $phoneNumber);
        $sms['sender'] = "025152026";
        $sms['testmode_yn'] = "Y";
        $sms['msg_type'] = "SMS";


        $host_info = explode("/", $sms_url);
        // $port = $host_info[0] == 'https' ? 443 : 80;
        $oCurl = curl_init();
        // curl_setopt($oCurl, CURLOPT_PORT, $port);
        curl_setopt($oCurl, CURLOPT_URL, $sms_url);
        curl_setopt($oCurl, CURLOPT_POST, true);
        curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($oCurl, CURLOPT_POSTFIELDS, $sms);
        curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
        $ret = curl_exec($oCurl);
        curl_close($oCurl);

        $retArr = json_decode($ret, true);
        $rs = $this->certModel->insert([
            'receiver' => $phoneNumber,
            'cert_num' => $randCertNum,
            'msg_id' => $retArr['msg_id'],
            'result_code' => $retArr['result_code'],
        ], true);

        return $rs;
    }
    private function generateRandomNumber() {
        do {
            $number = strval(rand(100000, 999999));
            $digits = str_split($number);
        } while (max(array_count_values($digits)) > 3);
    
        return $number;
    }
    public function checkCertNum($inputedCertNum, $chi) {
        $rs = $this->certModel->selectResultCode($inputedCertNum, $chi);
        if ($rs->result_code ?? false) {            
            $this->certModel->updateCertCompleted($chi);
            return 1;
        } else {
            return 0;
        }
    }
}

?>