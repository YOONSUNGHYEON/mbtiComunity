window.onload = function() {
	getBoardById(); //해당 게시물 내용 가져오기
	getCommentListByBoardId();
	getRecommentByUserIdAndBoardId();
}

function getParam(sMethod) {
	let params = new URLSearchParams(location.search);
	if (sMethod == 'id') {
		return params.get('id');
	}
	else if (sMethod == 'optionId') {
		return params.get('optionId');
	}
	else if (sMethod == 'page') {
		return params.get('page');
	}
}
function goLastPage() {
	let nOptionId = getParam('optionId');
	let nPage = getParam('page');
	location.href = 'board.php?id=' + nOptionId+'&page='+nPage;
}
//해당 게시물 내용 가져오기
function getBoardById() {
	let nBoardId = getParam('id');
	$.ajax({
		type: 'GET',
		url: "BoardController.php?method=getBoardById&id=" + nBoardId,
		dataType: "json",
		success: function(board) {
			if (board['checkUser'] == true) {
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



//게시물 삭제하기
function deleteBoard() {
	let nBoardId = getParam('id');
	$.ajax({
		type: 'DELETE',
		url: "BoardController.php?method=delete&id=" + nBoardId,
		success: function(deleteResult) {
			if(deleteResult==true) {
				alert("삭제 성공했습니다.");
			}
			else {
				alert(deleteResult);
			}
			goLastPage();
		}
	});
}

//수정하기
function editBoard() {
	const nBoardId = getParam('id');
	const nOptionId = getParam('optionId');
	location.href = 'edit.php?optionId=' + nOptionId + '&id=' + nBoardId;
}


////////////////////////////////////
////////////Comment////////////////
//////////////////////////////////

//댓글 달기
function enrollComment() {
	const nBoardId = getParam('id');
	const commentForm = $('#commentForm').serialize();
	$.ajax({
		url: "BoardController.php?method=comment&id=" + nBoardId,
		type: "POST",
		data: commentForm, // data에 바로 serialze한 데이터를 넣는다.
		success: function(result) {
			if (result == true) {
				alert("댓글을 작성했습니다.");
				$('#comment').val('');
				getCommentListByBoardId();
			}
			else {
				alert(result);
			}
		},
		error: function(request, status, error) {

		}
	})
}
//댓글 삭제
function deleteComment(commentId) {
	$.ajax({
		type: 'DELETE',
		url: "BoardController.php?method=deleteByCommentId&id=" + commentId,
		success: function(result) {
			getCommentListByBoardId();
		}
	});
}

//댓글 목록 가져오기
function getCommentListByBoardId() {

	const nBoardId = getParam('id');
	$.ajax({
		type: 'GET',
		url: "BoardController.php?method=getCommentListByBoardId&id=" + nBoardId,
		dataType: "json",
		success: function(commentList) {
			let commentTable = "";
			for (let i = 1; i < commentList.length; i++) {
				commentTable += "<ul>";
				if (commentList[i]['checkUser'] == true) {
					commentTable += "<button  onclick='deleteComment(" + commentList[i]['nCommentSeq'] + ");' class='btn-submit comment-delete'>삭제</button>";
				}
				commentTable += '<li class="comment-writer">' + commentList[i]['sID'] + '</li>';
				commentTable += '<li class="comment-content">' + commentList[i]['sContent'] + '</li>';
				commentTable += '<li class="comment-date">' + commentList[i]['dtCreateDate'] + '</li>';
				commentTable += '</ul><hr>';

			}
			$("#comment-list").html(commentTable);

		}
	});
}


////////////////////////////////////
////////////like////////////////
//////////////////////////////////

//좋아요 값 가져오기
function getRecommentByUserIdAndBoardId(){
	const nBoardId = getParam("id");
	$.ajax({
		type: 'GET',
		url: "BoardController.php?method=getRecommentByUserIdAndBoardId&id=" + nBoardId,
		dataType: "json",
		success: function(recommend) {
			if(recommend==true) {
				$(".btn-like").attr("src", "image/fullHeart.png");
			}
			else {
				$(".btn-like").attr("src", "image/heart.png");
			}
		}
	});
}


//좋아요 누르기
function clickLike() {
	const nBoardId = getParam("id");
	$.ajax({
		type: 'POST',
		url: "BoardController.php?method=recommend&id=" + nBoardId,
		dataType: "text",
		success: function(recommend) {
			if(recommend==true) {
				$(".btn-like").attr("src", "image/fullHeart.png");
			}
			else {
				$(".btn-like").attr("src", "image/heart.png");
			}
		}
	});

}

























