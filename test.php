<?php

include 'include/pdoConnect.php';
$sql = $pdo->prepare("DELETE FROM tCommentList WHERE nBoardSeq = :nId");
$sql->bindValue(":nId", 2);
$sql -> execute();
$row = $sql -> fetch();
