<?php
$dbHost = "127.0.0.1";
$dbName = "dbCommunity";
$dbUser = "zc753951"; // DB 아이디
$dbPass = "7566"; // DB 패스워드
$dbChar = "utf8";

// PDO 객체 생성 & DB 접속
try {
    $dsn = "mysql:host={$dbHost};dbname={$dbName};charset={$dbChar}";
    $pdo = new PDO($dsn, $dbUser, $dbPass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, fasle);
} catch (PDOException $e) {
    die('연결 실패: ' . $e->getMessage());
}

