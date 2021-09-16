<?php
include 'include/pdoConnect.php';
$sql = $pdo->prepare("INSERT INTO tBoardList (sTitle, sContent, dtCreateDate, nMemberSeq, nBoardOptionSeq )
                      VALUES (:sTile, :sContent, NOW(), :nUserId, :nOptionId)");
$sql->bindValue(":sTile","sssss");
$sql->bindValue(":sContent", "sssss");
$sql->bindValue(":nUserId","2");
$sql->bindValue(":nOptionId","2");
$sql->execute();
$boardId = $pdo -> lastInsertId();
$pdo = null;
print_r($boardId);

