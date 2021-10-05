<?php
require_once ($_SERVER ["DOCUMENT_ROOT"] . '/mbtiCommunity/include/pdoConnect.php');
class BoardDAO {
	private $pdo;
	function __construct() {
		$oPdo = new pdoConnect ();
		$this->pdo = $oPdo->connectPdo ();
	}

	// 게시판 옵션 목록
	public function findBoardOptionList() {
		$sQuery = ' SELECT 
                        * 
                    FROM
                        tBoardListOption';

		$oPdoStatement = $this->pdo->prepare ( $sQuery );
		$oPdoStatement->execute ();
		$aBoardOptionList = array ();
		while ( $aBoardOptionRow = $oPdoStatement->fetch ( PDO::FETCH_ASSOC ) ) {
			$aBoardOptionList [] = $aBoardOptionRow;
		}
		return $aBoardOptionList;
	}

	// 게시판 옵션 아이디에 따른 게시판 목록
	public function findListByOptionId($nOptionId) {
		$sQuery = ' SELECT
                        *
                    FROM
                        tBoardList BL
                        INNER JOIN tMemberList ML ON (BL.nMemberSeq= ML.nMemberSeq)
                    WHERE
                        BL.nBoardOptionSeq = :nBoardOptionId
                    ORDER BY
                        BL.nBoardSeq DESC';

		$oPdoStatement = $this->pdo->prepare ( $sQuery );
		$oPdoStatement->bindValue ( ":nBoardOptionId", $nOptionId );
		$oPdoStatement->execute ();
		$aBoardList = array ();
		while ( $aBoardRow = $oPdoStatement->fetch ( PDO::FETCH_ASSOC ) ) {
			$aBoardList [] = $aBoardRow;
		}
		return $aBoardList;
	}
	public function findListByOptionIdlLimit($nOptionId, $nStartCount, $nLimitCount) {
		$sQuery = ' SELECT 
                        * 
                    FROM 
                        tBoardList BL
                        INNER JOIN tMemberList ML ON ( BL.nMemberSeq= ML.nMemberSeq )
                    WHERE 
                        BL.nBoardOptionSeq = :nId 
                    ORDER BY 
                        BL.nBoardSeq DESC 
                    LIMIT 
                        :nLimitCount 
                    OFFSET :nStartCount ';

		$oPdoStatement = $this->pdo->prepare ( $sQuery );
		$oPdoStatement->bindValue ( ":nId", $nOptionId );
		$oPdoStatement->bindValue ( ":nLimitCount", $nLimitCount );
		$oPdoStatement->bindValue ( ":nStartCount", $nStartCount );
		$oPdoStatement->execute ();

		$aBoardList = array ();
		while ( $aBoardRow = $oPdoStatement->fetch ( PDO::FETCH_ASSOC ) ) {
			$aBoardList [] = $aBoardRow;
		}
		return $aBoardList;
	}

	// id에를 주면 게시판 이름 반환
	public function findOptionNameByOptionId($nOptionId) {
		$sQuery = ' SELECT 
                        sName
                    FROM 
                        tBoardListOption
                    WHERE 
                        nBoardOptionSeq = :nId ';

		$oPdoStatement = $this->pdo->prepare ( $sQuery );
		$oPdoStatement->bindValue ( ":nId", $nOptionId );
		$oPdoStatement->execute ();
		$sBoardOptionName = $oPdoStatement->fetchColumn ();
		return $sBoardOptionName;
	}

	// 새 게시물 등록
	public function create($sTitle, $sContent, $nUserId, $nOptionId) {
		$sQuery = ' INSERT INTO tBoardList
                               (sTitle,
                                sContent,
                                dtCreateDate, 
                                nMemberSeq,
                                nBoardOptionSeq ) 
                     VALUES     (:sTitle,
                                 :sContent, 
                                 NOW(),
                                 :nUserId,
                                 :nOptionId) ';

		$oPdoStatement = $this->pdo->prepare ( $sQuery );
		$oPdoStatement->bindValue ( ":sTitle", $sTitle );
		$oPdoStatement->bindValue ( ":sContent", $sContent );
		$oPdoStatement->bindValue ( ":nUserId", $nUserId );
		$oPdoStatement->bindValue ( ":nOptionId", $nOptionId );
		$oPdoStatement->execute ();
		$nBoardId = $this->pdo->lastInsertId ();
		return $nBoardId;
	}

	// BoardId에 해당되는 게시물 반환 (최신순 정렬)
	public function findById($nBoardId) {
		$sQuery = ' SELECT
                        *
                    FROM
                        tBoardList BL
                        INNER JOIN tMemberList ML ON (BL.nMemberSeq = ML.nMemberSeq)
                    WHERE
                        BL.nBoardSeq = :nId
                    ORDER  BY
                        BL.nBoardSeq DESC ';

		$oPdoStatement = $this->pdo->prepare ( $sQuery );
		$oPdoStatement->bindValue ( ":nId", $nBoardId );
		$oPdoStatement->execute ();
		$aBoard = $oPdoStatement->fetch ();
		return $aBoard;
	}
	public function findWriterById($nBoardId) {
		$sQuery = ' SELECT
                        nMemberSeq
                    FROM
                        tBoardList 
                    WHERE
                        nBoardSeq = :nId ';
		$oPdoStatement = $this->pdo->prepare ( $sQuery );
		$oPdoStatement->bindValue ( ":nId", $nBoardId );
		$oPdoStatement->execute ();
		$nMemberSeq = $oPdoStatement->fetchColumn ();
		return $nMemberSeq;
	}

	// 게시물 삭제
	public function deleteById($nBoardId) {
		try {
			$this->pdo->beginTransaction ();

			$sCommentQuery = '  DELETE FROM
                                    tCommentList
                                WHERE
                                    nBoardSeq = :nId ';

			$oPdoStatement = $this->pdo->prepare ( $sCommentQuery );
			$oPdoStatement->bindValue ( ":nId", $nBoardId );
			$oPdoStatement->execute ();

			$sRecommendQuery = ' DELETE FROM
                                    tRecommendList
                                WHERE
                                    nBoardSeq = :nId ';

			$oPdoStatement = $this->pdo->prepare ( $sRecommendQuery );
			$oPdoStatement->bindValue ( ":nId", $nBoardId );
			$oPdoStatement->execute ();
			
			$sBoardQuery = ' DELETE FROM
                                tBoardList
                            WHERE
                                nBoardSeq = :nId ';
			
			$oPdoStatement = $this->pdo->prepare ( $sBoardQuery );
			$oPdoStatement->bindValue ( ":nId", $nBoardId );
			$oPdoStatement->execute ();
			$this->pdo->commit ();
			return true;
		} catch ( PDOException $e ) {
			$this->pdo->rollBack ();
			return false;
		} finally {
			$this->pdo = null;
		}
	}

	// 게시물 수정하기
	public function update($nBoardId, $sTitle, $sContent) {
		try {
			$sQuery = ' UPDATE 
                            tBoardList 
                        SET 
                            sTitle = :sTitle,
                            sContent = :sContent
                        WHERE 
                            nBoardSeq = :nBoardId ';

			$this->pdo->beginTransaction ();
			$oPdoStatement = $this->pdo->prepare ( $sQuery );
			$oPdoStatement->bindValue ( ":sTitle", $sTitle );
			$oPdoStatement->bindValue ( ":sContent", $sContent );
			$oPdoStatement->bindValue ( ":nBoardId", $nBoardId );
			$oPdoStatement->execute ();
			$this->pdo->commit ();
			return true;
		} catch ( Exception $e ) {
			if ($this->pdo->inTransaction ()) {
				$this->pdo->rollback ();
			}
			return false;
		}
	}

	
}