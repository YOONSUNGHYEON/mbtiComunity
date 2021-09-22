window.onload=function(){
	checkSession();
}
function checkSession(){
	$.ajax({
		type: 'GET',
		url: "UserController.php?method=session",
		dataType: "text",
		success: function(bSession) {
			if(bSession==true) {
				location.href='./index.php';
			}
		}
	});
}



function login(){
	 $.ajax({
            url: "UserController.php?method=login",
            type: "POST",
            data: {
					username:$('#username').val(),
					password:$('#password').val()
			}, 
            success: function(result){
				if(result == true) {
					alert('로그인 성공!');
					location.href='./index.php';
				}
				else {
					alert('아이디 혹은 비밀번호를 확인하세요.');
				}
            },
            error: function (request, status, error){        
                console.log(error)
            }
        }) 

}

