<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 13-11-5
 * Time: 上午11:44
 * To change this template use File | Settings | File Templates.
 */
class Test extends CActiveRecord {

    public $db;

    public function __construct()
    {
        $this->db = Yii::app()->db;
    }

    public function get_columns_by_table($table_name = "xiangmu.sysuser"){
        return $this->db->queryAll("SHOW COLUMNS FROM {$table_name}");
    }

    public function get_list_by_table($table_name = "xiangmu.sysuser",$page=1,$rows=10){
        $start = ($page-1) * $rows;
        return $this->db->queryAll("SELECT * FROM {$table_name} LIMIT {$start},{$rows}");
    }

    public function get_count_by_table($table_name = "xiangmu.sysuser"){
        return $this->db->queryAll("SELECT COUNT(*) AS total FROM {$table_name}");
    }

    public function get_databases(){
        return $this->db->queryAll("SHOW DATABASES");
    }

    public function get_tables($database){
        $this->db->execute("USE {$database}");
        return $this->db->queryAll("SHOW TABLES");
    }

}