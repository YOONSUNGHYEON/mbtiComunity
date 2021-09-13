
<?php
require_once ('startsession.php');
require_once ('header.php');
require_once ('appvars.php');
require_once ('connectvars.php');

// Show the navigation menu
require_once ('navmenu.php');
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
$query = "SELECT * FROM tMbtiOption";
$data = mysqli_query($dbc, $query);
$responses = array();
while ($row = mysqli_fetch_array($data)) {
    array_push($responses, $row);
}

echo ' <div id="main-wrapper" class="content">';
echo '<h1>MBTI Community</h1>';
echo '<div id="content-wrapper" class="">';

for ($i = 0; $i < count($responses); $i = $i + 4) {
    echo ' <div class="d-table gap-3">';
    for ($j = $i; $j < $i + 4; $j ++) {
        echo '<a class="btn btn-lg btn-primary mbti-btn" type="button" href="board.php?id=' . $responses[$j]['nSeq'] . '">' . $responses[$j]['sName'] . '</a>';
    }
    echo '</div>';
}

echo '</div>';
echo '</div>';
echo '</body>';
echo '</html>';
require_once ('footer.php');
