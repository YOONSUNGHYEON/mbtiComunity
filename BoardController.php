<?php
require_once 'application/Service/Board.php';
require_once 'application/Service/Comment.php';
require_once 'application/DAO/User.php';
$oBoardController = new BoardController();
if ($_GET['method'] == 'findBoardOptionList') {
    echo $oBoardController->findOptionList();
} else if ($_GET['method'] == 'getOptionNameByOptionId') {
    echo $oBoardController->getOptionNameByOptionId($_GET['id']);
} else if ($_GET['method'] == 'findListByOptionId') {
    echo $oBoardController->findListByOptionId($_GET['id']);
} else if ($_GET['method'] == 'getListByBoardId') {
    echo $oBoardController->getListByBoardId($_GET['id']);
} else if ($_GET['method'] == 'create') {
    echo $oBoardController->create($_POST['title'], $_POST['content'], $_GET['id']);
} else if ($_GET['method'] == 'update') {
    echo $oBoardController->update($_POST['title'], $_POST['content'], $_GET['id']);
} else if ($_GET['method'] == 'getBoardById') {
    echo $oBoardController->getBoardById($_GET['id']);
} else if ($_GET['method'] == 'comment') {
    echo $oBoardController->comment($_GET['id'], $_POST['comment']);
} else if ($_GET['method'] == 'delete') {
    $oBoardController->deleteById($_GET['id']);
}

class BoardController
{

    public function findListByOptionId($nOptionId)
    {
        $oBoardService = new BoardService();
        $aBoardList = $oBoardService->findListByOptionId($nOptionId);
        $aBoardResult[] = array();
        foreach ($aBoardList as $aBoard) {
            array_push($aBoardResult, $aBoard);
        }
        return json_encode($aBoardResult, JSON_PRETTY_PRINT);
    }

    public function getListByBoardId($nBoardId)
    {
        $oCommentService = new CommentService();
        $aCommentList = $oCommentService->findListByBoardId($nBoardId);
        $aCommentResult[] = array();
        foreach ($aCommentList as $aComment) {
            array_push($aCommentResult, $aComment);
        }
        return json_encode($aCommentResult, JSON_PRETTY_PRINT);
    }

    public function findOptionList()
    {
        $oMbtiService = new MbtiService();
        $aMbtiOtionList = $oMbtiService->findMbtiList();
        $mbtiData[] = array();
        foreach ($aMbtiOtionList as $aMbtiOtion) {
            array_push($mbtiData, $aMbtiOtion);
        }

        $outputData = json_encode($mbtiData, JSON_UNESCAPED_UNICODE);
        return $outputData;
    }

    public function getOptionNameByOptionId($nOptionId)
    {
        $oBoardService = new BoardService();
        $sBoardName = $oBoardService->findOptionNameByOptionId($nOptionId);
        return $sBoardName;
    }

    public function comment($nBoardId, $sContent)
    {
        $oCommentService = new CommentService();
        if (! isset($_SESSION['userId'])) {
            return "로그인을 해주세요.";
        }
        $bResult = $oCommentService->create($_SESSION['userId'], $nBoardId, $sContent);
        if ($bResult == true) {
            return true;
        }
        return "댓글을 입력해주세요.";
    }

    public function create($sTitle, $sContent, $nOptionId)
    {
        $oBoardService = new BoardService();
        $nBoardId = $oBoardService->create($sTitle, $sContent, $nOptionId);
        return $nBoardId;
    }

    public function update($sTitle, $sContent, $nBoardId)
    {
        // $oUserDAO = new UserDAO();
        // $aUser = $oUserDAO->findByUserName($_SESSION['userName']);
        // if($_SESSION['userId'])
        $oBoardService = new BoardService();
        $bCheck = $oBoardService->update($sTitle, $sContent, $nBoardId);
        return $bCheck;
    }

    // create페이지 get방식
    public function getCreate($nBoardOption)
    {
        $oUserDAO = new UserDAO();
        if (! isset($_SESSION['userId'])) {
            return "로그인부터 해주세요.";
        }
        $aUser = $oUserDAO->findByUserName($_SESSION['userName']);
        if ($aUser['nMbtiSeq'] != $nBoardOption) {
            return "자신의 mbti 게시판을 이용해주세요.";
        }
        return null;
    }

    public function getBoardById($nBoardId)
    {
        $oBoardService = new BoardService();
        $aBoard = $oBoardService->findById($nBoardId);
        if ($_SESSION['userName'] == $aBoard['sID']) {
            $aBoard['checkUser'] = true;
        } else {
            $aBoard['checkUser'] = false;
        }
        $outputData = json_encode($aBoard, JSON_UNESCAPED_UNICODE);     
        return $outputData;
    }

    public function deleteById($nBoardId)
    {
        $oBoardService = new BoardService();
        $oBoardService->deleteById($nBoardId);
    }
}