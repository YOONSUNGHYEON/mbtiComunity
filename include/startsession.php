  <?php
session_start();

if (! isset($_SESSION['userId'])) {
    if (isset($_COOKIE['userId']) && isset($_COOKIE['userName'])) {
        $_SESSION['userId'] = $_COOKIE['userId'];
        $_SESSION['userName'] = $_COOKIE['userName'];
    }
}
?>