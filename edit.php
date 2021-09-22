<?php
session_start();
require_once ('include/header.php');
require_once ('include/navmenu.php');
?>
<div id="main-wrapper" class="content">
<h1> 글 수정하기</h1>
<div id="content-wrapper" class="">
	<form name="boardForm" id="boardForm" method="post" enctype="multipart/form-data" >
		<fieldset>
			<div class="form-group">
				<input type="text" class="form-control" name="title" id="title" placeholder="제목을 작성해주세요">
			</div>
			<div class="form-group">
				<textarea class="form-control" name="content" id="content" cols="100" rows="30" placeholder="내용을 작성해주세요"></textarea>
			</div>
			</br> <input type="file" name="SelectFile" />
		</fieldset>
		</br>
		<button onclick="clickEditBtn();" type="submit" name="submit" class="btn btn-primary">수정하기</button>

		<a class=" btn btn-outline-danger"  type="button" href="board.php?id="">취소</a>
		
	</form>
</div>
</div>
</body>
<script type="text/javascript" async="" src="js/edit.js"></script>
</html>