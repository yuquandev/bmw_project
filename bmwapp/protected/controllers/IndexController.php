<?php
/**
 * Created by JetBrains PhpStorm.
 * User: liuzhiyu
 * Date: 13-11-4
 * Time: 下午11:19
 * To change this template use File | Settings | File Templates.
 */

class IndexController extends Controller {

    
	private $works;
	private $works_img ;
	public function init(){
        $this->works     = new Works();
        $this->works_img = new WorkImg();
    }
    //BMW  INDEX
    public function actionIndex()
    {
      
    	//works  //后台推荐10个作品到首页
        $works = $this->works->selectWork(array('recommend'=>0,'review'=>0),'0',10,'create_time desc');
    	foreach($works as $key=>$val)
    	{
    	   $works_img_info = $this->works_img->getOneWorkImg(array('work_id'=>$val['id']));
    	   $works[$key]['imgname'] = $works_img_info['name'];
    	   $works[$key]['image_url'] = $works_img_info['image_url'];
    	}
    	
    	$data = array(
    	   'works'=>$works
    	);
        $this->render('index',$data);
    }
}