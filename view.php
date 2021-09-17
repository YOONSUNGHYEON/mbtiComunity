<?php
// Insert the page header
require_once ('include/header.php');
require_once ('include/navmenu.php');
?>
<link rel="stylesheet" type="text/css" href="css/view.css" />
<div id="main-wrapper" class="content">
<h1 id="boardTitle"> </h1>

<div id="content-wrapper" class="">
<div class="board_view auto-center">
    <h3>글보기</h3>
    <div class="table">
        <div class="tr">
            <div class="lbl">작성자</div>
            <div class="desc"><p id="writer"></p></div>
        </div>
        <div class="tr">
            <div class="lbl">제목</div>
            <div class="desc"><p id="title"></p></div>
        </div>
        <div class="tr">
            <div class="lbl">내용</div>
            <div class="desc content"><p id="content"></p></div>
        </div>
    </div>
    <div class="btn_group">
    	<button onclick="clickLike();" class="btn-like"><img class="btn-img" src="image/heart.png" alt="">좋아요</button>
    	<button onclick="goLastPage();"class="btn-default">목록</button>
        <a class="btn-submit" href="">수정</a>
        <button onclick="deleteBoard();"class="btn-submit">삭제</button>
    </div>
</div>
</div>

</div>
</body>

<script type="text/javascript" async="" src="js/view.js"></script>
</html>