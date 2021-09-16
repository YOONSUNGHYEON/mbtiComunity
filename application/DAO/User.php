<?php 


class UserDAO {
    
    //사용자 등록
    public function create($sRegisterName, $sRegisterPassword, $sRegisterOption) {
        include 'include/pdoConnect.php';
        $sql = $pdo->prepare("INSERT INTO tMemberList (sName, sPassword, dtJoinDate, nMbtiSeq ) VALUES (:sRegisterName, SHA(:sRegisterPassword), NOW(), :sRegisterOption)");
        $sql->bindValue(":sRegisterName",$sRegisterName);
        $sql->bindValue(":sRegisterPassword", $sRegisterPassword);
        $sql->bindValue(":sRegisterOption",$sRegisterOption);
        $sql->execute();
        $pdo = null;
    }
    
    //사용자 정보 리턴
    public function getUser($sUserName, $sUserPassword) {
        include 'include/pdoConnect.php';
        $sql = $pdo->prepare("SELECT nSeq, sName FROM tMemberList WHERE sName = :sUserName AND sPassword = SHA(:sUserPassword)");
        $sql->bindValue(":sUserName",$sUserName);
        $sql->bindValue(":sUserPassword", $sUserPassword);
        
        $sql->execute();
        $result = array();
        $row = $sql->fetch(PDO::FETCH_ASSOC); // 칼럼 키로 사용하는 연과 배열 반환 $row['id']
        $result[] = $row;
        $pdo = null;
        
        return $result[0];
    }
    
    //사용자 정보 리턴
    public function findUserByUserName($sUserName) {
        include 'include/pdoConnect.php';
        $sql = $pdo->prepare("SELECT * FROM tMemberList WHERE sName = :username");
        $sql->bindValue(":username",$sUserName);
        $sql->execute();
        $result = array();
        $row = $sql->fetch(); // 칼럼 키로 사용하는 연과 배열 반환 $row['id']
        $result[] = $row;
        $pdo = null;
        return $result[0];
    }
}