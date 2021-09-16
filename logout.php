<?php
session_start();
if (isset($_SESSION['userId'])) {

    $_SESSION = array();

    if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time() - 3600);
    }

    session_destroy();
}

setcookie('userId', '', time() - 3600);
setcookie('userName', '', time() - 3600);

$indexUrl = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php';
header('Location: ' . $indexUrl);
