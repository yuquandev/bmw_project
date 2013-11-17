<?php
class Public_class
{

/**
	 * 图片简单上传
	 * @auth  
	 * @createdate  2013.3.29
	 * @param $file_field 	   上传文件的文件域名字
	 * @param $max_file_size   上传文件大小,默认2M
	 * @return array 
	 */
	public static function uploadImage($file_field='upfile',$max_file_size=LUNBOTU_SIZI_LIMIT)
	{
		$uptypes=array('jpg'=>'image/jpg','jpeg'=>'image/jpeg','png'=>'image/png','gif'=>'image/gif','bmp'=>'image/bmp');
		$file=$file_field;//$_FILES[$file_field];
		#var_dump($file);
		if($max_file_size < $file["size"])
		{
			return array('state'=>false,'describe'=>'文件太大');
		}
		if(!in_array($file["type"], $uptypes))
		{
			return array('state'=>false,'describe'=>'只能上传图像文件');
		}
		$pace_path=ROOT_PATHT.DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'upload'.DIRECTORY_SEPARATOR.'img'.DIRECTORY_SEPARATOR;
		if (!is_dir($pace_path))
		{
			mkdir($pace_path,0700,true);
		}
		$file_type=$file['type'];
		$file_name='';
		switch ($file_type)
		{
			case $uptypes['jpg']:
				$file_name=mt_rand(0, 10).$file["size"].'.jpg';
				break;
			case $uptypes['jpeg']:
				$file_name=mt_rand(0, 10).$file["size"].'.jpeg';
				break;
			case $uptypes['png']:
				$file_name=mt_rand(0, 10).$file["size"].'.png';
				break;
			case $uptypes['gif']:
				$file_name=mt_rand(0, 10).$file["size"].'.gif';
				break;
			case $uptypes['bmp']:
				$file_name=mt_rand(0, 10).$file["size"].'.bmp';
				break;
		}
		if (!move_uploaded_file($file['tmp_name'],$pace_path.$file_name))
		{
			return array('state'=>false,'describe'=>'移动上传图片失败','error'=>$file['error']);
		}
		else
		{
			return $file_name;
		} 
	}
	
	
	/**
	* 产生随机字符串
	*
	* @param    int        $length  输出长度
	* @param    string     $chars   可选的 ，默认为 0123456789
	* @return   string     字符串
	*/

	public static function random($length, $chars = '0123456789zxcvbnmasdfghjklqwertyuiop') {		
		$hash = '';
		$max = strlen($chars) - 1;
		for($i = 0; $i < $length; $i++) {
			$hash .= $chars[mt_rand(0, $max)];
		}
		return $hash;
	}
	/**
	* 产生随机数字
	*
	* @param    int        $length  输出长度
	* @param    string     $chars   可选的 ，默认为 0123456789
	* @return   string     字符串
	*/

	public static function randomInt($length, $chars = '0123456789') {		
		$hash = '';
		$max = strlen($chars) - 1;
		for($i = 0; $i < $length; $i++) {
			$hash .= $chars[mt_rand(0, $max)];
		}
		return $hash;
	}
	/**
	 * 接收二进制流生成文件
	 * PHP默认只识别application/x-www.form-urlencoded标准的数据类型。
	 * 因此，对型如text/xml 或者 soap 或者 application/octet-stream 之类的内容无法解析，如果用$_POST数组来接收就会失败！
	 * 故保留原型，交给$GLOBALS['HTTP_RAW_POST_DATA'] 来接收。 另外还有一项 php://input 也可以实现此这个功能

	 * @param $filename 要生成的文件名称
	 * @param $path 存储路径 
	 */
	public static function createFile($file_name,$path='/public/upload/userface/')
	{
		$pace_path=ROOT_PATH.$path;
		
		if (!is_dir($pace_path))
		{
			mkdir($pace_path,0700);
		}
		$xmlstr = file_get_contents('php://input');
		if(empty($xmlstr)) $xmlstr =  $GLOBALS[HTTP_RAW_POST_DATA];
		$jpg = $xmlstr;//得到post过来的二进制原始数据
		$file = fopen($pace_path.$file_name,"w");//打开文件准备写入
		fwrite($file,$jpg);//写入
		fclose($file);//关闭 
		if ($file)
		{
			return array('state'=>true,'describe'=>'创建文件成功','file_path'=>$pace_path.$file_name);
		}
		else 
		{
			return array('state'=>false,'describe'=>'创建文件失败');
		}
		
	}


	/**
	 * 把一些预定义的字符转换为 HTML 实体
	 * @param $data 传值
	 */	
    public static function checkValues($data){
    	if(is_array($data)){
    		foreach($data as $key=>$value){
    			$data[$key]=htmlspecialchars($value);
    		}	
    	}elseif(is_string($data)){
    		$data=htmlspecialchars($data);    		
    	}
    	return $data;
    } 
	/**
	 * 把一些 HTML 实体转换为 预定义的字符
	 * @param $data 传值
	 * @auth  
	 * @createdate  2013.2.28
	 */	
    public static function checkValuesDecode($data){
    	if(is_array($data)){
    		foreach($data as $key=>$value){
    			$data[$key]=htmlspecialchars_decode($value);
    		}	
    	}elseif(is_string($data)){
    		$data=htmlspecialchars_decode($data);
    	}
    	return $data;
    }	
   
	/**
	 * 生成混合字符串
	 */
	public static function createInt($mix)
	{
		$strlen=11;
		$string=self::randomInt($strlen);
		$len=strlen($mix);
		$state=$strlen;
		$int=$strlen-$len;
		while($state>=$int)
		{
			$state=self::randomInt(1);			
		}
		$repace=substr_replace($string,$mix,$state,$len);
		$len=$len<10?'0'.$len:$len;
		$repace=$repace.$state.$len;
		return $repace;
		
		
	}
	/**
	 * 解析混合后的字符串
	 * @param string $mix
	 * @return int
	 */
	public static function deInt($mix)
	{
		$state=substr($mix,-3,1);
		$len=(int)substr($mix,-1,1);
		$string=substr($mix,$state,$len);
		return $string;
	}
	/**
	 * 计算长宽按各自缩放比例缩放的比例
	**/
	private static function Ratio2($maxwidth,$maxheight,$pic_width,$pic_height)
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
		if($resizewidth_tag && $resizeheight_tag)
		{
			$ratio = array($widthratio,$heightratio);
		}
		if($resizewidth_tag && !$resizeheight_tag)
			$ratio = array($widthratio,$widthratio);
		if($resizeheight_tag && !$resizewidth_tag)
			$ratio = array($heightratio,$heightratio);

		return $ratio;
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
	public static function uploadfile_r($filefield,$userid,$maxsize=2097152,$ImgType=1)
	{
		$arr1 = array('gif'=>'image/gif','jpg'=>'image/jpg','jpeg'=>'image/jpeg','kkk'=>'image/pjpeg','png'=>'image/png','rar'=>'application/octet-stream','zip'=>'application/x-zip-compressed');
		$arr2 = array('image/gif'=>'gif','image/jpg'=>'jpg','image/jpeg'=>'jpg','image/pjpeg'=>'jpg','image/png'=>'png','application/octet-stream'=>'rar','application/x-zip-compressed'=>'zip');
		$arr3 = array('jpg'=>'image/jpg','jpeg'=>'image/jpeg','kkkk'=>'image/pjpeg');

		$filearr = $_FILES[$filefield];

		if ((int)$filearr['size']>$maxsize) return '2';

		if (!in_array($filearr['type'],$arr1) || ($ImgType==2 && !in_array($filearr['type'],$arr3))) return '3';

		if ($ImgType == 1)
		{
			$returnPath = date("Ym",time()).DIRECTORY_SEPARATOR.$userid;
			$path		= ROOT_PATH.DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'upload'.DIRECTORY_SEPARATOR.$returnPath;
			$filname	= md5(microtime(true).self::random(4).$userid);
		}
		elseif ($ImgType == 2)
			{
				$returnPath = $userid;
				$path		= ROOT_PATH.DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'upload'.DIRECTORY_SEPARATOR.$returnPath;
				$filname	= $userid;
			}
		if (!is_dir($path))
		{
			mkdir($path,0700,true);
		}
		$fileType	 = $arr2[$filearr['type']];
		$path1		 = $path.DIRECTORY_SEPARATOR.$filname.'.'.$fileType;
		$returnPath .= DIRECTORY_SEPARATOR.$filname.'.'.$fileType;

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
					
					$a = 228;
					$b = 336;
					break;
				case 2:
					$a = 265;
					$b = 176;
					
					break;
				case 3:
					$a = 735;
					$b = 615;
					break;
				default:
					$a = 10;
			}
			self::resizeImage($im,$a,$b,$newPath,$fileType,$ImgType);
		}
	}
	 
	
	
	
	/**
	 * 目前样式通用的分页
	 * 
	 * @param unknown_type $all_tol    总数
	 * @param unknown_type $uri_contro 当前变换页面的url  /控制器/方法
	 * @param unknown_type $page       当前的页数
	 * @param unknown_type $page_limit 每页显示的数量 
	 * @param unknown_type $jump_num   跳转页面 
	 */
	public static function page_limit($all_tol,$uri_contro,$page,$page_limit)
	{
		#$all_tol  = count($all_tol);
		$all_tol  = (int)$all_tol; 
		$page_num = ceil( $all_tol/$page_limit );//总页数
		if($page_num  <= 1)
		                  return ;
		$uri = false === strpos($uri_contro, '?') ? '?' : '&';
		
		$uri_contro = $uri_contro.$uri;
		
		$uri_info = explode('?',$uri_contro);
		
		$name    = substr($uri_info[1], 0,strpos($uri_info[1],'='));
	    $value   = substr($uri_info[1], strpos($uri_info[1],'=')+1,1);
		if(!empty($value) && !empty($name))
		    $type_hidden = "<input type='hidden' value='{$value}' name='{$name}'>"; //目前跳转，需要完善和修改,修改为JS跳转
		
		for($i = 1;$i<=$page_num;$i++)
		{
		    $class ='';
			if($i == $page)
		           $class = "class='page-hover'";
		    $str_end .= "<a href='{$uri_contro}page=$i' $class>$i</a>";
		}
		//左偏移
		$l_num = $page - 1;
		//右偏移
		$r_num = $page + 1;
		if($page != 1)
		{
		     $str_left  = "<a class='page-left' href='{$uri_contro}page=$l_num'><span><</span></a>";
		}
		if($page != $page_num){
		     
		      $str_right = "<a class='page-left' href='{$uri_contro}page=$r_num'><span>></span></a>";
		}
		$page_html = <<<HTML
		        <form action="$uri_contro" method="get" >
		        {$type_hidden}
		        <a class="page-last" href="{$uri_contro}page=1">首页</a>
                {$str_left}
                <span class="page-number">
                  {$str_end}   
                </span>
                {$str_right}
                <a class="page-last" href="{$uri_contro}page={$page_num}">尾页</a>
                <span>
                                         第<input class="page-text" type="text" name="page"/>页
                
                <input class="page-submit" type="submit" value="GO"/>
                </form>
                </span>
HTML;
     
       return $page_html;
}

  /**
   * 计算访客动态
   *
   * @param unknown_type $time  传入时间戳
   */
   public static function countTimeForBar($time){
   
	$now 	= time();
	if($time){
		$time = substr($time,0,(strlen($time)-2));
		$time = $time.'00';
		$now = substr($now,0,(strlen($now)-2));
		$now = $now.'00';
	}
	$rs 	= $now - $time;
	$day 	= 3600 * 24;
    $t 		= floor($rs / $day);
    if($t == 0){
		$hour 	= 3600;
		$h 		= floor($rs/$hour);
		if($h == 0){
			$minute	= 60;
			$m 		= floor($rs/$minute);
			$str 	= ($m == 0)? '1分钟前':$m.'分钟前';
		}else{
			$str = $h.'小时前';
		}
	}else if($t >= 7){
		$str = '7天前';
	}else{
		$str = $t.'天前';
	}
	return $str;
    }
  
	 
}
		
	