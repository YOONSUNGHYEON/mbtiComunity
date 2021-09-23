<?php 
require_once ($_SERVER["DOCUMENT_ROOT"] . '/MbtiCommunity/include/pdoConnect.php');
class MbtiDAO {
    private $pdo;
    
    function __construct()
    {
        $oPdo = new pdoConnect();
        $this->pdo = $oPdo->connectPdo();
    }
    //MBTI 옵션 목록
    public function findMbtiList() {
        $sql = $this->pdo->prepare("SELECT * FROM tMbtiOption");
        $sql->execute();
        $result = array();
        while($row= $sql-> fetch(PDO::FETCH_ASSOC)) {
            $result[] = $row;
        }
        $this->pdo = null;
        return $result;
    }
    
    //id에를 주면 mbti 이름 반환
    public function findNameById($nId) {
        $sql = $this->pdo->prepare("SELECT sName FROM tMbtiOption WHERE nMbtiSeq = :nId");
        $sql->bindValue(":nId", $nId);
        $sql->execute();
        $row = $sql ->fetchColumn();
        $this->pdo = null;
        return $row;
        
    }
}
?>