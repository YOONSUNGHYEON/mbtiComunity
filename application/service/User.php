<?php 
require_once  'application/DAO/User.php';

class UserService {
    
    public function register($sRegisterName, $sRegisterPassword, $sRegisterPassword2, $sRegisterOption) {
        $oUserDAO = new UserDAO();
        $aUser = $oUserDAO->findByUserName($sRegisterName);
        if($sRegisterPassword != $sRegisterPassword2) {
            return "비밀번호가 같지 않습니다.";
        }
        else if(empty($sRegisterName) || empty($sRegisterPassword) || empty($sRegisterOption) ) {
            return "모든 데이터를 입력해주세요!";
        }
        else if(mb_strlen($sRegisterName, "UTF-8")>32) {
            return "username 32자 이하로 작성해 주세요.";
        }
        else if(mb_strlen($sRegisterPassword, "UTF-8")>40) {
            return "비밀번호 40자 이하로 작성해 주세요.";
        }
        if ($aUser == NULL) {
            $oUserDAO->register($sRegisterName, $sRegisterPassword, $sRegisterOption); 
            return null;
        }
        else {
            return "아이디가 중복됩니다.";
        }
    }
    
    public function login($sLoginName, $sLoginPassword) {
        $oUserDAO = new UserDAO();
        $aUser = $oUserDAO->getUser(trim($sLoginName), trim($sLoginPassword)); //유저 데이터 받기  
       
    
        if (empty($sLoginName) && empty($sLoginPassword)) {
            return false;
        }
        else if ($aUser != NULL) {
            $_SESSION['userId'] = $aUser['nMemberSeq'];
            $_SESSION['userName'] = $aUser['sID'];
            setcookie('userId', $aUser['nMemberSeq'], time() + (60 * 60 * 24 * 30)); // expires in 30 days
            setcookie('userName', $aUser['sID'], time() + (60 * 60 * 24 * 30)); // expires in 30 days
            return true;
        }
        return false;
    } 
    
    public function findByUserName($sUserName) {
        
        return $result[0];
    }
    
}
