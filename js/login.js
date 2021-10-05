window.onload = function() {
	checkSession();
}
function checkSession() {
	$.ajax({
		type: 'GET',
		url: "UserController.php?method=session",
		dataType: "text",
		success: function(bSession) {
			if (bSession == true) {
				location.href = './index.php';
			}
		}
	});
}



function login() {
	$.ajax({
		url: "UserController.php?method=login",
		type: "POST",
		data: {
			username: $('#username').val(),
			password: $('#password').val()
		},
		success: function(result) {
			if (result == true) {
				alert('로그인 성공!');
				location.href = './index.php';
			}
			else {
				alert(result);
			}
		}

	})

}

