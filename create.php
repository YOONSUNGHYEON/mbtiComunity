<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<?php
require_once ('include/header.php');
?>
</head>
<body>
<?php
require_once ('include/navmenu.php');
?>
	<div id="main-wrapper" class="content">
		<h1>글 작성</h1>
		<div id="content-wrapper" class="">
			<form name="boardForm" id="boardForm" method="post" enctype="multipart/form-data">
				<fieldset>
					<div class="form-group">
						<input type="text" class="form-control" name="title" id="" placeholder="제목을 작성해주세요">
					</div>
					<div class="form-group">
						<textarea class="form-control" name="content" id="exampleTextarea" cols="100" rows="30" placeholder="내용을 작성해주세요"></textarea>
					</div>
					</br>
				</fieldset>
				</br>
				<button onclick="sendBoardForm();" type="submit" name="submit" class="btn btn-primary">글 작성</button>

				<a class=" btn btn-outline-danger" type="button" href="javascript:goLastPage()">취소</a>

			</form>
		</div>
	</div>

</body>
<script type="text/javascript" async="" src="js/create.js"></script>
</html>