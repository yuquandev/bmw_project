<?php
// 本类由系统自动生成，仅供测试用途
class MemberAction extends CommonAction {
	
	public function __construct(){
	   parent::_initialize();
	   $this->notice();
	   session_start();
	}
	
	
    public function regist(){
      $set=M("usersetting");
      $res=$set->field("new_reg,require_mobile,require_code")->where("id=1")->find();
      //手机验证码
      if($res['new_reg']==0)
      {
         $this->display("regist2");
		 exit();
      }
       $place=M("city")->where("cityid=1")->select();    
       $this->assign("place",$place); 
      
       $array=explode('-',$res['require_code']);		
	   $res1=in_array(1,$array);
	   if($res1)
	   {
		  $this->assign("yzm",1);
		}
		else
		{
		 $this->assign("yzm",0);
		}
      
           
       $this->assign("res",$res);
       $this->display();
    }

	public function check_email(){
	    $member=M("member");
	    $email=$_GET['email'];
		$res=$member->where("email='$email'")->find();
		if($res)
	    {
		   echo 0;
		}
		else
		{
		   echo 1;
		}
	}

	//检测昵称是否存在
	public function check_username(){
	   $member=M("member");
	   $username=$_GET['username'];
	   $res=$member->where("username='$username'")->find();
	    if($res)
	    {
		   echo 0;
		}
		else
		{
		   echo 1;
		}

	}


    public function get_yzm(){
	    $phone=$_POST['phone'];
		$time=time();
		$str1=substr($time,4, 6);
		$_SESSION['phone_yzm']=$str1;
        $str.="您的KOD联盟注册验证码是".substr($time,4, 6)."。该验证码在2分内有效。如非本人操作，请勿理会！".【kod联盟】;
	   // $str=substr($time,4, 6).【kod】; 
		$res=$this->send_info($phone,$str);
	    echo $res;
	}


	//发送短信
	public function send_info($phone,$content){
	     import("ORG.Util.Ws-demo");
         $cpid="kod123";
	     $cppsw="kod123";

		 import("ORG.Util.HTTP_SDK"); 
		 $engine = HTTP_SDK::getInstance($cpid,$cppsw);

		 $res=$engine->pushMt($phone,'1111111111', $content,0);
		 return $res;
     
	}
	
	public function check_yzm(){
       $open_pyzm=$_POST['open_pyzm'];
       $open_yzm=$_POST['open_yzm'];
       if($open_pyzm==1)
       {
          $s_yzm=$_SESSION['phone_yzm'];
          $p_yzm=$_POST['p_yzm'];
          if($s_yzm!=$p_yzm)
          {
             echo 0;//手机验证码有误
             exit();
          }
       }
       
       if($open_yzm==1)
       {
           $ver=$_SESSION['verify'];
           $yzm=md5($_POST['yzm']);
           if($ver!=$yzm)
           {
             echo 2;//验证码有误
             exit();
           }
       }
       
       echo 1;	
	}
	public function registok(){		
	   $member=M('member');   
	   $set=M("usersetting");
	   $res=$set->where("id=1")->find();
      
	   $data['email']=$_POST['email'];
	   $data['username']=$_POST['username'];
	   $data['name']=$_POST['name'];
	   $data['password']=md5($_POST['password']);
	   $data['phone']=$_POST['phone'];
	   $data['country']=$_POST['country'];	   
	   $data['usa_city']=$_POST['usa_city'];
       $data['city']=implode('-',$_POST['city']);
	   $data['user_login_ip']=$_SERVER["REMOTE_ADDR"];
	   $data['regist_time']=time();
	   $data['user_integral']=0;
	   $data['user_grade']=0;
	
     //根据后台设置,判断是否需要发送邮件进行注册
	  if($res['send_email']==1)
	  {    
		     $data['user_status']=0;
			 $res=$member->add($data);
			 
		     $id = $member->GetLastInsID ();
             $n_number = 'p' . substr ( strval ( $id + 10000000 ), 1, 7 );
             $member->where ( "id=" . $id )->save ( array ("u_number" => $n_number ) );
			 
			 
			 
	         $sendTo=$_POST['email'];
			 $subject="kod-账号激活";
			 //发送邮件中的变量
			 $email_row=$member->where("id=".$id)->find();
			 $this->assign("email_row",$email_row);
			 $body=$this->fetch("Member:youjian");
			 $this->sendmail($sendTo,$subject,$body);
			 
			 
			 
			 
			 
			 
			 $this->assign("email",$_POST['email']);
			 $this->display("yanz");
	  }
	  else
	  {	   
		    $data['user_status']=1;
		    $res=$member->add($data);
		    $id = $member->GetLastInsID ();
            $n_number = 'P' . substr ( strval ( $id + 10000000 ), 1, 7 );
            $member->where ( "id=" . $id )->save ( array ("u_number" => $n_number ) );
		   if($res)
		   {
			        $data['user_id'] = $res;
			        /*注册成功加载ECSHOP*/
					$this->Eshop_Synchronous_Tk_Reginfo($data); 
					/*数据同步*/    
		   	    $email=$_POST['email'];
			    $res1=$member->where("email='$email'")->find();
                $_SESSION['memberID']=$res1['id'];
				$_SESSION['islogin']=1;
				$_SESSION['username']=$email;
				
				$this->redirect("Member/index");
		   }
		   else
		   {  
			  $this->redirect("Member/index");
		   }
	   }
	}
	
	//重新发送邮件
	public function send_email_agin(){
		     $member=M("member");
		     $sendTo=$_POST['email'];
			 $subject="kod-账号激活";
			 $email_row=$member->where("email=$sendTo")->find();
			 $this->assign("email_row",$email_row);
			 $body=$this->fetch("Member:youjian");
			 $this->sendmail($sendTo,$subject,$body);
			 
			 $this->assign("email", $sendTo);
			 $this->display("yanz");	
	}

    //激活
	public function jihuo1(){
	   $member=M('member');
	   $email=$_GET['user'];
	   $res=$member->where("email like'%$email%'")->find();
	   if($res['user_status'==1])
	   {
	     echo '该账号已激活';
	   }
	   else
	   {
		  $status=1;
		  $res1=$member->where("email like '%$email%'")->save(array("user_status"=>$status));
		  if($res1)
		  {  
		  	   $_SESSION['memberID']=$res['id'];
			   $_SESSION['islogin']=1;
			   $_SESSION['username']=$email;
			  $this->redirect("Member/index");
		  }
		  else
		  {
		      echo '激活失败';
		  }
	   
	   }	
	}
	
	 
   //public function sende(){
   //   $this->sendmail("122808725@qq.com","CESHI","AAAAAA");
  // }




	public function login(){
		$row=M("usersetting")->where("id=1")->find();
		$array=explode('-',$row['require_code']);
		
		$res=in_array(2,$array);
		if($res)
		{
		  $this->assign("yzm",1);
		}
		else
		{
		 $this->assign("yzm",0);
		}
	    $this->display();
	}

	public function loginok(){
	   $member=M('member');
	   
	   //检测是否需要判断验证码
	   $yzm=$_POST['yzm'];
	   if($yzm==1)
	   {
	      $ver=md5($_POST['ver']);
	      $ver1=$_SESSION['verify'];
	      if($ver!=$ver1)
	      {
	         echo 0;// 验证码输入有误
	         exit();
	      }
	       
	   }

	   $email=$_POST['user'];
	   $pwd=$_POST['pwd'];

       $password=md5($pwd);
	   $res=$member->where("email='$email'")->find();
	  
	   if($res['user_status']==1)
	   {
			   if($res['password']==$password)
			   { 
				  session_start();
				  $_SESSION['memberID']=$res['id'];
				  $_SESSION['islogin']=1;
				  $_SESSION['username']=$email;
				  echo 1;
			   }
			   else
			   {
                    echo 2;//密码错误
			   }
		 }
		 else
		 {
		     echo 3; //用户还未用邮箱激活
		 }
	}


   public function index(){
   	   $uid=$_SESSION['memberID'];
	   if(empty($uid))
	   {
	   	 $this->redirect("login");
	   }
       $this->display();
   }


	//会员中心
	public function userinfo(){
	   $uid=$_SESSION['memberID'];
	   if(empty($uid))
	   {
	   	 $this->redirect("login");
	   }
	   $member=M("member");
	   $row1=$member->where("id=".$uid)->find();
	   $this->assign("row1",$row1);
	   
       $mycity=explode('-',$row1['city']);
       $this->assign("mycity",$mycity);
      
       foreach($mycity as $key=>$val){
          $mycity1[]=M("city")->where("cityid=".$mycity[$key])->select();
       }
       $this->assign("mycity1",$mycity1);
    
     
	   
	   $place=M("city")->where("cityid=1")->select();    
       $this->assign("place",$place); 


 
	   $this->assign("uid",$uid);
	   $memberinfo=M("member_info");
	   $row=$memberinfo->where("uid=".$uid)->find();
	   
	   $bir=explode('-',$row['b_day']);
	   $this->assign("bir",$bir);
	   $this->assign("row",$row);

       
	   for($i=1959;$i<=2014;$i++){
	     $year[]=$i;
	   }
       $this->assign("year",$year);
       
       for($i=1;$i<=12;$i++){
	     $mou[]=$i;
	   }
       $this->assign("mou",$mou);
       
       	for($i=1;$i<=31;$i++){
	     $day[]=$i;
	   }
       $this->assign("day",$day);



	   $this->display();
	
	}
	
	//修改基本资料
	public function update_userinfo(){	   
		$uid=$_SESSION['memberID'];  
         
	    $date['country']=$_POST['country'];
		$date['name']=$_POST['name'];
		$date['username']=$_POST['username'];
	    $date['city']=implode('-',$_POST['city']);
	    $date['usa_city']=$_POST['usa_city'];
	    M("member")->where("id=".$uid)->save($date);
	    
	    $country=$_POST['country'];		
	    $bir=implode('-',$_POST['bir']);
	    $memberinfo=M("member_info");
        $data=$memberinfo->create();
	    $data['b_day']=$bir;        

	    $res=$memberinfo->where("uid=".$uid)->find();
	    if($res){	    	
	        $res1=$memberinfo->where("uid=".$uid)->save($data);
	    }else{
	       $data['uid']=$uid;
	       $res1=$memberinfo->add($data);
	    }
	    	    
	    if($res1){
	       $this->redirect("Member/userinfo");
	    }else{
	      $this->redirect("Member/userinfo");
	    }
	
	}
	
	
	public function update(){
	   $uid=$_SESSION['memberID'];
	   $memberinfo=M("member_info");
	   $uid=$_SESSION['memberID'];
   

	   $date['name']=$_POST['name'];
	   $date['username']=$_POST['username'];
	   M("member")->where("id=".$uid)->save($date);
	   
	   $data=$memberinfo->create();
	   $res=$memberinfo->where("uid=".$uid)->find(); 



	   $str='';
       for($i=0;$i<count($_POST['dance_types']);$i++)
	   {
		    $str.=$_POST['dance_types'][$i].'-';
	   }
       $data['dance_types']=$str;
       $data['b_day']=implode('-',$_POST['bir']);
	   if($res)
	   {
             $res1=$memberinfo->where("uid=".$uid)->save($data);
		     $this->redirect("vip_info");
		  

	   }
	   else
	   {
		  $data['uid']=$uid;
		  $res1=$memberinfo->add($data);
		  if($res1)
		  {
			  $this->redirect("vip_info");
		  }
		  else
		   {
		     $this->redirect("vip_info");
		  }
	   }
	}

	public function password(){
	  $this->display();
	}



	//检测原密码是否正确
	public function check_oldpwd(){
	   $uid=$_SESSION['memberID'];
	   if(empty($uid)){
	      $this->redirect("login");
	   }
	   $pwd=md5($_GET['pwd']);
	   $row=M("member")->where("id=".$uid)->find();
	   if($row['password']==$pwd){
	      echo 1;
	   }else{
		  echo 0;
	   }
	
	 
	}
   
    //修改密码
	public function  repwd(){
	   $uid=$_SESSION['memberID'];
	   if(empty($uid)){
	      $this->redirect("login");
	   }
	    $newpwd=md5($_POST['newpwd']);
		$oldpwd=md5($_POST['oldpwd']);
	    $member=M("member");
		$res=$member->where("id=".$uid)->find();

		if($res['password']==$oldpwd)
		{   
	
				$res1=$member->where("id=".$uid)->save(array("password"=>$newpwd));
				if($res1)
				{
				   echo 1; //修改密码成功
				}
				else
				{
				   echo 2;//修改密码失败
				}
		 }
		 else
		 {
              echo 0; //原密码错误
		 } 
	}

	//修改头像
	public function vip_sctx(){
	   	//$uid=5;
	   $uid=$_SESSION['memberID'];
	   if(empty($uid)){
	      $this->redirect("login");
	   }

	   $member=M("member");
	   $row=$member->where("id=".$uid)->find();

	   $membergroup=M("member_group");
	   $res2=$membergroup->where("id=".$row['user_grade'])->find();
	   $row['g_name']=$res2['group_name'];

       $memberinfo=M("member_info");
	   $row3=$memberinfo->where("uid=".$uid)->find();
	   $row['user_img']=$row3["user_img"];
	   $row['name']=$row3['name'];

	   $this->assign("row",$row);
	   $this->display();
	}
    
	public function vip_uptx(){
		 $uid=$_SESSION['memberID'];
	   if(empty($uid)){
	      $this->redirect("login");
	   }

 
	    import("ORG.Net.UploadFile");
		$upload = new UploadFile();// 实例化上传类
		           
	
		$upload->maxSize = 3145728 ;// 讴置附件上传大小
		$upload->allowExts = array('jpg', 'gif', 'png', 'jpeg');// 讴置附件上传类型
		$upload->thumb = "true";
		$upload->thumbMaxHeight="94px";
		$upload->thumbMaxWidth="94px";
		$upload->thumbPrefix="thumb_";
		$upload->savePath = './Public/Uploads/member/';// 讴置附件上传目录
		$upload->saveRule = 'uniqid';
     
		if($upload->upload())
		{
		   $info = $upload->getUploadFileInfo();// 上传错诣 提示错诣信息
		}

		$memberinfo=M("member_info");
		$uid=$_SESSION['memberID'];
	   //$uid=$_SESSION['memberID'];
	    $result=$memberinfo->where("uid=".$uid)->find();
		if(empty($result)){
			$res=$memberinfo->add(array("uid"=>$uid,"user_img"=>$info[0]['savename']));
		
		}else{
		    $res=$memberinfo->where("uid=".$uid)->save(array("user_img"=>$info[0]['savename']));
		}
	   
		if($res)
		{
		   $this->redirect("vip_sctx");
		}
		else
		{
		   $this->redirect("vip_sctx");
		}
	}





	public function cz(){

	   $uid=$_SESSION['memberID'];
	   $member=M("member");
	   $row=$member->where("id=".$uid)->find();

	   $membergroup=M("member_group");
	   $res2=$membergroup->where("id=".$row['user_grade'])->find();
	   $row['g_name']=$res2['group_name'];
   
       
	   $memberinfo=M("member_info");
	   $res3=$memberinfo->where("uid=".$uid)->find();
	   $row['name']=$res3['name'];
  
       $this->assign("row",$row);

	    $mrecord=M("moneyrecord");
		$paysetting=M("paysetting");
	    $rows=$mrecord->where("uid=".$uid)->select();
	    foreach($rows as $key=>$val)
		{
	        $res=$paysetting->where("id=".$rows[$key]['post_method'])->find();
			$rows[$key]['platform_name']=$res['platform_name'];
		}
		$this->assign("rows",$rows);
	    $this->display();
	}

	public function vip_goup(){
        $userss=M("userss");
		$res=$userss->where("id=1")->find();
		$row['content']=$res['content'];
		$this->assign("row",$row);

	   $row=M("usersetting")->where("id=1")->find();
	   $this->assign("money",$row['vipkd']);

	   $uid=$_SESSION['memberID'];
	   $urow=M("member")->where("uid=".$uid)->find();
	   $urow['all_kd']=$urow['kd']-$row['vipkd'];
	   $this->assign("urow",$urow);
	   $this->display();
	}

   public function vip_info(){
	   $uid=$_SESSION['memberID'];
	   if(empty($uid))
	   {
	   	 $this->redirect("login");
	   }
	   $member=M("member");
	   $row1=$member->where("id=".$uid)->find();

       if($row1['user_grade']==0){
	     $this->redirect("vip_goup");
	   }

	   $this->assign("row1",$row1);



	   $this->assign("uid",$uid);
	   $memberinfo=M("member_info");
	   $row=$memberinfo->where("uid=".$uid)->find();
	   $this->assign("row",$row);

	   $u_dance=explode("-",$row['dance_types']);	
	   $this->assign("u_dancee",$u_dance);

	   $user_jiguan=M("user_jiguan");
	   $jiguan=$user_jiguan->select();
	   $this->assign("jiguan",$jiguan);

	
	  
    $place=M("city")->where("cityid=1")->select();    
       $this->assign("place",$place); 



	   $this->assign("uid",$uid);

	   
	   $bir=explode('-',$row['b_day']);
	   $this->assign("bir",$bir);
	   $this->assign("row",$row);
	   


       
	   for($i=1959;$i<=2014;$i++){
	     $year[]=$i;
	   }
       $this->assign("year",$year);
       
       
       for($i=1;$i<=12;$i++){
	     $mou[]=$i;
	   }
       $this->assign("mou",$mou);
       
       	for($i=1;$i<=31;$i++){
	     $day[]=$i;
	   }
	   
      $this->assign("day",$day);

	  
	  
	  

	   $con=M("constellation");
	   $xz=$con->select();
	   $this->assign("xz",$xz);

	   $dan=M('dance_type');
	   $dance=$dan->select();
   	   $this->assign("dance",$dance);
	   $this->display();
	}


   //我的赛事
   public function  wdsh(){
       $uid=$_SESSION['memberID'];
       

	   if(empty($uid))
	   {
	   	 $this->redirect("login");
	   }
	    $sign=M("sign_up");
		//我报名的赛事
		$sign_rows=$sign->table("tp_sign_up t1,tp_schedule t2")->field("t1.*,t2.ScheduleTitle")->where("t1.uid=$uid and t1.sid=t2.ScheduleID and t1.is_user=0")->select();
		$this->assign("sign_rows",$sign_rows);
	

		 //我参加过的赛事
         $psorce=M("person_sorce");
		 $rows=$psorce->table("tp_personal t1,tp_person_sorce t2")->field("t1.schid,t1.id,t2.*")->where("t2.uid=$uid and t1.id=t2.perid")->select();
		 foreach($rows as $key=>$val){
		    $row=M("schedule")->field("ScheduleTitle")->where("ScheduleID=".$val['schid'])->find();
			$join_rows[$key]['ScheduleTitle']=$row['ScheduleTitle'];
			$join_rows[$key]['sorce']=$val['sorce'];
		 
		 }
		$this->assign("join_rows",$join_rows);
        $this->display();   
   }

      //我的优惠
   public function  wdyh(){
       	 $memberinfo=M("member_info");
		$member=M("member");
	    $uid=$_SESSION['memberID'];
		$row=$memberinfo->where("uid=".$uid)->field("name")->find();

		$res=$member->where("id=".$uid)->find();
		$row['user_integral']=$res['user_integral'];
	    $membergroup=M("member_group");
	    $res2=$membergroup->where("id=".$res['user_grade'])->find();
	    $row['g_name']=$res2['group_name'];
     		
        $userss=M("userss");
		$res3=$userss->where("id=2")->find();
		$row['content']=$res3['content'];

        $this->assign("row",$row);
        $this->display(); 
   }

     //我的资格
   public function  wdzg(){
	    $memberinfo=M("member_info");
		$member=M("member");
	    $uid=$_SESSION['memberID'];
		$row=$memberinfo->where("uid=".$uid)->field("zg_number,name")->find();

		$res=$member->where("id=".$uid)->find();
		$row['user_integral']=$res['user_integral'];
	    $membergroup=M("member_group");
	    $res2=$membergroup->where("id=".$res['user_grade'])->find();
	    $row['g_name']=$res2['group_name'];
	      	
        $userss=M("userss");
		$res3=$userss->where("id=1")->find();
		$row['content']=$res3['content'];
		
		
		//我的参赛资格
		$sign=M("sign_up");
		$rows=$sign->where("uid=".$uid." and is_user=0")->select();
		$this->assign("rows",$rows);

        $this->assign("row",$row);
        $this->display();   
   }

    //浏览记录
   public function  lljl(){
        $memberinfo=M("member_info");
		$member=M("member");
	    $uid=$_SESSION['memberID'];
		$row=$memberinfo->where("uid=".$uid)->field("name")->find();

		$res=$member->where("id=".$uid)->find();
		$row['user_integral']=$res['user_integral'];
	    $membergroup=M("member_group");
	    $res2=$membergroup->where("id=".$res['user_grade'])->find();
	    $row['g_name']=$res2['group_name'];

		$look=M("look_record");
		$rows=$look->where("uid=".$uid)->select();

	    $this->assign("rows",$rows);
        $this->assign("row",$row);
        $this->display(); 
   }




	//注销 退出登录
	public function loginout(){
	
	    session_destroy();
		$this->redirect("login");
	}
  
   //发送邮件测试

   public function fasong(){
      $sendTo="122808725@qq.com";
	  $subject="测试";
	  $body="加油啊啊啊啊啊啊啊啊";
      $this->sendmail($sendTo,$subject,$body);
   }










//ajax请求排序
	public function order(){
            $item=$_GET['item'];
			$type=M('news');
		    $re=$type->order("$item")->select();
            $this->assign('re',$re);
		    $this->display();
       }
//ajax联动显示日期输入框
	public function show(){
			echo "<input type='text'name='b_day' id='start'  class='vip_text' onclick=HS_setDate(document.getElementById('start'))>";
		
          }
//ajax联动显示栏目下拉框
	public function tshow(){
           //查询二级新闻
			$tree=M('tree');
			$newRe=$tree->field("tid,tname")->where("pid=".$_GET['pid'])->select();
			$counts=count($newRe);
			echo "<select name='tid' class='sel'>";
	  	          for($i=0;$i<$counts;$i++){echo "<option value=".$newRe[$i]['tid']." selected>".$newRe[$i]['tname']."</option>";}
		    echo "</select>";
          }
          
          
          
	Public function verify(){
		// 导入Image类库
		import("ORG.Util.Image");
		Image::buildImageVerify();
	}
	
	public function zx(){
	   $row=M("usersetting")->where("id=1")->find();
	   $data[0]['money']=100;
	   $data[0]['kb']=100*$row['money2jifen'];
	   $data[1]['money']=200;
	   $data[1]['kb']=200*$row['money2jifen'];
	   $data[2]['money']=500;
	   $data[2]['kb']=500*$row['money2jifen'];
	   $this->assign("data",$data);
	   $this->display();
	}
	
	
	//支付
	public function chinabank(){
	     $row['money']=$_POST['money'];
		 $uid=$_SESSION['memberID'];
	     $row['order_sn']=time().$uid;
		 $row['uid']=$uid;
	     $this->assign("row",$row);
	     $this->display();
	}
	
	
	public function pay_success(){
		 session_start();
		$key='kod2013y';							//登陆后在上面的导航栏里可能找到“B2C”，在二级导航栏里有“MD5密钥设置”
		//建议您设置一个16位以上的密钥或更高，密钥最多64位，但设置16位已经足够了
		//****************************************
			
		$v_oid     =trim($_POST['v_oid']);       // 商户发送的v_oid定单编号   
		$v_pmode   =trim($_POST['v_pmode']);    // 支付方式（字符串）   
		$v_pstatus =trim($_POST['v_pstatus']);   //  支付状态 ：20（支付成功）；30（支付失败）
		$v_pstring =trim($_POST['v_pstring']);   // 支付结果信息 ： 支付完成（当v_pstatus=20时）；失败原因（当v_pstatus=30时,字符串 
		$v_amount  =trim($_POST['v_amount']);     // 订单实际支付金额
		$v_moneytype  =trim($_POST['v_moneytype']); //订单实际支付币种    
		$remark1   =trim($_POST['remark1' ]);      //备注字段1
		$remark2   =trim($_POST['remark2' ]);     //备注字段2
		$v_md5str  =trim($_POST['v_md5str' ]);   //拼凑后的MD5校验值  
		
		/**
		 * 重新计算md5的值
		 */
		                           
	 $md5string=strtoupper(md5($v_oid.$v_pstatus.$v_amount.$v_moneytype.$key));			
     $pay_res=M("moneyrecord")->where(array("order_sn"=>$v_oid))->find();
		//判断订单是否已存在
	  if($pay_res){
			if($pay_res['pstatus']==20){
                $this->redirect("vip_centent");
			}else{
			  exit();
			}		
		}

       	$set=M("usersetting")->field("money2jifen")->find(); //K币兑换比列
		$data['uid']=$remark1;
		$data['userid']=$_SESSION['memberID'];
		$data['order_sn']=$v_oid;
		$data['money']=$v_amount;
		$data['time']=time();
		$data['pay_method']=$v_pmode;
		$data['pstatus']=$v_pstatus;
		$data['kd']=$v_amount*$set['money2jifen'];
		M("moneyrecord")->add($data);
		if ($v_md5str==$md5string)
		{           

			if($v_pstatus=='20')
			{  

			    //支付成功，可进行逻辑处理！			     
			     $uid=$remark1;
				 $member=M("member");
			  	 $before=$member->where("id=".$uid)->find();
				 $kd=$v_amount*$set['money2jifen'];
			     $nowkd=$kd+$before['kd'];
			     $res=$member->where("id=".$uid)->save(array("kd"=>$nowkd));	
				 if($res){
					  $this->redirect("vip_centent");
				 }else{
				    echo '请联系管理员';
				 }
					
			}else{
				echo "支付失败";
			}
		
		
		}else{
			echo "<br>校验失败,数据可疑";
		}
	
	}
	
	public function AutoReceive(){
		     session_start();
		    $key='kod2013y';
		    $v_oid     =trim($_POST['v_oid']);      
			$v_pmode   =trim($_POST['v_pmode']);      
			$v_pstatus =trim($_POST['v_pstatus']);      
			$v_pstring =trim($_POST['v_pstring']);      
			$v_amount  =trim($_POST['v_amount']);     
			$v_moneytype  =trim($_POST['v_moneytype']);     
			$remark1   =trim($_POST['remark1' ]);     
			$remark2   =trim($_POST['remark2' ]);     
			$v_md5str  =trim($_POST['v_md5str' ]);     
			/**
			 * 重新计算md5的值
			 */
       			                           
			$md5string=strtoupper(md5($v_oid.$v_pstatus.$v_amount.$v_moneytype.$key)); //拼凑加密串
			if ($v_md5str==$md5string)
			{  
			   $pay_res=M("moneyrecord")->where(array("order_sn"=>$v_oid))->find();
				//判断订单是否已存在
			   if($pay_res){
					if($pay_res['pstatus']==20){
						echo 'ok';
					}else{
					   echo "error";
					}		
				}

				$set=M("usersetting")->field("money2jifen")->find(); //K币兑换比列
				$data['uid']=$remark1;
				$data['userid']=$_SESSION['memberID'];
				$data['order_sn']=$v_oid;
				$data['money']=$v_amount;
				$data['time']=time();
				$data['pay_method']=$v_pmode;
				$data['pstatus']=$v_pstatus;
				$data['kd']=$v_amount*$set['money2jifen'];
				M("moneyrecord")->add($data);
				
			   if($v_pstatus=="20")
				{
					//支付成功，可进行逻辑处理！			     
					 $uid=$remark1;
					 $member=M("member");
					 $before=$member->where("id=".$uid)->find();
					 $kd=$v_amount*$set['money2jifen'];
					 $nowkd=$kd+$before['kd'];
					 $res=$member->where("id=".$uid)->save(array("kd"=>$nowkd));	
					 if($res){
						echo 'ok';
					 }else{
						echo '请联系管理员';
					 }
				}
			
				
			}else{
				echo "error";
			}
	}
	
	//升级为VIP会员
	public function serach_kd(){
	    $uid=$_SESSION['memberID'];
	    $member=M("member");
	    $res=$member->where("id=".$uid)->find();

		$row=M("usersetting")->where("id=1")->find();
	    $kd=$res['kd']-$row['vipkd'];
        if($kd>=0){
            $data['uid']=$uid;
            M("vip_info")->add($data);
            $id = M("vip_info")->GetLastInsID ();          
            $num='K' . substr ( strval ( $id + 10000000 ), 1, 7 );
            $res1=M("vip_info")->where("id=".$id)->save(array("vip_number"=>$num));           
            if($res1){
			   $kd1=$kd+4000;
               $member->where("id=".$uid)->save(array("kd"=>$kd1,"u_number"=>$num,"user_grade"=>1));
               echo 1;
            }else{
               echo 2;
            }
        }else{
          echo 0;
        }	
	}
	
	
	
	//查询城市
	public function select_city(){
	   $cityid=$_GET['cityid'];	
	   $rows=M("city")->where("cityid=".$cityid)->select();

	     $str.="<option value='0'>请选择</option>";
	   foreach($rows as $key=>$val){
	     $str.="<option value='$val[provinceid]'>$val[countryname]</option>";
	   }
	   echo $str;
	}
	
	
	
	
	
	//网站公告
	public function notice(){
        $notice_rows=M("notice")->select();
        $this->assign("notice_rows",$notice_rows);  
               
        $uid=$_SESSION['memberID'];
	   $member=M("member");
	   $row1=$member->where("id=".$uid)->find();
	   //查找会员积分
	   $int=M("person_sorce")->where("uid=".$uid)->select();
	   $jifen=0;
	   foreach($int as $val){
	      $jifen=$jifen+$val['sorce'];
	   }

	   $row1['user_integral']=$jifen;
	   $this->assign("row1",$row1);



	   $this->assign("uid",$uid);
	   $memberinfo=M("member_info");
	   $row=$memberinfo->where("uid=".$uid)->find();
	   $this->assign("row",$row);
	}

	//临时 快速注册
	public function quick_regist(){
	   $data['email']=$_POST['email'];
	   $data['password']=md5($_POST['password']);
	   $data['phone']=$_POST['phone'];
	   $data['user_login_ip']=$_SERVER["REMOTE_ADDR"];
	   $data['regist_time']=time();
	   $data['user_integral']=0;
	   $data['user_grade']=0;
	   $data['user_status']=1;
        
		$member=M("member");
	    $res=$member->add($data);
		$id = $member->GetLastInsID ();
        $n_number = 'P' . substr ( strval ( $id + 10000000 ), 1, 7 );
        $member->where ( "id=" . $id )->save ( array ("u_number" => $n_number ) );

		 if($res)
		   {
			    $email=$_POST['email'];
			    $res1=$member->where("email='$email'")->find();
                $_SESSION['memberID']=$res1['id'];
				$_SESSION['islogin']=1;
				$_SESSION['username']=$email;
				
				$this->redirect("Member/index");
		   }
		   else
		   {  
			  $this->redirect("Member/index");
		   }
	
	}
    
	public function vip_centent(){
	   $uid=$_SESSION['memberID'];
	   if(empty($uid))
	   {
	   	 $this->redirect("login");
	   }
	   $member=M("member");
	   $row1=$member->where("id=".$uid)->find();

       if($row1['user_grade']==0){
	     $this->redirect("vip_goup");
	   }

	   $userss=M("userss");
		$res=$userss->where("id=1")->find();
		$row['content']=$res['content'];
		$this->assign("row",$row);
	
	   $this->display();
	}


	//找回密码
	public function zpwd(){
	   $this->display();
	}

    public function ForgotPWD(){
	     $email=$_POST['email'];	
		 $member=D("member");
		 $row=$member->where("email='$email'")->find();
			if (!$row){
				$this->error ( "邮箱地址错误！, 这个邮箱还没有注册!");
			}
         

			$pin=M("pin");

		$list=$pin->where("uid=".$row['id'])->find();
			$data['uid']=$row['id'];
			$data['email']=$row['email'];
			$time=time();
			$lin=substr($time,4, 6);
			$data['pin_pwd']=$lin;
			$data['time']=$time;
		if(empty($list)){
		   $pin->add($data);
		}else{
		  $pin->where("uid=".$row['id'])->save($data);
		}

           
			$body="您的临时密码为:".$lin."。请及时修改你的密码";
			$subject="KOD找回密码";
			$this->sendmail($email,$subject,$body);
			//$this->display("pin_repwd");
			$this->redirect("pin_repwd");
	}

	public function pin_repwd(){
	  $this->display();
	}
	
	//检测临时密码是否正确
	public function search_pin(){
	   $email=$_POST['email'];
	   $pin1=$_POST['pin'];
	   $pin=M("pin");
	   $res=$pin->where(array("email"=>$email,"pin_pwd"=>$pin1))->find();  
	   if($res){
	      echo 1;
	   }else{
	     echo 0;
	   }
	}

	//新密码
	public function newpwd(){
	   $email=$_POST['email'];
	   $pwd=$_POST['password'];
	   $member=M("member");
	   $res=$member->where("email='$email'")->save(array("password"=>md5($pwd)));
	   if($res){
	       $this->redirect("login");
	   }else{
	     $this->search_pin("search_pin");
	   }
	}
  
	/**
	 * 同步注册会员信息，当会员在KOD注册成功是同时同步的商城
	 * 的用户表里面
	 * Enter description here ...
	 */
	private function Eshop_Synchronous_Tk_Reginfo($data)
	{
	  
		if( is_array( $data ))
	    {
	        $esc_data = array();
	    	$_ecshop_user_get = M("users",'ecs_'); //加载ECS用户表
            $esc_data['user_id'] 		= $data['user_id'];
	    	$esc_data['email'] 			= $data['email'];   
	        $esc_data['user_name']		= $data['username'];
	        $esc_data['password']   	= $data['password'];
	        $esc_data['mobile_phone']   = $data['phone'];
	        $esc_data['last_ip']   		= $data['user_login_ip'];
	        if( !empty($esc_data['user_id'] ) )
	        	$_ecshop_user_get->add($esc_data);
	    }else{
	       return array('stasus'=>false);
	    }     
	
	}
	
	




}
