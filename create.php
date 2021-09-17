<?php
session_start();
require_once ('include/header.php');
require_once ('include/navmenu.php');
?>
<div id="main-wrapper" class="content">
<h1> 글 작성</h1>
<div id="content-wrapper" class="">
	<form name="boardForm" id="boardForm" method="post" enctype="multipart/form-data" >
		<fieldset>
			<div class="form-group">
				<input type="text" class="form-control" name="title" id="" placeholder="제목을 작성해주세요">
			</div>
			<div class="form-group">
				<textarea class="form-control" name="content" id="exampleTextarea" cols="100" rows="30" placeholder="내용을 작성해주세요"></textarea>
			</div>
			</br> <input type="file" name="SelectFile" />
		</fieldset>
		</br>
		<button onclick="sendBoardForm();" type="submit" name="submit" class="btn btn-primary">글 작성</button>

		<a class=" btn btn-outline-danger"  type="button" href="board.php?id="">취소</a>';
		
	</form>
</div>
</div>
</body>
<script type="text/javascript" async="" src="js/create.js"></script>
</html>