<?php
require_once 'application/DAO/Comment.php';

class CommentService
{

    // 새 댓글 등록
    public function create($nUserId, $nBoardId, $sContent)
    {
        if (!empty($sContent)) {
            $oCommentDAO = new CommentDAO();
            $oCommentDAO->create($nUserId, $nBoardId, $sContent);
            return true;
        }
        return false;
    }
    
    //board id에 해당하는 댓글 목록
    public function findListByBoardId($nBoardId) {
        $oCommentDAO = new CommentDAO();
        $aCommentList = $oCommentDAO->findListByBoardId($nBoardId);
        if ($aCommentList != NULL) {
            return $aCommentList;
        } else {
            return "가져올 댓글 목록이 없습니다.";
        }
    }
    
    public function deleteByCommentId($nCommentId) {
        $oCommentDAO = new CommentDAO();
        $oCommentDAO->deleteByCommentId($nCommentId);      
    }
    
    //게시물 댓글 수 리턴
    public function getCountByBoardId($nBoardId) {
        $oCommentDAO = new CommentDAO();
        $nCommentCount = $oCommentDAO->getCountByBoardId($nBoardId);
        return  $nCommentCount['count(*)'];
        
    }
}