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
    public static function authcode()
    {
		$w = 80; //设置图片宽和高
		$h = 26;
		$str = Array(); //用来存储随机码
		$string = "ABCDEFGHIJKLMNDPBRSTUVWXYZF123456789";//随机挑选其中4个字符，也可以选择更多，注意循环的时候加上，宽度适当调整
		for($i = 0;$i < 4;$i++){
		   $str[$i] = $string[rand(0,35)];
		   $vcode .= $str[$i];
		}
		$session = new session;
		$session->start();
		
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


}