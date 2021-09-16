<?php 

class MbtiDAO {
    
    //MBTI 옵션 목록
    public function findMbtiList() {
        include 'include/pdoConnect.php';
        $sql = $pdo->prepare("SELECT * FROM tMbtiOption");
               
        $sql->execute();
        $result = array();
        while($row= $sql-> fetch(PDO::FETCH_ASSOC)) {
            $result[] = $row;
        }
        $pdo = null;
        return $result;
    }
    
    //id에를 주면 mbti 이름 반환
    public function findNameById($nId) {
        include 'include/pdoConnect.php';
        $sql = $pdo->prepare("SELECT sName FROM tMbtiOption WHERE nSeq = :nId");
        $sql->bindValue(":nId", $nId);
        $sql->execute();
        $row = $sql ->fetchColumn();
        $pdo = null;
        return $row;
        
    }
}
?>