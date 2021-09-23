window.onload = function() {
	//새글 버튼 보여주기 여부 검사
	getOptionNameByOptionId();
	getListByOptionId(getParam('page'));
}

function getParam(sMethod) {
	let params = new URLSearchParams(location.search);
	if(sMethod=='page') {
		return params.get('page');
	}
	else if(sMethod=='optionId') {
		return params.get('id');
	}
}

function getBoardOptionIdParam() {
	let params = new URLSearchParams(location.search);
	let BoardOptionId = params.get('id');
	
	return BoardOptionId;
}
function clickCreateBtn() {
	let nBoardOptionId = getParam('optionId');
	location.href = "./create.php?id=" + nBoardOptionId;
}
function getOptionNameByOptionId() {
	let nBoardOptionId = getParam('optionId');
	$.ajax({
		type: 'GET',
		url: "BoardController.php?method=getOptionNameByOptionId&id=" + nBoardOptionId,
		dataType: "text",
		success: function(boardOptionName) {
			$("#boardTitle").text(boardOptionName);
		}
	});
}
//게시물 삭제하기
function deleteBoard(nBoardId, page) {

	$.ajax({
		type: 'DELETE',
		url: "BoardController.php?method=delete&id=" + nBoardId,
		success: function(board) {
			getListByOptionId(page);
		}
	});
}

//게시판 목록 가져오기
function getListByOptionId(page) {
	let nBoardOptionId = getParam('optionId');
	$.ajax({
		type: 'GET',
		url: "BoardController.php?method=board&id=" + nBoardOptionId + "&page=" + page,
		dataType: "json",
		success: function(data) {
			let boardTable = "";
			for (let i = 1; i <= data['currentCount']; i++) {
				boardTable += '<tr style="cursor:pointer;">';
				boardTable += '<th class="content-th" scope="row"><div><a class="board-a" href="view.php?optionId=' + nBoardOptionId + '&id=' + data[i]['nBoardSeq'] +  '&page=' +data["pageData"]["currentPage"] + '">' + data[i]['sTitle'] + '</a></div>';
				boardTable += '<td class="content-th">' + data[i]['sID'] + '</td>';
				boardTable += '<td class="content-th">' + data[i]['nHit'] + '</td>';
				boardTable += '<td class="content-th">' + data[i]['nCommentCount'] + '</td>';
				boardTable += '<td class="content-th">' + data[i]['dtCreateDate'] + '</td>';
				if(data["checkAdmin"]==true) {
					boardTable += "<td class='content-th'><button id='delete' onclick='deleteBoard(" + data[i]['nBoardSeq']+ "," + page + ");' class='btn-submit'>삭제</button></td>";
				}
				boardTable += '</tr>';
			}
			$("#boardTable").html(boardTable);
			
			let pagingHtml="";
			pagingHtml+="<li class='page-item'><a class='page-link' href='javascript:getListByOptionId(" + data["pageData"]["startPage"]+")'>&laquo;</a></li>";
			for (var i = data["pageData"]['startPage']; i <= data["pageData"]["endPage"]; i++) {
				if (i == data["pageData"]["currentPage"]) {
					pagingHtml += "<li class='page-item active'>";
				} else {
					pagingHtml += "<li class=page-item>";
				}
				pagingHtml += "<a class=page-link href='javascript:getListByOptionId("+i+")'>" + i;
				pagingHtml += "</a></li>";
			}
			pagingHtml+="<li class='page-item'><a class='page-link' href='javascript:getListByOptionId(" + data["pageData"]["endPage"]+")'>&raquo;</a></li>";
			$('#pagination').empty();
			$('#pagination').html(pagingHtml);


		}
	});
}




