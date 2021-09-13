
<?php
require_once ('header.php');

require_once ('appvars.php');
require_once ('connectvars.php');
require_once ('navmenu.php');
// Start the session
session_start();
// Clear the error message
$error_msg = "";
// If the user isn't logged in, try to log them in
if (! isset($_SESSION['user_id'])) {
    if (isset($_POST['submit'])) {
        // Connect to the database
        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

        // Grab the user-entered log-in data
        $user_username = mysqli_real_escape_string($dbc, trim($_POST['username']));
        $user_password = mysqli_real_escape_string($dbc, trim($_POST['password']));

        if (! empty($user_username) && ! empty($user_password)) {
            // Look up the username and password in the database
            $query = "SELECT nSeq, sName FROM tMemberList WHERE sName = '$user_username' AND sPassword = SHA('$user_password')";
            $data = mysqli_query($dbc, $query);

            if (mysqli_num_rows($data) == 1) {
                // The log-in is OK so set the user ID and username session vars (and cookies), and redirect to the home page
                $row = mysqli_fetch_array($data);
                $_SESSION['user_id'] = $row['nSeq'];
                $_SESSION['username'] = $row['sName'];
                setcookie('user_id', $row['nSeq'], time() + (60 * 60 * 24 * 30)); // expires in 30 days
                setcookie('username', $row['sName'], time() + (60 * 60 * 24 * 30)); // expires in 30 days
                $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php';
                header('Location: ' . $home_url);
            } else {
                // The username/password are incorrect so set an error message
                $error_msg = '아이디 또는 비밀번호가 잘못 입력 되었습니다.</ br>아이디와 비밀번호를 정확히 입력해 주세요.';
            }
        } else {

            $error_msg = '아이디 또는 비번을 입력해주세요..';
        }
    }
}

// If the session var is empty, show any error message and the log-in form; otherwise confirm the log-in
if (empty($_SESSION['user_id'])) {
    if(!empty($error_msg)){
        echo '<div class="alert alert-dismissible alert-danger">';
        echo '<strong>' . $error_msg . '</strong></div>';
    }
   
 ?>
<div id="main-wrapper" class="content">
	<h1>로그인</h1>
	<div id="content-wrapper" class="">
		  <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<fieldset>
				<div class="form-group">
					<label for="exampleInputEmail1" class="form-label mt-4"> UserName</label>
					<input type="text" class="form-control" 
						aria-describedby="usernameHelp" placeholder="Enter Username"
						name="username"
						value="<?php if (!empty($user_username)) echo $user_username; ?>" />
				</div>
				<div class="form-group">
					<label for="exampleInputPassword1" class="form-label mt-4">Password</label>
					<input type="password" name="password" class="form-control" placeholder="Password">

				</div>
				<a href="register.php" class="register-btn btn btn-primary">회원가입 하기</a>
				<button type="submit" name="submit" class="register-btn btn btn-primary">로그인 하기</button>
			</fieldset>
		</form>
	</div>
</div>
<?php
} else {
    // Confirm the successful log-in
    echo ('<p class="login">You are logged in as ' . $_SESSION['username'] . '.</p>');
}

