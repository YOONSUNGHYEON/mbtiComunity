<?php
require_once ('include/header.php');
require_once ('include/navmenu.php');

?>
<div id="main-wrapper" class="content">
	<h1 id="result">LOGIN</h1>
	<div id="content-wrapper" class="">
		<form method="post" action="loginProcess.php">
			<fieldset>
				<div class="form-group">
					<label for="exampleInputEmail1" class="form-label mt-4"> UserName</label>
					<input type="text" class="form-control" id="username"
						aria-describedby="usernameHelp" placeholder="Enter Username"
						name="username" value="" />
				</div>
				<div class="form-group">
					<label for="exampleInputPassword1" class="form-label mt-4">Password</label>
					<input type="password" id="password" name="password"
						class="form-control" placeholder="Password">
				</div>
				<a href="register.php" class="register-btn btn btn-primary">회원가입 하기</a>
				<button type="submit" name="submit"
					class="register-btn btn btn-primary">로그인 하기</button>

			</fieldset>
		</form>
	</div>
</div>

</body>
<script type="text/javascript" async="" src="js/login.js"></script>
</html>


