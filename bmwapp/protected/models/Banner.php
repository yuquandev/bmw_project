<?php

/**
 * This is the model class for table "banner_tbl".
 *
 * The followings are the available columns in table 'banner_tbl':
 * @property string $id
 * @property integer $topic_id
 * @property string $name
 * @property string $description
 * @property string $image_url
 * @property integer $status
 * @property integer $sort_int
 * @property string $update_time
 * @property string $create_time
 */
class Banner extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Banner the static model class
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
		return 'banner_tbl';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('topic_id, name, description, image_url', 'required'),
			array('topic_id, status, sort_int', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>50),
			array('description', 'length', 'max'=>200),
			array('image_url', 'length', 'max'=>256),
			array('update_time, create_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, topic_id, name, description, image_url, status, sort_int, update_time, create_time', 'safe', 'on'=>'search'),
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
			'topic_id' => 'Topic',
			'name' => 'Name',
			'description' => 'Description',
			'image_url' => 'Image Url',
			'status' => 'Status',
			'sort_int' => 'Sort Int',
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
		$criteria->compare('topic_id',$this->topic_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('image_url',$this->image_url,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('sort_int',$this->sort_int);
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
    public function selectBanner($array,$limit = 0,$limit_offis = 10,$order='create_time desc')
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
        $sql = sprintf("SELECT `id`,`topic_id`,`name`,`image_url`,`description`,`update_time`,`create_time` FROM %s where %s order by %s limit %s",$this->tableName(),$where,$order_list,$limit_sned);
        
        $res = Yii::app()->db->createCommand($sql)->queryAll();
        return $res;
    }
	
	
}