<?php
include 'include/pdoConnect.php';
include 'include/pdoConnect.php';
$sql = $pdo->prepare("SELECT * FROM tBoardList WHERE nSeq = :nId");
$sql->bindValue(":nId", 4);
$sql -> execute();
$row = $sql -> fetch();

$pdo = null;

print_r($row);

