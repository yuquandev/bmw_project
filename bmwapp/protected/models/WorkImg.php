<?php

/**
 * This is the model class for table "work_img_tbl".
 *
 * The followings are the available columns in table 'work_img_tbl':
 * @property string $id
 * @property integer $work_id
 * @property string $name
 * @property string $description
 * @property string $image_url
 * @property integer $status
 * @property string $create_time
 */
class WorkImg extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return WorkImg the static model class
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
		return 'work_img_tbl';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('work_id, image_url', 'required'),
			array('work_id, status', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>50),
			array('description', 'length', 'max'=>200),
			array('image_url', 'length', 'max'=>256),
			array('create_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, work_id, name, description, image_url, status, create_time', 'safe', 'on'=>'search'),
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
			'work_id' => 'Work',
			'name' => 'Name',
			'description' => 'Description',
			'image_url' => 'Image Url',
			'status' => 'Status',
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
		$criteria->compare('work_id',$this->work_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('image_url',$this->image_url,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('create_time',$this->create_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    /**
     * 全部数据
     * Enter description here ...
     * @param unknown_type $array  =>  array('id'=>2,'user_id'=>3,...); $order => $order='create_time desc'
     */
    public function selectWorkImg($array,$order='create_time desc',$limit = 5)
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
        $sql = sprintf("SELECT `id`,`work_id`,`name`,`description`,image_url`,`status`,`create_time` FROM $this->tableName() where %s %s limit %d",$where,$order_list,$limit_sned);
        $res = Yii::app()->db->createCommand($sql)->queryAll();
        return $res;
    }
    
    /**
     * 查询总数
     * Enter description here ...
     */
    public function countWorkImg()
    {
        $sql = sprintf("SELECT COUNT(1) AS `num` FROM $this->tableName() where %s",$where);
        $res = Yii::app()->db->createCommand($sql)->queryAll();
        return $res;
    }
    
    
    /**
     * 单个数据
     * Enter description here ...
     * @param unknown_type $array array('id'=>2,'user_id'=>3,...);
     */
    public function getOneWorkImg($array)
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
        $sql = sprintf("SELECT `id`,`work_id`,`name`,`description`,image_url`,`status`,`create_time` FROM $this->tableName() where %s limit 1",$where);
        $res = Yii::app()->db->createCommand($sql)->queryRow();
        return $res;
    } 
    /**
     * 保存
     * Enter description here ...
     * @param unknown_type $array   array('id'=>2,'user_id'=>3,...);
     */
    public function insertWorkImg($array)
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
     * 修改
     * Enter description here ...
     * @param unknown_type $array  array('id'=>2,'user_id'=>3,...);
     * @param unknown_type $id  作品ID
     */
    public function updateWorkImg($array,$id)
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
    	$sql=sprintf("UPDATE $this->tableName() SET %s WHERE `id` =%d",$command,$id);
    	$res = Yii::app()->db->createCommand($sql)->execute();
        return $res;
    }
    /**
     * 删除
     * Enter description here ...
     */
    public function delWorkImg($id)
    {
       $sql =sprintf("DELETE FROM $this->tableName() WHERE `id` in(%s)",$id);
       $res = Yii::app()->db->createCommand($sql)->execute();
       return $res;
    }
    



}