<?php 
require_once 'application/DAO/Board.php';
require_once 'application/DAO/Comment.php';
session_start();
class BoardService {
    //게시판 옵션 목록
    public function findBoardOptionList() {
        $oBoardDAO = new BoardDAO();
        $aBoardOption = $oBoardDAO->findBoardOptionList(); 
        if ($aBoardOption != NULL) {
            return $aBoardOption;
        } else {
            return "가져올 게시판 옵션 목록이 없습니다.";
        }
    }
    
    //게시판 옵션 아이디에 따른 게시판 목록
    public function findListByOptionId($sOptionId) {
        $oBoardDAO = new BoardDAO();
        $aBoard= $oBoardDAO->findListByOptionId($sOptionId);
        if ($aBoard != NULL) {
            return $aBoard;
        } else {
            return "가져올 게시판 글 목록이 없습니다.";
        }
    }
    
    //id에를 주면 게시판 이름 반환
    public function findOptionNameByOptionId($nOptionId) {
        $oBoardDAO = new BoardDAO();
        $sBoardName = $oBoardDAO->findOptionNameByOptionId($nOptionId);
        if ($sBoardName != NULL) {
            return $sBoardName;
        } else {
            return "가져올 게시판 이름이 없습니다.";
        }
        
    }
    
    //새 게시물 등록
    public function create($sTile, $sContent, $nOptionId) {
        if(mb_strlen($sTile, "UTF-8")>40) {
            return -1;
        }
        if (isset($_SESSION['userId'])) {
            if(!empty($sTile)  &&  !empty($sContent)) {
                $oBoardDAO = new BoardDAO();
                $boardId = $oBoardDAO->create($sTile, $sContent, $_SESSION['userId'], $nOptionId);
                return $boardId;
            }
            return "";               
        }             
    }
    //게시물 수정
    public function update($sTitle, $sContent, $nBoardId) {
        if(mb_strlen($sTitle, "UTF-8")>40) {
            return false;
        }
        if (isset($_SESSION['userId'])) {
            if(!empty($sTitle)  &&  !empty($sContent)) {
                $oBoardDAO = new BoardDAO();
                $oBoardDAO->update($nBoardId, $sTitle, $sContent);
                return true;
            }
            return false;
        }
    }
    //BoardId에 해당되는 게시물 반환
    public function findById($nBoardId) {
        $oBoardDAO = new BoardDAO();
        $aBoard =  $oBoardDAO->findById($nBoardId);
        return $aBoard;
    }
    
    //게시물 삭제
    public function deleteById($nBoardId) {
        $oBoardDAO = new BoardDAO();
        $oCommentDAO = new CommentDAO();
      
        $oBoardDAO->deleteById($nBoardId);
        $oCommentDAO->deleteByBoardId($nBoardId);
    }
}