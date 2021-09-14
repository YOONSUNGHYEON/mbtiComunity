
<?php
// Insert the page header
require_once ('header.php');
require_once ('appvars.php');
require_once ('connectvars.php');
session_start();
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

echo '<div id="main-wrapper" class="content">';
echo '<h1>' . $title . '</h1>';

echo '<div id="content-wrapper" class="">';
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $query = "SELECT * FROM tMemberList WHERE nSeq='$user_id'";
    $data = mysqli_query($dbc, $query);
    $row = mysqli_fetch_array($data);

    if ($row['nMbtiSeq'] == $id) {
        echo '	<div>';
        echo '<a class="write-btn btn btn-primary " type="button" href="create.php?id=' . $id . '">글쓰기</a>';
        echo '	</div>';
    }
}

$query = "SELECT * FROM tBoardList WHERE nBoardOptionSeq='$id'";
$data = mysqli_query($dbc, $query);

echo '<table class="table table-hover">';
echo '<thead>';
echo '<tr class="table-light">';
echo '<th scope="col" class="title-th">제목</th>';
echo '<th scope="col">작성자</th>';
echo '<th scope="col">추천수</th>';
echo '<th scope="col">댓글수</th>';
echo '<th scope="col">등록일</th>';
echo '</tr>';
echo '</thead>';
echo '<tbody>';
while ($row = mysqli_fetch_array($data)) {

    echo '<tr style="cursor:pointer;">';
    echo '<th class="content-th" scope="row"><div><a class="board-a" href="view.php">' . $row['sTitle'] . '</a></div>';
    echo '<td class="content-th">' . $row['nMemberSeq'] . '</td>';
    echo '<td class="content-th">0</td>';
    echo '<td class="content-th">0</td>';
    echo '<td class="content-th">' . $row['dtCreateDate'] . '</td>';
    echo '</tr>';
}
echo '</tbody>';
echo '</table>';
?>


</div>


</body>
</html>
<?php
require_once ('footer.php');