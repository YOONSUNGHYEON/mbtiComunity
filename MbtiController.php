<?php
require_once 'application/service/Mbti.php';
$oMbtiController = new MbtiController();
if ($_GET['method'] == 'getMbtiList') {
    echo $oMbtiController->getMbtiList();
}
else if($_GET['method'] == 'getNameById') {
    echo $oMbtiController->getNameById($_GET['id']);
}

class MbtiController
{
    public function getNameById($nId) {
        $oMbtiService = new MbtiService();
        $sMbtiName = $oMbtiService->findNameById($nId);
        return $sMbtiName;
    }

    public function getMbtiList() {
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
