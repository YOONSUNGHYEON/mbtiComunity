window.onload = function() {
	getBoardById(); //해당 게시물 내용 가져오기
	getCommentListByBoardId();
}

function getParam(sMethod) {
	let params = new URLSearchParams(location.search);
	if(sMethod=='id') {
		return params.get('id');
	}
	else if(sMethod=='optionId') {
		return params.get('optionId');
	}
}
function goLastPage() {
	let nOptionId = getParam('optionId');
	location.href='board.php?id='+nOptionId;
}
//해당 게시물 내용 가져오기
function getBoardById() {
	let nBoardId = getParam('id');
	$.ajax({
		type: 'GET',
		url: "BoardController.php?method=getBoardById&id=" + nBoardId,
		dataType: "json",
		success: function(board) {	
			console.log(board);
			if(board['checkUser']==true) {
				$("#edit").show();
				$("#delete").show();
			}
			else {
				$("#edit").hide();
				$("#delete").hide();
			}				
			$("#writer").html(board['sID']);
			$("#title").html(board['sTitle']);
			$("#content").html(board['sContent']);

		}
	});
}

function clickLike() {
	console.log("좋아요");
}
//댓글 달기
function enrollComment() {
	const nBoardId = getParam('id');
	const commentForm = $('#commentForm').serialize();
	 $.ajax({
            url: "BoardController.php?method=comment&id="+nBoardId,
            type: "POST",
            data: commentForm, // data에 바로 serialze한 데이터를 넣는다.
            success: function(result){
				if(result==true) {
					alert("댓글을 작성했습니다.");	
					 $('#comment').val('');
					getCommentListByBoardId();
				} 
				else {
					alert(result);	
				}			
            },
            error: function (request, status, error){        
                
            }
        }) 
}
//댓글 목록 가져오기
function getCommentListByBoardId() {
	
	const nBoardId = getParam('id');
	$.ajax({
		type: 'GET',
		url: "BoardController.php?method=getListByBoardId&id=" + nBoardId,
		dataType: "json",
		success: function(commentList) {
			let commentTable = "";
			for (let i = 1; i < commentList.length; i++) {
				commentTable+= '<ul>';
				commentTable+= '<li class="comment-writer">'+commentList[i]['sID']+'</li>';
				commentTable+= '<li class="comment-content">'+commentList[i]['sContent']+'</li>';
				commentTable+= '<li class="comment-date">'+commentList[i]['dtCreateDate']+'</li>';
				commentTable+= '</ul><hr>';

			}
			$("#comment-list").html(commentTable);

		}
	});
}

//게시물 삭제하기
function deleteBoard() {
	let nBoardId = getParam('id');
	$.ajax({
		type: 'DELETE',
		url: "BoardController.php?method=delete&id=" + nBoardId,
		success: function(board) {
			goLastPage();
		}
	});
}

//수정하기
function editBoard() {
	const nBoardId = getParam('id');
	const nOptionId = getParam('optionId');
	location.href='edit.php?optionId='+nOptionId+'&id='+nBoardId;
}
