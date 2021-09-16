<?php
require_once 'application/service/Mbti.php';
$oMbtiController = new MbtiController();
if ($_GET['method'] == 'findMbtiList') {
    echo $oMbtiController->findMbtiList();
}
else if($_GET['method'] == 'findNameById') {
    echo $oMbtiController->findNameById($_GET['id']);
}

class MbtiController
{
    public function findNameById($nId) {
        $oMbtiService = new MbtiService();
        $sMbtiName = $oMbtiService->findNameById($nId);
        return $sMbtiName;
    }

    public function findMbtiList() {
        $oMbtiService = new MbtiService();
        $aMbtiOtionList = $oMbtiService->findMbtiList();
        $mbtiData[] = array();
        foreach($aMbtiOtionList as $aMbtiOtion) {
            array_push($mbtiData, $aMbtiOtion);
        }
        
        $outputData = json_encode($mbtiData, JSON_UNESCAPED_UNICODE);
        return $outputData;
    }
}
