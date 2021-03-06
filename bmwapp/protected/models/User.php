<?php

/**
 * This is the model class for table "user_tbl".
 *
 * The followings are the available columns in table 'user_tbl':
 * @property string $id
 * @property string $username
 * @property string $nickname
 * @property string $password
 * @property integer $salt
 * @property string $telephone
 * @property string $ip
 * @property integer $status
 * @property string $last_login
 * @property string $update_time
 * @property string $create_time
 */
class User extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
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
		return 'user_tbl';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password, salt, ip', 'required'),
			array('salt, status', 'numerical', 'integerOnly'=>true),
			array('username, nickname', 'length', 'max'=>50),
			array('password', 'length', 'max'=>32),
			array('telephone', 'length', 'max'=>11),
			array('ip', 'length', 'max'=>15),
			array('last_login, update_time, create_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, username, nickname, password, salt, telephone, ip, status, last_login, update_time, create_time', 'safe', 'on'=>'search'),
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
			'nickname' => 'Nickname',
			'password' => 'Password',
			'salt' => 'Salt',
			'telephone' => 'Telephone',
			'ip' => 'Ip',
			'status' => 'Status',
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
		$criteria->compare('nickname',$this->nickname,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('salt',$this->salt);
		$criteria->compare('telephone',$this->telephone,true);
		$criteria->compare('ip',$this->ip,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('last_login',$this->last_login,true);
		$criteria->compare('update_time',$this->update_time,true);
		$criteria->compare('create_time',$this->create_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    //
    public function get_user_list($page=1,$rows=10){
        $offset = ($page-1) * $rows;
        $sql = sprintf("SELECT * FROM `user_tbl` order by create_time desc LIMIT %d, %d",$offset,$rows);
        $res = Yii::app()->db->createCommand($sql)->queryAll();
        return $res;
    }

    public function get_user_total(){
        $sql = sprintf("SELECT count(1) as total FROM user_tbl");
        $res = Yii::app()->db->createCommand($sql)->queryAll();
        return $res;
    }

    //添加用户
    public function add_user_info($data){
        extract($data);
        $sql = sprintf("INSERT INTO `user_tbl` (`username`,`nickname`,`password`,`salt`,`telephone`,`ip`,`status`,`last_login`,`update_time`,`create_time`) VALUES ('%s','%s','%s','%d','%s','%s',0,NULL,NULL,NOW());",$username,$nickname,$password,$salt,$telephone,$ip);
        $res = Yii::app()->db->createCommand($sql)->execute();
        if ($res){
            return Yii::app()->db->getLastInsertID();
        }else {
            return 0;
        }
    }

    //根据用户名获取用户信息
    public function get_userinfo_by_username($username){
        $sql = sprintf("SELECT * FROM `user_tbl` WHERE `username`='%s'",$username);
        $res = Yii::app()->db->createCommand($sql)->queryRow();
        return $res;
    }
    
    public function getOneUser($array)
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
        $sql = sprintf("SELECT `id`,`username`,`nickname` FROM %s where %s limit 1",$this->tableName(),$where);
        $res = Yii::app()->db->createCommand($sql)->queryRow();
        return $res;
    }


    //删除详情
    public function del_id($id){
        $sql = sprintf("delete from user_tbl where id = %d;",$id);
        $res = Yii::app()->db->createCommand($sql)->execute();
        return $res;
    }
    
    
    
}