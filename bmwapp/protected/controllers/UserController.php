<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 13-11-6
 * Time: 上午11:08
 * To change this template use File | Settings | File Templates.
 */

class UserController extends Controller {
    #public $layout = "";
    public $user;
    public static $is_login;
    public $vcode;
    const LOGIN_KEY = 'bmw!_yu*@quan=)';

    public function init(){
        UserController::check_login();
        $this->user = new User();
    }

    static public function getuserinfo(){
        UserController::check_login();
        if (self::$is_login){
            return array('username'=>$_COOKIE['bmw_username'],'uid'=>$_COOKIE['bmw_uid']);
        }else {
            return array();
        }
    }

    //验证用户是否登录
    static public function check_login(){
        if (isset($_COOKIE['bmw_uid']) && isset($_COOKIE['bmw_username']) && isset($_COOKIE['bmw_ses']) && isset($_COOKIE['bmw_t'])){
            if ($_COOKIE['bmw_ses'] == md5($_COOKIE['bmw_uid'].UserController::LOGIN_KEY.$_COOKIE['bmw_username'].$_COOKIE['bmw_t'])){
                self::$is_login = true;
            }else {
                self::$is_login = false;
            }
        }else {
            self::$is_login = false;
        }
    }
    
    //检查用户名
    public function actionRegusername()
    {
       $username = isset($_GET['username']) ? trim($_GET['username']) : '';
       $userinfo =$this->user->get_userinfo_by_username($username);
       if(!empty($userinfo)){
          echo json_encode(array('status'=>false));
       }else{ 
          echo json_encode(array('status'=>true));
       }   
    }
    //检查手机号
    public function axtionRegphone()
    {
       $telephone = isset($_POST['telephone']) ? intval($_POST['telephone']) : '';
       $userinfo = $this->user->getOneUser(array('telephone'=>$telephone));
       if(!empty($userinfo))
          echo json_encode(array('status'=>false));
       else 
          echo json_encode(array('status'=>true));
    }
    
    //注册
    public function actionJoin(){
        if (self::$is_login){
            $this->redirect("/index.php");
        }

        $username = isset($_POST['username']) ? trim($_POST['username']) : '';
        $nickname = isset($_POST['nickname']) ? trim($_POST['nickname']) : '';
        $password = isset($_POST['password']) ? trim($_POST['password']) : '';
        $password_confim = isset($_POST['password_confim']) ? trim($_POST['password_confim']) : '';
        $telephone = isset($_POST['telephone']) ? intval($_POST['telephone']) : '';

        if (!empty($username) && !empty($password) && !empty($telephone) && ($password == $password_confim)){
            $userinfo = $this->user->get_userinfo_by_username($username);
            if (!empty($userinfo)){
                echo "已经被注册了";
            }else {
                $salt = rand(1,32767);
                $password = md5($password.$salt);
                $ip = self::get_client_ip();
                $data = array(
                    'username'  =>  $username,
                    'nickname'  =>  $nickname,
                    'password'  =>  $password,
                    'salt'      =>  $salt,
                    'telephone' =>  $telephone,
                    'ip'        =>  $ip
                );
                $res = $this->user->add_user_info($data);
                if ($res){
                    $life_time = 60*60;
                    $time = time();
                    setcookie('bmw_ses', md5($res.UserController::LOGIN_KEY.$username.$time), $time+$life_time, "/");
                    setcookie('bmw_username', $username, $time + $life_time, "/");
                    setcookie('bmw_uid', $res, $time + $life_time, "/");
                    setcookie('bmw_t', $time, $time + $life_time, "/");
                    echo "注册成功";
                }else {
                    echo "注册失败";
                }
            }
        }else {
            echo "参数错误";
        }

        $this->render("/user/join");
    }

    //登录
    public function actionLogin(){
        if (self::$is_login){
            $this->redirect("/index.php");
        }

        $username = isset($_POST['username']) ? trim($_POST['username']) : '';
        $password = isset($_POST['password']) ? trim($_POST['password']) : '';

        if (!empty($username) && !empty($password)){
            $userinfo = $this->user->get_userinfo_by_username($username);
            if (!empty($userinfo) && $userinfo['password'] == md5($password.$userinfo['salt'])){
                $life_time = 60*60;
                $time = time();
                setcookie('bmw_ses', md5($userinfo['id'].UserController::LOGIN_KEY.$userinfo['username'].$time), $time+$life_time, "/");
                setcookie('bmw_username', $userinfo['username'], $time + $life_time, "/");
                setcookie('bmw_uid', $userinfo['id'], $time + $life_time, "/");
                setcookie('bmw_t', $time, $time + $life_time, "/");
                echo "登录成功";
            }else {
                echo "密码错误";
            }
        }

        $this->render("/user/login");
    }

    //退出
    public function actionLogout(){
        if (!self::$is_login){
            $this->redirect("/index.php/user/login");
        }
        $time = time();
        setcookie('bmw_ses', '', $time - 3600, "/");
        setcookie('bmw_username', '', $time - 3600, "/");
        setcookie('bmw_uid', '', $time - 3600, "/");
        setcookie('bmw_t','', $time - 3600, "/");
        $this->redirect("/");
    }

    public function actionAjax_login(){
        if (self::$is_login){
            echo json_encode(array('status'=>'success','msg'=>'已经登陆了'));exit();
        }

        $username = isset($_POST['username']) ? trim($_POST['username']) : '';
        $password = isset($_POST['password']) ? trim($_POST['password']) : '';

        if (!empty($username) && !empty($password)){
            $userinfo = $this->user->get_userinfo_by_username($username);
            if (!empty($userinfo) && $userinfo['password'] == md5($password.$userinfo['salt'])){
                $life_time = 60*60;
                $time = time();
                setcookie('bmw_ses', md5($userinfo['id'].UserController::LOGIN_KEY.$userinfo['username'].$time), $time+$life_time, "/");
                setcookie('bmw_username', $userinfo['username'], $time + $life_time, "/");
                setcookie('bmw_uid', $userinfo['id'], $time + $life_time, "/");
                setcookie('bmw_t', $time, $time + $life_time, "/");
                echo json_encode(array('status'=>'success','msg'=>'登陆成功'));exit();
            }else {
                echo json_encode(array('status'=>'falis','msg'=>'密码错误'));exit();
            }
        }
        echo json_encode(array('status'=>'falis','msg'=>'请输入用户名和密码'));exit();
    }

    public function actionAjax_join(){
        if (self::$is_login){
            //$this->redirect("/index.php");
            echo json_encode(array('status'=>'success','msg'=>'登陆成功'));exit();
        }

        $username = isset($_POST['username']) ? trim($_POST['username']) : '';
        $nickname = isset($_POST['nickname']) ? trim($_POST['nickname']) : '';
        $password = isset($_POST['password']) ? trim($_POST['password']) : '';
        $password_confim = isset($_POST['password_confim']) ? trim($_POST['password_confim']) : '';
        $telephone = isset($_POST['telephone']) ? intval($_POST['telephone']) : '';

        if (!empty($username) && !empty($password) && !empty($telephone) && ($password == $password_confim)){
            $userinfo = $this->user->get_userinfo_by_username($username);
            if (!empty($userinfo)){
                //echo "已经被注册了";
                echo json_encode(array('status'=>'falis','msg'=>'用户名已经被注册了'));exit();
            }else {
                $salt = rand(1,32767);
                $password = md5($password.$salt);
                $ip = self::get_client_ip();
                $data = array(
                    'username'  =>  $username,
                    'nickname'  =>  $nickname,
                    'password'  =>  $password,
                    'salt'      =>  $salt,
                    'telephone' =>  $telephone,
                    'ip'        =>  $ip
                );
                $res = $this->user->add_user_info($data);
                if ($res){
                    $life_time = 60*60;
                    $time = time();
                    setcookie('bmw_ses', md5($res.UserController::LOGIN_KEY.$username.$time), $time+$life_time, "/");
                    setcookie('bmw_username', $username, $time + $life_time, "/");
                    setcookie('bmw_uid', $res, $time + $life_time, "/");
                    setcookie('bmw_t', $time, $time + $life_time, "/");
                    //echo "注册成功";
                    echo json_encode(array('status'=>'success','msg'=>'注册成功'));exit();
                }else {
                    //echo "注册失败";
                    echo json_encode(array('status'=>'falis','msg'=>'注册失败'));exit();
                }
            }
        }else {
            //echo "参数错误";
            echo json_encode(array('status'=>'falis','msg'=>'参数错误'));exit();
        }

        //$this->render("/user/join");
    }
  
}