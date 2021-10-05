window.onload = function() {
	getMbtiList();
}


function getMbtiList() {
	$.ajax({
		type: 'GET',
		url: "MbtiController.php?method=getMbtiList",
		dataType: "json",
		success: function(data) {
			console.log(data);
			let option = "";
			for (let i = 1; i < data.length; i += 4) {
				option += ' <div class="d-table gap-3">';
				for (let j = i; j < i + 4; j++) {
					option += '<a class="btn btn-lg btn-primary mbti-btn" type="button" href="board.php?id=' + data[j]['nMbtiOptionSeq'] + '&page=1">' + data[j]['sName'] + '</a>';
				}
				option += '</div>';
			}
			$("#content-wrapper").html(option);
		}
	});
}