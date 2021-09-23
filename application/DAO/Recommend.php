<?php 

class RecommendDAO {
    //처음 추천 누르기
    public function create($nUserId, $nBoardId) {
        include 'include/pdoConnect.php';
        $sql = $pdo->prepare("INSERT INTO tRecommendList (nMemberSeq, nBoardSeq, nCheck)
                      VALUES (:nUserId, :nBoardId, 1)");
        $sql->bindValue(":nUserId",$nUserId);
        $sql->bindValue(":nBoardId",$nBoardId);
        $sql->execute();
        $pdo = null;
    } 
    
    //추천 값 변경
    public function update($nCheck, $nRecommendId)
    {
        include 'include/pdoConnect.php';
        try {
            $pdo->beginTransaction();
            $sql = $pdo->prepare("UPDATE tRecommendList SET nCheck = :nCheck WHERE nRecommendSeq = :nRecommendId");
            $sql->bindValue(":nCheck", $nCheck);
            $sql->bindValue(":nRecommendId", $nRecommendId);
            $sql->execute();
            $pdo->commit();
            $pdo = null;
            return true;
        } catch (Exception $e) {
            if ($pdo->inTransaction()) {
                $pdo->rollback();
            }
            throw $e;
            return false;
        }
    }
    
    //해당 게시물에 좋아요 눌렀는지 여부
    public function getByUserIdAndBoardId($nUserId, $nBoardId) {
        include 'include/pdoConnect.php';
        $sql = $pdo->prepare("SELECT * FROM tRecommendList where nBoardSeq=:nBoardId AND nMemberSeq=:nUserId");
        $sql->bindValue(":nBoardId", $nBoardId);
        $sql->bindValue(":nUserId", $nUserId);
        $sql -> execute();
        $row = $sql -> fetch();
        $pdo = null;
        return $row;
    }
    
    //게시물 좋아요 수 리턴
    public function getCountByBoardId($nBoardId) {
        include 'include/pdoConnect.php';
        $sql = $pdo->prepare("SELECT count(*) FROM tRecommendList where nBoardSeq=:nId");
        $sql->bindValue(":nId", $nBoardId);
        $sql -> execute();
        $row = $sql -> fetch();
        $pdo = null;
        return $row['count(*)'];
    }
}