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
    
    private $oMbtiService;
    
    function __construct()
    {
        $this->oMbtiService = new MbtiService();
    }
    
    public function getNameById($nId) {
        $sMbtiName = $this->oMbtiService->findNameById($nId);
        return $sMbtiName;
    }

    public function getMbtiList() {
        $aMbtiOtionList = $this->oMbtiService->findMbtiList();
        $mbtiData[] = array();
        foreach($aMbtiOtionList as $aMbtiOtion) {
            array_push($mbtiData, $aMbtiOtion);
        }
        
        $outputData = json_encode($mbtiData, JSON_UNESCAPED_UNICODE);
        return $outputData;
    }
}
