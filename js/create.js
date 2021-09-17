window.onload = function() {

}
function getnBoardOptionIdParam() {
	let params = new URLSearchParams(location.search);
	let nOptionId = params.get('id');
	return nOptionId;
}

function sendBoardForm() {
	const nOptionId = getnBoardOptionIdParam();
	const boardForm = $('#boardForm').serialize();
	 $.ajax({
            url: "BoardController.php?method=create&id="+nOptionId,
            type: "POST",
            cache: false,
            data: boardForm, // data에 바로 serialze한 데이터를 넣는다.
            success: function(nBoardId){
				location.href='view.php?optionId='+nOptionId+'&id='+nBoardId;
            },
            error: function (request, status, error){        
                console.log(error)
            }
        }) 
}

