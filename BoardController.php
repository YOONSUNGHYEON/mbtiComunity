<?php
require_once ('application/Service/Board.php');
require_once ('application/Service/Comment.php');
require_once ('application/DAO/User.php');
require_once ('application/service/User.php');
require_once ('application/Service/Recommend.php');
session_start();

$oBoardController = new BoardController();
// $_GET['method'] param check
if ($_GET['method'] == 'findBoardOptionList') {
    echo $oBoardController->findOptionList();
} else if ($_GET['method'] == 'getOptionNameByOptionId') {
    echo $oBoardController->getOptionNameByOptionId();
} else if ($_GET['method'] == 'board') {
    echo $oBoardController->board();
} else if ($_GET['method'] == 'getCommentListByBoardId') {
    echo $oBoardController->getCommentListByBoardId();
} else if ($_GET['method'] == 'create') {
    echo $oBoardController->create();
} else if ($_GET['method'] == 'update') {
    echo $oBoardController->update();
} else if ($_GET['method'] == 'getBoardById') {
    echo $oBoardController->getBoardById();
} else if ($_GET['method'] == 'comment') {
    echo $oBoardController->comment();
} else if ($_GET['method'] == 'delete') {
    echo $oBoardController->deleteById();
} else if ($_GET['method'] == 'deleteByCommentId') {
    $oBoardController->deleteByCommentId();
} else if ($_GET['method'] == 'getRecommentByUserIdAndBoardId') {
    echo $oBoardController->getRecommentByUserIdAndBoardId();
} else if ('recommend' == $_GET['method']) {
    echo $oBoardController->recommend();
} else if ($_GET['method'] == 'checkWritePermission') {
	echo $oBoardController->checkWritePermission();
} else if ($_GET['method'] == 'checkEditPermission') {
	echo $oBoardController->checkEditPermission();
}


class BoardController
{

    private $oBoardService;

    private $oCommentService;

    private $oRecommendService;

    private $oUserService;

    function __construct()
    {
        $this->oBoardService = new BoardService();
        $this->oCommentService = new CommentService();
        $this->oRecommendService = new RecommendService();
        $this->oUserService = new UserService();
    }

    public function board()
    {
        $aPagingBoardData = $this->oBoardService->pagingBoard($_GET['id'], $_GET['page']);
        if (isset($_SESSION['adminId'])) {
            $aPagingBoardData['nCheckAdmin'] = true;
        } else {
            $aPagingBoardData['nCheckAdmin'] = false;
        }
        return json_encode($aPagingBoardData, JSON_PRETTY_PRINT);
    }

    public function getCommentListByBoardId()
    {
        $nBoardId = $_GET['id'];
        $aCommentList = $this->oCommentService->findListByBoardId($nBoardId);
        $aCommentResult[] = array();
        foreach ($aCommentList as $aComment) {
            if ($aComment['nMemberSeq'] == $_SESSION['userId']) {
                $aComment['checkUser'] = true;
            } else {
                $aComment['checkUser'] = false;
            }
            array_push($aCommentResult, $aComment);
        }
        return json_encode($aCommentResult, JSON_PRETTY_PRINT);
    }

    public function findOptionList()
    {
        $aMbtiOtionList = $this->oMbtiService->findMbtiList();
        $mbtiData[] = array();
        foreach ($aMbtiOtionList as $aMbtiOtion) {
            array_push($mbtiData, $aMbtiOtion);
        }

        $outputData = json_encode($mbtiData, JSON_UNESCAPED_UNICODE);
        return $outputData;
    }

    public function getOptionNameByOptionId()
    {
        $nOptionId = $_GET['id'];
        $sBoardName = $this->oBoardService->findOptionNameByOptionId($nOptionId);
        return $sBoardName;
    }

    public function comment()
    {
        $nBoardId = $_GET['id'];
        $sContent = $_POST['comment'];
        if (! isset($_SESSION['userId'])) {
            return "로그인을 해주세요.";
        }
        $bResult = $this->oCommentService->create($_SESSION['userId'], $nBoardId, $sContent);
        if ($bResult == true) {
            return true;
        }
        return "댓글을 입력해주세요.";
    }

    public function create() {
        $sTitle = $_POST['title'];
        $sContent = $_POST['content'];
        $nOptionId = $_GET['id'];
        if (empty($sTitle) || empty($sContent) || empty($nOptionId) ) {
            return "빈칸을 채워주세요.";
        } else if(mb_strlen($sTitle, "UTF-8") > 40){
            return "제목은  40자 이하로 작성해 주세요.";
        }
        $nBoardId = $this->oBoardService->create($sTitle, $sContent, $nOptionId);
        return $nBoardId;
    }

    public function update()
    {
        $sTitle = $_POST['title'];
        $sContent = $_POST['content'];
        $nBoardId = $_GET['id'];
        $aBoard = $this->oBoardService->findById($nBoardId);
    	 if(empty($sTitle) || empty($sContent) || empty($nBoardId) ) {
            return "빈칸을 채워주세요.";
        }
        else if(mb_strlen($sTitle, "UTF-8") > 40){
            return "제목은  40자 이하로 작성해 주세요.";
        }
        $bCheck = $this->oBoardService->update($sTitle, $sContent, $nBoardId);
        return $bCheck;
    }

    // create페이지 get방식
    public function checkWritePermission()
    {
        if(isset($_SESSION['adminId'])) {
            return null;
        }
        if (! isset($_SESSION['userId'])) {
            return "로그인부터 해주세요.";
        }
        $nMbtiId = $this->oUserService->findMbtiIdByUserName($_SESSION['userName']);
        if ($nMbtiId != $_GET['id']) {
            return "자신의 mbti 게시판을 이용해주세요.";
        }
        
        return null;
    }
    // edit페이지 get방식
    public function checkEditPermission()
    {
    	$nBoardId = $_GET['id'];
    	$aBoard = $this->oBoardService->findById($nBoardId);
    	if (! isset($_SESSION['userId'])) {
    		return "로그인부터 해주세요.";
    	} else if($_SESSION['userName'] != $aBoard['sID']) {
    		return "접근 거부";		
    	}    	
    	return null;
    }
    public function getBoardById()
    {
        $nBoardId = $_GET['id'];
        $aBoard = $this->oBoardService->findById($nBoardId);
        if (isset($_SESSION['userName'])) {
            if ($_SESSION['userName'] == $aBoard['sID']) {
                $aBoard['checkUser'] = true;
            } else {
                $aBoard['checkUser'] = false;
            }
        } else {
            $aBoard['checkUser'] = false;
        }
        $outputData = json_encode($aBoard, JSON_UNESCAPED_UNICODE);
        return $outputData;
    }

    // 게시물 삭제
    public function deleteById()
    {
        $nBoardId= $_GET['id'];
        if (isset($_SESSION['userId'])) {
            if ($this->oBoardService->findWriterById($nBoardId) == $_SESSION['userId']) {             
            	return $this->oBoardService->deleteById($nBoardId);
            }
        }
        if(isset($_SESSION['adminId'])) {
            return $this->oBoardService->deleteById($nBoardId);
        }
        return false;
    }

    // 댓글 삭제
    public function deleteByCommentId()
    {
        $nCommentId = $_GET['id'];
        if (isset($_SESSION['userId'])) {
            if ($this->oCommentService->findWriterById($nCommentId) == $_SESSION['userId']) {
                return $this->oCommentService->deleteByCommentId($nCommentId);
            }
        }
        return flase;
    }

    /* -----------------좋아요 부분----------------- */
    public function getRecommentByUserIdAndBoardId()
    {
        $bRecommend = $this->oRecommendService->getByUserIdAndBoardId($_SESSION['userId'], $_GET['id']);

        return $bRecommend;
    }

    public function recommend()
    {
        $bRecommend = $this->oRecommendService->recommend($_SESSION['userId'], $_GET['id']);

        return $bRecommend;
    }
}