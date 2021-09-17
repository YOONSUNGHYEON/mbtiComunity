window.onload = function() {
	findById();
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
function findById() {
	let nBoardId = getParam('id');
	$.ajax({
		type: 'GET',
		url: "BoardController.php?method=view&id=" + nBoardId,
		dataType: "json",
		success: function(board) {
			$("#writer").html(board['nMemberSeq']);
			$("#title").html(board['sTitle']);
			$("#content").html(board['sContent']);

		}
	});
}

function clickLike() {
	console.log("좋아요");
}

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
