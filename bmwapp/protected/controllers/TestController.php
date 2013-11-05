<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 13-11-5
 * Time: 下午7:27
 * To change this template use File | Settings | File Templates.
 */
class TestController extends Controller {
    public $layout = "test";
    public $test;
    public $layout_var = null;

    public function __construct(){
        $this->test = new Test();
    }

    public function actionIndex(){
        $this->render('/test/index');
    }

    public function actionDatagrid(){
        if(!isset(Yii::app()->session['username']) || !isset(Yii::app()->session['host'])){
            header("Location:/test/login");
        }

        $columns = $this->test->get_columns_by_table();

        $data = array("columns"=>$columns,
        );
        $this->layout_var = array("host"=>Yii::app()->session['host'],
            "username" => Yii::app()->session['username']
        );
        $this->render("/test/datagrid",$data);
    }

    //异步获取表数据
    public function actionDatajson(){
        $table_name = isset($_GET['tbl']) ? trim($_GET['tbl']) : "";
        $page = isset($_POST['page']) ? intval($_POST['page']) : 0;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 0;
        if(empty($table_name)){echo "";}
        else {
            $data = $this->test->get_list_by_table($table_name,$page,$rows);
            $count = $this->test->get_count_by_table($table_name);
            $data = array("total"=>$count[0]['total'],"rows"=>$data);
            echo json_encode($data);
        }
    }

    //异步获取数据库树
    public function actionTreedata(){
        $id = isset($_POST['id']) ? trim($_POST['id']) : "";
        if(empty($id)){
            $databases = $this->test->get_databases();
            $res = array();
            foreach ($databases as $k=>$v){
                $res[] = array("id"=>$v['Database'],"text"=>$v["Database"],"state"=>"closed");
            }
            echo json_encode($res);
        }else {
            if($id == "null"){echo "";exit();}

            $tables = $this->test->get_tables($id);
            $tbl_res = array();
            foreach ($tables as $k=>$v){
                $tbl_res[] = array("id"=>$id.'.'.$v["Tables_in_{$id}"],"text"=>$v["Tables_in_{$id}"]);
            }
            $tbl_res = !empty($tbl_res) ? array("text"=>"Table","state"=>"closed","children"=>$tbl_res) : array("id"=>"null","text"=>"Table","state"=>"closed");

            echo json_encode(array($tbl_res,
                array("id"=>"null","text"=>"Views","state"=>"closed"),
                array("id"=>"null","text"=>"Stored Procs","state"=>"closed"),
                array("id"=>"null","text"=>"Functions","state"=>"closed"),
                array("id"=>"null","text"=>"Triggers","state"=>"closed"),
                array("id"=>"null","text"=>"Events","state"=>"closed"),
            ));
        }

    }

    //异步获取表的字段名
    public function actionColumns(){
        $table = isset($_POST['tbl']) ? trim($_POST['tbl']) : '';
        if(empty($table)){echo "";}
        else {
            $columns = $this->test->get_columns_by_table($table);
            echo json_encode($columns);
        }
    }

    public function actionLogin(){
        echo phpinfo();
        $this->layout = "test_login";
        $this->render("/test/login");
    }

    public function actionLoginsubmit(){
        $host = isset($_POST['host']) ? trim($_POST['host']) : '';
        $username = isset($_POST['username']) ? trim($_POST['username']) : '';
        $password = isset($_POST['password']) ? trim($_POST['password']) : '';
        $port = isset($_POST['port']) ? intval($_POST['port']) : '';

        $con_res = @mysql_connect("{$host}:{$port}",$username,$password);
        if(!$con_res){
            die('Could not connect: ' . mysql_error());
        }else {
            echo 1;
            Yii::app()->session['username'] = $username;
            Yii::app()->session['host'] = $host;
        }
        mysql_close($con_res);
    }

    public function actionLogout(){
        Yii::app()->session->destroy();
        header("Location:/test/login");
    }

}
?>