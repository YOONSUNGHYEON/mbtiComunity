<?php

include 'include/pdoConnect.php';

try {
    $pdo->beginTransaction();
    $sql = $pdo->prepare("UPDATE tRecommendList SET nCheck = :nCheck WHERE nRecommendSeq = :nRecommendSeq");
    $sql->bindValue(":nCheck", 1);
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
