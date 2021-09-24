<?php
require_once 'application/Service/User.php';
session_start();
$oUserController = new UserController();

if ($_GET['method'] == 'register') {
    echo $oUserController->register();
} else if ($_GET['method'] == 'login') {
    echo $oUserController->login();
} else if ($_GET['method'] == 'session') {
    echo $oUserController->session();
} else if ($_GET['method'] == 'logout') {
    echo $oUserController->logout();
}

class UserController
{    
    private $oUserService;
    
    function __construct()
    {
        $this->oUserService = new UserService();
    }
    public function register()
    {
        $sRegisterName = trim($_POST['username']);
        $sRegisterPassword = trim($_POST['password1']);
        $sRegisterPassword2 = trim($_POST['password2']);
        $sRegisterOption = isset($_POST['mbtiOption']) ? $_POST['mbtiOption'] : false;
        $sUser = $this->oUserService->register($sRegisterName, $sRegisterPassword, $sRegisterPassword2, $sRegisterOption);
        return $sUser;
    }

    // 세션 검사
    public function session()
    {
        if (isset($_SESSION['userId'])) {
            return true;
        }
        return false;
    }

    // 로그인
    public function login()
    {
        $sLoginName = trim($_POST['username']);
        $sLoginPassword = trim($_POST['password']);
        
        if (empty($sLoginName) && empty($sLoginPassword)) {
            return false;
        }
        $aUser = $this->oUserService->login($sLoginName, $sLoginPassword);
        if ($aUser != NULL) {          
            $_SESSION['userId'] = $aUser['nMemberSeq'];
            $_SESSION['userName'] = $aUser['sID'];
            setcookie('userId', $aUser['nMemberSeq'], time() + (60 * 60 * 24 * 30)); // expires in 30 days
            setcookie('userName', $aUser['sID'], time() + (60 * 60 * 24 * 30)); // expires in 30 days
            if($aUser['nAdmin']==1) {
                $_SESSION['adminId'] = $aUser['nMemberSeq'];
                $_SESSION['adminName'] = $aUser['sID'];
                setcookie('adminId', $aUser['nMemberSeq'], time() + (60 * 60 * 24 * 30)); // expires in 30 days
                setcookie('adminName', $aUser['sID'], time() + (60 * 60 * 24 * 30)); // expires in 30 days
            }
            return true;
        }
        return false;
    }

    // 로그아웃
    public function logout()
    {
        if (isset($_SESSION['userId'])) {

            $_SESSION = array();

            if (isset($_COOKIE[session_name()])) {
                setcookie(session_name(), '', time() - 3600);
            }

            session_destroy();
        }
      
        setcookie('adminId', '', time() - 3600);
        setcookie('adminName', '', time() - 3600);
        setcookie('userId', '', time() - 3600);
        setcookie('userName', '', time() - 3600);
    }
}
