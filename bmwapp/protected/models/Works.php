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
     * 作品表全部数据
     * Enter description here ...
     * @param unknown_type $array  =>  array('id'=>2,'user_id'=>3,...); $order => $order='create_time desc'
     */
    public function selectWork($array,$order='create_time desc',$limit = 5)
    {
        if( is_array($array) )
        {
            foreach($array as $key=>$val)
            {
               $where .= "`$key` = '$val' and";  
            }
        	$where = substr($where,0,-3); 
        }else{
            $where = 1;
        }
        if( is_string($order) )
        {
           $order_list = trim($order);
        }
        if( is_int($limit) ){
           $limit_sned = intval($limit);
        }
        $sql = sprintf("SELECT `id`,`user_id`,`name`,`description`,`status`,`vote_num`,`update_time`,`create_time` FROM $this->tableName() where %s %s limit %d",$where,$order_list,$limit_sned);
        $res = Yii::app()->db->createCommand($sql)->queryAll();
        return $res;
    }
    
    /**
     * 查询总数
     * Enter description here ...
     */
    public function countWork()
    {
        $sql = sprintf("SELECT COUNT(1) AS `num` FROM $this->tableName() where %s",$where);
        $res = Yii::app()->db->createCommand($sql)->queryAll();
        return $res;
    }
    
    
    /**
     * 作品表单个数据
     * Enter description here ...
     * @param unknown_type $array array('id'=>2,'user_id'=>3,...);
     */
    public function getOneWork($array)
    {
        if( is_array($array) )
        {
            foreach($array as $key=>$val)
            {
               $where .= "`$key` = '$val' and";  
            }
        	$where = substr($where,0,-3); 
        }else{
            return false;
        }
        $sql = sprintf("SELECT `id`,`user_id`,`name`,`description`,`status`,`vote_num`,`update_time`,`create_time` FROM $this->tableName() where %s limit 1",$where);
        $res = Yii::app()->db->createCommand($sql)->queryRow();
        return $res;
    } 
    /**
     * 保存作品
     * Enter description here ...
     * @param unknown_type $array   array('id'=>2,'user_id'=>3,...);
     */
    public function insertWork($array)
    {
        if( is_array($array) )
        {
           foreach($array as $key=>$val){
                  $key[] = "`$k`";
                  $row[] = "'$val'";
            }
    		$key = implode(',',$key);
    		$row = implode(',',$row);
        }else{
           return false;
        }
    	$sql = sprintf("INSERT INTO $this->tableName() ( %s ,`create_time`) VALUES ( %s ,NOW())",$key,$row);
        $res = Yii::app()->db->createCommand($sql)->execute();
        return $res;
    }
    
    /**
     * 修改作品
     * Enter description here ...
     * @param unknown_type $array  array('id'=>2,'user_id'=>3,...);
     * @param unknown_type $id  作品ID
     */
    public function updateWork($array,$id)
    {
        if( is_array($array) && $id)
        {
            foreach ( $data as $key => $value ) {
                $command [] = "`$key` = '$value'";
			}
		    $command = implode ( ',', $command );
        }else{
           return false;
        }
    	$sql=sprintf("UPDATE $this->tableName() SET %s,`update_time` = now() WHERE `id` =%d",$command,$id);
    	$res = Yii::app()->db->createCommand($sql)->execute();
        return $res;
    }
    /**
     * 删除作品
     * Enter description here ...
     */
    public function delWork($id)
    {
       $sql =sprintf("DELETE FROM $this->tableName() WHERE `id` in(%s)",$id);
       $res = Yii::app()->db->createCommand($sql)->execute();
       return $res;
    }
    
    
    

}