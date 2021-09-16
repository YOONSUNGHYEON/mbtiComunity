<?php 
require_once 'application/service/User.php';
$sLoginName = $_POST['username'];
$sLoginPassword = $_POST['password'];
$oUserService = new UserService();
$bUser = $oUserService->login($sLoginName, $sLoginPassword);
if($bUser==true)
    echo "<script>alert('로그인 성공!'); location.href='./index.php';</script>";
else
    echo "<script>alert('아이디 혹은 비밀번호를 확인하세요.'); history.back();</script>";
    