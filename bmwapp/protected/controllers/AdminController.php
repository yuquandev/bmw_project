<?php
/**
 * Created by JetBrains PhpStorm.
 * User: zhaoquan
 * Date: 13-11-4
 * Time: 下午11:19
 * To change this template use File | Settings | File Templates.
 */

class AdminController extends Controller {
    public $layout = "admin";
    public $admin_user;
    public $user;
    public $topic;
    public static $is_login;
    public $login_key = '@_yu)*quan!=dev';
    private $works;
    private $works_img ;

    public $car_type;
    public $car_list;
    public $topic_nav;
    public $nav_list;
    public $topic_image;

    public $user_info;

    public $video;
    public $video_list;


    public function init(){
        $this->check_login();
        $this->admin_user = new Admin();
        $this->car_type = new CarType();
        $this->topic_nav = new TopicNav();
        $this->topic_image = new TopicImage();
        $this->works = new Works();
        $this->video = new Video();
        $this->user = new User();
    }

    //验证用户是否登录
    private function check_login(){
        if (isset($_COOKIE['bmw_ad_uid']) && isset($_COOKIE['bmw_ad_username']) && isset($_COOKIE['bmw_ad_ses']) && isset($_COOKIE['bmw_ad_t'])){
            if ($_COOKIE['bmw_ad_ses'] == md5($_COOKIE['bmw_ad_uid'].$this->login_key.$_COOKIE['bmw_ad_username'].$_COOKIE['bmw_ad_t'])){
                self::$is_login = true;
            }else {
                self::$is_login = false;
            }
        }else {
            self::$is_login = false;
        }
    }

    public function actionIndex(){
        if (!self::$is_login){
            $this->redirect("/index.php/admin/login");
        }

        $this->user_info['username'] = $_COOKIE['bmw_ad_username'];

        $this->car_list = $this->car_type->get_car_list();

        $this->nav_list = $this->topic_nav->get_nav_list();

        $this->video_list = $this->video->get_nav_list();

        $this->render("/admin/index");
    }

    public function actionLogin(){
        if (self::$is_login){
            $this->redirect("/index.php/admin");
        }

        $this->layout = "admin_login_1";
        $username = isset($_POST['username']) ? trim($_POST['username']) : '';
        $password = isset($_POST['password']) ? trim($_POST['password']) : '';

        $msg = '';
        if (empty($username) || empty($password)){
            $msg = "";
        }else {
            $userinfo = $this->admin_user->get_admin_info_by_name($username);
            if (empty($userinfo)){
                $msg = '帐号不存在';
            }else {

            if ( $userinfo['password'] != md5($password.$userinfo['salt'])){
                $msg =  "密码错误";
            }else {
                $lifeTime = 60*60*24;
                $time = time();
                setcookie('bmw_ad_ses', md5($userinfo['id'].$this->login_key.$userinfo['username'].$time), $time + $lifeTime, "/");
                setcookie('bmw_ad_username', $userinfo['username'], $time + $lifeTime, "/");
                setcookie('bmw_ad_uid', $userinfo['id'], $time + $lifeTime, "/");
                setcookie('bmw_ad_t',$time, $time + $lifeTime, "/");
                $this->redirect("/index.php/admin");
            }
            }
        }

        $data = array('msg'=>$msg,'userinfo'=>$username,'password'=>$password);
        $this->render("/admin/login_1",$data);
    }

    public function actionLogout(){
        if (!self::$is_login){
            $this->redirect("/index.php/admin/login");
        }
        $time = time();
        setcookie('bmw_ad_ses', '', $time - 3600*24, "/");
        setcookie('bmw_ad_username', '', $time - 3600*24, "/");
        setcookie('bmw_ad_uid', '', $time - 3600*24, "/");
        setcookie('bmw_ad_t','', $time - 3600*24, "/");
        $this->redirect("/index.php/admin/login");
    }

    public function actionAddadmin(){
        $username = isset($_POST['username']) ? trim($_POST['username']) : '';
        $password = isset($_POST['password']) ? trim($_POST['password']) : '';
        if (!empty($username) && !empty($password) ){
            $userinfo = $this->admin_user->get_admin_info_by_name($username);
            if (!empty($userinfo)){
                //echo "已经被注册了";
                echo json_encode(array('status'=>'fails','msg'=>'已经被注册了'));exit();
            }else {
                $salt = rand(1,32767);
                $password = md5($password.$salt);
                $ip = self::get_client_ip();
                $res = $this->admin_user->add_admin_info($username,$password,$salt,$ip);
                if ($res){
                    echo json_encode(array('status'=>'success','msg'=>'注册成功'));exit();
                }else {
                    echo json_encode(array('status'=>'fails','msg'=>'注册失败'));exit();
                }
            }
        }
        echo json_encode(array('status'=>'fails','msg'=>'参数错误'));exit();
    }

    //用户管理部分
    //异步获取表的字段名
    public function actionColumns(){
        $act = isset($_POST['act']) ? trim($_POST['act']) : '';
        if(empty($act)){echo "";exit();}
        $res = array();
        if ($act == 'user_list') {
            $res = array(
                array("field"=>"id","title"=>"用户id"),
                array("field"=>"username","title"=>"用户名(邮箱)"),
                array("field"=>"nickname","title"=>"真实姓名"),
                array("field"=>"telephone","title"=>"手机"),
                array("field"=>"ip","title"=>"ip"),
                //array("field"=>"status","title"=>"状态"),
                //array("field"=>"last_login","title"=>"登录时间"),
                array("field"=>"create_time","title"=>"注册时间"),
                array("field"=>"editor","title"=>"编辑"),
            );
        }elseif ($act == 'topic_list'){
            $res = array(
                array("field"=>"id","title"=>"id"),
                array("field"=>"name","title"=>"名称"),
                array("field"=>"description","title"=>"描述"),
                array("field"=>"create_time","title"=>"创建时间"),
                array("field"=>"editor","title"=>"编辑"),
            );
        }elseif(substr($act,0,10) == 'works_list')
        {
            $res = array(
                //array("field"=>"id","title"=>"作品id"),
                array("field"=>"username","title"=>"用户名"),
                array("field"=>"name","title"=>"作品名称"),
                array("field"=>"img_url","title"=>"作品图片"),
                array("field"=>"description","title"=>"作品描述"),
                array("field"=>"review","title"=>"审核状态"),
                array("field"=>"recommend","title"=>"推荐状态"),
                array("field"=>"vote_num","title"=>"投票数"),
                array("field"=>"create_time","title"=>"创建时间"),
                array("field"=>"editor","title"=>"编辑"),
            );
        }elseif (substr($act,0,10) == 'image_list'){
            $res = array(
                array("field"=>"name","title"=>"名称"),
                array("field"=>"image_url","title"=>"图片地址"),
                array("field"=>"description","title"=>"图片描述"),
                array("field"=>"status","title"=>"图片状态"),
                array("field"=>"create_time","title"=>"创建时间"),
                array("field"=>"editor","title"=>"编辑"),
            );
        }elseif (substr($act,0,10) == 'video_list'){
            $res = array(
                array("field"=>"name","title"=>"视频名称"),
                array("field"=>"video_url","title"=>"视频地址"),
                array("field"=>"c_url","title"=>"链接地址"),
                array("field"=>"status","title"=>"视频状态"),
                array("field"=>"create_time","title"=>"创建时间"),
                array("field"=>"editor","title"=>"编辑"),
            );
        }elseif ($act == 'admin_list'){
            $res = array(
                array("field"=>"id","title"=>"id"),
                array("field"=>"username","title"=>"管理员名称"),
                array("field"=>"ip","title"=>"ip"),
                //array("field"=>"status","title"=>"状态"),
                //array("field"=>"last_login","title"=>"登录时间"),
                array("field"=>"create_time","title"=>"注册时间"),
                array("field"=>"editor","title"=>"编辑"),
            );
        }
        echo json_encode($res);
    }


    //异步获取表数据
    public function actionDatajson(){
        $act = isset($_GET['act']) ? trim($_GET['act']) : "";
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        $page = isset($_POST['page']) ? intval($_POST['page']) : 0;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 0;
        $sort = isset($_POST['sort']) ? trim($_POST['sort']) : 'id';
        $order = isset($_POST['order']) ? trim($_POST['order']) : 'desc';
        if(empty($table_name)){echo "";}

        $res = array();
        if ($act == 'user_list'){
            $this->user = new User();
            $data = $this->user->get_user_list($page,$rows);
            #print_r($data);
            $count = $this->user->get_user_total();
            #print_r($count);
            $res = array("total"=>$count[0]['total'],"rows"=>$data);
        }else if ($act == 'topic_list'){
            $this->topic = new Topic();
            $data = $this->topic->get_topic_info_by_id($id);
            $res = array("total"=>1,"rows"=>$data);
        }else if(substr($act,0,10) == 'works_list'){
            #$this->works     = new Works();
            #$this->works_img = new WorkImg();
            $type_id = substr($act,11,strlen($act)-10);
            $sort = $sort == 'id' ? 'create_time' : $sort;
            $data = $this->works->get_works_list_by_type($type_id,$page,$rows,$sort,$order);
            $count = $this->works->get_works_total_by_type($type_id);
            $res = array("total"=>$count[0]['total'],"rows"=>$data);
        }else if (substr($act,0,10) == 'image_list'){
            $type_id = substr($act,11,strlen($act)-10);
            $data = $this->topic_image->get_image_list_by_type($type_id,$page,$rows);
            $count = $this->topic_image->get_image_total_by_type($type_id);
            $res = array("total"=>$count[0]['total'],"rows"=>$data);
        }else if (substr($act,0,10) == 'video_list'){
            $type_id = substr($act,11,strlen($act)-10);
            $data = $this->video->get_video_list_by_type($type_id,$page,$rows);
            $count = $this->video->get_video_total_by_type($type_id);
            $res = array("total"=>$count[0]['total'],"rows"=>$data);
        }else if ($act == 'admin_list'){
            $data = $this->admin_user->get_user_list($page,$rows);
            #print_r($data);
            $count = $this->admin_user->get_user_total();
            #print_r($count);
            $res = array("total"=>$count[0]['total'],"rows"=>$data);
        }
        echo json_encode($res);
    }


    //异步获取数据库树
    public function actionTreedata(){
        $id = isset($_POST['id']) ? trim($_POST['id']) : "";
        if(empty($id)){
            $res = array(
                array("id"=>'1',"text"=>'X1',"state"=>"closed"),
                array("id"=>'2',"text"=>'3系',"state"=>"closed"),
                array("id"=>'3',"text"=>'5系',"state"=>"closed")
            );
            echo json_encode($res);
        }else {
            if($id == "null"){echo "";exit();}
            $this->topic = new Topic();
            $topic_list = $this->topic->get_topiclist_by_type($id);
            #print_r($topic_list);
            $tbl_res = array();
            foreach ($topic_list as $k=>$v){
                $tbl_res[] = array("id"=>$v['id'],"text"=>$v["name"]);
            }
            #$tbl_res = !empty($tbl_res) ? array("text"=>"Table","state"=>"closed","children"=>$tbl_res) : array("id"=>"null","text"=>"Table","state"=>"closed");

            echo json_encode($tbl_res);
        }

    }

    //添加汽车分类
    public function actionAddcardtype(){
        $name = isset($_POST['name']) ? trim($_POST['name']) : '';
        $type_id = isset($_POST['type_id']) ? intval($_POST['type_id']) : 0;
        if (!empty($name)){
            if (empty($type_id)){
                $this->car_type->add_cartype_info($name);
            }else {
                $this->car_type->set_cartype_info($type_id,$name);
            }
        }
    }

    //添加专题导航
    public function actionAddnav(){
        $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
        $name = isset($_POST['name']) ? trim($_POST['name']) : '';
        $des = isset($_POST['des']) ? trim($_POST['des']) : '';
        $resource = isset($_POST['resource']) ? trim($_POST['resource']) : '';
        $act = isset($_POST['act']) ? trim($_POST['act']) : '';
        if (!empty($name)){
            if ($act == 'add'){
                $res = $this->topic_nav->add_nav_info($id,$name,$des,$resource);
            }else if($act == 'set') {
                $res = $this->topic_nav->set_nav_info($id,$name,$des,$resource);
            }
            echo json_encode(array('status'=>'success','res'=>$res));
        }else {
            echo json_encode(array('status'=>'fails','res'=>0));
        }
    }

    //获取单个导航详情
    public function actionNavinfo(){
        $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
        if (!empty($id)){
            $info = $this->topic_nav->get_info_by_id($id);
            echo json_encode($info);
        }
    }

    public function actionNavStat(){
        $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
        $stat = isset($_POST['stat']) ? intval($_POST['stat']) : 0;
        if (!empty($id)){
            if ($stat == 1){
                $stat = 0;
            }else if ($stat == 0) {
                $stat = 1;
            }
            $res = $this->topic_nav->set_nav_status($id,$stat);
            if($res){
                echo json_encode(array('status'=>'success','res'=>$res));
            }else {
                echo json_encode(array('status'=>'fails'));
            }
        }


    }

    public function actionUpload(){

        if (!isset($_FILES["Filedata"]) || !is_uploaded_file($_FILES["Filedata"]["tmp_name"]) || $_FILES["Filedata"]["error"] != 0) {
            echo 'false';
        }

        /* save to tmp */
        $file = $_FILES["Filedata"];
        if (!is_dir(Yii::app()->params['root_dir'].'uploads/topic')){
            mkdir(Yii::app()->params['root_dir'].'uploads/topic',0777);
        }
        $new_file = $_COOKIE['bmw_ad_uid'].'_'.time().'.jpg';
        $target = Yii::app()->params['root_dir'].'uploads/topic/'.$new_file;
//		$target = '/tmp/1-1373267407.jpg';

        if(!move_uploaded_file($file['tmp_name'], $target)){
            echo 'false';
        }

        //include_once(Yii::app()->params['root_dir'].'protected/components/Common.php');

        //$filename=(_UPLOADPIC($_FILES["upload"],$maxsize,$updir,$newname='date'));
        //$show_pic_scal=show_pic_scal(256, 176, $target);
        //resize($target,$show_pic_scal[0],$show_pic_scal[1]);

        echo  '/uploads/topic/'.$new_file;
    }

    //添加图片
    public function actionAddtimg(){
        $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
        $type_id = isset($_POST['type_id']) ? intval($_POST['type_id']) : 0;
        $name = isset($_POST['name']) ? trim($_POST['name']) : '';
        $img_url = isset($_POST['image_url']) ? trim($_POST['image_url']) : '';
        $stat = isset($_POST['stat']) ? trim($_POST['stat']) : '';
        $act = isset($_POST['act']) ? trim($_POST['act']) : '';
        $des = isset($_POST['des']) ? trim($_POST['des']) : '';
        if (!empty($type_id) && !empty($name)){
            if ($act == 'add'){
                $res = $this->topic_image->add_image_info($type_id,$name,$img_url,$des,$stat);
            }else if($act == 'set') {
                $res = $this->topic_image->set_img_info($id,$name,$img_url,$des,$stat);
            }
            echo json_encode(array('status'=>'success','res'=>$res));
        }else {
            echo json_encode(array('status'=>'fails','res'=>0));
        }
    }

    //修改状态imgstat
    public function actionImgstat(){
        $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
        $stat = isset($_POST['stat']) ? intval($_POST['stat']) : 0;
        if (!empty($id)){
            if ($stat == 1){
                $stat = 0;
            }else if ($stat == 0) {
                $stat = 1;
            }
            $res = $this->topic_image->set_img_status($id,$stat);
            if($res){
                echo json_encode(array('status'=>'success','res'=>$res));
            }else {
                echo json_encode(array('status'=>'fails'));
            }
        }


    }

    public function actionWorkstat(){
        $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
        $stat = isset($_POST['stat']) ? intval($_POST['stat']) : 0;
        $act = isset($_POST['act']) ? trim($_POST['act']) : 0;
        if (!empty($id)){
            if ($stat == 1){
                $stat = 0;
            }else if ($stat == 0) {
                $stat = 1;
            }
            if ($act == 'review'){
                $res = $this->works->set_work_review($id,$stat);
            }else if ($act == 'recommend'){
                $res = $this->works->set_work_recommend($id,$stat);
            }
            if($res){
                echo json_encode(array('status'=>'success','res'=>$res));exit();
            }else {
                echo json_encode(array('status'=>'fails'));exit();
            }
        }
        echo json_encode(array('status'=>'fails'));exit();
    }

    public function actionAjaxdelid(){
        $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
        $act = isset($_POST['act']) ? trim($_POST['act']) : 0;
        if (!empty($id)){
            if ($act == 'user'){
                $res = $this->user->del_id($id);
            }else if ($act == 'car_type'){
                $res = $this->car_type->del_id($id);
            }else if($act == 'topic_nav'){
                $res = $this->topic_nav->del_id($id);
            }else if ($act == 'topic_image'){
                $res = $this->topic_image->del_id($id);
            }else if ($act == 'video'){
                $res = $this->video->del_id($id);
            }else if ($act == 'works'){
                $res = $this->works->del_id($id);
            }else if ($act == 'admin'){
                $res = $this->admin_user->del_id($id);
            }
            if($res){
                echo json_encode(array('status'=>'success','res'=>$res));exit();
            }else {
                echo json_encode(array('status'=>'fails'));exit();
            }
        }
        echo json_encode(array('status'=>'fails'));exit();
    }

    //添加专题视频
    public function actionAddvideo(){
        $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
        $name = isset($_POST['name']) ? trim($_POST['name']) : '';
        $des = isset($_POST['des']) ? trim($_POST['des']) : '';
        $resource = isset($_POST['resource']) ? trim($_POST['resource']) : '';
        $act = isset($_POST['act']) ? trim($_POST['act']) : '';
        if (!empty($name)){
            if ($act == 'add'){
                $res = $this->video->add_nav_info($id,$name,$des,$resource);
            }else if($act == 'set') {
                $res = $this->video->set_nav_info($id,$name,$des,$resource);
            }
            echo json_encode(array('status'=>'success','res'=>$res));
        }else {
            echo json_encode(array('status'=>'fails','res'=>0));
        }
    }

    //获取单个视频详情
    public function actionvideoinfo(){
        $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
        if (!empty($id)){
            $info = $this->video->get_info_by_id($id);
            echo json_encode($info);
        }
    }

    public function actionVideoStat(){
        $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
        $stat = isset($_POST['stat']) ? intval($_POST['stat']) : 0;
        if (!empty($id)){
            if ($stat == 1){
                $stat = 0;
            }else if ($stat == 0) {
                $stat = 1;
            }
            $res = $this->video->set_nav_status($id,$stat);
            if($res){
                echo json_encode(array('status'=>'success','res'=>$res));
            }else {
                echo json_encode(array('status'=>'fails'));
            }
        }


    }

    public function actionVotenum(){
        $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
        $vote = isset($_POST['vote']) ? intval($_POST['vote']) : 0;
        if (!empty($id)){
            $res = $this->works->set_vote_num($id,$vote);
            if($res){
                echo json_encode(array('status'=>'success','res'=>$res));
            }else {
                echo json_encode(array('status'=>'fails'));
            }
        }
    }

}