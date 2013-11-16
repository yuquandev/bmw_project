<?php

/**
 * This is the model class for table "works_tbl".
 *
 * The followings are the available columns in table 'works_tbl':
 * @property string $id
 * @property integer $user_id
 * @property string $name
 * @property string $description
 * @property integer $status
 * @property integer $vote_num
 * @property string $update_time
 * @property string $create_time
 */
class Video extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Works the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'video_tbl';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id', 'required'),
			array('name, status', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>50),
			array('video_url, c_url', 'length', 'max'=>200),
			array('create_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, video_url,  c_url, status, create_time', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'status' => 'Status',
			'video_url' => 'Videourl',
			'c_url' => 'C_url',
			'create_time' => 'Create Time',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('video_url',$this->video_url,true);
		$criteria->compare('c_url',$this->c_url);
		$criteria->compare('status',$this->status);
		$criteria->compare('create_time',$this->create_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    /**
     * 
     * Enter description here ...
     * @param unknown_type $array  =>  array('id'=>2,'user_id'=>3,...); $order => $order='create_time desc'
     */
    public function selectVideo($array,$limit = 0,$limit_offis = 10,$order='create_time desc')
    {
        $where = '';
    	if( is_array($array) )
        {
            foreach($array as $key=>$val)
            {
               $where .= "`$key` = '$val' and";  
            }
        	$where = substr($where,0,-4); 
        	
        }else{
            $where = 1;
        }
        
        if( is_string($order) )
        {
           $order_list = trim($order);
        }
        if( !empty($limit) )
        {
            $limit = ($limit - 1) * $limit_offis;
        	$limit_sned = "limit {$limit},{$limit_offis}";
        }else{
           $limit_sned ='';
        }
        $sql = sprintf("SELECT `id`,`name`,`video_url`,`c_url`,`status`,`create_time` FROM %s where %s order by %s %s",$this->tableName(),$where,$order_list,$limit_sned);
        //echo $sql;
        $res = Yii::app()->db->createCommand($sql)->queryAll();
        return $res;
    }
    
  
    
    
    /**
     * 
     * Enter description here ...
     * @param unknown_type $array array('id'=>2,'user_id'=>3,...);
     */
    public function getOneVideo($array)
    {
        $where =''; 
    	if( is_array($array) )
        {
            foreach($array as $key=>$val)
            {
               $where .= "`$key` = '$val' and";  
            }
        	$where = substr($where,0,-4); 
        }else{
            return false;
        }
        $sql = sprintf("SELECT `id`,`user_id`,`name`,`img_url`,`description`,`status`,`vote_num`,`update_time`,`create_time` FROM %s where %s limit 1",$this->tableName(),$where);
        $res = Yii::app()->db->createCommand($sql)->queryRow();
        return $res;
    } 
    /**
     * 
     * Enter description here ...
     * @param unknown_type $array   array('id'=>2,'user_id'=>3,...);
     */
    public function insertVideo($array)
    {
        $ky  = $ry = array();
    	if( is_array($array) )
        {
           foreach($array as $key=>$val){
                  $ky[] = "`$key`";
                  $ry[] = "'$val'";
            }
    		$k  = implode(',',$ky);
    		$r  = implode(',',$ry);
            $time = date('Y-m-d H:i:s');
        }else{
           return false;
        }
    	$sql = sprintf("INSERT INTO %s ( %s ,`create_time`) VALUES ( %s ,'$time')",$this->tableName(),$k,$r);
        $res = Yii::app()->db->createCommand($sql)->execute();
        return $res;
    }
    
    /**
     * 
     * Enter description here ...
     * @param unknown_type $array  array('id'=>2,'user_id'=>3,...);
     * @param unknown_type $id  ��ƷID
     */
    public function updateVideo($array,$id)
    {
        if( is_array($array) && $id)
        {
            $command = array();
        	foreach ( $array as $key => $value ) {
                if($key =='vote_num'){
                   $command[] = "`$key` = $value";
                }else{
                   $command[] = "`$key` = '$value'";
                }
        		
			}
			
		    $command = implode ( ',', $command );
        }else{
           return false;
        }
    	$sql=sprintf("UPDATE %s SET %s WHERE `id` =%d",$this->tableName(),$command,$id);
    	$res = Yii::app()->db->createCommand($sql)->execute();
        return $res;
    }
    /**
     * 
     * Enter description here ...
     */
    public function delVideo($id)
    {
       $sql =sprintf("DELETE FROM %s WHERE `id` in(%s)",$this->tableName(),$id);
       $res = Yii::app()->db->createCommand($sql)->execute();
       return $res;
    }

    //添加导航
    public function add_nav_info($id,$name,$video_url,$c_url,$status=1){
        $sql = sprintf("insert into video_tbl (type_id,name,video_url,status,c_url,create_time) value (%d,'%s','%s',%d,'%s',NOW())",$id,$name,$video_url,$status,$c_url);
        $res = Yii::app()->db->createCommand($sql)->execute();
        if ($res){
            return Yii::app()->db->getLastInsertID();
        }else {
            return 0;
        }
    }

    public function get_video_list_by_type($type_id,$page=1,$rows=10){
        $offset = ($page-1) * $rows;
        $sql = sprintf("SELECT * FROM `video_tbl` WHERE type_id = %d order by id desc LIMIT %d, %d",$type_id,$offset,$rows);
        $res = Yii::app()->db->createCommand($sql)->queryAll();
        return $res;
    }

    public function get_video_total_by_type($type_id){
        $sql = sprintf("SELECT count(1) as total FROM video_tbl WHERE type_id = %d",$type_id);
        $res = Yii::app()->db->createCommand($sql)->queryAll();
        return $res;
    }

    //获取导航列表
    public function get_nav_list(){
        $sql = sprintf("select id,type_id,name from video_tbl ;");
        $res = Yii::app()->db->createCommand($sql)->queryAll();
        return $res;
    }

    public function get_info_by_id($id){
        $sql = sprintf("select * from video_tbl where id = %d",$id);
        $res = Yii::app()->db->createCommand($sql)->queryRow();
        return $res;
    }

    //更新单个导航信息
    public function set_nav_info($id,$name,$video_url,$c_url){
        $sql = sprintf("update video_tbl set name='%s',video_url='%s',c_url='%s' where id=%d",$name,$video_url,$c_url,$id);
        $res = Yii::app()->db->createCommand($sql)->execute();
        return $res;
    }

    //设置导航开启关闭
    public function set_nav_status($id,$status){
        $sql = sprintf("update video_tbl set status = %d where id = %d;",$status,$id);
        $res = Yii::app()->db->createCommand($sql)->execute();
        return $res;
    }

    //删除详情
    public function del_id($id){
        $sql = sprintf("delete from video_tbl where id = %d;",$id);
        $res = Yii::app()->db->createCommand($sql)->execute();
        return $res;
    }
   


    

    


}