<?php
/**
 * Created by JetBrains PhpStorm.
 * User: liuzhiyu
 * Date: 13-11-4
 * Time: 下午11:19
 * To change this template use File | Settings | File Templates.
 */

class IndexController extends Controller {

    public  $layout = "layout_bm";
	public  $top;   //微博
    public  $nav;   //导航
    public $userinfo = array();
    public $type;
    private $works;
    private $user;
	private $topicimage;
	private $topicnav;
   
    public function init(){
        $this->works       = new Works();
        $this->user        = new User();
	    $this->topicimage  = new TopicImage();
        $this->topicnav    = new TopicNav();
        include_once(Yii::app()->params['root_dir'].'protected/controllers/UserController.php');
        $this->userinfo = UserController::getuserinfo();
        $this->type = 2;
    }
    //BMW  INDEX 3X
    public function actionIndex()
    {
        $this->nav = '2x';  //定义导航样式
    	$this->top = true;
        
    	
    	$name_title = $video = $description = array(); 
    	
    	//topicnav
        $topicnav = $this->topicnav->selectTopicnav(array('type_id'=>2,'status'=>0),'','','id ASC');
    	foreach($topicnav as $k=>$val)
    	{
    	    if($val['name'] && empty($val['media_url']))
    	    {
    	       $name_title[] = $val['name'];
    	       $description[] = $val['description'];
    	    }
    		
    		if($val['name'] && $val['media_url'])
    		{
    		    $video_title[] = $val['media_url'];
    			$video_url[] = $val['media_url'];
    		}
    	}
    	//var_dump($video_url);die;
    	//works  
        $works = $this->works->selectWork(array('recommend'=>0,'review'=>0,'type'=>2),0,8);
    	//footer img
        $image_list = $this->topicimage->selectCarTopicimage(array('type_id'=>2,'status'=>0),0,12);
        
        $data = array(
           'topicnav'=>$topicnav,
           'works'=>$works,
           'image_list'=>$image_list,
            'name_title'=>$name_title,
           'description'=>$description, 
    	   'video_title'=>$video,
    	   'video_url'  =>$video_url,
    	);
    	$this->render('three',$data);
    }


    
   //产品更多展示页
    public function actionMore()
    {
       $this->top  =false;
       $this->nav = '2xmoer';
       $list     = isset($_GET['uuid'])    ? trim($_GET['uuid']) : '';
       if( strpos($list,',') !== false ){
          list($uid,$type) = explode(',', $list);
       } 
       if($type !='')
       {
          $this->nav = $type.'x';
       }
       if($uid == '' || $type =='')
       {
          $this->redirect('/',5);
       }
       
       $works_user_list = $this->works->selectWork(array('review'=>0,'user_id'=>$uid,'type'=>$type));
       
       foreach($works_user_list as $k=>$val){
          $user_info       = $this->user->getOneUser(array('id'=>$val['user_id']));
       	  $works_user_list[$k]['username'] =!empty($user_info['nickname']) ?  $user_info['nickname'] : $user_info['username'];
       }
      
       $data = array(
           'works_user_list' => $works_user_list,
       );
       $this->render('more',$data);
    }
    
    
    
    //宝马X3更多页
    public function actionthreemoer()
    {
       $this->nav = '2x';
       $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
       $page_limit = 8;
       
       $works = $this->works->selectWork(array('review'=>0,'type'=>2),$page,$page_limit);
       $count_number = $this->works->countWork(array('recommend'=>0,'review'=>0,'type'=>2));
       
       $page_html = $this->page_limit($count_number,$page,$page_limit,4);
       
       $data = array(
    	   'works'=>$works,
           'page' =>$page_html
    	);
       $this->render('threemoer',$data);
    }

    //轮播详细
    public function actionfooterlg()
    {
       
       $id_type = isset($_GET['id']) ? trim($_GET['id']) : '';
       if( strpos($id_type, ',') !==false )
       {
          list($id,$type) = explode(',', $id_type);
       }
       $this->nav = $type.'x';
       $array = array();
       if($id && $type){
         $one_img = $this->topicimage->getOneTopicImage(array('id'=>$id,'type_id'=>$type));
       }else{
         $one_img = '';
       }
       
       $all_img = $this->topicimage->selectCarTopicimage(array('type_id'=>$type));
       foreach($all_img as $key=>$v)
       {
           if($v['id'] == $id){
              unset($all_img[$key]);
           }
       }
       $data = array(
          'one_img'=>$one_img,
          'all_img'=>$all_img
       );
       
       $this->render('footerimg',$data);
    }
    //图片上传
    public function actionUploads(){

        if (!isset($_FILES["Filedata"]) || !is_uploaded_file($_FILES["Filedata"]["tmp_name"]) || $_FILES["Filedata"]["error"] != 0) {
            echo 'fails';
        }

        /* save to tmp */
        $file = $_FILES["Filedata"];
        if (!is_dir(Yii::app()->params['root_dir'].'uploads/works')){
            mkdir(Yii::app()->params['root_dir'].'uploads/works',0777);
        }
        $new_file = $this->userinfo['uid'].'_'.time().'.jpg';
        $target = Yii::app()->params['root_dir'].'uploads/works/'.$new_file;
//		$target = '/tmp/1-1373267407.jpg';

        if(!move_uploaded_file($file['tmp_name'], $target)){
            echo 'fails';
        }

        echo  '/uploads/works/'.$new_file;

    }
    
}