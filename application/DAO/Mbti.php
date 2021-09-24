<?php 
require_once ($_SERVER["DOCUMENT_ROOT"] . '/mbtiCommunity/include/pdoConnect.php');
class MbtiDAO {
    private $pdo;
    
    function __construct()
    {
        $oPdo = new pdoConnect();
        $this->pdo = $oPdo->connectPdo();
    }
    //MBTI 옵션 목록
    public function findMbtiList() {
        $sQuery = ' SELECT 
                        * 
                    FROM 
                        tMbtiOption ';
        
        $oPdoStatement = $this->pdo->prepare($sQuery);
        $oPdoStatement->execute();
        $aMbtiList = array();
        while($aMbtiRow= $oPdoStatement-> fetch(PDO::FETCH_ASSOC)) {
            $aMbtiList[] = $aMbtiRow;
        }
        $this->pdo = null;
        return $aMbtiList;
    }
    
    //id에를 주면 mbti 이름 반환
    public function findNameById($nId) {
        $sQuery = ' SELECT 
                        sName
                    FROM
                        tMbtiOption
                    WHERE
                        nMbtiSeq = :nId ';
        
        $oPdoStatement = $this->pdo->prepare();
        $oPdoStatement->bindValue(":nId", $nId);
        $oPdoStatement->execute();
        $sMbtiName = $oPdoStatement ->fetchColumn();
        $this->pdo = null;
        return $sMbtiName;
        
    }
}
?>