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

    public function init(){
        $this->check_login();
        $this->admin_user = new Admin();
        $this->user = new User();
    }

    private function check_login(){
        if (isset($_COOKIE['bmw_ad_uid']) && isset($_COOKIE['bmw_ad_username']) && isset($_COOKIE['bmw_ad_ses'])){
            if ($_COOKIE['bmw_ad_ses'] == md5($_COOKIE['bmw_ad_uid'].$this->login_key.$_COOKIE['bmw_ad_username'])){
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
                setcookie('bmw_ad_ses', md5($userinfo['id'].$this->login_key.$userinfo['username']), time() + $lifeTime, "/");
                setcookie('bmw_ad_username', $userinfo['username'], time() + $lifeTime, "/");
                setcookie('bmw_ad_uid', $userinfo['id'], time() + $lifeTime, "/");
                $this->redirect("/index.php/admin");
            }
        }

        $this->render("/admin/login");
    }

    public function actionLogout(){
        if (!self::$is_login){
            $this->redirect("/index.php/admin/login");
        }
        setcookie('bmw_ad_ses', '', time() - 3600, "/");
        setcookie('bmw_ad_username', '', time() - 3600, "/");
        setcookie('bmw_ad_uid', '', time() - 3600, "/");
        $this->redirect("/index.php/admin/login");
    }

    //异步获取表的字段名
    public function actionColumns(){
        $act = isset($_POST['act']) ? trim($_POST['act']) : '';
        if(empty($act)){echo "";}
        else {
            $act = array("id","username","nickname","telephone","ip");
            echo json_encode($act);
        }
    }

    //异步获取表数据
    public function actionDatajson(){
        $table_name = isset($_GET['act']) ? trim($_GET['act']) : "";
        $page = isset($_POST['page']) ? intval($_POST['page']) : 0;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 0;
        if(empty($table_name)){echo "";}
        else {
            $data = $this->user->get_user_list($page,$rows);
            #print_r($data);
            $count = $this->user->get_user_total();
            #print_r($count);
            $data = array("total"=>$count[0]['total'],"rows"=>$data);
            echo json_encode($data);
        }
    }

}