<?php
/**
 * Created by JetBrains PhpStorm.
 * User: liuzhiyu
 * Date: 13-11-4
 * Time: 下午11:19
 * To change this template use File | Settings | File Templates.
 */

class OneController extends Controller {

    public  $layout = "layout_bm";
	public  $top;   //微博
    public  $nav;   //导航
   
    private $works;
    private $user;
	private $topicimage;
	private $topicnav;
    public function init(){
        $this->works     = new Works();
        $this->user      = new User();
        $this->topicimage  = new TopicImage();
        $this->topicnav    = new TopicNav();
	}
    //BMW  INDEX 3X
    public function actionIndex()
    {
        $this->nav = '1x';  //定义导航样式
    	$this->top = true;
        
        $name_title = $video = $description = array(); 
    	
    	//topicnav
        $topicnav = $this->topicnav->selectTopicnav(array('type_id'=>1,'status'=>0));
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
        $works = $this->works->selectWork(array('recommend'=>0,'review'=>0,'type'=>1),0,16);
    	//footer img
        $image_list = $this->topicimage->selectCarTopicimage(array('type_id'=>1,'status'=>0),0,12);
        $data = array(
    	   'works'=>$works,
           'image_list'=>$image_list,
           'topicnav'=>$topicnav,
           'name_title'=>array_unique($name_title),
           'description'=>array_slice($description, 3), 
    	   'video'      =>$video,
    	);
    	$this->render('/index/one',$data);
    }

   //产品更多展示页
    public function actionMore()
    {
       $this->top  =false;
       $this->nav = '1x';
       $list     = isset($_GET['uuid'])    ? trim($_GET['uuid']) : '';
       if( strpos($list,',') !== false ){
          list($uid,$type) = explode(',', $list);
       } 
       
       if($uid == '' || $type =='')
       {
          $this->redirect('/',5);
       }
       
       $works_user_list = $this->works->selectWork(array('review'=>0,'user_id'=>$uid,'type'=>1));
       
       foreach($works_user_list as $k=>$val){
          $user_info       = $this->user->getOneUser(array('id'=>$val['user_id']));
       	  $works_user_list[$k]['username'] =!empty($user_info['nickname']) ?  $user_info['nickname'] : $user_info['username'];
       }
      
       $data = array(
           'works_user_list' => $works_user_list,
       );
       $this->render('/index/more',$data);
    }
    
    //宝马X1更多页
    public function actionOnemoer()
    {
       $this->nav = '1x';
       $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
       $page_limit = 16;
       
       $works = $this->works->selectWork(array('review'=>0,'type'=>1),$page,$page_limit);
       $count_number = $this->works->countWork(array('recommend'=>0,'review'=>0,'type'=>1));
       
       $page_html = $this->page_limit($count_number,$page,$page_limit,4);
       
       $data = array(
    	   'works'=>$works,
           'page' =>$page_html
    	);
       $this->render('/index/onemoer',$data);
    }
    

    //宝马1系列
    public function actionOne()
    {
        $this->nav = '1x';
    	$this->top =false;
        //works  
        $works = $this->works->selectWork(array('recommend'=>0,'review'=>0,'type'=>1),0,16);
    	$data = array(
    	   'works'=>$works,
    	);
        $this->render('index',$data);
    }
    
    
    

    
 

    



}