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
    public  $nav;
    public  $center;
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
        $this->nav = 1;
    	$this->render('index');
    }
    
    //BMW 规则
    public function actionRule()
    {
        $this->nav = 2;
    	$this->render('rule');
    }

    //BMW 上传图片
    public function actionUpimg()
    {
       $this->nav = 3;
       if( empty($this->userinfo)){
           $this->msg('对不起，您还没有登录,请登录','/index.php/phone/login',false);
           exit;
       }
       $this->render('upimg');
    }

    public function actionuplodeimg()
    { 
       if( empty($this->userinfo)){
           $this->msg('对不起，您还没有登录,请登录','/index.php/phone/login',false);
           exit;
       }
       if(isset($_POST['submit']))
       {
          $title      = isset($_POST['titles']) ? trim($_POST['titles']) : ''; 
       	  $images_url = $this->uploadfile_r($_FILES['img'],$this->userinfo['uid'],'phone');
       	 
          if($images_url == 2)
       	  {
       	     $this->msg('请上传小于2MB的作品!','/index.php/phone/uplodeimg',false);exit;
       	  }
       	  if($images_url == 3)
       	  {
       	     $this->msg('上传作品必须为图片!','/index.php/phone/uplodeimg',false);exit;
       	  }
       	  $content    = isset($_POST['content']) ? trim($_POST['content']) : ''; 
          $array      = array(
          
              'user_id' => $this->userinfo['uid'],
              'name'    => $title,
              'img_url' => '/uploads/phone/'.$images_url['path'],
              'description' =>$content,
              'status' =>1,
              'type'   =>2
          );
       	  $info = $this->works->insertWork($array);
          if( $info ){
             $this->msg('上传成功，请等待审核!','/index.php/phone/works');exit;
          }else{
             $this->msg('上传失败，请重新上传!','/index.php/phone/works',false);exit;
          }       
       }else{
          $this->msg('','/index.php/phone');
          exit;
       }
    }
    
    
    
    //BMW 作品
    public function actionWorks()
    {
        $this->nav = 4;
    	$uid  = $this->center ='';
        $uid_list = isset($_GET['uuid']) ? trim($_GET['uuid']) : ''; 
        if( $uid_list ){
           list($uid , $center) = explode(',', $uid_list);	
        }
    	$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $page_limit = 8;
    	if($uid && $center == 'phone'){
            $this->center = 'phone';
    		$works = $this->works->selectWork(array('user_id'=>$uid,'type'=>2),$page,$page_limit,'`vote_num` desc ,`update_time` desc');		
    	    $count_number = $this->works->countWork(array('user_id'=>$uid,'type'=>2));
    	}else{
    	    $works = $this->works->selectWork(array('review'=>0,'type'=>2),$page,$page_limit,'`vote_num` desc ,`update_time` desc');
    	    $count_number = $this->works->countWork(array('review'=>0,'type'=>2));
    	}
    	if( empty($works) )
    	{
    	   $this->msg('您还没有上传作品，请上传作品!','/index.php/phone/works',false);exit;
    	}
    	
    	//查找文件缩略图
        foreach($works as $key=>$val)
        {
           $new_path   = $this->getFileNameArr($val['img_url']);
           $works[$key]['new_img_path'] = (file_exists(Yii::app()->params['root_dir'].$new_path[0]) == true) ? $new_path[0] :  $val['img_url'];
        }
        $page_html = $this->page_limit($count_number,$page,$page_limit,4);
    	$data = array(
    	   'uid'   =>$uid,
    	   'page'  =>$page_html,
    	   'works' =>$works,
    	);
        $this->render('works',$data);
    }
    
    //作品详情
    public function actionShow()
    {
       $this->nav = 4;
       $str = isset($_GET['id']) ? trim($_GET['id']) : false;
       list($id,$sign) = explode(',', $str);
       
       if( empty($id) || $sign !='phone'){
           $this->redirect('/index.php/phone');
       }
    
       $getone = $this->works->getOneWork(array('id'=>$id));
       $review = $getone['review'];
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
           $this->msg('对不起，您还没有登录,请登录','/index.php/phone/login',false);
           exit;
       }
       
       $wid = isset($_GET['wid']) ? intval($_GET['wid']) : false;     
       $ip  = $this->get_client_ip();
       if( false === $wid){
              $this->msg('操作失败','/index.php/phone/works',false);exit;
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
              $this->msg('投票失败，请不要恶意投票!','/index.php/phone/works',false); 	
          }
       }else{
       	      $this->msg('对不起，您已经投过该作品了!','/index.php/phone/works',false); 
       }
    }
   
    //提示跳转页
    private function msg($msg='',$url,$status = true)
    {
        $data = array(
          'msg'=>$msg,
          'url'=>$url,
          'img_url'=> ($status == true) ? '/img/bm_tck_pic_big.jpg' : '/img/bm_tck_pic2_big.jpg',
    	);
    	$this->render('msg',$data);
    }


}