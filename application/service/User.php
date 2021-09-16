<?php 
require_once  'application/DAO/User.php';
session_start();
class UserService {
    
    public function register($sRegisterName, $sRegisterPassword, $sRegisterPassword2, $sRegisterOption) {
        $oUserDAO = new UserDAO();
        $aUser =  $oUserDAO->findUserByUserName($sRegisterName);
        if($sRegisterPassword != $sRegisterPassword2) {
            return "비밀번호가 같지 않습니다.";
        }
        else if(empty($sRegisterName) || empty($sRegisterPassword) || empty($sRegisterOption) ) {
            return "모든 데이터를 입력해주세요!";
        }
        
        if ($aUser == NULL) {
            $oUserDAO->create($sRegisterName, $sRegisterPassword, $sRegisterOption); 
            return null;
        }
        else {
            $sErrorMessage =  "아이디가 중복됩니다.";
        }
    }
    
    public function login($sLoginName, $sLoginPassword) {
        $oUserDAO = new UserDAO();
        $aUser = $oUserDAO->getUser(trim($sLoginName), trim($sLoginPassword)); //유저 데이터 받기  
       
    
        if (empty($sLoginName) && empty($sLoginPassword)) {
            return false;
        }
        else if ($aUser != NULL) {
            $_SESSION['userId'] = $aUser['nSeq'];
            $_SESSION['userName'] = $aUser['sName'];
            setcookie('userId', $aUser['nSeq'], time() + (60 * 60 * 24 * 30)); // expires in 30 days
            setcookie('userName', $aUser['sName'], time() + (60 * 60 * 24 * 30)); // expires in 30 days
            return true;
        }
        return false;
    } 
    
    
    
}
