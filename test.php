<?php

require_once ($_SERVER["DOCUMENT_ROOT"] . '/mbtiCommunity/include/pdoConnect.php');
$oPdo = new pdoConnect();
$pdo = $oPdo->connectPdo();
$sQuery = ' SELECT
                        nMemberSeq,
                        sID
                    FROM
                        tMemberList
                    WHERE
                        sID = :sUserName
                    AND
                        sPassword = SHA(:sUserPassword) ';

$oPdoStatement = $pdo->prepare($sQuery);
$oPdoStatement->bindValue(":sUserName",'admin');
$oPdoStatement->bindValue(":sUserPassword", '1234');

$oPdoStatement->execute();
$aUser = $oPdoStatement->fetch(PDO::FETCH_ASSOC); 
print_r($aUser);

