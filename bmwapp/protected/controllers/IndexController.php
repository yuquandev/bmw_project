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
    public  $userinfo = array();
    public  $type;
    public  $style;
    private $works;
    private $user;
	private $topicimage;
	private $video;
	
   
    public function init(){
        //wap 验证
    	if($this->check_wap() == true)
    	{
    	   $this->redirect('index.php/phone');exit;
    	}
		$this->works       = new Works();
        $this->user        = new User();
	    $this->topicimage  = new TopicImage();
        $this->video       = new Video();
        include_once(Yii::app()->params['root_dir'].'protected/controllers/UserController.php');
        $this->userinfo = UserController::getuserinfo();
        //var_dump($this->userinfo);
        $this->type = 2;
    }
    //BMW  INDEX 3X
    public function actionIndex()
    {
        $this->nav = '1x';  //定义导航样式
    	$this->top = true;
        //video
        $video = $this->video->selectVideo(array('status'=>0),1,5);
    	//var_dump($video);
        //works  
        $works = $this->works->selectWork(array('review'=>0,'type'=>2),1,8,'`recommend` asc, `vote_num` desc ,`update_time` desc');
         //查找文件缩略图
        foreach($works as $key=>$val)
        {
           $new_path   = $this->getFileNameArr($val['img_url']);
           $works[$key]['new_img_path'] = (file_exists(Yii::app()->params['root_dir'].$new_path[2]) == true) ? $new_path[2] :  $val['img_url'];
        }
        
        //footer img
        $image_list = $this->topicimage->selectCarTopicimage(array('type_id'=>2,'status'=>0),1,12);
        //查找文件缩略图
        foreach($image_list as $key=>$val)
        {
           $new_path   = $this->getFileNameArr($val['image_url']);
           $image_list[$key]['new_img_path'] = (file_exists(Yii::app()->params['root_dir'].$new_path[1]) == true) ? $new_path[1] :  $val['image_url'];
        }
        
        $data = array(
           'video'=>$video,
           'works'=>$works,
           'image_list'=>$image_list,
        );
    	$this->render('three',$data);
    }


    
   //产品更多展示页
    public function actionMore()
    {
       $this->top  =false;
      // $this->nav = '1x';
       $pash_where = '';
       $get_one_works='';
       $list     = isset($_GET['uuid'])    ? trim($_GET['uuid']) : '';
       if( strpos($list,',') !== false ){
          list($id,$uid,$type,$center) = explode(',', $list);
       } 
       if($uid == '')
       {
          $this->redirect('/',5);
       }
       if($id > 0){
           $pash_where = sprintf('and id !=%d',$id);
            //用户选择的图
           $get_one_works = $this->works->getOneWork(array('id'=>$id));
       }
       
       if($center === 'center')  //用户中心
       {
          $works_user_list = $this->works->selectWork(array('user_id'=>$uid,'type'=>$type),0,0,'create_time desc',$pash_where);
       }else{
          $works_user_list = $this->works->selectWork(array('review'=>0,'user_id'=>$uid,'type'=>$type),0,0,'create_time desc',$pash_where);
       }
       
       if( !empty($works_user_list )){
       		foreach($works_user_list as $k=>$val){
          		$user_info       = $this->user->getOneUser(array('id'=>$val['user_id']));
       	  		$works_user_list[$k]['username'] =!empty($user_info['nickname']) ?  $user_info['nickname'] : $user_info['username'];
       		}
       }		
      if($get_one_works){
       	   $user_info       = $this->user->getOneUser(array('id'=>$get_one_works['user_id']));
           $get_one_works['username'] = $user_info['username'];
       	   array_unshift($works_user_list,$get_one_works);
      }	
       $data = array(
           'center'          => $center,
           'works_user_list' => $works_user_list,
       );
       $this->render('more',$data);
    }
    
    
    
    //宝马X3更多页
    public function actionthreemoer()
    {
       $this->top  =false;
       //$this->nav = '1x';
       $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
       $page_limit = 8;
       
       $works = $this->works->selectWork(array('review'=>0,'type'=>2),$page,$page_limit,'`vote_num` desc ,`update_time` desc');
       $count_number = $this->works->countWork(array('review'=>0,'type'=>2));
       
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
       $this->top  =false;
       $id_type = isset($_GET['id']) ? trim($_GET['id']) : '';
       if( strpos($id_type, ',') !==false )
       {
          list($id,$type) = explode(',', $id_type);
       }
       $array = array();
       if($id && $type){
         $one_img = $this->topicimage->getOneTopicImage(array('id'=>$id,'type_id'=>$type));
       }else{
         $one_img = '';
       }
       $all_img = $this->topicimage->selectCarTopicimage(array('type_id'=>$type,'status'=>0),0,21);
       foreach($all_img as $key=>$v)
       {
           if($v['id'] == $id){
              unset($all_img[$key]);
           }
       }
       if($one_img){
       		array_unshift($all_img,$one_img);
       }
       
       $data = array(
          'all_img'=>$all_img
       );
       
       $this->render('footerimg',$data);
    }
    //图片上传
    public function actionUploads(){

        if (!isset($_FILES["Filedata"]) || !is_uploaded_file($_FILES["Filedata"]["tmp_name"]) || $_FILES["Filedata"]["error"] != 0) {
            echo 'false';
        }
         $_FILES["Filedata"]['type'] = 'image/jpg';
         /* save to tmp */
         $file = $_FILES["Filedata"];
         $images_url = $this->uploadfile_r($_FILES["Filedata"], $this->userinfo['uid'],'works');
         if($images_url == 2)
       	 {
       	     echo 'false';
       	 }else if($images_url == 3)
       	 {
       	     echo 'false';
       	 }
        /* save to tmp */
        echo  '/uploads/works/'.$images_url['path'];
    	
        
        
        /*if (!isset($_FILES["Filedata"]) || !is_uploaded_file($_FILES["Filedata"]["tmp_name"]) || $_FILES["Filedata"]["error"] != 0) {
            echo 'false';
        }

   
        $file = $_FILES["Filedata"];
        if (!is_dir(Yii::app()->params['root_dir'].'uploads/works')){
            mkdir(Yii::app()->params['root_dir'].'uploads/works',0777);
        }
        $new_patg_name = md5( time(). mt_rand() );
        $new_file = $this->userinfo['uid'].'_'.$new_patg_name.'.jpg';
        $target = Yii::app()->params['root_dir'].'uploads/works/'.$new_file;
     	$target = '/tmp/1-1373267407.jpg';

        if(!move_uploaded_file($file['tmp_name'], $target)){
            echo 'false';
        }

        echo  '/uploads/works/'.$new_file;*/

    }
    
    //瀑布流
    public function actionFlow()
    {
        $this->nav = '2x';  //定义导航样式
    	//img
        $all_img = $this->topicimage->selectCarTopicimage(array('type_id'=>2,'status'=>0),0,5);
        if( $all_img ){
	    	foreach($all_img as $key=>$val)
	        {
	           str_replace(array('	',' '),array('',''),$val['description']);
	        }
        }
        //video
        $all_video = $this->video->selectVideo(array('status'=>0));
    	if($all_video){
       //查找文件缩略图
		        $last_one_video = array();
    		    foreach($all_video as $key=>$val)
		        {
		           if( $val['id'] == 16 ){  //特殊视频处理
		              $last_one_video  =  $val;
		              $last_one_video['img_url_path']  =  !empty($val['img_url'])  ? $val['img_url'] : '/img/bm_spt_pic.jpg';
		              unset($all_video[$key]);
		           }else{
		              $all_video[$key]['img_url_path'] =  !empty($val['img_url'])  ? $val['img_url'] : '/img/bm_spt_pic.jpg';
		           }
		        }
    	        if( $last_one_video ){
		          array_push($all_video,$last_one_video);
    	        }  
    	}
    	$data = array(
           'all_img'=>$all_img,
    	   'all_video'=>$all_video,
        );
        
        $this->render('flow',$data);
    }
    
    //人车交互
    public function actionpopcar()
    {
       $this->nav = '3x';  //定义导航样式
       $this->render('rcar');
    }
    //视频详细
    public function actionShowvideo()
    {
       $status = isset($_GET['sid']) ? trim($_GET['sid']) : '';
       list($id,$label) = explode(',', $status);
       if( empty($id) || $label !='video')
       {
          $this->redirect('/');
       }
       
       $get_one_video_info = $this->video->getOneVideo(array('id'=>$id));
       $data = array(
          'get_one_video_info'=>$get_one_video_info,
       );
       $this->render('video',$data);
    }
    
    
}