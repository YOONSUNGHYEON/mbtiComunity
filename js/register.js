$(window).load(function() {
	checkSession();
	getMbtiList();
});

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
function register() {
	const registerForm = $('#registerForm').serialize();
	$.ajax({
		url: "UserController.php?method=register",
		type: "POST",
		data: registerForm, // data에 바로 serialze한 데이터를 넣는다.
		success: function(result) {
			if (result != "") {
				alert(result);
			}
			else {
				alert('회원가입 성공!');
				location.href = './login.php';
			}
		},
		error: function(request, status, error) {

		}
	})
}
function getMbtiList() {
	$.ajax({
		type: 'GET',
		url: "MbtiController.php?method=getMbtiList",
		dataType: "json",
		success: function(data) {
			let option = "";
			for (let i = 1; i < data.length; i++) {
				option += '<option id="' + data[i]['nMbtiOptionSeq'] + '"';
				option += ' name="' + data[i]['nMbtiOptionSeq'] + '"';
				option += ' value = "' + data[i]['nMbtiOptionSeq'] + '">';
				option += data[i]['sName'] + '</option>';
			}

			$("#mbtiOptionSelect").html(option);
		}
	});
}