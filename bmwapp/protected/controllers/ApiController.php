<?php 
/**
 * API接口文件
 * Enter description here ...
 * @author Administrator
 *
 */
class ApiController extends Controller {

    private $vote_log_tbl;
    private $works;
	public function init(){
        $this->vote_log_tbl = new VoteLog();  //作品投票
        $this->works        = new Works();
	}
       
    /**
     * 作品投票  限制，一个作品一个IP只能投票一次
     * Enter description here ...
     */
    public function actionVote()
    {
       $wid = isset($_GET['wid']) ? intval($_GET['wid']) : false;     
       $ip  = $this->getIP();
       $data = array(
           'work_id'=>$wid,
           'ip'=>$ip
       ); 
       $vote_info = $this->vote_log_tbl->getOneVoteLog($data);
       if( empty($vote_info) )
       {
       	  $vote_info = $this->vote_log_tbl->insertVoteLog($data);
          if($vote_info){
          	  $this->works->updateWork(array('vote_num'=>"vote_num+1"),$wid);
          	  echo json_encode(1); 
          }else{
              echo json_encode(2); 	
          }
       }else{
       	     echo json_encode(3); 
       }
    }

   /**
     * 获取当前登录的ip
     * @return string ip地址
     */
    private function getIP(){
        $ip = '';
        if(getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown')) {
            $ip = getenv('HTTP_CLIENT_IP');
        } elseif(getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown')) {
            $ip = getenv('HTTP_X_FORWARDED_FOR');
        } elseif(getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown')) {
            $ip = getenv('REMOTE_ADDR');
        } elseif(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown')) {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }

}

?>