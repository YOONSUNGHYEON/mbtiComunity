<?php

require_once ($_SERVER["DOCUMENT_ROOT"] . '/MbtiCommunity/include/pdoConnect.php');
$oPdo = new pdoConnect();
$pdo = $oPdo->connectPdo();
try {
    $pdo->beginTransaction();
    $sql = $pdo->prepare("UPDATE tRecommendList SET nCheck = :nCheck WHERE nRecommendSeq = :nRecommendSeq");
    $sql->bindValue(":nCheck", 0);
    $sql->bindValue(":nRecommendSeq", 1);
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
