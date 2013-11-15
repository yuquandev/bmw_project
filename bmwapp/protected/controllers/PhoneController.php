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
    public  $style = 'style="background:url(/img/phone/bm_hd_title2.jpg) repeat-x top left; line-height:35px;"';
    public function init(){
        $this->works       = new Works();
        $this->user        = new User();
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
       $this->render('upimg');
    }

    //BMW 作品
    public function actionWorks()
    {
        $works = $this->works->selectWork(array('review'=>0,'type'=>2),1,8,'`vote_num` desc ,`update_time` desc');
    	$data = array(
    	   'works' =>$works,
    	);
        $this->render('works',$data);
    }
    
    //登录
    public function actionLogin()
    {
        $this->render('login');
    }
    //注册
    public function actionReg()
    {
        $this->render('reg');
    }
    //提示跳转页
    public function actionMsg()
    {
       $this->render('msg');
    }

}