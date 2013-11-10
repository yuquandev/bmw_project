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
   
    private $works;
    private $user;
	private $topicimage;
	private $topicnav;
    public function init(){
        $this->works       = new Works();
        $this->user        = new User();
	    $this->topicimage  = new TopicImage();
        $this->topicnav    = new TopicNav();
    }
    //BMW  INDEX 3X
    public function actionIndex()
    {
        $this->nav = '2x';  //定义导航样式
    	$this->top = true;
        
    	
    	$name_title = $video = $description = array(); 
    	
    	//topicnav
        $topicnav = $this->topicnav->selectTopicnav(array('type_id'=>2,'status'=>0),0,0,'id ASC');
    	foreach($topicnav as $k=>$val)
    	{
    	    $name_title[] = $val['name'];
    		if( !empty($val['media_url']))
    	    {
    		  $video[] = $val['media_url'];
    	    }
    	    $description[] = $val['description'];
    	}
    	
    	//works  
        $works = $this->works->selectWork(array('recommend'=>0,'review'=>0,'type'=>2),0,8);
    	//footer img
        $image_list = $this->topicimage->selectCarTopicimage(array('type_id'=>2,'status'=>0),0,12);
      
        $data = array(
           'topicnav'=>$topicnav,
           'name_title'=>array_unique($name_title),
           'description'=>$description,
    	   'video'      =>$video,
           'works'=>$works,
           'image_list'=>$image_list,
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
       
       if($uid == '' || $type =='')
       {
          $this->redirect('/',5);
       }
       
       $works_user_list = $this->works->selectWork(array('review'=>0,'user_id'=>$uid,'type'=>2));
       
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
       
       $data = array(
          'one_img'=>$one_img,
          'all_img'=>$all_img
       );
       
       $this->render('footerimg',$data);
    }  
    
}