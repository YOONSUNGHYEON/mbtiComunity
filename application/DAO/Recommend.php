<?php 
require_once ($_SERVER["DOCUMENT_ROOT"] . '/MbtiCommunity/include/pdoConnect.php');
class RecommendDAO {
    private $pdo;
    
    function __construct()
    {
        $oPdo = new pdoConnect();
        $this->pdo = $oPdo->connectPdo();
    }
    //처음 추천 누르기
    public function create($nUserId, $nBoardId) {
        $sql = $this->pdo->prepare("INSERT INTO tRecommendList (nMemberSeq, nBoardSeq, nCheck)
                      VALUES (:nUserId, :nBoardId, 1)");
        $sql->bindValue(":nUserId",$nUserId);
        $sql->bindValue(":nBoardId",$nBoardId);
        $sql->execute();
    } 
    
    //추천 값 변경
    public function update($nCheck, $nRecommendId)
    {
        try {
            $this->pdo->beginTransaction();
            $sql =  $this->pdo->prepare("UPDATE tRecommendList SET nCheck = :nCheck WHERE nRecommendSeq = :nRecommendId");
            $sql->bindValue(":nCheck", $nCheck);
            $sql->bindValue(":nRecommendId", $nRecommendId);
            $sql->execute();
            $this->pdo->commit();
            return true;
        } catch (Exception $e) {
            if ($this->pdo->inTransaction()) {
                $this->pdo->rollback();
            }
            throw $e;
            return false;
        }
    }
    
    //해당 게시물에 좋아요 눌렀는지 여부
    public function getByUserIdAndBoardId($nUserId, $nBoardId) {
        $sql = $this->pdo->prepare("SELECT * FROM tRecommendList where nBoardSeq=:nBoardId AND nMemberSeq=:nUserId");
        $sql->bindValue(":nBoardId", $nBoardId);
        $sql->bindValue(":nUserId", $nUserId);
        $sql -> execute();
        $row = $sql -> fetch();
        return $row;
    }
    
    //게시물 좋아요 수 리턴
    public function getCountByBoardId($nBoardId) {
        $sql = $this->pdo->prepare("SELECT count(*) FROM tRecommendList where nBoardSeq=:nId");
        $sql->bindValue(":nId", $nBoardId);
        $sql -> execute();
        $row = $sql -> fetch();
        return $row['count(*)'];
    }
}