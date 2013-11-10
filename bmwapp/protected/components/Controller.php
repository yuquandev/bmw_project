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