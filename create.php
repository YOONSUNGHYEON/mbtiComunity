<?php
session_start();
require_once ('header.php');
require_once ('appvars.php');
require_once ('connectvars.php');
require_once ('navmenu.php');
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if (isset($_GET['id'])) {
    // get으로 부터 데이터 왔다면
    $id = $_GET['id'];
    $query = "SELECT * FROM tBoardListOption WHERE nSeq='$id'";
    $data = mysqli_query($dbc, $query);
    $row = mysqli_fetch_array($data);
    $title = $row['sName'];
}
if (isset($_SESSION['user_id'])) {
    if (isset($_POST['submit'])) {
        $board_title = $_POST['title'];
        $board_content = $_POST['content'];
        $user_id = $_SESSION['user_id'];
        if(!empty($board_title)  &&  !empty($board_content))
        {
            $query = "INSERT INTO tBoardList (sTitle, sContent, dtCreateDate, nMemberSeq, nBoardOptionSeq ) 
                      VALUES ('$board_title', '$board_content', NOW(), '$user_id', '$id')";
            mysqli_query($dbc, $query);
            echo 'alert(' . '글쓰기 완료되었습니다.' . ');';
            $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/board.php?id=' . $id;
            header('Location: ' . $home_url);
        }
        else {
            echo '<div class="alert alert-dismissible alert-danger">';
            echo '<strong>모든 데이터를 입력해주세요!</strong>';
            echo '</div>';
        }
    }
}
else{ //로그인없이 글쓰기 페이지 들어 왔을때 처리
    $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/login.php';
    header('Location: ' . $home_url);
}
echo '<div id="main-wrapper" class="content">';
echo '<h1>' . $title . ' 글 작성</h1>';
?>
<div id="content-wrapper" class="">
	<form method="post" action="<?php echo $_SERVER['PHP_SELF'] . '?id=' . $id; ?>">
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
		<button type="submit" name="submit" class="btn btn-primary">글 작성</button>

		<?php 
		echo '<a class=" btn btn-outline-danger"  type="button" href="board.php?id=' . $id . '">취소</a>';
		?>
	</form>
</div>
</div>
<?php
require_once ('footer.php');
?>