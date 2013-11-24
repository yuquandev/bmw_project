<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();

    //获取客户端ip
    static public function get_client_ip() {
        if(getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown')) {
            $ip = getenv('HTTP_CLIENT_IP');
        } elseif(getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown')) {
            $ip = getenv('HTTP_X_FORWARDED_FOR');
        } elseif(getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown')) {
            $ip = getenv('REMOTE_ADDR');
        } elseif(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown')) {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return preg_match ( '/[\d\.]{7,15}/', $ip, $matches ) ? $matches [0] : '';
    }



 /**
     * 验证码
     */
    public  function authcode()
    {
		$w = 80; //设置图片宽和高
		$h = 26;
		$str = Array(); //用来存储随机码
		$vcode ='';
		$string = "ABCDEFGHIJKLMNDPBRSTUVWXYZF123456789";//随机挑选其中4个字符，也可以选择更多，注意循环的时候加上，宽度适当调整
		for($i = 0;$i < 4;$i++){
		   $str[$i] = $string[rand(0,35)];
		   $vcode .= $str[$i];
		}
		$_SESSION['VCODE'] = strtolower($vcode);
		$im = imagecreatetruecolor($w,$h);
		$white = imagecolorallocate($im,255,255,255); //第一次调用设置背景色
		$black = imagecolorallocate($im,0,0,0); //边框颜色
		imagefilledrectangle($im,0,0,$w,$h,$white); //画一矩形填充
		imagerectangle($im,0,0,$w-1,$h-1,$black); //画一矩形框
		//生成雪花背景
		for($i = 1;$i < 200;$i++){
		   $x = mt_rand(1,$w-9);
		   $y = mt_rand(1,$h-9);
		   $color = imagecolorallocate($im,mt_rand(200,255),mt_rand(200,255),mt_rand(200,255));
		   imagechar($im,1,$x,$y,"*",$color);
		}
		//将验证码写入图案
		for($i = 0;$i < count($str);$i++){
		   $x = 13 + $i * ($w - 15)/4;
		   $y = mt_rand(3,$h / 3);
		   $color = imagecolorallocate($im,mt_rand(0,225),mt_rand(0,150),mt_rand(0,225));
		   imagechar($im,5,$x,$y,$str[$i],$color);
		}
		header("Content-type:image/jpeg"); //以jpeg格式输出，注意上面不能输出任何字符，否则出错
		imagejpeg($im);
		imagedestroy($im);
}
   



	/**
	 * 图片简单上传
	 * @auth  gexiaogang
	 * @createdate  2013.3.29
	 * @param $file_field 	   上传文件的文件域名字
	 * @param $max_file_size   上传文件大小,默认2M
	 * @return array 
	 */
	public static function uploadImage($file_field='upfile',$max_file_size=LUNBOTU_SIZI_LIMIT)
	{
		$uptypes=array('jpg'=>'image/jpg','jpeg'=>'image/jpeg','png'=>'image/png','gif'=>'image/gif','bmp'=>'image/bmp');
		$file=$_FILES[$file_field];
		if($max_file_size < $file["size"])
		{
			return array('state'=>false,'describe'=>'文件太大');
		}
		if(!in_array($file["type"], $uptypes))
		{
			return array('state'=>false,'describe'=>'只能上传图像文件');
		}
		$pace_path=ROOT_PATH.DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'upload'.DIRECTORY_SEPARATOR.'img'.DIRECTORY_SEPARATOR;
		if (!is_dir($pace_path))
		{
			mkdir($pace_path,0700,true);
		}
		$file_type=$file['type'];
		$file_name='';
		switch ($file_type)
		{
			case $uptypes['jpg']:
				$file_name=md5(microtime(true).self::random(4).$file["size"]).'.jpg';
				break;
			case $uptypes['jpeg']:
				$file_name=md5(microtime(true).self::random(4).$file["size"]).'.jpeg';
				break;
			case $uptypes['png']:
				$file_name=md5(microtime(true).self::random(4).$file["size"]).'.png';
				break;
			case $uptypes['gif']:
				$file_name=md5(microtime(true).self::random(4).$file["size"]).'.gif';
				break;
			case $uptypes['bmp']:
				$file_name=md5(microtime(true).self::random(4).$file["size"]).'.bmp';
				break;
		}
		if (!move_uploaded_file($file['tmp_name'],$pace_path.$file_name))
		{
			return array('state'=>false,'describe'=>'移动上传图片失败','error'=>$file['error']);
		}
		else
		{
			return array('state'=>true,'describe'=>'上传图像文件成功','filename'=>$file_name);
		} 
	}



	 /**
	 * 分页代码
	 * Enter description here ...
	 * @param unknown_type $page_num 页面总数  
	 * @param unknown_type $page     当前页数
	 * @param unknown_type $page_limit 显示条数
	 * @param unknown_type $pageSite    当前页面左右显示的个数 
	 */
	static public  function page_limit($count_number,$page,$page_limit,$pageSite=4)
    {
		
		$page_num  =    ceil($count_number / $page_limit);
	
	    $pageSite =  (int)$pageSite;  //当前页面左右显示的个数 
		
		$url = $_SERVER['REQUEST_URI'];
	    
        $uri = false != strpos($url,'?page')  ? substr($url , 0, strpos($url,'page')-1)  : $url;
		
        $uri_list = false === strpos($uri, '?') ? '?' : '&';  
		
		if($page_num  <= 1)
		{
		      return "<div class='news_page'></div>";
		}
		
		$uri_path = $uri.$uri_list;
		
		$_j  = ($page + $pageSite) >= $page_num ?  $page_num : ($page + $pageSite);
        $_i  = ($page - $pageSite) > 1 ? $page - $pageSite : 1;
        $str_end ='';
        for($i = $_i ; $i<= $_j; $i++)
		{
             $class ='';
		   	 if($i == $page)
			 {
		           $class = "color:red;";
			 }
		     $str_end .= "<a href='{$uri_path}page=$i#toppage'  class='news_page_2' style='padding-right:5px;$class'>$i</a>";
		}
        
		//左偏移
		$l_num = $page - 1;
		//右偏移
		$r_num = $page + 1;
		$str_left  = '';
		$str_right = '';
		if($page != 1)
		{
		     $str_left  = "<a href='{$uri_path}page=$l_num#toppage' class='news_page_1'> <img src='/img/page_2.jpg' /></a>";
		}
		if($page != $page_num){
		     $str_right = "<a href='{$uri_path}page=$r_num#toppage' class='news_page_1'><img src='/img/page_3.jpg' /></a>";
		}
		$page_html = <<<HTML
		        <div class="news_page">
                    	<a href="{$uri_path}page=1#toppage" class="news_page_1"><img src="/img/page_1.jpg" /></a>
		                {$str_left}
                        {$str_end}
                        {$str_right}
                        <a href="{$uri_path}page={$page_num}#toppage" class="news_page_1"><img src="/img/page_4.jpg" /> </a>
                    </div>
HTML;
      return $page_html;
      
    }
      	/**
	 * 执行上传一个张图片文件或一个压缩包的功能,如果图片文件，自动生成原图的大中小三幅图，文件名为原文件名依次加“_1” “_2” “_3”
	 * 
	 * @createdate  2013.2.18
	 * @param $filefield 上传的文本控件名称
	 * @param $userid 上传的用户ID
	 * @param $maxsize 上传文件最大尺寸（默认2M）
	 * @param $ImgType 上传图片的种类（默认为1   1 - 普通图片  2 - 头像图片）
	 * @return  
	 *          '2'      文件尺寸过大
	 *          '3'      文件类型不符合要求
	 *			array   上传成功，返回文件路径和文件大小
	 *			Array
	 *			(
	 *				[path] => D:\xampp\perl\lib\CGI\c_1.jpeg
	 *				[size] => 2313213
	 *			)
	**/
public static function uploadfile_r($filefield,$userid,$path_name ='works',$maxsize=2097152,$ImgType=1)
	{
		$arr1 = array('gif'=>'image/gif','jpg'=>'image/jpg','jpeg'=>'image/jpeg','kkk'=>'image/pjpeg','png'=>'image/png');
		$arr2 = array('image/gif'=>'gif','image/jpg'=>'jpg','image/jpeg'=>'jpg','image/pjpeg'=>'jpg','image/png'=>'png');
		$arr3 = array('jpg'=>'image/jpg','jpeg'=>'image/jpeg','kkkk'=>'image/pjpeg');

		$filearr = $filefield;//$_FILES[$filefield];
        
		if ((int)$filearr['size']>$maxsize){ 
		    return '2';	
		}
        if (!in_array($filearr['type'],$arr1)){
			return '3';
		} 

		if ($ImgType == 1)
		{
			$returnPath = $userid;
			$path		= Yii::app()->params['root_dir'].'uploads/'.$path_name.'/'.$returnPath;
			$filname	= mt_rand(1,100).date("Ymd",time());
		}
		elseif ($ImgType == 2)
			{
				$returnPath = $userid;
				$path		= Yii::app()->params['root_dir'].'uploads/'.$path_name.'/'.$returnPath;
				$filname	= $userid;
			}
		if (!is_dir($path))
		{
			mkdir($path,0777,true);
		}
		$fileType	 = $arr2[$filearr['type']];
		$path1		 = $path.'/'.$filname.'.'.$fileType;
		$returnPath .= '/'.$filname.'.'.$fileType;

		move_uploaded_file($filearr['tmp_name'],$path1);

		//如果是上传图片，生成大中小三付图片
		if ($fileType == 'jpg' || $fileType == 'png' || $fileType == 'gif')
		{
			for ($i=1;$i<=3;$i++)
			{
				self::getIM($path1,$i,$ImgType);
			}
		}
		return array('path'=>str_replace('\\','/',$returnPath),'size'=>$filearr['size']);
	}
	private static function getIM($path,$i,$ImgType)
	{
		$arr		= explode(DIRECTORY_SEPARATOR,$path);
		$filename	= $arr[count($arr)-1];
		$fileArr	= explode('.',$filename);
		$fileType	= $fileArr[count($fileArr)-1];
		
		$fileArr[count($fileArr)-2] .= '_'.$i;
		$arr[count($arr)-1]			 = implode('.',$fileArr);

		$newPath	= implode(DIRECTORY_SEPARATOR,$arr);

		switch ($fileType)
		{
			case 'jpg':
				$im = imagecreatefromjpeg($path);
				break;
			case 'gif':
				$im = imagecreatefromgif($path);
				break;
			case 'png':
				$im = imagecreatefrompng($path);
				break;
			default:
				$im = '';
		}
		if ($im)
		{
			switch ($i)
			{
				case 1:
					
					$a = 135;   //手机展现的尺寸
					$b = 195;
					break;
				case 2:
					$a = 310;   //首页底部展现的尺寸
					$b = 210;
					
					break;
				case 3:
					$a = 80;
					$b = 130;
					break;
				default:
					$a = 10;
			}
			self::resizeImage($im,$a,$b,$newPath,$fileType,$ImgType);
		}
	}
	 


/**
	 *实现缩放图片的函数
	 * @auth  
	 * @createdate  2013.2.20
	 * @param $im 图片对象
	 * @param $maxwidth 图片缩小后的宽度
	 * @param $maxheight 图片缩小后的高度
	 * @param $name 生成的图片不带后缀的绝对路径
	 * @param $filetype 图片的后缀名
	 * @param $copytype 图片的缩放方式（默认为1 - 长宽按同一比例缩放  2 - 长宽按各自比例分别缩放）
	 × @return 无
	**/
	private static function resizeImage($im,$maxwidth,$maxheight,$name,$filetype,$copytype)
	{
		$pic_width = imagesx($im);
		$pic_height = imagesy($im);

		if(($maxwidth && $pic_width > $maxwidth) || ($maxheight && $pic_height > $maxheight))
		{
			if ($copytype == 1)
			{
				$ratio = self::Ratio1((int)$maxwidth,(int)$maxheight,(int)$pic_width,(int)$pic_height);
				$newwidth = $pic_width * $ratio;
				$newheight = $pic_height * $ratio;
			}
			elseif ($copytype == 2)
				{
					$ratio = self::Ratio2((int)$maxwidth,(int)$maxheight,(int)$pic_width,(int)$pic_height);
					$newwidth = $pic_width * $ratio[0];
					$newheight = $pic_height * $ratio[1];
				}
			if(function_exists("imagecopyresampled"))
			{
				$newim = imagecreatetruecolor($newwidth,$newheight);
			   imagecopyresampled($newim,$im,0,0,0,0,$newwidth,$newheight,$pic_width,$pic_height);
			}
			else
			{
				$newim = imagecreate($newwidth,$newheight);
			   imagecopyresized($newim,$im,0,0,0,0,$newwidth,$newheight,$pic_width,$pic_height);
			}

			$im_tmp = $newim;
		}
		else
		{
			$im_tmp = $im;
		}           

		switch ($filetype)
		{
			case 'jpg':
				imagejpeg($im_tmp,$name);
				break;
			case 'gif':
				imagegif($im_tmp,$name);
				break;
			case 'png':
				imagepng($im_tmp,$name);
				break;
		}
		imagedestroy($im_tmp);
	}
/**
	 * 计算长宽相同缩放比例的比例
	**/
	private static function Ratio1($maxwidth,$maxheight,$pic_width,$pic_height)
	{
		if($maxwidth && $pic_width>$maxwidth)
		{
			$widthratio = $maxwidth/$pic_width;
			$resizewidth_tag = true;
		}

		if($maxheight && $pic_height>$maxheight)
		{
			$heightratio = $maxheight/$pic_height;
			$resizeheight_tag = true;
		}
       // $resizewidth_tag = $resizeheight_tag = true;
		
		if($resizewidth_tag && $resizeheight_tag)
		{
			if($widthratio<$heightratio)
				$ratio = $widthratio;
			else
				$ratio = $heightratio;
		}

		if($resizewidth_tag && !$resizeheight_tag)
			$ratio = $widthratio;
		if($resizeheight_tag && !$resizewidth_tag)
			$ratio = $heightratio;

		return $ratio;
	}
/**
	 *返回一幅原图的大中小图绝对地址
	 * @auth  
	 * @createdate  2013.2.20
	 * @param $path 原图的绝对地址
	 × @return array
	 ×	
	 ×	Array
	 ×	(
	 ×		[0] => 20/c_1.jpeg
	 ×		[1] => 20/c_2.jpeg
	 ×		[2] => 20/c_3.jpeg
	 ×	)
    **/
	public static function getFileNameArr($path)
	{
		$newPath = array();

		for ($i=1;$i<=3;$i++)
		{
			$arr		= explode('/',$path);
			$filename	= $arr[count($arr)-1];
			$fileArr	= explode('.',$filename);
			
			$fileArr[count($fileArr)-2] .= '_'.$i;
			$arr[count($arr)-1]			 = implode('.',$fileArr);

			$newPath[] = implode('/',$arr);
		}

		return $newPath;
	}

   public function check_wap() 
   { 
		if (isset($_SERVER['HTTP_VIA'])) return true; 
		if (isset($_SERVER['HTTP_X_NOKIA_CONNECTION_MODE'])) return true; 
		if (isset($_SERVER['HTTP_X_UP_CALLING_LINE_ID'])) return true; 
		if (strpos(strtoupper($_SERVER['HTTP_ACCEPT']),"VND.WAP.WML") > 0) { 
		// Check whether the browser/gateway says it accepts WML. 
		$br = "WML"; 
		} else { 
		$browser = isset($_SERVER['HTTP_USER_AGENT']) ? trim($_SERVER['HTTP_USER_AGENT']) : ''; 
		if(empty($browser)) return true; 
		$mobile_os_list=array('Google Wireless Transcoder','Windows CE','WindowsCE','Symbian','Android','armv6l','armv5','Mobile','CentOS','mowser','AvantGo','Opera Mobi','J2ME/MIDP','Smartphone','Go.Web','Palm','iPAQ'); 
		$mobile_token_list=array('Profile/MIDP','Configuration/CLDC-','160×160','176×220','240×240','240×320','320×240','UP.Browser','UP.Link','SymbianOS','PalmOS','PocketPC','SonyEricsson','Nokia','BlackBerry','Vodafone','BenQ','Novarra-Vision','Iris','NetFront','HTC_','Xda_','SAMSUNG-SGH','Wapaka','DoCoMo','iPhone','iPod'); 
		$found_mobile=$this->checkSubstrs($mobile_os_list,$browser) || 
		$this->checkSubstrs($mobile_token_list,$browser); 
		if($found_mobile) 
		$br ="WML"; 
		else $br = "WWW"; 
		} 
		if($br == "WML") { 
		return true; 
		} else { 
		return false; 
		} 
   } 
	function checkSubstrs($list,$str){ 
		$flag = false; 
		for($i=0;$i<count($list);$i++){ 
			if(strpos($str,$list[$i]) > 0){ 
			$flag = true; 
			break; 
	 	} 
	} 
		return $flag; 
	} 

   


}    	        
?> 











