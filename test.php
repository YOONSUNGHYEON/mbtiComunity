<?php
require_once ($_SERVER ["DOCUMENT_ROOT"] . '/mbtiCommunity/include/pdoConnect.php');
$oPdo = new pdoConnect ();
$pdo = $oPdo->connectPdo ();
try {
	$pdo->beginTransaction ();

	$sCommentQuery = '  DELETE FROM
                                    tCommentList
                                WHERE
                                    nBoardSeq = :nId ';

	$oPdoStatement = $pdo->prepare ( $sCommentQuery );
	$oPdoStatement->bindValue ( ":nId", 2 );
	$oPdoStatement->execute ();

	$sRecommendQuery = ' DELETE FROM
                                    tRecommendList
                                WHERE
                                    nBoardSeq = :nId ';

$oPdoStatement = $pdo->prepare ( $sRecommendQuery );
	$oPdoStatement->bindValue ( ":nId", 2 );
	$oPdoStatement->execute ();

	$sBoardQuery = ' DELETE FROM
                                tBoardList
                            WHERE
                                nBoardSeq = :nId ';

	$oPdoStatement = $pdo->prepare ( $sBoardQuery );
	$oPdoStatement->bindValue ( ":nId", 2 );
	$oPdoStatement->execute ();
	$pdo->commit ();
} catch ( PDOException $e ) {
	$pdo->rollBack ();
	return false;
} finally {
	$pdo = null;
}


