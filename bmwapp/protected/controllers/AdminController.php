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
    public static $is_login;
    public $login_key = '@_yu)*quan!=dev';
    private $works;
	private $works_img ;
	
    
    public function init(){
        $this->check_login();
        $this->admin_user = new Admin();
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
        #print_r($this->admin_user->get_admin_user_list());
        $data = array("key"=>array(1,2,3));
        $this->render("/admin/index",$data);
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
        }elseif($act == 'works_list')
        {
            $res = $this->actionWorks();
        }
        echo json_encode($res);
    }

    //作品管理部分
    public function actionWorks()
    {
        $works_list = array(
                array("field"=>"id","title"=>"作品id"),
                array("field"=>"user_id","title"=>"用户用户ID"),
                array("field"=>"name","title"=>"作品名称"),
                array("field"=>"img_url","title"=>"作品图片"),
                array("field"=>"description","title"=>"作品描述"),
                array("field"=>"status","title"=>"作品状态"),
                array("field"=>"review","title"=>"审核状态"),
                array("field"=>"recommend","title"=>"推荐状态"),
                array("field"=>"vote_num","title"=>"投票数"),
                array("field"=>"update_time","title"=>"更新时间"),
                array("field"=>"create_time","title"=>"创建实际上呢"),
        );
        echo json_encode($works_list);  
    } 
    
    
    //异步获取表数据
    public function actionDatajson(){
        $act = isset($_GET['act']) ? trim($_GET['act']) : "";
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
        }else if($act == 'works_list'){
            $this->works     = new Works();
            $this->works_img = new WorkImg();
            $data = $this->works->selectWork(1,$page,$rows,'create_time desc');
            $count = $this->works->countWork(1);
            $res = array("total"=>$count[0]['total'],"rows"=>$data);
        }
        echo json_encode($res);
    }
   
    
    
    
    
    
   
}