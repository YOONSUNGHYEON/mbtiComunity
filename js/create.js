window.onload = function() {

}

function sendBoardForm() {
	
	const boardForm = $('#boardForm').serialize();
	 $.ajax({
            url: "BoardController.php?method=create",
            type: "POST",
            cache: false,
            data: boardForm, // data에 바로 serialze한 데이터를 넣는다.
            success: function(data){
                console.log(data)
            },
            error: function (request, status, error){        
                console.log(error)
            }
        }) 
	console.log(boardForm);
}

