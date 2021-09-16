<?php
require_once 'application/DAO/Mbti.php';
session_start();

class MbtiService
{

    public function findMbtiList()
    {
        $oMbtiDAO = new MbtiDAO();
        $aMbtiList = $oMbtiDAO->findMbtiList();
        if ($aMbtiList != NULL) {
            return $aMbtiList;
        } else {
            return "가져올 mbti 옵션이 없습니다.";
        }
    }

    public function findNameById($nId)
    {
        $oMbtiDAO = new MbtiDAO();
        $sMbtiName = $oMbtiDAO->findNameById($nId);
        if ($sMbtiName != NULL) {
            return $sMbtiName;
        } else {
            return "가져올 mbti 이름이 없습니다.";
        }
    }
}
