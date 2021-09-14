<?php 
class UserModel
{

    // 로그인 체크
    public function getUser($userID, $password) {
        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $user_username = mysqli_real_escape_string($dbc, trim($userID));
        $user_password = mysqli_real_escape_string($dbc, trim($password));
        $query = "SELECT nSeq, sName FROM tMemberList WHERE sName = '$user_username' AND sPassword = SHA('$user_password')";
        $data = mysqli_query($dbc, $query);       
        return $data;
    }
  
}


?>