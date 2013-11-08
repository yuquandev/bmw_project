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


    public function init(){
        $this->check_login();
        $this->admin_user = new Admin();
        $this->car_type = new CarType();
        $this->topic_nav = new TopicNav();
        $this->topic_image = new TopicImage();
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


        $this->car_list = $this->car_type->get_car_list();

        $this->nav_list = $this->topic_nav->get_nav_list();

        $this->render("/admin/index");
    }

    public function actionLogin(){
        if (self::$is_login){
            $this->redirect("/index.php/admin");
        }

        $this->layout = "admin_login";
        $username = isset($_POST['username']) ? trim($_POST['username']) : '';
        $password = isset($_POST['password']) ? trim($_POST['password']) : '';

        if (empty($username) || empty($password)){
            echo "参数错误";
        }else {
            $userinfo = $this->admin_user->get_admin_info_by_name($username);

            if ( $userinfo['password'] != md5($password.$userinfo['salt'])){
                echo "密码错误";
            }else {
                $lifeTime = 60*60;
                $time = time();
                setcookie('bmw_ad_ses', md5($userinfo['id'].$this->login_key.$userinfo['username'].$time), $time + $lifeTime, "/");
                setcookie('bmw_ad_username', $userinfo['username'], $time + $lifeTime, "/");
                setcookie('bmw_ad_uid', $userinfo['id'], $time + $lifeTime, "/");
                setcookie('bmw_ad_t',$time, $time + $lifeTime, "/");
                $this->redirect("/index.php/admin");
            }
        }

        $this->render("/admin/login");
    }

    public function actionLogout(){
        if (!self::$is_login){
            $this->redirect("/index.php/admin/login");
        }
        $time = time();
        setcookie('bmw_ad_ses', '', $time - 3600, "/");
        setcookie('bmw_ad_username', '', $time - 3600, "/");
        setcookie('bmw_ad_uid', '', $time - 3600, "/");
        setcookie('bmw_ad_t','', $time - 3600, "/");
        $this->redirect("/index.php/admin/login");
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
                array("field"=>"username","title"=>"用户名"),
                array("field"=>"nickname","title"=>"昵称"),
                array("field"=>"telephone","title"=>"手机"),
                array("field"=>"ip","title"=>"ip"),
                array("field"=>"status","title"=>"状态"),
                array("field"=>"last_login","title"=>"登录时间"),
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
        }elseif($act == 'works_list')
        {
            $res = array(
                array("field"=>"id","title"=>"作品id"),
                array("field"=>"user_name","title"=>"用户名"),
                array("field"=>"name","title"=>"作品名称"),
                array("field"=>"img_url","title"=>"作品图片"),
                array("field"=>"description","title"=>"作品描述"),
                array("field"=>"review","title"=>"审核状态"),
                array("field"=>"recommend","title"=>"推荐状态"),
                array("field"=>"vote_num","title"=>"投票数"),
                array("field"=>"create_time","title"=>"创建时间"),
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
        }else if($act == 'works_list'){
            $this->works     = new Works();
            $this->works_img = new WorkImg();
            $data = $this->works->selectWork(1,$page,$rows,'create_time desc');
            $count = $this->works->countWork(1);
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
        if (!empty($name)){
            $this->car_type->add_cartype_info($name);
        }
    }

    //添加专题导航
    public function actionAddnav(){
        $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
        $name = isset($_POST['name']) ? trim($_POST['name']) : '';
        $des = isset($_POST['des']) ? trim($_POST['des']) : '';
        $resource = isset($_POST['resource']) ? trim($_POST['resource']) : '';
        if (!empty($id) && !empty($name)){
            $res = $this->topic_nav->add_nav_info($id,$name,$des,$resource);
            echo 'success';
        }else {
            echo 'fails';
        }
    }

    //获取单个导航详情
    public function actionNavinfo(){
        $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
        if (!empty($id)){
            $info = $this->topic_nav->get_info_by_id($id);
            print_r($info);
        }
    }

}