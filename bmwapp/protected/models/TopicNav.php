<?php

/**
 * This is the model class for table "topic_nav_tbl".
 *
 * The followings are the available columns in table 'topic_nav_tbl':
 * @property integer $id
 * @property integer $type_id
 * @property string $name
 * @property string $description
 * @property integer $status
 * @property string $media_url
 * @property string $update_time
 * @property string $create_time
 */
class TopicNav extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TopicNav the static model class
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
		return 'topic_nav_tbl';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('type_id, name, description, media_url, update_time, create_time', 'required'),
			array('type_id, status', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>50),
			array('description, media_url', 'length', 'max'=>512),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, type_id, name, description, status, media_url, update_time, create_time', 'safe', 'on'=>'search'),
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
			'description' => 'Description',
			'status' => 'Status',
			'media_url' => 'Media Url',
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
		$criteria->compare('description',$this->description,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('media_url',$this->media_url,true);
		$criteria->compare('update_time',$this->update_time,true);
		$criteria->compare('create_time',$this->create_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}