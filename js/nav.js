$(window).load(function() {
    checkSession();
});

function checkSession(){
	
	
	$.ajax({
		type: 'GET',
		url: "UserController.php?method=session",
		dataType: "text",
		success: function(bSession) {
			let a="";
			if(bSession==true) {
				a+='<a href="logout.php">Log out</a>'; 
			}
			else {
				a+='<a href="login.php">Log In  |  </a>';
				a+='<a href="register.php">Sign Up</a>';
			}
		$("#login-logout-register").append(a);
			
		}
	});
}

    
