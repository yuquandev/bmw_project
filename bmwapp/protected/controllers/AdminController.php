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
        print_r($this->admin_user->get_admin_user_list());
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
            print_r(md5($password.$userinfo['salt']));
            if ( $userinfo['password'] != md5($password.$userinfo['salt'])){
                echo "密码错误";
            }else {
                $lifeTime = 60;
                setcookie('bmw_ad_ses', md5($userinfo['id'].$this->login_key.$userinfo['username']), time() + $lifeTime, "/");
                setcookie('bmw_ad_username', $userinfo['username'], time() + $lifeTime, "/");
                setcookie('bmw_ad_uid', $userinfo['id'], time() + $lifeTime, "/");
                $this->redirect("/index.php/admin");
            }
        }

        $this->render("/admin/login");
    }
}