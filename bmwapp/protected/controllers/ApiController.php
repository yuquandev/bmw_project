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
    public $userinfo = array();
	public function init(){
        $this->vote_log_tbl = new VoteLog();  //作品投票
        $this->works        = new Works();
        include_once(Yii::app()->params['root_dir'].'protected/controllers/UserController.php');
        $this->userinfo = UserController::getuserinfo();
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

   public function actionuplodewords()
   {
   	   if(!$this->userinfo['uid'])
   	   {
   	   	    return false;
   	   }
   	   $title = isset($_POST['title']) ? trim($_POST['title']) : '';
   	   $file  = isset($_POST['file']) ? trim($_POST['file']) :   '';
   	   $text  = isset($_POST['text']) ? trim($_POST['text']) :   '';
	   $type  = isset($_POST['type']) ? intval($_POST['type']) :   '';
   	   $uplade = $this->works->insertWork(array(
	                             'user_id'=>$this->userinfo['uid'],
	                             'name'=>$title,
	                             'img_url'=>$file,
	                             'description'=>$text,
	                             'status'=>1,
	                             'review'=>1,
	                             'recommend'=>1,
	                             'type'=>$type
	    )); 
      
   	   if($uplade){ 
          echo json_encode(array('status'=>'true'));	
       }else{  
          echo json_encode(array('status'=>'false'));
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
    
    /**
     * 验证码
     * Enter description here ...
     */
    public function actionvcode()
    {
         echo $this->authcode();
    }
  
    public function actionregvcode()
    {
       $vcode  = $_SESSION['VCODE'];
       $pvcode = isset($_GET['vcode']) ? trim($_GET['vcode']) : false;
       if($vcode == $pvcode){
          echo json_encode(array('status'=>'true'));
       }else{
       	  echo json_encode(array('status'=>'false'));
       }
    
    }

}

?>