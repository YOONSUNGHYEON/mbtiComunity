<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<?php
require_once ('include/header.php');
?>
<link rel="stylesheet" type="text/css" href="css/comment.css" />
<link rel="stylesheet" type="text/css" href="css/view.css" />
<script type="text/javascript" async="" src="js/view.js"></script>
</head>
<body>
<?php
require_once ('include/navmenu.php');
?>

	<div id="main-wrapper" class="content">
		<h1 id="boardTitle"></h1>

		<div id="content-wrapper" class="">
			<div class="board_view auto-center">
				<h3>글보기</h3>
				<div class="table">
					<div class="tr">
						<div class="lbl">작성자</div>
						<div class="desc">
							<p id="writer"></p>
						</div>
					</div>
					<div class="tr">
						<div class="lbl">제목</div>
						<div class="desc">
							<p id="title"></p>
						</div>
					</div>
					<div class="tr">
						<div class="lbl">내용</div>
						<div class="desc content">
							<p id="content"></p>
						</div>
					</div>
				</div>
				<div class="btn_group">
					<button onclick="clickLike();" class="btn-like">
						<img class="btn-img btn-like" src="image/heart.png" alt="">좋아요
					</button>
					<button onclick="goLastPage();" class="btn-default">목록</button>
					<button id="edit" onclick="editBoard();" class="btn-submit">수정</button>
					<button id="delete" onclick="deleteBoard();" class="btn-submit">삭제</button>
				</div>

			</div>
			<!-- 댓글 -->
			<div class="comment-view">
				<form name="commentForm" id="commentForm" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<textarea class="form-control" id="comment" name="comment" rows="3" placeholder="댓글을 작성해 주세요."></textarea>
						<button type="button" onClick="enrollComment();" class="btn-comment btn btn-outline-light btn-sm">댓글 등록</button>
					</div>
				</form>

				<hr>
				<div id="comment-list"></div>

			</div>
		</div>
	</div>
</body>
</html>