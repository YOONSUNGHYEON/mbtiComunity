<?php
// Insert the page header
require_once ('include/header.php');
require_once ('include/navmenu.php');
?>


<div id="main-wrapper" class="content">
	<div>
		<h1 id="boardTitle"></h1>
	</div>

	<div id="content-wrapper" class="">
		<div>
			<button type="submit" onClick="clickCreateBtn();" class="btn-sm btn btn-outline-dark btn-write">글쓰기</button>
		</div>
		<table class="table table-hover">
			<thead>
				<tr class="table-light">
					<th scope="col" class="title-th">제목</th>
					<th scope="col">작성자</th>
					<th scope="col">추천수</th>
					<th scope="col">댓글수</th>
					<th scope="col">등록일</th>
				</tr>
			</thead>
			<tbody id="boardTable">
			</tbody>
		</table>
	</div>
	</body>
	<script type="text/javascript" async="" src="js/board.js"></script>
	</html>