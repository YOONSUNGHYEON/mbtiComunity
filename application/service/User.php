<?php
require_once ($_SERVER["DOCUMENT_ROOT"] . '/mbtiCommunity/application/DAO/User.php');

class UserService
{

    private $oUserDAO;

    function __construct() {
        $this->oUserDAO = new UserDAO();
    }

    public function register($sRegisterName, $sRegisterPassword, $sRegisterPassword2, $sRegisterOption) {
        $aUser =  $this->oUserDAO->findByUserName($sRegisterName);
        if ($sRegisterPassword != $sRegisterPassword2) {
            return "비밀번호가 같지 않습니다.";
        } else if (empty($sRegisterName) || empty($sRegisterPassword) || empty($sRegisterOption)) {
            return "모든 데이터를 입력해주세요!";
        } else if (mb_strlen($sRegisterName, "UTF-8") > 32) {
            return "username 32자 이하로 작성해 주세요.";
        } else if (mb_strlen($sRegisterPassword, "UTF-8") > 40) {
            return "비밀번호 40자 이하로 작성해 주세요.";
        }
        if ($aUser == NULL) {
            $this->oUserDAO->register($sRegisterName, $sRegisterPassword, $sRegisterOption);
            return null;
        } else {
            return "아이디가 중복됩니다.";
        }
    }

    public function login($sLoginName, $sLoginPassword) {
        $aUser =  $this->oUserDAO->getUser($sLoginName, $sLoginPassword); // 유저 데이터 받기
        return $aUser;
    }

    public function findMbtiIdByUserName($sUserName) {
        $nMbtiId = $this->oUserDAO->findMbtiIdByUserName($sUserName);
        return $nMbtiId;
    }
}
