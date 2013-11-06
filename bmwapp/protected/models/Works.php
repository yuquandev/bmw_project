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
    public function selectWork($array,$limit = 5,$limit_offis = 10,$order='create_time desc')
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
        $limit_sned = "{$limit},{$limit_offis}";
        $sql = sprintf("SELECT `id`,`user_id`,`name`,`description`,`status`,`vote_num`,`update_time`,`create_time` FROM %s where %s order by %s limit %s",$this->tableName(),$where,$order_list,$limit_sned);
        
        $res = Yii::app()->db->createCommand($sql)->queryAll();
        return $res;
    }
    
    /**
     * 
     * Enter description here ...
     */
    public function countWork($where)
    {
        $sql = sprintf("SELECT COUNT(1) AS `num` FROM %s where %s",$this->tableName(),$where);
        $res = Yii::app()->db->createCommand($sql)->queryAll();
        return $res;
    }
    
    
    /**
     * 
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
        	$where = substr($where,0,-4); 
        }else{
            return false;
        }
        $sql = sprintf("SELECT `id`,`user_id`,`name`,`description`,`status`,`vote_num`,`update_time`,`create_time` FROM %s where %s limit 1",$this->tableName(),$where);
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
        if( is_array($array) )
        {
           foreach($array as $key=>$val){
                  $key[] = "`$k`";
                  $row[] = "'$val'";
            }
    		$key  = implode(',',$key);
    		$row  = implode(',',$row);
            $time = date('Y-m-d H:i:s');
        }else{
           return false;
        }
    	$sql = sprintf("INSERT INTO %s ( %s ,`create_time`) VALUES ( %s ,'$time')",$this->tableName(),$key,$row);
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
    
    
    

}