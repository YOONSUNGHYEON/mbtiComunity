
<?php
require_once ('include/startsession.php');
require_once ('include/header.php');
require_once ('include/navmenu.php');

?>

<div id="main-wrapper" class="content">
	<h1>회원가입</h1>
	<div id="content-wrapper" class="">
		<form method="post" action= "registerProcess.php">
			<fieldset>
				<div class="form-group">
					<label for="exampleInputEmail1" class="form-label mt-4">Username </label>
					<input type="text" id="username" name="username" value="" class="form-control"
						aria-describedby="emailHelp" placeholder="Enter id"> <small
						id="emailHelp" class="form-text text-muted">We'll never share your
						email with anyone else.</small>

				</div>
				<div class="form-group">
					<label for="exampleInputPassword1" class="form-label mt-4">Password</label>
					<input type="password" id="password1" name="password1"
						class="form-control" placeholder="Password">

				</div>
				<div class="form-group">
					<label for="exampleInputPassword2" class="form-label mt-4">Password (retype)</label>
					<input type="password" id="password2" name="password2"
						class="form-control" placeholder="Password">

				</div>
				<div class="form-group">
					<label for="exampleSelect1" class="form-label mt-4">Example select</label>
					<select class="form-select" id="mbtiOptionSelect" name="mbtiOption">

					</select>
				</div>

				<button type="submit" value="Sign Up" name="submit"
					class="register-btn btn btn-primary">Submit</button>
			</fieldset>
		</form>
	</div>
</div>
</body>
<script type="text/javascript" async="" src="js/register.js"></script>
</html>
