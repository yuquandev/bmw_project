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
	private $works;
	private $works_img ;
	private $banner;
	private $topic;
	public function init(){
        $this->works     = new Works();
        $this->works_img = new WorkImg();
        $this->banner    = new Banner();
        $this->topic     = new Topic();
	}
    //BMW  INDEX
    public function actionIndex()
    {
      
    	//works  //后台推荐20个作品到首页
        $works = $this->works->selectWork(array('recommend'=>0,'review'=>0),0,20);
    	
    	//活动介绍，规则  
    	$contentdis = $this->topic->selectTopic(array('type'=>1,'status'=>0));
    	
    	//底部  x1 相关图片
    	$bmw_x1 = $this->banner->selectBanner(array('topic_id'=>4,'status'=>0),0,9);
    	$bmw_x3 = $this->banner->selectBanner(array('topic_id'=>8,'status'=>0),0,9);
    	$bmw_x5 = $this->banner->selectBanner(array('topic_id'=>13,'status'=>0),0,9);
    	$data = array(
    	   'works'=>$works,
    	   'bmw_x1'=>$bmw_x1,
    	   'bmw_x3'=>$bmw_x3,
    	   'bmw_x5'=>$bmw_x5,
    	   'contentdis'=>$contentdis,
    	);
        $this->render('index',$data);
    }

    //宝马微直播
    public function actionWeibo()
    {
       $this->render('weibo');
    }

    //宝马3系列
    public function actionThreex()
    {
       $this->render('threex');
    } 
    
    //宝马5系列
    public function actionFivex()
    {
       $this->render('five');
    }

    //产品更多展示页
    public function actionMore()
    {
       $id = isset($_GET['wid']) ? intval($_GET['wid']) : '';
       $works_get_one = $this->works->getOneWork($id);
       $this->render('more');
    }
 

}