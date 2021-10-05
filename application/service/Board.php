<?php
require_once ($_SERVER ["DOCUMENT_ROOT"] . '/mbtiCommunity/application/DAO/Board.php');
require_once ($_SERVER ["DOCUMENT_ROOT"] . '/mbtiCommunity/application/DAO/Comment.php');
require_once ($_SERVER ["DOCUMENT_ROOT"] . '/mbtiCommunity/paging.php');
class BoardService {
	private $oBoardDAO;
	private $oCommentDAO;
	private $oRecommendDAO;
	function __construct() {
		$this->oBoardDAO = new BoardDAO ();
		$this->oCommentDAO = new CommentDAO ();
		$this->oRecommendDAO = new RecommendDAO ();
	}

	// 게시판 옵션 목록
	public function findBoardOptionList() {
		$aBoardOption = $this->oBoardDAO->findBoardOptionList ();
		if ($aBoardOption != NULL) {
			return $aBoardOption;
		} else {
			return "가져올 게시판 옵션 목록이 없습니다.";
		}
	}

	// 게시판 옵션 아이디에 따른 게시판 목록
	public function findListByOptionId($sOptionId) {
		$aBoard = $this->oBoardDAO->findListByOptionId ( $sOptionId );
		if ($aBoard != NULL) {
			return $aBoard;
		} else {
			return "가져올 게시판 글 목록이 없습니다.";
		}
	}

	// BoardId를 주면 게시판 작성자 id반환
	public function findWriterById($nBoardId) {
		$nBoardWriterId = $this->oBoardDAO->findWriterById ( $nBoardId );
		if ($nBoardWriterId != NULL) {
			return $nBoardWriterId;
		} else {
			return "가져올 작성자 없습니다.";
		}
	}

	// id에를 주면 게시판 이름 반환
	public function findOptionNameByOptionId($nOptionId) {
		$sBoardName = $this->oBoardDAO->findOptionNameByOptionId ( $nOptionId );
		if ($sBoardName != NULL) {
			return $sBoardName;
		} else {
			return "가져올 게시판 이름이 없습니다.";
		}
	}

	// board 로드 시 필요한 데이터
	public function pagingBoard($nOptionId, $nCurrentPage) {
		$aBoardListTotalLength = count ( $this->oBoardDAO->findListByOptionId ( $nOptionId ) );
		$aPageData = paging ( $aBoardListTotalLength, $nCurrentPage );
		$aBoardList = $this->oBoardDAO->findListByOptionIdlLimit ( $nOptionId, $aPageData ['nStartCount'], $aPageData ['nBlockCount'] );
		$aBoardResult [] = array ();

		foreach ( $aBoardList as $aBoard ) {
			$aBoard ['nCommentCount'] = $this->oCommentDAO->getCountByBoardId ( $aBoard ['nBoardSeq'] );
			$aBoard ['nHit'] = $this->oRecommendDAO->getCountByBoardId ( $aBoard ['nBoardSeq'] );
			array_push ( $aBoardResult, $aBoard );
		}
		$aBoardResult ['nTotalCount'] = $aBoardListTotalLength;
		$aBoardResult ['nCurrentCount'] = count ( $aBoardList );
		$aBoardResult ['pageData'] = $aPageData;
		return $aBoardResult;
	}

	// 새 게시물 등록
	public function create($sTitle, $sContent, $nOptionId) {
		$boardId = $this->oBoardDAO->create ( $sTitle, $sContent, $_SESSION ['userId'], $nOptionId );
		return $boardId;
	}

	// 게시물 수정
	public function update($sTitle, $sContent, $nBoardId) {
		$this->oBoardDAO->update ( $nBoardId, $sTitle, $sContent );
		return true;
	}

	// BoardId에 해당되는 게시물 반환
	public function findById($nBoardId) {
		$aBoard = $this->oBoardDAO->findById ( $nBoardId );
		return $aBoard;
	}

	// 게시물 삭제
	public function deleteById($nBoardId) {
		return $this->oBoardDAO->deleteById( $nBoardId );
	}
}