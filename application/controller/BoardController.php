<?php 
require_once 'Models/BoardModel.php';

class BoardController {
    // Board Option list를 반환한다.
    public function getBoardOption() {
        $boardModel = new BoardModel();
        $list = $boardModel->getBoardOption();
        return $list;
    }
}
