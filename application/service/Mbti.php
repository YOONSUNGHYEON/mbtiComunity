<?php
require_once ($_SERVER["DOCUMENT_ROOT"] . '/mbtiCommunity/application/DAO/Mbti.php');

class MbtiService
{
    private $oMbtiDAO;
 
    function __construct() {
        $this->oMbtiDAO = new MbtiDAO();

    }  
    public function findMbtiList() {
        $aMbtiList = $this->oMbtiDAO->findMbtiList();
        if ($aMbtiList != NULL) {
            return $aMbtiList;
        } else {
            return "가져올 mbti 옵션이 없습니다.";
        }
    }

    public function findNameById($nId) {
        $sMbtiName = $this->oMbtiDAO->findNameById($nId);
        if ($sMbtiName != NULL) {
            return $sMbtiName;
        } else {
            return "가져올 mbti 이름이 없습니다.";
        }
    }
}
