<?php
/**
 * Created by JetBrains PhpStorm.
 * User: liuzhiyu
 * Date: 13-11-10
 * Time: 下午10:19
 * To change this template use File | Settings | File Templates.
 */

class PhoneController extends Controller
{
    public  $layout = "layout_phone";
    public  $userinfo = array();
    public  $works;
    public  $user;
    private $vote_log_tbl;
    public  $style = 'style="background:url(/img/phone/bm_hd_title2.jpg) repeat-x top left; line-height:35px;"';
    public function init(){
        $this->works        = new Works();
        $this->user         = new User();
	    $this->vote_log_tbl = new VoteLog();  //作品投票
        include_once(Yii::app()->params['root_dir'].'protected/controllers/UserController.php');
        $this->userinfo = UserController::getuserinfo();
        
    }
    //BMW  INDEX 3X
    public function actionIndex()
    {
        $this->render('index');
    }
    
    //BMW 规则
    public function actionRule()
    {
        $this->render('rule');
    }

    //BMW 上传图片
    public function actionUpimg()
    {
       if( empty($this->userinfo)){
           $this->msg('对不起，您还没有登录,请登录','/index.php/phone/login');
           exit;
       }
       $this->render('upimg');
    }

    public function actionuplodeimg()
    { 
       if(isset($_POST['submit']))
       {
          $title      = isset($_POST['title']) ? trim($_POST['title']) : ''; 
       	  $images_url = $this->uploadfile_r($_FILES['img'],$this->userinfo['uid']);
       	  $new_path   = $this->getFileNameArr($images_url['path']);
          
          $content    = isset($_POST['content']) ? trim($_POST['content']) : ''; 
          $array      = array(
          
              'user_id' => $this->userinfo['uid'],
              'name'    => $title,
              'img_url' => Yii::app()->params['root_dir'].'/uploads/phone/'.$new_path[0],
              'description' =>$content,
              'status' =>1,
              'type'   =>2
          );
       	  $info = $this->works->insertWork($array);
          if( $info ){
             $this->msg('上传成功，请等待审核!','/index.php/phone/works');
          }else{
             $this->msg('上传失败，请重新上传!','/index.php/phone/works');
          }       
       }else{
          $this->msg('','/index.php/phone');
          exit;
       }
    }
    
    
    
    //BMW 作品
    public function actionWorks()
    {
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $page_limit = 8;
    	$works = $this->works->selectWork(array('review'=>0,'type'=>2),$page,$page_limit,'`vote_num` desc ,`update_time` desc');
    	$count_number = $this->works->countWork(array('review'=>0,'type'=>2));
    	$page_html = $this->page_limit($count_number,$page,$page_limit,4);
    	$data = array(
    	   'page'  =>$page_html,
    	   'works' =>$works,
    	);
        $this->render('works',$data);
    }
    
    //作品详情
    public function actionShow()
    {
       $str = isset($_GET['id']) ? trim($_GET['id']) : false;
       list($id,$sign) = explode(',', $str);
       
       if( empty($id) || $sign !='phone'){
           $this->redirect('/index.php/phone');
       }
       $getone = $this->works->getOneWork(array('id'=>$id));
       
       //上一遍
       $up_getone = $this->works->getUpwork(array('id'=>$id),'<','id desc');
       if( empty($up_getone) )
       {
          $up_getone['name'] = '已经是第一篇了!';
       }
       //下一遍
       $down_getone = $this->works->getUpwork(array('id'=>$id),'>','id asc');
       if( empty($down_getone) )
       {
          $down_getone['name'] ='已经是最后一篇了!';
       }
       
       $data = array(
           'getone'=>$getone,
           'up_getone'=>$up_getone,
           'down_getone'=>$down_getone,
       );
       $this->render('show',$data);
    }
    
    
    //登录
    public function actionLogin()
    {
        if( !empty($this->userinfo)){
           $this->msg('','/index.php/phone');
           exit;
        }
    	$this->render('login');
    }
    //注册
    public function actionReg()
    {
        if( !empty($this->userinfo)){
           $this->msg('','/index.php/phone');
           exit;
        }
    	$this->render('reg');
    }
    
   /**
     * PHONE
     * 作品投票  限制，一个作品一个IP只能投票一次
     * Enter description here ...
     */
    public  function actionPhonevote()
    {
       
       if( empty($this->userinfo)){
           $this->msg('对不起，您还没有登录,请登录','/index.php/phone/login');
           exit;
       }
       
       $wid = isset($_GET['wid']) ? intval($_GET['wid']) : false;     
       $ip  = $this->get_client_ip();
       if( false === $wid){
              $this->msg('操作失败','/index.php/phone/works');exit;
       }
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
          	  $this->msg('恭喜您，投票成功!','/index.php/phone/works');
          }else{
              $this->msg('投票失败，请不要恶意投票!','/index.php/phone/works'); 	
          }
       }else{
       	      $this->msg('对不起，您已经投过该作品了!','/index.php/phone/works'); 
       }
    }
   

   //提示跳转页
    private function msg($msg='',$url)
    {
        $data = array(
          'msg'=>$msg,
          'url'=>$url,
        );
    	$this->render('msg',$data);
    }


}