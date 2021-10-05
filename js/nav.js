$(window).load(function() {
	checkSession();
});

function checkSession() {
	$.ajax({
		type: 'GET',
		url: "UserController.php?method=session",
		dataType: "text",
		success: function(bSession) {
			let a = "";
			if (bSession == true) {
				a += '<a href="javascript:clickLogout();">Log out</a>';
			}
			else {
				a += '<a href="login.php">Log In  |  </a>';
				a += '<a href="register.php">Sign Up</a>';
			}
			$("#login-logout-register").append(a);

		}
	});
}

function clickLogout() {
	$.ajax({
		type: 'GET',
		url: "UserController.php?method=logout",
		dataType: "text",
		success: function(result) {
			alert("로그아웃 되었습니다.");
			location.href = "./index.php";
		}
	});
}


