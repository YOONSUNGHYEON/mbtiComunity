<?php
require_once ($_SERVER ["DOCUMENT_ROOT"] . '/mbtiCommunity/application/DAO/Comment.php');
class CommentService {
	private $oCommentDAO;
	function __construct() {
		$this->oCommentDAO = new CommentDAO ();
	}

	// 새 댓글 등록
	public function create($nUserId, $nBoardId, $sContent) {
		if (! empty ( $sContent )) {
			$this->oCommentDAO->create ( $nUserId, $nBoardId, $sContent );
			return true;
		}
		return false;
	}

	// board id에 해당하는 댓글 목록
	public function findListByBoardId($nBoardId) {
		$aCommentList = $this->oCommentDAO->findListByBoardId ( $nBoardId );
		if ($aCommentList != NULL) {
			return $aCommentList;
		} else {
			return "가져올 댓글 목록이 없습니다.";
		}
	}
	public function deleteByCommentId($nCommentId) {
		$this->oCommentDAO->deleteByCommentId ( $nCommentId );
	}

	// 게시물 댓글 수 리턴
	public function getCountByBoardId($nBoardId) {
		$nCommentCount = $this->oCommentDAO->getCountByBoardId ( $nBoardId );
		return $nCommentCount ['count(*)'];
	}

	// CommentId를 주면 작성자 id반환
	public function findWriterById($nCommentId) {
		$nCommentWriterId = $this->oCommentDAO->findWriterById ( $nCommentId );
		if ($nCommentWriterId != NULL) {
			return $nCommentWriterId;
		} else {
			return "가져올 작성자 없습니다.";
		}
	}
}