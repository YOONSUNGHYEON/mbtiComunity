<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">


	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
	<link rel="stylesheet" href="css/font-awesome.min.css">


		<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
		<link rel="stylesheet" href="css/prism-okaidia.css">

			<link rel="stylesheet" type="text/css" href="css/main.css" />


			<link rel="stylesheet" type="text/css" href="css/_bootswatch.scss" />
			<script type="text/javascript" async="" src="js/custom.js"></script>
			<script
				src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

</head>
<body>
<?php
require_once ('nav.html');
?>
	<div id="main-wrapper" class="content">
		<h1>로그인</h1>
		<div id="content-wrapper" class="">
			<form>
				<fieldset>
					<div class="form-group">
						<label for="exampleInputEmail1" class="form-label mt-4">Email
							address</label> <input type="email" class="form-control"
							id="exampleInputEmail1" aria-describedby="emailHelp"
							placeholder="Enter email">
					
					</div>
					<div class="form-group">
						<label for="exampleInputPassword1" class="form-label mt-4">Password</label>
						<input type="password" class="form-control"
							id="exampleInputPassword1" placeholder="Password">
					
					</div>
					<button type="submit" class="register-btn btn btn-primary">회원가입 하기</button>
					<button type="submit" class="register-btn btn btn-primary">로그인 하기</button>
				</fieldset>
			</form>
		</div>
	</div>
</body>
</html>
