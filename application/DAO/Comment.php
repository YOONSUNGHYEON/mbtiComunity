<?php 
require_once ($_SERVER["DOCUMENT_ROOT"] . '/mbtiCommunity/include/pdoConnect.php');

class CommentDAO {
    
    private $pdo;
    
    function __construct()
    {
        $oPdo = new pdoConnect();
        $this->pdo = $oPdo->connectPdo();
    }
    
    //새 댓글 등록
    public function create($nUserId, $nBoardId, $sContent) {
        $sQuery = ' INSERT INTO tCommentList
                                (sContent, 
                                dtCreateDate, 
                                nMemberSeq, 
                                nBoardSeq )
                    VALUES      (:sContent, 
                                NOW(), 
                                :nUserId, 
                                :nBoardId )';
        
        $oPdoStatement = $this->pdo->prepare($sQuery);
        $oPdoStatement->bindValue(":sContent", $sContent);
        $oPdoStatement->bindValue(":nUserId",$nUserId);
        $oPdoStatement->bindValue(":nBoardId",$nBoardId);
        $oPdoStatement->execute();
    }
    
    //BoardId에 적혀있는 모든 댓글 삭제
    public function deleteByBoardId($nBoardId) {
        $sQuery = ' DELETE FROM 
                        tCommentList 
                    WHERE 
                        nBoardSeq = :nId ';
        
        $oPdoStatement = $this->pdo->prepare($sQuery);
        $oPdoStatement->bindValue(":nId", $nBoardId);
        $oPdoStatement -> execute();        
    }
    
    // 댓글 삭제
    public function deleteByCommentId($nCommentId) {
        $sQuery = ' DELETE FROM 
                        tCommentList 
                    WHERE 
                        nCommentSeq = :nId ';
        
        $oPdoStatement = $this->pdo->prepare( $sQuery );
        $oPdoStatement->bindValue(":nId", $nCommentId);
        $oPdoStatement -> execute();
    }
    
    //board id에 해당하는 댓글 목록 
    public function findListByBoardId($nBoardId) {
        $sQuery = ' SELECT 
                        * 
                    FROM 
                        tCommentList CL 
                        INNER JOIN tMemberList ML ON CL.nMemberSeq= ML.nMemberSeq 
                    WHERE 
                        CL.nBoardSeq = :nBoardId
                    ORDER BY 
                        CL.nCommentSeq 
                    DESC';
        
        $oPdoStatement = $this->pdo->prepare($sQuery);
        $oPdoStatement->bindValue(":nBoardId",$nBoardId);
        $oPdoStatement->execute();
        $aCommentList = array();
        while($aCommentRow= $oPdoStatement-> fetch(PDO::FETCH_ASSOC)) {
            $aCommentList[] = $aCommentRow;
        }
        return $aCommentList;
    }
    
    //게시물 댓글 수 리턴
    public function getCountByBoardId($nBoardId) {
        $sQuery = ' SELECT 
                        count(*) 
                    FROM 
                        tCommentList 
                    WHERE    
                        nBoardSeq=:nId ';
        $oPdoStatement = $this->pdo->prepare($sQuery);
        $oPdoStatement->bindValue(":nId", $nBoardId);
        $oPdoStatement -> execute();
        $aCommentRow = $oPdoStatement -> fetch();
        return $aCommentRow['count(*)'];
    }
    
    public function findWriterById($nCommentId)
    {
        $sQuery = ' SELECT
                        nMemberSeq
                    FROM
                        tCommentList
                    WHERE
                        nCommentSeq = :nId ';
        $oPdoStatement = $this->pdo->prepare($sQuery);
        $oPdoStatement->bindValue(":nId", $nCommentId);
        $oPdoStatement->execute();
        $nMemberSeq  = $oPdoStatement->fetchColumn();
        return $nMemberSeq;
    }
    
}
