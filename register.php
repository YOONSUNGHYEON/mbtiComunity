<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<?php
require_once ('include/header.php');
?>
<script type="text/javascript" async="" src="js/register.js"></script>
</head>
<body>
<?php
require_once ('include/navmenu.php');
?>
<div id="main-wrapper" class="content">
		<h1>회원가입</h1>
		<div id="content-wrapper" class="">
			<form method="post" id="registerForm" enctype="multipart/form-data">
				<fieldset>
					<div class="form-group">
						<label for="exampleInputEmail1" class="form-label mt-4">Username </label> <input type="text" id="username" name="username" value="" class="form-control" aria-describedby="emailHelp" placeholder="Enter id"> <small id="emailHelp" class="form-text text-muted">We'll never share your username with anyone else.</small>

					</div>
					<div class="form-group">
						<label for="exampleInputPassword1" class="form-label mt-4">Password</label> <input type="password" id="password1" name="password1" class="form-control" placeholder="Password">

					</div>
					<div class="form-group">
						<label for="exampleInputPassword2" class="form-label mt-4">Password (retype)</label> <input type="password" id="password2" name="password2" class="form-control" placeholder="Password">

					</div>
					<div class="form-group">
						<label for="exampleSelect1" class="form-label mt-4">Example select</label>
						<select class="form-select" id="mbtiOptionSelect" name="mbtiOption">

						</select>
					</div>

					<button type="submit" name="submit" class="register-btn btn btn-primary" onClick="register();">Submit</button>
				</fieldset>
			</form>
		</div>
	</div>
</body>
</html>
