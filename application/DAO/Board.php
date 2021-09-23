<?php
require_once ($_SERVER["DOCUMENT_ROOT"] . '/MbtiCommunity/include/pdoConnect.php');

class BoardDAO
{

    private $pdo;

    function __construct()
    {
        $oPdo = new pdoConnect();
        $this->pdo = $oPdo->connectPdo();
    }

    // 게시판 옵션 목록
    public function findBoardOptionList()
    {
        $sql = $this->pdo->prepare("SELECT * FROM tBoardListOption");
        $sql->execute();
        $result = array();
        while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
            $result[] = $row;
        }
        return $result;
    }

    // 게시판 옵션 아이디에 따른 게시판 목록
    public function findListByOptionId($sOptionId)
    {
        $sql = $this->pdo->prepare("SELECT * FROM tBoardList AS b
                                INNER JOIN tMemberList as m ON b.nMemberSeq= m.nMemberSeq
                                WHERE nBoardOptionSeq = :nId ORDER BY nBoardSeq DESC;");
        $sql->bindValue(":nId", $sOptionId);
        $sql->execute();
        $result = array();
        while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
            $result[] = $row;
        }
        return $result;
    }

    public function findListByOptionIdlLimit($nOptionId, $nStartCount, $nLimitCount)
    {
        $sql = $this->pdo->prepare("SELECT * FROM tBoardList AS b
                                INNER JOIN tMemberList as m ON b.nMemberSeq= m.nMemberSeq
                                WHERE nBoardOptionSeq = :nId ORDER BY nBoardSeq DESC LIMIT :nLimitCount OFFSET :nStartCount");
        $sql->bindValue(":nId", $nOptionId);
        $sql->bindValue(":nLimitCount", $nLimitCount);
        $sql->bindValue(":nStartCount", $nStartCount);
        $sql->execute();
        $result = array();
        while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
            $result[] = $row;
        }
        return $result;
    }

    // id에를 주면 게시판 이름 반환
    public function findOptionNameByOptionId($nOptionId)
    {
        $sql =  $this->pdo->prepare("SELECT sName FROM tBoardListOption WHERE nBoardOptionSeq = :nId");
        $sql->bindValue(":nId", $nOptionId);
        $sql->execute();
        $row = $sql->fetchColumn();
        return $row;
    }

    // 새 게시물 등록
    public function create($sTitle, $sContent, $nUserId, $nOptionId)
    {
        $sql =  $this->pdo->prepare("INSERT INTO tBoardList (sTitle, sContent, dtCreateDate, nMemberSeq, nBoardOptionSeq ) 
                      VALUES (:sTitle, :sContent, NOW(), :nUserId, :nOptionId)");
        $sql->bindValue(":sTitle", $sTitle);
        $sql->bindValue(":sContent", $sContent);
        $sql->bindValue(":nUserId", $nUserId);
        $sql->bindValue(":nOptionId", $nOptionId);
        $sql->execute();
        $boardId =  $this->pdo->lastInsertId();
        return $boardId;
    }

    // BoardId에 해당되는 게시물 반환 (최신순 정렬)
    public function findById($nBoardId)
    {
        $sql =  $this->pdo->prepare("SELECT * FROM tBoardList AS b 
                                INNER JOIN tMemberList as m ON b.nMemberSeq= m.nMemberSeq 
                                WHERE nBoardSeq = :nId ORDER BY nBoardSeq DESC;");
        $sql->bindValue(":nId", $nBoardId);
        $sql->execute();
        $row = $sql->fetch();
        return $row;
    }
    public function findWriterById($nBoardId) {
        $sQuery = ' SELECT
                        nMemberSeq
                    FROM
                        tBoardList 
                    WHERE
                        nBoardSeq = :nId ';
        $oPrepare = $this->pdo->prepare($sQuery);
        $oPrepare->bindValue(":nId", $nBoardId);
        $oPrepare->execute();
        $nMemberSeq = $oPrepare->fetch();
        return $nMemberSeq;
        
    }
    // BoardId에 해당되는 게시물 반환 (최신순 정렬)
    public function findByIdTemp($nBoardId, $sParam)
    {
        // if (null != $sParam) {

        // }
        // include 'include/pdoConnect.php';
        $sQuery = ' SELECT
                        *
                    FROM
                        tBoardList BL
                        INNER JOIN tMemberList ML ON (BL.nMemberSeq= ML.nMemberSeq) 
                    WHERE
                        BL.nBoardSeq = :nId
                    ORDER BY
                        BL.nBoardSeq DESC';

        $sQuery = ' SELECT
                        *
                    FROM
                        tBoardList BL
                        INNER JOIN tMemberList ML ON (BL.nMemberSeq= ML.nMemberSeq) 
                    WHERE
                        BL.nBoardSeq = ' . $sParam . '
                    ORDER BY
                        BL.nBoardSeq DESC ';
        $sQuery = " SELECT
                        *
                    FROM
                        tBoardList BL
                        INNER JOIN tMemberList ML ON (BL.nMemberSeq= ML.nMemberSeq) 
                    WHERE
                        BL.nBoardSeq = {$sParam}
                    ORDER BY
                        BL.nBoardSeq DESC ";
        // $oPrepare = $pdo->prepare($sQuery);
        // $oPrepare->bind

        $sql = $pdo->prepare("SELECT * FROM tBoardList AS b
                                INNER JOIN tMemberList as m ON b.nMemberSeq= m.nMemberSeq
                                WHERE nBoardSeq = :nId ORDER BY nBoardSeq DESC;");

        $sql = $pdo->prepare("SELECT * FROM tBoardList AS b 
                                INNER JOIN tMemberList as m ON b.nMemberSeq= m.nMemberSeq 
                                WHERE nBoardSeq = :nId ORDER BY nBoardSeq DESC;");
        $sql->bindValue(":nId", $nBoardId);
        $sql->execute();
        $row = $sql->fetch();
        return $row;
    }

    // 게시물 삭제
    public function deleteById($nBoardId)
    {
        try {
            $this->pdo->beginTransaction();
            $sql = $this->pdo->prepare("DELETE FROM tBoardList WHERE nBoardSeq = :nId");
            $sql = $this->pdo->prepare("DELETE FROM tCommentList WHERE nBoardSeq = :nId");
            $sql->bindValue(":nId", $nBoardId);
            $sql->execute();
            $this->pdo->commit();
            return true;
        } catch (Exception $e) {
            if ($this->pdo->inTransaction()) {
                $this->pdo->rollback();
            }
        }
    }

    // 게시물 수정하기
    public function update($nBoardId, $sTitle, $sContent)
    {
        try {
            $this->pdo->beginTransaction();
            $sql =  $this->pdo->prepare("UPDATE tBoardList SET sTitle = :sTitle, sContent = :sContent WHERE nBoardSeq = :nBoardId");
            $sql->bindValue(":sTitle", $sTitle);
            $sql->bindValue(":sContent", $sContent);
            $sql->bindValue(":nBoardId", $nBoardId);
            $sql->execute();
            $this->pdo->commit();

            return true;
        } catch (Exception $e) {
            if ( $this->pdo->inTransaction()) {
                $this->pdo->rollback();
            }
            throw $e;
            return false;
        }
    }
}