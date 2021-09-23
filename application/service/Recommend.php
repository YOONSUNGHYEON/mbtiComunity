<?php 
require_once ('application/DAO/Recommend.php');


class RecommendService {
    
    //해당 게시물에 좋아요 눌렀는지 여부
    public function getByUserIdAndBoardId($nUserId, $nBoardId) {
        $oRecommendDAO = new RecommendDAO();
        $aRecommend = $oRecommendDAO->getByUserIdAndBoardId($nUserId, $nBoardId);
        if($aRecommend==null || $aRecommend['nCheck']==false) {
            return false;
        }
        return true;
        
    }
    
    
    //해당 게시물에 좋아요
    public function recommend($nUserId, $nBoardId) {
        $oRecommendDAO = new RecommendDAO();
        $aRecommend = $oRecommendDAO->getByUserIdAndBoardId($nUserId, $nBoardId);
        if($aRecommend==null) {
            $oRecommendDAO->create($nUserId, $nBoardId);
            return true;
        }
        if($aRecommend['nCheck']==0) {
            $oRecommendDAO->update(1, $aRecommend['nRecommendSeq']);
            return true;
        }
        else {
            $oRecommendDAO->update(0, $aRecommend['nRecommendSeq']);
            return false;
        }
       
               
    }
}