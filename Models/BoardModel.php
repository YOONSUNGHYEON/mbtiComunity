<?php 
class BoardModel
{


    public function getBoardOption() {
        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $query = "SELECT * FROM tMbtiOption";
        $data = mysqli_query($dbc, $query);
        $responses = array();
        while ($row = mysqli_fetch_array($data)) {
            array_push($responses, $row);
        }
        return $responses;
    }
}
