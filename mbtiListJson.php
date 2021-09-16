<?php 
header("Content-Type: application/json");
require_once 'application/service/Mbti.php';

$oMbtiService = new MbtiService();
$aMbtiOtionList = $oMbtiService->findMbtiList();
$mbtiData[] = array();
foreach($aMbtiOtionList as $aMbtiOtion) {
    array_push($mbtiData, $aMbtiOtion);
}

$outputData = json_encode($mbtiData, JSON_UNESCAPED_UNICODE);
echo $outputData;

?>