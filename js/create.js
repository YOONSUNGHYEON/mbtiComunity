window.onload = function() {
	checkWritePermission();
}
function getnBoardOptionIdParam() {
	const params = new URLSearchParams(location.search);
	const nOptionId = params.get('id');
	return nOptionId;
}
//create 페이지 들어가자마자 글쓰기 권한이 있는지 확인
function checkWritePermission(){
	const nBoardOptionId = getnBoardOptionIdParam();
	$.ajax({
		type: 'GET',
		url: "BoardController.php?method=checkWritePermission&id=" + nBoardOptionId,
		dataType: "text",
		success: function(sResult) {
			if(sResult!="") {			
				location.href = "./board.php?id=" + nBoardOptionId;
				alert(sResult);
			}
			
		}
	});
}

function goLastPage() {
	const nOptionId =getnBoardOptionIdParam();
	location.href = './board.php?id=' + nOptionId;
}

function sendBoardForm() {
	const nOptionId = getnBoardOptionIdParam();
	const boardForm = $('#boardForm').serialize();
	 $.ajax({
            url: "BoardController.php?method=create&id="+nOptionId,
            type: "POST",
            cache: false,
            data: boardForm, // data에 바로 serialze한 데이터를 넣는다.
            success: function(result){
				if(result>0) {
					location.href='view.php?optionId='+nOptionId+'&id='+result;					
				}
				else {
					alert(result);
				}
				
            },
            error: function (request, status, error){        
                console.log(error)
            }
        }) 
}

