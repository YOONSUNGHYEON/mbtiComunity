<?php
require_once ($_SERVER ["DOCUMENT_ROOT"] . '/mbtiCommunity/include/pdoConnect.php');
class UserDAO {
	private $pdo;
	function __construct() {
		$oPdo = new pdoConnect ();
		$this->pdo = $oPdo->connectPdo ();
	}
	// 사용자 등록
	public function register($sRegisterName, $sRegisterPassword, $sRegisterOption) {
		$sQuery = ' INSERT INTO tMemberList 
                                (sID,
                                sPassword, 
                                dtJoinDate, 
                                nMbtiOptionSeq ) 
                    VALUES      (:sRegisterName, 
                                SHA(:sRegisterPassword), 
                                NOW(), 
                                :sRegisterOption) ';

		$oPdoStatement = $this->pdo->prepare ( $sQuery );
		$oPdoStatement->bindValue ( ":sRegisterName", $sRegisterName );
		$oPdoStatement->bindValue ( ":sRegisterPassword", $sRegisterPassword );
		$oPdoStatement->bindValue ( ":sRegisterOption", $sRegisterOption );
		$oPdoStatement->execute ();
		$this->pdo = null;
	}

	// 사용자 정보 리턴
	public function getUser($sUserName, $sUserPassword) {
		$sQuery = ' SELECT 
                        nMemberSeq, 
                        sID,
                        nAdmin
                    FROM  
                        tMemberList 
                    WHERE 
                        sID = :sUserName 
                    AND 
                        sPassword = SHA(:sUserPassword) ';

		$oPdoStatement = $this->pdo->prepare ( $sQuery );
		$oPdoStatement->bindValue ( ":sUserName", $sUserName );
		$oPdoStatement->bindValue ( ":sUserPassword", $sUserPassword );

		$oPdoStatement->execute ();
		$aUser = $oPdoStatement->fetch ( PDO::FETCH_ASSOC );
		return $aUser;
	}

	// 사용자 정보 리턴
	public function findByUserName($sUserName) {
		$sQuery = ' SELECT 
                        * 
                    FROM 
                        tMemberList 
                    WHERE       
                        sID = :sUserName ';
		$oPdoStatement = $this->pdo->prepare ( $sQuery );
		$oPdoStatement->bindValue ( ":sUserName", $sUserName );
		$oPdoStatement->execute ();
		$aUser = $oPdoStatement->fetch ( PDO::FETCH_ASSOC );
		return $aUser;
	}
	public function findMbtiIdByUserName($sUserName) {
		$sQuery = ' SELECT
                        nMbtiOptionSeq
                    FROM
                        tMemberList
                    WHERE
                       sID = :sUserName ';

		$oPdoStatement = $this->pdo->prepare ( $sQuery );
		$oPdoStatement->bindValue ( ":sUserName", $sUserName );
		$oPdoStatement->execute ();
		$nMbtiId = $oPdoStatement->fetchColumn ();
		return $nMbtiId;
	}
}
