<?php

/**
 * This is the model class for table "car_type_tbl".
 *
 * The followings are the available columns in table 'car_type_tbl':
 * @property integer $type_id
 * @property string $name
 * @property integer $status
 * @property string $create_time
 */
class CarType extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CarType the static model class
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
		return 'car_type_tbl';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, status, create_time', 'required'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('type_id, name, status, create_time', 'safe', 'on'=>'search'),
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
			'type_id' => 'Type',
			'name' => 'Name',
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

		$criteria->compare('type_id',$this->type_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('create_time',$this->create_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

       public function selectCartype($array,$limit = 0,$limit_offis = 10,$order='create_time desc')
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
        $sql = sprintf("SELECT `type_id`,`name`,`create_time` FROM %s where %s order by %s limit %s",$this->tableName(),$where,$order_list,$limit_sned);
        
        $res = Yii::app()->db->createCommand($sql)->queryAll();
        return $res;
       }

    //添加分类
    public function add_cartype_info($name,$status=1){
        $sql = sprintf("insert into car_type_tbl (name,status,create_time) value ('%s',%d,NOW())",$name,$status);
        $res = Yii::app()->db->createCommand($sql)->execute();
        if ($res){
            return Yii::app()->db->getLastInsertID();
        }else {
            return 0;
        }
    }

    //获取列表
    public function get_car_list(){
        $sql = sprintf("select * from car_type_tbl where status = 1");
        $res = Yii::app()->db->createCommand($sql)->queryAll();
        return $res;
    }

    //删除详情
    public function del_id($id){
        $sql = sprintf("delete from car_type_tbl where type_id = %d;",$id);
        $res = Yii::app()->db->createCommand($sql)->execute();
        return $res;
    }

    public function set_cartype_info($type_id,$name){
        $sql = sprintf("update car_type_tbl set name = '%s' where type_id = %d",$name,$type_id);
        $res = Yii::app()->db->createCommand($sql)->execute();
        return $res;
    }

}