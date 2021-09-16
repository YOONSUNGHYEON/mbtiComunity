window.onload = function() {
	getMbtiList();
}


function getMbtiList() {
	$.ajax({
		type: 'GET',
		url: "MbtiController.php?method=findMbtiList",
		dataType: "json",
		success: function(data) {
			
			let option = "";
			for(let i = 1; i<data.length; i++) {				
				option += '<option id="' + data[i]['nSeq']+'"';
				option += ' name="'+ data[i]['nSeq']+'"';
				option += ' value = "' + data[i]['nSeq']+'">';
				option += data[i]['sName'] + '</option>';
			}
	
			$("#mbtiOptionSelect").html(option);
		}
	});
}