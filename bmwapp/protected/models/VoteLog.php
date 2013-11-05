<?php

/**
 * This is the model class for table "vote_log_tbl".
 *
 * The followings are the available columns in table 'vote_log_tbl':
 * @property string $id
 * @property integer $work_id
 * @property integer $user_id
 * @property string $ip
 * @property string $create_time
 */
class VoteLog extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return VoteLog the static model class
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
		return 'vote_log_tbl';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('work_id, ip', 'required'),
			array('work_id, user_id', 'numerical', 'integerOnly'=>true),
			array('ip', 'length', 'max'=>15),
			array('create_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, work_id, user_id, ip, create_time', 'safe', 'on'=>'search'),
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
			'user_id' => 'User',
			'ip' => 'Ip',
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('ip',$this->ip,true);
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
    public function selectVoteLog($array,$order='create_time desc',$limit = 5)
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
        $sql = sprintf("SELECT `id`,`work_id`,`user_id`,`ip`,create_time` FROM $this->tableName() where %s %s limit %d",$where,$order_list,$limit_sned);
        $res = Yii::app()->db->createCommand($sql)->queryAll();
        return $res;
    }
    
    /**
     * 
     * Enter description here ...
     */
    public function countVoteLog()
    {
        $sql = sprintf("SELECT COUNT(1) AS `num` FROM $this->tableName() where %s",$where);
        $res = Yii::app()->db->createCommand($sql)->queryAll();
        return $res;
    }
    
    
    /**
     * 
     * Enter description here ...
     * @param unknown_type $array array('id'=>2,'user_id'=>3,...);
     */
    public function getOneVoteLog($array)
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
        $sql = sprintf("SELECT `id`,`work_id`,`user_id`,`ip`,create_time` FROM $this->tableName() where %s limit 1",$where);
        $res = Yii::app()->db->createCommand($sql)->queryRow();
        return $res;
    } 
    /**
     * 
     * Enter description here ...
     * @param unknown_type $array   array('id'=>2,'user_id'=>3,...);
     */
    public function insertVoteLog($array)
    {
        if( is_array($array) )
        {
           foreach($array as $key=>$val){
                  $key[] = "`$k`";
                  $row[] = "'$val'";
            }
    		$key = implode(',',$key);
    		$row = implode(',',$row);
    		$time = date('Y-m-d H:i:s');
        }else{
           return false;
        }
    	$sql = sprintf("INSERT INTO $this->tableName() ( %s ,`create_time`) VALUES ( %s ,'$time')",$key,$row);
        $res = Yii::app()->db->createCommand($sql)->execute();
        return $res;
    }
    
    /**
     * 
     * Enter description here ...
     * @param unknown_type $array  array('id'=>2,'user_id'=>3,...);
     * @param unknown_type $id  ��ƷID
     */
    public function updateVoteLog($array,$id)
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
     * 
     * Enter description here ...
     */
    public function delVoteLog($id)
    {
       $sql =sprintf("DELETE FROM $this->tableName() WHERE `id` in(%s)",$id);
       $res = Yii::app()->db->createCommand($sql)->execute();
       return $res;
    }
    












}