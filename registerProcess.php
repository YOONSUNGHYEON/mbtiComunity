<?php

require_once 'application/service/User.php';
$sRegisterName =trim($_POST['username']);
$sRegisterPassword = trim($_POST['password1']);
$sRegisterPassword2 = trim($_POST['password2']);
$sRegisterOption = isset($_POST['mbtiOption']) ? $_POST['mbtiOption'] : false;


$oUserService = new UserService();
$sUser = $oUserService->register($sRegisterName, $sRegisterPassword, $sRegisterPassword2, $sRegisterOption);

if($sUser == null) {
    echo "<script>alert('회원가입 성공!'); location.href='./login.php';</script>";

}
else 
    echo '<div class="alert alert-dismissible alert-success">';
    echo '<strong>' . $sUser . '</strong> 바로 <a href="login.php" class="alert-link">로그인 하러가기</a>.';
    echo '</div>';