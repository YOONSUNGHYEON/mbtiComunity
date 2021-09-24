<?php 
require_once ($_SERVER["DOCUMENT_ROOT"] . '/mbtiCommunity/application/DAO/Recommend.php');


class RecommendService {
    
    
    private $oRecommendDAO;
    
    
    function __construct() {
        $this->oRecommendDAO = new RecommendDAO();
        
    }
    
    //해당 게시물에 좋아요 눌렀는지 여부
    public function getByUserIdAndBoardId($nUserId, $nBoardId) {
        $aRecommend =  $this->oRecommendDAO->getByUserIdAndBoardId($nUserId, $nBoardId);
        if($aRecommend==null || $aRecommend['nCheck']==false) {
            return false;
        }
        return true;
        
    }
    
    
    //해당 게시물에 좋아요
    public function recommend($nUserId, $nBoardId) {
        $aRecommend =  $this->oRecommendDAO->getByUserIdAndBoardId($nUserId, $nBoardId);
        if($aRecommend==null) {
            $this->oRecommendDAO->create($nUserId, $nBoardId);
            return true;
        }
        if($aRecommend['nCheck']==0) {
            $this->oRecommendDAO->update(1, $aRecommend['nRecommendSeq']);
            return true;
        }
        else {
            $this->oRecommendDAO->update(0, $aRecommend['nRecommendSeq']);
            return false;
        }
       
               
    }
    
}