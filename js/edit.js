window.onload = function() {
	findByBoardId();
}


function getParam(sMethod) {
	let params = new URLSearchParams(location.search);
	if (sMethod == 'id') {
		return params.get('id');
	}
	else if (sMethod == 'optionId') {
		return params.get('optionId');
	}
}
//해당 게시물 내용 가져오기
function findByBoardId() {
	const nBoardId = getParam('id');
	$.ajax({
		type: 'GET',
		url: "BoardController.php?method=getBoardById&id=" + nBoardId,
		dataType: "json",
		success: function(board) {
			$('#title').val(board['sTitle']);
			$('#content').val(board['sContent']);


		}
	});
}
function goLastPage() {
	const nOptionId = getParam('optionId');
	location.href = './board.php?id=' + nOptionId;
}
function clickEditBtn() {
	const nBoardId = getParam('id');
	const nOptionId = getParam('optionId');
	const boardForm = $('#boardForm').serialize();
	//console.log(nBoardId);
	$.ajax({
		url: "BoardController.php?method=update&id=" + nBoardId,
		type: "POST",
		cache: false,
		data: boardForm, // data에 바로 serialze한 데이터를 넣는다.
		success: function(result) {

			if (nBoardId == -1) {
				alert("제목은  40자 이하로 작성해 주세요.");
			}
			else {

				location.href =  'view.php?optionId=' + nOptionId + '&id=' + nBoardId;
			}
		},
		error: function(request, status, error) {
			console.log(error)
		}
	})
}