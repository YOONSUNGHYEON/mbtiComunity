window.onload=function(){

	callFile("checkLogin");
}

function callFile(fileName) {
 		$.ajax({
  			type: 'GET',
   			url : fileName+".php",
    		data: createData(),
     		dataType:"json",
     		success : function(data) {
     			$('#result').text(data); 
     		}, error: function(jqXHR, textStatus, errorThrown) {
     			console.log(jqXHR.responseText); 
       	}
	}); 
}

function createData() {
	var sendData = {
	username:$('#username').val(),
	password:$('#password').val()
	};
	return sendData; 
}