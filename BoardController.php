<?php 
require_once 'application/Service/Board.php';
$oBoardController = new BoardController();
if ($_GET['method'] == 'findBoardOptionList') {
    echo $oBoardController->findOptionList();
}
else if($_GET['method'] == 'board') {
    echo $oBoardController->board($_GET['id']);
}
else if($_GET['method'] == 'findListByOptionId') {
    echo $oBoardController->findListByOptionId($_GET['id']);
}
else if($_GET['method'] == 'create') {
    echo $oBoardController->create($_POST['title'],$_POST['content'], $_GET['id']);
}
else if($_GET['method'] == 'view') {
    echo $oBoardController->view($_GET['id']);
}
else if($_GET['method'] == 'delete') {
    $oBoardController->deleteById($_GET['id']);
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
    
    public function board($nOptionId) {
        $oBoardService = new BoardService();
        $sBoardName = $oBoardService->findOptionNameByOptionId($nOptionId);
        return $sBoardName;
    }
    
    public function create($sTitle, $sContent, $nOptionId) {
        $oBoardService = new BoardService();
        $nBoardId = $oBoardService->create($sTitle, $sContent, $nOptionId);
        return $nBoardId;
    }
    
    //BoardId에 해당되는 게시물 반환
    public function view($nBoardId) {
        $oBoardService = new BoardService();
        $aBoard =   $oBoardService ->findById($nBoardId);
        $outputData = json_encode($aBoard, JSON_UNESCAPED_UNICODE);
        return $outputData;
    }
    
    //게시물 삭제
    public function deleteById($nBoardId) {
        $oBoardService = new BoardService();
        $oBoardService->deleteById($nBoardId);      
        
    }
    
}