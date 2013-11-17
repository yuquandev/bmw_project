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
class Works extends CActiveRecord
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
		return 'works_tbl';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id', 'required'),
			array('user_id, status, vote_num', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>50),
			array('description', 'length', 'max'=>200),
			array('update_time, create_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, name, description, status, vote_num, update_time, create_time', 'safe', 'on'=>'search'),
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
			'user_id' => 'User',
			'name' => 'Name',
			'description' => 'Description',
			'status' => 'Status',
			'vote_num' => 'Vote Num',
			'update_time' => 'Update Time',
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('vote_num',$this->vote_num);
		$criteria->compare('update_time',$this->update_time,true);
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
    public function selectWork($array,$limit = 0,$limit_offis = 10,$order='create_time desc')
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
        $sql = sprintf("SELECT `id`,`user_id`,`name`,`img_url`,`description`,`type`,`vote_num`,`review`,`update_time`,`create_time` FROM %s where %s order by %s %s",$this->tableName(),$where,$order_list,$limit_sned);
        //echo $sql;
        $res = Yii::app()->db->createCommand($sql)->queryAll();
        return $res;
    }
    
    /**
     * 
     * Enter description here ...
     */
    public function countWork($array)
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
    	$sql = sprintf("SELECT COUNT(1) AS `num` FROM %s where %s",$this->tableName(),$where);
        //echo $sql;
        $res = Yii::app()->db->createCommand($sql)->queryAll();
        return $res[0]['num'];
    }
    
    
    /**
     * 
     * Enter description here ...
     * @param unknown_type $array array('id'=>2,'user_id'=>3,...);
     */
    public function getOneWork($array)
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
    public function insertWork($array)
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
    public function updateWork($array,$id)
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
			$time = date('Y-m-d H:i:s');
		    $command = implode ( ',', $command );
        }else{
           return false;
        }
    	$sql=sprintf("UPDATE %s SET %s,`update_time` = '$time' WHERE `id` =%d",$this->tableName(),$command,$id);
    	$res = Yii::app()->db->createCommand($sql)->execute();
        return $res;
    }
    /**
     * 
     * Enter description here ...
     */
    public function delWork($id)
    {
       $sql =sprintf("DELETE FROM %s WHERE `id` in(%s)",$this->tableName(),$id);
       $res = Yii::app()->db->createCommand($sql)->execute();
       return $res;
    }

    public function get_works_list_by_type($type_id,$page=1,$rows=10,$sort='vote_num',$order='desc'){
        $offset = ($page-1) * $rows;
        $sql = sprintf("SELECT w.id,w.user_id,w.name,w.img_url,w.description,w.status,w.review,w.recommend,w.type,w.vote_num,w.update_time,w.create_time,u.username as username FROM `works_tbl` as w left join user_tbl as u on w.user_id = u.id  where type=%d order by w.%s %s LIMIT %d, %d",$type_id,$sort,$order,$offset,$rows);
        $res = Yii::app()->db->createCommand($sql)->queryAll();
        //print_r($res);
        return $res;
    }

    public function get_works_total_by_type($type_id){
        $sql = sprintf("SELECT count(1) as total FROM works_tbl where type=%d",$type_id);
        $res = Yii::app()->db->createCommand($sql)->queryAll();
        return $res;
    }

    public function set_work_review($id,$stat){
        $sql = sprintf("update works_tbl set review = %d,update_time=NOW() where id = %d",$stat,$id);
        //print_r($sql);exit();
        $res = Yii::app()->db->createCommand($sql)->execute();
        return $res;
    }

    public function set_work_recommend($id,$stat){
        $sql = sprintf("update works_tbl set recommend = %d,update_time=NOW() where id = %d",$stat,$id);
        //print_r($sql);exit();
        $res = Yii::app()->db->createCommand($sql)->execute();
        return $res;
    }
    
    public function set_vote_num($id,$vote){
        $sql = sprintf("update works_tbl set vote_num = %d,update_time=NOW() where id = %d",$vote,$id);
        //print_r($sql);exit();
        $res = Yii::app()->db->createCommand($sql)->execute();
        return $res;
    }

    public function del_id($id)
    {
        $sql =sprintf("DELETE FROM works_tbl WHERE `id` = %d ",$id);
        $res = Yii::app()->db->createCommand($sql)->execute();
        return $res;
    }
    


}