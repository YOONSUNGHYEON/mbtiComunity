<?php 
require_once 'Models/UserModel.php';

class UserController {
    //로그인 하기
    public function login($userID, $password) {
        $oUserModel = new UserModel();
        $aData = $oUserModel->getUser($userID, $password);
        if (mysqli_num_rows($aData)==1) {
            session_start();
            $row = mysqli_fetch_array($aData);
            $_SESSION['user_id'] = $row['nSeq'];
            $_SESSION['username'] = $row['sName'];
            setcookie('user_id', $row['nSeq'], time() + (60 * 60 * 24 * 30)); // expires in 30 days
            setcookie('username', $row['sName'], time() + (60 * 60 * 24 * 30)); // expires in 30 days
            $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php';
            header('Location: ' . $home_url);
        }
        else{
            echo '<div class="alert alert-dismissible alert-danger">';
            echo '<strong>다시 입력해 주세요.</strong></div>';
        }
       
    } 
}
