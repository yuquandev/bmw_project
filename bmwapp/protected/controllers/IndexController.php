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
    public  $minjs; //JS
    private $works;
    private $user;
	
    public function init(){
        $this->works     = new Works();
        $this->user      = new User();
	}
    //BMW  INDEX 3X
    public function actionIndex()
    {
        $this->nav = '2x';  //定义导航样式
    	
        //works  
        $works = $this->works->selectWork(array('recommend'=>0,'review'=>0,'type'=>2),0,8);
    	$data = array(
    	   'works'=>$works,
    	);
    	$this->render('three',$data);
    }

    //宝马微直播
    public function actionWeibo()
    {
       $this->render('weibo');
    }

    //宝马1系列
    public function actionOne()
    {
        $this->nav = '1x';
    	$this->top =true;
        //works  
        $works = $this->works->selectWork(array('recommend'=>0,'review'=>0,'type'=>1),0,16);
    	$data = array(
    	   'works'=>$works,
    	);
        $this->render('index',$data);
    }
    
    //宝马X1更多页
    public function actionOnemoer()
    {
       $this->nav = '1x';
       $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
       $page_limit = 16;
       
       $works = $this->works->selectWork(array('recommend'=>0,'review'=>0,'type'=>1),$page,$page_limit);
       $count_number = $this->works->countWork(array('recommend'=>0,'review'=>0,'type'=>1));
       
       $page_html = $this->page_limit($count_number,$page,$page_limit,4);
       
       $data = array(
    	   'works'=>$works,
           'page' =>$page_html
    	);
       $this->render('allmoer',$data);
    }
    
    //宝马X3更多页
    public function actionthreemoer()
    {
       $this->nav = '3x';
       $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
       $page_limit = 8;
       
       $works = $this->works->selectWork(array('recommend'=>0,'review'=>0,'type'=>2),$page,$page_limit);
       $count_number = $this->works->countWork(array('recommend'=>0,'review'=>0,'type'=>2));
       
       $page_html = $this->page_limit($count_number,$page,$page_limit,4);
       
       $data = array(
    	   'works'=>$works,
           'page' =>$page_html
    	);
       $this->render('threemoer',$data);
    }
    
    
    
    //宝马5系列
    public function actionFivex()
    {
       $this->render('five');
    }

    //产品更多展示页
    public function actionMore()
    {
       $this->minjs= $this->top  =false;
       $list     = isset($_GET['uuid'])    ? trim($_GET['uuid']) : '';
       if( strpos($list,',') !== false ){
          list($uid,$type) = explode(',', $list);
       } 
       $this->nav = $type.'x';
       if($uid == '' || $type =='')
       {
          $this->redirect('/',5);
       }
       $works_user_list = $this->works->selectWork(array('review'=>0,'user_id'=>$uid));
       
       foreach($works_user_list as $k=>$val){
          $user_info       = $this->user->getOneUser(array('id'=>$val['user_id']));
       	  $works_user_list[$k]['username'] =!empty($user_info['nickname']) ?  $user_info['nickname'] : $user_info['username'];
       }
      
       $data = array(
           'works_user_list' => $works_user_list,
       );
       $this->render('more',$data);
    }
 

    



}