<?php 
require_once ($_SERVER["DOCUMENT_ROOT"] . '/MbtiCommunity/include/pdoConnect.php');

class CommentDAO {
    
    private $pdo;
    
    function __construct()
    {
        $oPdo = new pdoConnect();
        $this->pdo = $oPdo->connectPdo();
    }
    
    //새 댓글 등록
    public function create($nUserId, $nBoardId, $sContent) {
        $sql = $this->pdo->prepare("INSERT INTO tCommentList (sContent, dtCreateDate, nMemberSeq, nBoardSeq )
                      VALUES (:sContent, NOW(), :nUserId, :nBoardId)");
        $sql->bindValue(":sContent", $sContent);
        $sql->bindValue(":nUserId",$nUserId);
        $sql->bindValue(":nBoardId",$nBoardId);
        $sql->execute();
    }
    
    //BoardId에 적혀있는 모든 댓글 삭제
    public function deleteByBoardId($nBoardId) {
        $sql = $this->pdo->prepare("DELETE FROM tCommentList WHERE nBoardSeq = :nId");
        $sql->bindValue(":nId", $nBoardId);
        $sql -> execute();
        $row = $sql -> fetch();
        
    }
    
    // 댓글 삭제
    public function deleteByCommentId($nCommentId) {
        $sql = $this->pdo->prepare("DELETE FROM tCommentList WHERE nCommentSeq = :nId");
        $sql->bindValue(":nId", $nCommentId);
        $sql -> execute();
        $row = $sql -> fetch();
        
    }
    
    //board id에 해당하는 댓글 목록 
    public function findListByBoardId($nBoardId) {
        $sql = $this->pdo->prepare("SELECT * FROM tCommentList AS c 
                                INNER JOIN tMemberList as m ON c.nMemberSeq= m.nMemberSeq 
                                WHERE nBoardSeq = :nBoardId ORDER BY nCommentSeq DESC ");
        $sql->bindValue(":nBoardId",$nBoardId);
        $sql->execute();
        $result = array();
        while($row= $sql-> fetch(PDO::FETCH_ASSOC)) {
            $result[] = $row;
        }
        return $result;
    }
    
    //게시물 댓글 수 리턴
    public function getCountByBoardId($nBoardId) {
        $sql = $this->pdo->prepare("SELECT count(*) FROM tCommentList where nBoardSeq=:nId");
        $sql->bindValue(":nId", $nBoardId);
        $sql -> execute();
        $row = $sql -> fetch();
        return $row['count(*)'];
    }
}
