<?php
require_once 'application/Service/User.php';
$oUserController = new UserController();

if ($_GET['method'] == 'register') {
    echo $oUserController->register();
} else if ($_GET['method'] == 'login') {
    echo $oUserController->login();
} else if ($_GET['method'] == 'session') {
    echo $oUserController->session();
}

class UserController
{

    public function register()
    {
        $sRegisterName = trim($_POST['username']);
        $sRegisterPassword = trim($_POST['password1']);
        $sRegisterPassword2 = trim($_POST['password2']);
        $sRegisterOption = isset($_POST['mbtiOption']) ? $_POST['mbtiOption'] : false;
        $oUserService = new UserService();
        $sUser = $oUserService->register($sRegisterName, $sRegisterPassword, $sRegisterPassword2, $sRegisterOption);
        return $sUser;
    }

    // 세션 검사
    public function session()
    {
        session_start();
        if (isset($_SESSION['userId'])) {
            return true;
        }
        return false;      
    }

    // 로그인
    public function login()
    {
        $sLoginName = $_POST['username'];
        $sLoginPassword = $_POST['password'];
        $oUserService = new UserService();
        $bUser = $oUserService->login($sLoginName, $sLoginPassword);
        return $bUser;
    }
}
