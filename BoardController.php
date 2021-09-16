<?php 
require_once 'application/Service/Board.php';
$oBoardController = new BoardController();
if ($_GET['method'] == 'findBoardOptionList') {
    echo $oBoardController->findOptionList();
}
else if($_GET['method'] == 'findOptionNameByOptionId') {
    echo $oBoardController->findOptionNameByOptionId($_GET['id']);
}
else if($_GET['method'] == 'findListByOptionId') {
    echo $oBoardController->findListByOptionId($_GET['id']);
}
else if($_GET['method'] == 'create') {
    echo $oBoardController->create($_POST['title'],$_POST['content']);
}


class BoardController
{
    public function findListByOptionId($sOptionId) {
        $oBoardService = new BoardService();
        $aBoardList = $oBoardService->findListByOptionId($sOptionId);
        $aBoardResult[] = array();
        foreach($aBoardList as $aBoard) {
            array_push($aBoardResult, $aBoard);
        }
        return json_encode($aBoardResult, JSON_UNESCAPED_UNICODE);
    }

    public function findOptionList() {
        $oMbtiService = new MbtiService();
        $aMbtiOtionList = $oMbtiService->findMbtiList();
        $mbtiData[] = array();
        foreach($aMbtiOtionList as $aMbtiOtion) {
            array_push($mbtiData, $aMbtiOtion);
        }
        
        $outputData = json_encode($mbtiData, JSON_UNESCAPED_UNICODE);
        return $outputData;
    }
    
    public function findOptionNameByOptionId($nOptionId) {
        $oBoardService = new BoardService();
        $sBoardName = $oBoardService->findOptionNameByOptionId($nOptionId);
        return $sBoardName;
    }
    
    public function create($sTitle, $sContent) {
        return $sTitle;
    }
    
}