<?php
require_once ($_SERVER ["DOCUMENT_ROOT"] . '/mbtiCommunity/include/pdoConnect.php');
class RecommendDAO {
	private $pdo;
	function __construct() {
		$oPdo = new pdoConnect ();
		$this->pdo = $oPdo->connectPdo ();
	}
	// 처음 추천 누르기
	public function create($nUserId, $nBoardId) {
		$sQuery = ' INSERT INTO tRecommendList 
                                (nMemberSeq,
                                 nBoardSeq,  
                                 nCheck)
                    VALUES      (:nUserId,
                                 :nBoardId,      
                                 1) ';

		$oPdoStatement = $this->pdo->prepare ( $sQuery );
		$oPdoStatement->bindValue ( ":nUserId", $nUserId );
		$oPdoStatement->bindValue ( ":nBoardId", $nBoardId );
		$oPdoStatement->execute ();
	}

	// 추천 값 변경
	public function update($nCheck, $nRecommendId) {
		try {
			$this->pdo->beginTransaction ();
			$sQuery = ' UPDATE 
                            tRecommendList 
                        SET 
                            nCheck = :nCheck 
                        WHERE 
                            nRecommendSeq = :nRecommendId ';

			$oPdoStatement = $this->pdo->prepare ( $sQuery );
			$oPdoStatement->bindValue ( ":nCheck", $nCheck );
			$oPdoStatement->bindValue ( ":nRecommendId", $nRecommendId );
			$oPdoStatement->execute ();
			$this->pdo->commit ();
			return true;
		} catch ( Exception $e ) {
			if ($this->pdo->inTransaction ()) {
				$this->pdo->rollback ();
			}
			throw $e;
			return false;
		}
	}

	// 해당 게시물에 좋아요 눌렀는지 여부
	public function getByUserIdAndBoardId($nUserId, $nBoardId) {
		$sQuery = ' SELECT 
                        * 
                    FROM 
                        tRecommendList 
                    WHERE 
                        nBoardSeq=:nBoardId 
                    AND 
                        nMemberSeq=:nUserId ';

		$oPdoStatement = $this->pdo->prepare ( $sQuery );
		$oPdoStatement->bindValue ( ":nBoardId", $nBoardId );
		$oPdoStatement->bindValue ( ":nUserId", $nUserId );
		$oPdoStatement->execute ();
		$aRecommend = $oPdoStatement->fetch ();
		return $aRecommend;
	}

	// 게시물 좋아요 수 리턴
	public function getCountByBoardId($nBoardId) {
		$sQuery = ' SELECT 
                        count(*) 
                    FROM 
                        tRecommendList 
                    WHERE 
                        nBoardSeq = :nId 
                    AND 
                        nCheck = 1 ';

		$oPdoStatement = $this->pdo->prepare ( $sQuery );
		$oPdoStatement->bindValue ( ":nId", $nBoardId );
		$oPdoStatement->execute ();
		$nRecommendCount = $oPdoStatement->fetchColumn ();
		return $nRecommendCount;
	}
}