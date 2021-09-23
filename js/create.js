window.onload = function() {
	checkWritePermission();
}
function getnBoardOptionIdParam() {
	let params = new URLSearchParams(location.search);
	let nOptionId = params.get('id');
	return nOptionId;
}
//create 페이지 들어가자마자 글쓰기 권한이 있는지 확인
function checkWritePermission(){
	let nBoardOptionId = getnBoardOptionIdParam();
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

function sendBoardForm() {
	const nOptionId = getnBoardOptionIdParam();
	const boardForm = $('#boardForm').serialize();
	 $.ajax({
            url: "BoardController.php?method=create&id="+nOptionId,
            type: "POST",
            cache: false,
            data: boardForm, // data에 바로 serialze한 데이터를 넣는다.
            success: function(nBoardId){
				if(nBoardId==-1) {
					alert("제목은  40자 이하로 작성해 주세요.");
				}
				else {
					location.href='view.php?optionId='+nOptionId+'&id='+nBoardId;
				}
				
            },
            error: function (request, status, error){        
                console.log(error)
            }
        }) 
}

