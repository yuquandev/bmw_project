<?php

/**
 * This is the model class for table "topic_image_tbl".
 *
 * The followings are the available columns in table 'topic_image_tbl':
 * @property integer $id
 * @property integer $type_id
 * @property string $name
 * @property string $image_url
 * @property integer $status
 * @property string $update_time
 * @property string $create_time
 */
class TopicImage extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TopicImage the static model class
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
		return 'topic_image_tbl';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('type_id, name, image_url, update_time, create_time', 'required'),
			array('type_id, status', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>20),
			array('image_url', 'length', 'max'=>256),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, type_id, name, image_url, status, update_time, create_time', 'safe', 'on'=>'search'),
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
			'type_id' => 'Type',
			'name' => 'Name',
			'image_url' => 'Image Url',
			'status' => 'Status',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('type_id',$this->type_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('image_url',$this->image_url,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('update_time',$this->update_time,true);
		$criteria->compare('create_time',$this->create_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	
	
     public function selectCarTopicimage($array,$limit = 0,$limit_offis = 10,$order='create_time desc')
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
        $sql = sprintf("SELECT `id`,`type_id`,`name`,`image_url`,`update_time`,`create_time` FROM %s where %s order by %s %s",$this->tableName(),$where,$order_list,$limit_sned);
        //echo $sql;
        $res = Yii::app()->db->createCommand($sql)->queryAll();
        return $res;

	}

	
	public function getOneTopicImage($array)
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
        $sql = sprintf("SELECT `id`,`type_id`,`name`,`image_url`,`update_time`,`create_time` FROM %s where %s limit 1",$this->tableName(),$where);
        $res = Yii::app()->db->createCommand($sql)->queryRow();
        return $res;
    } 
    //
    public function get_image_list_by_type($type_id,$page=1,$rows=10){
        $offset = ($page-1) * $rows;
        $sql = sprintf("SELECT * FROM `topic_image_tbl` WHERE type_id = %d order by id desc LIMIT %d, %d",$type_id,$offset,$rows);
        $res = Yii::app()->db->createCommand($sql)->queryAll();
        return $res;
    }

    public function get_image_total_by_type($type_id){
        $sql = sprintf("SELECT count(1) as total FROM topic_image_tbl WHERE type_id = %d",$type_id);
        $res = Yii::app()->db->createCommand($sql)->queryAll();
        return $res;
    }

    //添加图片
    public function add_image_info($type_id,$name,$image_url,$stat){
        $sql = sprintf("insert into topic_image_tbl (type_id,name,image_url,status,update_time,create_time) value (%d,'%s','%s',%d,NOW(),NOW()); ",$type_id,$name,$image_url,$stat);
        $res = Yii::app()->db->createCommand($sql)->execute();
        if ($res){
            return Yii::app()->db->getLastInsertID();
        }else {
            return 0;
        }
    }

    //设置图片开启关闭
    public function set_img_status($id,$status){
        $sql = sprintf("update topic_image_tbl set status = %d where id = %d;",$status,$id);
        $res = Yii::app()->db->createCommand($sql)->execute();
        return $res;
    }

    //更新单个图片信息
    public function set_img_info($id,$name,$image_url,$stat){
        $sql = sprintf("update topic_image_tbl set name='%s',image_url='%s',status=%s,update_time=NOW() where id=%d",$name,$image_url,$stat,$id);
        $res = Yii::app()->db->createCommand($sql)->execute();
        return $res;
    }

}     