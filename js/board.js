window.onload = function() {
	getOptionNameByOptionId();
	getListByOptionId();
	//getMbtiList();
}

function getnBoardIdParam() {
	let params = new URLSearchParams(location.search);
	let nBoardId = params.get('id');
	return nBoardId;
}

function getOptionNameByOptionId() {
	let nBoardId = getnBoardIdParam();
	$.ajax({
		type: 'GET',
		url: "BoardController.php?method=findOptionNameByOptionId&id=" + nBoardId,
		dataType: "text",
		success: function(mbtiName) {
			$("#boardTitle").text(mbtiName);
		}
	});
}

function getListByOptionId() {
	let nBoardId = getnBoardIdParam();
	$.ajax({
		type: 'GET',
		url: "BoardController.php?method=findListByOptionId&id=" + nBoardId,
		dataType: "json",
		success: function(boardList) {
			let boardTable = "";
			for (let i = 1; i < boardList.length; i++) {
				boardTable += '<tr style="cursor:pointer;">';
				boardTable += '<th class="content-th" scope="row"><div><a class="board-a" href="view.php?id='+boardList[i]['nSeq']+'">'+ boardList[i]['sTitle'] + '</a></div>';
				boardTable += '<td class="content-th">'+ boardList[i]['nMemberSeq'] + '</td>';
				boardTable += '<td class="content-th">0</td>';
				boardTable += '<td class="content-th">0</td>';
				boardTable += '<td class="content-th">' + boardList[i]['dtCreateDate'] + '</td>';
				boardTable += '</tr>';
			}
			$("#boardTable").html(boardTable);

		}
	});
}

