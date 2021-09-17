<?php 


class BoardDAO {
    
    //게시판 옵션 목록
    public function findBoardOptionList() {
        include 'include/pdoConnect.php';
        $sql = $pdo->prepare("SELECT * FROM tBoardListOption");
        
        $sql->execute();
        $result = array();
        while($row= $sql-> fetch(PDO::FETCH_ASSOC)) {
            $result[] = $row;
        }
        $pdo = null;
        return $result;
    }
    
    //게시판 옵션 아이디에 따른 게시판 목록
    public function findListByOptionId($sOptionId) {
        include 'include/pdoConnect.php';
        $sql = $pdo->prepare("SELECT * FROM tBoardList WHERE nBoardOptionSeq=:id");
        $sql->bindValue(":id",$sOptionId);
        $sql->execute();
        $result = array();
        while($row= $sql-> fetch(PDO::FETCH_ASSOC)) {
            $result[] = $row;
        }
        $pdo = null;
        return $result;
    }
    
    //id에를 주면 게시판 이름 반환
    public function findOptionNameByOptionId($nOptionId) {
        include 'include/pdoConnect.php';
        $sql = $pdo->prepare("SELECT sName FROM tBoardListOption WHERE nSeq = :nId");
        $sql->bindValue(":nId", $nOptionId);
        $sql->execute();
        $row = $sql ->fetchColumn();
        $pdo = null;
        return $row;
        
    }
    
    //새 게시물 등록
    public function create($sTile, $sContent, $nUserId, $nOptionId) {
        include 'include/pdoConnect.php';
        $sql = $pdo->prepare("INSERT INTO tBoardList (sTitle, sContent, dtCreateDate, nMemberSeq, nBoardOptionSeq ) 
                      VALUES (:sTile, :sContent, NOW(), :nUserId, :nOptionId)");
        $sql->bindValue(":sTile",$sTile);
        $sql->bindValue(":sContent", $sContent);
        $sql->bindValue(":nUserId",$nUserId);
        $sql->bindValue(":nOptionId",$nOptionId);
        $sql->execute();
        $boardId = $pdo -> lastInsertId();
        $pdo = null;
        return $boardId;
        
    }
    
    //BoardId에 해당되는 게시물 반환
    public function findById($nBoardId) {
        include 'include/pdoConnect.php';
        $sql = $pdo->prepare("SELECT * FROM tBoardList WHERE nSeq = :nId");
        $sql->bindValue(":nId", $nBoardId);
        $sql -> execute();
        $row = $sql -> fetch();
        $pdo = null;
        return $row;
        
    }
    
    //게시물 삭제
    public function deleteById($nBoardId) {
        include 'include/pdoConnect.php';
        $sql = $pdo->prepare("DELETE FROM tBoardList WHERE nSeq = :nId");
        $sql->bindValue(":nId", $nBoardId);
        $sql -> execute();
        $row = $sql -> fetch();
        
    }
    
    
}