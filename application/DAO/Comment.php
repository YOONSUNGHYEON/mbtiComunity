<?php 


class CommentDAO {
    //새 댓글 등록
    public function create($nUserId, $nBoardId, $sContent) {
        include 'include/pdoConnect.php';
        $sql = $pdo->prepare("INSERT INTO tCommentList (sContent, dtCreateDate, nMemberSeq, nBoardSeq )
                      VALUES (:sContent, NOW(), :nUserId, :nBoardId)");
        $sql->bindValue(":sContent", $sContent);
        $sql->bindValue(":nUserId",$nUserId);
        $sql->bindValue(":nBoardId",$nBoardId);
        $sql->execute();
        $pdo = null;
    }
    
    //BoardId에 적혀있는 모든 댓글 삭제
    public function deleteByBoardId($nBoardId) {
        include 'include/pdoConnect.php';
        $sql = $pdo->prepare("DELETE FROM tCommentList WHERE nBoardSeq = :nId");
        $sql->bindValue(":nId", $nBoardId);
        $sql -> execute();
        $row = $sql -> fetch();
        
    }
    
    // 댓글 삭제
    public function deleteByCommentId($nCommentId) {
        include 'include/pdoConnect.php';
        $sql = $pdo->prepare("DELETE FROM tCommentList WHERE nCommentSeq = :nId");
        $sql->bindValue(":nId", $nCommentId);
        $sql -> execute();
        $row = $sql -> fetch();
        
    }
    
    //board id에 해당하는 댓글 목록 
    public function findListByBoardId($nBoardId) {
        include 'include/pdoConnect.php';
        $sql = $pdo->prepare("SELECT * FROM tCommentList AS c 
                                INNER JOIN tMemberList as m ON c.nMemberSeq= m.nMemberSeq 
                                WHERE nBoardSeq = :nBoardId ORDER BY nCommentSeq DESC ");
        $sql->bindValue(":nBoardId",$nBoardId);
        $sql->execute();
        $result = array();
        while($row= $sql-> fetch(PDO::FETCH_ASSOC)) {
            $result[] = $row;
        }
        $pdo = null;
        return $result;
    }
}
