
<?php
require_once 'application/controller/UserController.php';
require_once 'header.php';
require_once 'appvars.php';
require_once 'connectvars.php';
require_once 'navmenu.php';

$user = new UserController();
if (! isset($_SESSION['user_id'])) {
    if (isset($_POST['submit'])) {
        $responses = $user->login($_POST['username'], $_POST['password']);
    }
}

?>

<div id="main-wrapper" class="content">
	<h1>LOGIN</h1>
	<div id="content-wrapper" class="">
		<form method="post" action="<?= $_SERVER['PHP_SELF'] ?>">
			<fieldset>
				<div class="form-group">
					<label for="exampleInputEmail1" class="form-label mt-4"> UserName</label>
					<input type="text" class="form-control"
						aria-describedby="usernameHelp" placeholder="Enter Username"
						name="username"
						value="<?= $user_username ?>" />
				</div>
				<div class="form-group">
					<label for="exampleInputPassword1" class="form-label mt-4">Password</label>
					<input type="password" name="password" class="form-control"
						placeholder="Password">

				</div>
				<a href="register.php" class="register-btn btn btn-primary">회원가입 하기</a>
				<button type="submit" name="submit"
					class="register-btn btn btn-primary">로그인 하기</button>
			</fieldset>
		</form>
	</div>
</div>
<?php
require_once ('footer.php');
?>

