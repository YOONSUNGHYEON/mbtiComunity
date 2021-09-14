
<?php
require_once ('startsession.php');
require_once ('header.php');
require_once ('appvars.php');
require_once ('connectvars.php');
require_once ('navmenu.php');

require_once 'application/controller/BoardController.php';

$board = new BoardController();
$responses = $board->getBoardOption();
?>
<div id="main-wrapper" class="content">
<h1>MBTI Community</h1>
<div id="content-wrapper" class="">
<?php

for ($i = 0; $i < count($responses); $i = $i + 4) {
    echo ' <div class="d-table gap-3">';
    for ($j = $i; $j < $i + 4; $j ++) {
        echo '<a class="btn btn-lg btn-primary mbti-btn" type="button" href="board.php?id=' . $responses[$j]['nSeq'] . '">' . $responses[$j]['sName'] . '</a>';
    }
    echo '</div>';
}
?>
</div>
</div>
</body>
</html>
