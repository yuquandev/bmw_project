<?php

/**
 * This is the model class for table "admin_tbl".
 *
 * The followings are the available columns in table 'admin_tbl':
 * @property string $id
 * @property string $username
 * @property string $password
 * @property integer $salt
 * @property string $email
 * @property integer $status
 * @property string $ip
 * @property string $last_login
 * @property string $update_time
 * @property string $create_time
 */
class Admin extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Admin the static model class
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
		return 'admin_tbl';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password, salt', 'required'),
			array('salt, status', 'numerical', 'integerOnly'=>true),
			array('username, password', 'length', 'max'=>32),
			array('email', 'length', 'max'=>50),
			array('ip', 'length', 'max'=>15),
			array('last_login, update_time, create_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, username, password, salt, email, status, ip, last_login, update_time, create_time', 'safe', 'on'=>'search'),
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
			'username' => 'Username',
			'password' => 'Password',
			'salt' => 'Salt',
			'email' => 'Email',
			'status' => 'Status',
			'ip' => 'Ip',
			'last_login' => 'Last Login',
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
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('salt',$this->salt);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('ip',$this->ip,true);
		$criteria->compare('last_login',$this->last_login,true);
		$criteria->compare('update_time',$this->update_time,true);
		$criteria->compare('create_time',$this->create_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    //根据用户名获取管理员信息
    public function get_admin_info_by_name($username,$status=0){
        $sql = sprintf("SELECT * FROM admin_tbl WHERE username = '%s' AND STATUS = %d;",$username,$status);
        $res = Yii::app()->db->createCommand($sql)->queryRow();
        return $res;
    }

    public function get_admin_user_list(){
        $sql = sprintf("SELECT * FROM admin_tbl");
        $res = Yii::app()->db->createCommand($sql)->queryAll();
        return $res;
    }

    public function get_user_list($page=1,$rows=10){
        $offset = ($page-1) * $rows;
        $sql = sprintf("SELECT * FROM `admin_tbl` order by id desc LIMIT %d, %d",$offset,$rows);
        $res = Yii::app()->db->createCommand($sql)->queryAll();
        return $res;
    }

    public function get_user_total(){
        $sql = sprintf("SELECT count(1) as total FROM admin_tbl");
        $res = Yii::app()->db->createCommand($sql)->queryAll();
        return $res;
    }

    public function add_admin_info($username,$password,$salt,$ip){
        $sql = sprintf("insert into admin_tbl (username,password,salt,ip,create_time) value ('%s','%s',%d,'%s',NOW())",$username,$password,$salt,$ip);
        $res = Yii::app()->db->createCommand($sql)->execute();
        if ($res){
            return Yii::app()->db->getLastInsertID();
        }else {
            return 0;
        }
    }

    //删除详情
    public function del_id($id){
        $sql = sprintf("delete from admin_tbl where id = %d;",$id);
        $res = Yii::app()->db->createCommand($sql)->execute();
        return $res;
    }
}