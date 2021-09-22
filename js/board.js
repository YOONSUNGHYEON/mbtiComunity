window.onload = function() {
	//새글 버튼 보여주기 여부 검사
	getOptionNameByOptionId();
	getListByOptionId();
}

function getBoardOptionIdParam() {
	let params = new URLSearchParams(location.search);
	let BoardOptionId = params.get('id');
	return BoardOptionId;
}
function clickCreateBtn(){
	let nBoardOptionId = getBoardOptionIdParam();
	location.href="./create.php?id="+nBoardOptionId;
}
function getOptionNameByOptionId() {
	let nBoardOptionId = getBoardOptionIdParam();
	$.ajax({
		type: 'GET',
		url: "BoardController.php?method=getOptionNameByOptionId&id=" + nBoardOptionId,
		dataType: "text",
		success: function(boardOptionName) {
			$("#boardTitle").text(boardOptionName);
		}
	});
}

//게시판 목록 가져오기
function getListByOptionId() {
	let nBoardOptionId = getBoardOptionIdParam();
	$.ajax({
		type: 'GET',
		url: "BoardController.php?method=findListByOptionId&id=" + nBoardOptionId,
		dataType: "json",
		success: function(boardList) {
			let boardTable = "";
			for (let i = 1; i < boardList.length; i++) {
				boardTable += '<tr style="cursor:pointer;">';
				boardTable += '<th class="content-th" scope="row"><div><a class="board-a" href="view.php?optionId='+nBoardOptionId+'&id='+boardList[i]['nBoardSeq']+'">'+ boardList[i]['sTitle'] + '</a></div>';
				boardTable += '<td class="content-th">'+ boardList[i]['sID'] + '</td>';
				boardTable += '<td class="content-th">' + boardList[i]['nHit'] + '</td>';
				boardTable += '<td class="content-th">0</td>';
				boardTable += '<td class="content-th">' + boardList[i]['dtCreateDate'] + '</td>';
				boardTable += '</tr>';
			}
			$("#boardTable").html(boardTable);

		}
	});
}

