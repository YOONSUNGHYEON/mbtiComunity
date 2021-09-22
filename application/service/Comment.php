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
}