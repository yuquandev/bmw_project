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

    public function init(){
        $this->admin_user = new Admin();
        $this->user = new User();
    }

    public function actionIndex(){
        print_r($this->admin_user->get_admin_user_list());
        $this->render("/admin/index");
    }

    public function actionLogin(){
        $this->layout = "admin_login";
        $this->render("/admin/login");
    }
}