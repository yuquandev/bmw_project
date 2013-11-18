<?php $this->beginContent('//index/header'); ?>
<?php $this->endContent(); ?>

<div class="bm_index">
    <?php $this->beginContent('//index/nav'); ?>
    <?php $this->endContent(); ?>
    <!--活动细则-->
    <div class="bm_hd">
    	<div class="bm_hd_title">
        	<ul>
        		<li><a href="javascript:;"  class="hymenuon" id=menuTabmenu012_12 onclick="setTimeout('Show_menuTab012(1,2)',200);"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/bm_hd_ico.jpg" /><span>活动介绍</span></a></li>
            	<li><a href="javascript:;" class="hymenuoff" id=menuTabmenu012_11 onclick="setTimeout('Show_menuTab012(1,1)',200);"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/bm_hd_ico2.jpg" /><span>活动规则</span></a></li>
           		<li><a href="javascript:;" class="hymenuoff" id=menuTabmenu012_10 onclick="setTimeout('Show_menuTab012(1,0)',200);"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/bm_hd_ico3.gif" /><span>视频</span></a></li>
            </ul>
            <div class="bm_dl">
            	 <?php if (empty($this->userinfo)){?>
            	    <a href="javascript:com_dialog('login');">登陆 | </a><a href="javascript:com_dialog('reg');">注册</a>
                <?php }else { ?>
                    欢迎您，<?php echo $this->userinfo['username'] ?>&nbsp;<a href="/index.php/index/more?uuid=<?php echo $this->userinfo['uid'];?>,2,center"><span style="color:red;">查看作品</span></a> | <a href='/index.php/user/logout'>退出</a>
                <?php }?>
            </div>
        </div>
        <div class="bm_hd_main" id="menuTabcontent012_12">
        	<div class="bm_hd_left">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/img/bm_hd_tp.png" border="0" usemap="#Map" />
                <map name="Map" id="Map">
                <?php if (!empty($this->userinfo)){?>
        	    <area shape="poly" coords="78,98,56,98,40,71,22,37,23,22,58,16,104,19,125,22,130,31,129,42,96,96" href="javascript:void(0);" onclick="com_dialog('uploads');" />
                <?php }else {?>
        	    <area shape="poly" coords="78,98,56,98,40,71,22,37,23,22,58,16,104,19,125,22,130,31,129,42,96,96" href="com_dialog('uploads');"  />
                <?php }?>
               </map>
           </div>
        	
        	<div class="bm_hd_zj" style="left:0px;width:500px">
            <h2 style="padding-left:200px; padding-bottom:10px;">　　　运动宣言有奖活动征集</h2>
            <span style="padding-left:210px">参与运动宣言活动的用户，上传图片并发</span><br />
            <p style="padding-left:198px">表运动宣言，即有机会获得宝马中国提供</p>
            <p style="padding-left:183px">的精美奖品。用户可以通过在线投票选出</p>
            <p style="padding-left:168px">自己喜欢的图片。</p>
            <p style="padding-left:157px">让我们一起见证这激情的盛会，与BMW3系</p>
            <p style="padding-left:145px">共同去感受运动的热潮，去寻找纯粹的运动</p>
            <p style="padding-left:130px">基因！</p>

			<p style="padding-left:117px"><strong>活动要求：<></p>
 			<p style="padding-left:107px">1.参与者拍摄三张自己的运动特写照片</p>
            <p style="padding-left:96px">2.使用美图秀秀的BMW3系专属模板进行拼</p>
            <p style="padding-left:86px">图并保存</p>
            <p style="padding-left:70px">3.将拼好图片上传至活动官网并写出你的</p>
            <p style="padding-left:60px">运动宣言参与有奖活动</p>
            </div>

            <div class="bm_hd_yc">
            	<div class="bm_hd_tu"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/bm_hd_tu.jpg" /></div>
            </div>
        </div>
        <div class="bm_hd_main" style="display:none" id="menuTabcontent012_11">
        	
        	<div class="bm_hd_left">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/img/bm_hd_tp.png" border="0" usemap="#Map" />
                <map name="Map" id="Map">
                <?php if (!empty($this->userinfo)){?>
        	    <area shape="poly" coords="78,98,56,98,40,71,22,37,23,22,58,16,104,19,125,22,130,31,129,42,96,96" href="javascript:void(0);" onclick="com_dialog('uploads');" />
                <?php }else {?>
        	    <area shape="poly" coords="78,98,56,98,40,71,22,37,23,22,58,16,104,19,125,22,130,31,129,42,96,96" href="com_dialog('uploads');"  />
                <?php }?>
               </map>
           </div>
        	
        	
        	
        
            <div class="bm_hd_zj">
            <h2 style="padding-top:10px;">　　　　　　活动时间：11月25—12月1日</h2><br />
 			<p>　　　　　　　　1.登陆美图秀秀，下载BMW专属海报模板，<br />　　　　　　　将生活中自己带有运动元素的图片进行拼图。</p><br />
            <p style="padding-left:75px">2.上传至活动官网参与活动。</p><br />
            <p style="padding-left:51px">3.用户浏览官方网站，对喜欢的图片进行</p>
            <p style="padding-left:39px">投票。</p><br />
            <p style="padding-left:17px">4.奖项评选将根据得票数量由高到低进行</p>
            <p style="padding-left:3px">评选。</p>
            </div>


            <div class="bm_hd_yc">
            	<div class="bm_hd_tu"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/bm_hd_tu.jpg" /></div>
            </div>
        </div>
        <div class="bm_hd_main" id="menuTabcontent012_10" style="display:none">
        	
        	<div class="bm_hd_left">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/img/bm_hd_tp.png" border="0" usemap="#Map" />
                <map name="Map" id="Map">
                <?php if (!empty($this->userinfo)){?>
        	    <area shape="poly" coords="78,98,56,98,40,71,22,37,23,22,58,16,104,19,125,22,130,31,129,42,96,96" href="javascript:void(0);" onclick="com_dialog('uploads');" />
                <?php }else {?>
        	    <area shape="poly" coords="78,98,56,98,40,71,22,37,23,22,58,16,104,19,125,22,130,31,129,42,96,96" href="com_dialog('uploads');"  />
                <?php }?>
               </map>
           </div>
        	
        	<div class="bm_hd_zj">
            <h2>　　　　　　　你的运动宣言有动征集33x</h2><br />
            <span>　　　　　　　　BMW 3系的历史在这里一览无疑，由于脾<br />　　　　　　　气火爆，性格直率，所以被人们常常亲切称为<br />　　　　　　“三哥”。
			</span><br /><br />
 			<p>　　　　漂亮的甩尾，灵动的转弯，澎湃的动力，都刺<br />　　　激着你的肾上腺素</p><br />
            <h2>　　　　BMW 3系</h2><br />
            <h2>　　　　运动王者 领衔起跑</h2>
            </div>

            <div class="bm_hd_yc">
            	<div class="bm_hd_tu">
                	<div class="bm_3x_st">
                        <div class="bm_3x_sp">
                            <div class="rollBox">                           
<a href="javascript:;" onmousedown="ISL_GoDown()" onmouseup="ISL_StopDown()" onmouseout="ISL_StopDown()" class="img1" hidefocus="true"></a>
     <div class="Cont" id="ISL_Cont" name="video">
      <div class="ScrCont">
       <div id="List1">
        <!-- 图片列表 begin -->
        <?php foreach($video as $v):?>
        <div class="pic">
          <a><div class="wz_js"><a target="_blank" href="http://<?php if(isset($v['c_url'])){ echo $v['c_url'];}else{ echo '/'; }?>"><?php echo $v['name'];?></a></div><embed src="<?php echo $v['video_url'];?>" allowFullScreen="true" quality="high" width="400" height="243" align="middle" allowScriptAccess="always" type="application/x-shockwave-flash"></embed></a>
         </div>
        <?php endforeach;?>
        <!-- 图片列表 end -->
       </div>
       <div id="List2"></div>
      </div>
     </div>
<a href="javascript:;"  onmousedown="ISL_GoUp()" onmouseup="ISL_StopUp()" onmouseout="ISL_StopUp()" class="img2" hidefocus="true"></a>
    </div>
                        	
                        </div>
                	</div>
                </div>
            </div>
        </div>
    </div>
    <!--活动细则-->
    <!--人车交互-->
    <div class="bm_rcjh">
    	<div class="bm_zpzs_title">
        	<span>人车交互</span>
        </div>
        <div class="bm_rcjh_main"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/bm_rcjh.jpg" /></div>
    </div>
    <!--作品展示-->
    <div class="bm_zpzs">
    	<div class="bm_zpzs_title">
        	<span>作品展示</span>
            <a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/index/threemoer"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/bm_zpzs_more.jpg" /></a>
        </div>
          <div class="bm_zpzs_main">
        	<?php foreach($works as $key=>$val):?>
        	<div class="bm_zpzs_list">
            	<div class="bm_zpzs_tu" style="position: relative;background: url(/js/lazyload/grey.gif) no-repeat center center;"><a style="position: absolute;width:366px;"  href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/index/more?&uuid=<?php echo $val['id'];?>,<?php echo $val['user_id'];?>,<?php echo $val['type'];?>,b"><img src="<?php echo $val['img_url']; ?>" width="" height="366"/></a></div>
                <div class="bm_zpzs_zi"><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/index/more?&uuid=<?php echo $val['id'];?>,<?php echo $val['user_id'];?>,<?php echo $val['type'];?>,b"><?php echo $val['name'];?></a></div>
                <div class="bm_zpzs_zan">
                	<input onclick="top_vote(<?php echo $val['id']?>,<?php echo $val['vote_num']?>);" type="button" class="bm_tp_an" value="投票"/>
                    <span  id="vote_<?php echo $val['id']?>"><?php echo $val['vote_num']?></span>
                </div>
            </div>
            <?php endforeach;?> 
        </div>
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
    <!--微直播-->
    <div class="bm_wzb">
    
    	<div class="bm_zpzs_title">
        	<span>微直播</span>
            <a name="top"></a>
        </div>
        <div class="bm_wzb_main">   
     <wb:topic topmid="z8ClGsZa8" column="n" border="n" title="BMW%203%E7%B3%BB%20%E8%BF%90%E5%8A%A8%E7%8E%8B%E8%80%85%20%E5%B0%BD%E5%9C%A8%E5%92%AB%E5%B0%BA" width="978" height="1165" tags="%E5%83%8F%E5%AE%9D%E9%A9%AC%E4%B8%80%E6%A0%B7%E5%A5%94%E8%B7%91%2C%E6%88%91%E7%9A%84%E7%A5%9E%E9%A9%AC%E7%85%A7%2C%E5%AE%9D%E9%A9%AC%E7%AC%91%E8%84%B8%E5%A2%99" color="333333%2Cffffff%2C0078b6%2Ccccccc%2C333333%2Cfafeff%2C0078b6%2Ccccccc%2Ccccccc%2Ce9f4fb" language="zh_cn" version="base" refer="y" footbar="y" url="http%3A%2F%2Fwww.bmw3-sport.com" filter="n" ></wb:topic>
        </div>
    </div>
    <!--X1-->
    <div class="bm_x1">
    	
        <div class="bm_hd_title3">
        	<ul>
                <div class="bm_jcts_left"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/bm_hd_ico4.gif" style="padding-left:10px;"/><span >精彩图赏</span></div>
                <div class="bm_jcts_you"><a href="#"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/more.png" /></a></div>
            </ul>
        </div>
        <div class="bm_x1_main" id="menuTabcontent013_12">
        	<div id="featureContainer">
				<div id="feature">
		<div id="block">
			<div id="botton-scroll">
				<ul class="featureUL">
					<?php foreach($image_list as $key=>$val):?>
					<li class="featureBox" >
					<div class="box" style="background: url(/js/lazyload/grey.gif) no-repeat center center;">
						<a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/index/footerlg?id=<?php echo $val['id']?>,<?php echo $val['type_id']?>" target="_blank">
						<img src="<?php echo $val['image_url'];?>"  width="265" height="176">
						</a>
					</div>
					<!-- /box -->
					</li>
					<?php endforeach;?>
				</ul>
			</div>
			<!-- /botton-scroll --></div>
		<!-- /block --><a class="prev" href="javascript:void();">Previous</a><a class="next" href="javascript:void();">Next</a>
	</div>
		    </div>
        </div>
    </div>
    <!--底部-->
    <?php $this->beginContent('//index/footer'); ?>
<?php $this->endContent(); ?>
</div>
<!--上传图片-->

<span id="uplode_img"></span>
<input type="hidden" id="ty_id" value="<?php echo $this->type;?>">
<!--注册账号-->
<div id="com_dialog"></div>
<!--登陆与注册-->
<!--投票成功-->
<span id="popmsg"></span>
<span id="popmsg2"></span>
<div id="bg" class="bg" style="display:none;"></div>
<iframe id='popIframe' class='popIframe' frameborder='0' ></iframe>

<script language="javascript" type="text/javascript">
<!--//--><![CDATA[//><!--
//图片滚动列表 mengjia 070816
var Speed = 10; //速度(毫秒)
var Space = 10; //每次移动(px)
var PageWidth = 419; //翻页宽度
var fill = 0; //整体移位
var MoveLock = false;
var MoveTimeObj;
var Comp = 0;
var AutoPlayObj = null;
GetObj("List2").innerHTML = GetObj("List1").innerHTML;
GetObj('ISL_Cont').scrollLeft = fill;
//GetObj("ISL_Cont").onmouseover = function(){clearInterval(AutoPlayObj);}
//GetObj("ISL_Cont").onmouseout = function(){AutoPlay();}
AutoPlay();
function GetObj(objName){if(document.getElementById){return eval('document.getElementById("'+objName+'")')}else{return eval

('document.all.'+objName)}}
//function AutoPlay(){ //自动滚动
//clearInterval(AutoPlayObj);
//AutoPlayObj = setInterval('ISL_GoDown();ISL_StopDown();',5000); //间隔时间
//}
function ISL_GoUp(){ //上翻开始
if(MoveLock) return;
clearInterval(AutoPlayObj);
MoveLock = true;
MoveTimeObj = setInterval('ISL_ScrUp();',Speed);
}
function ISL_StopUp(){ //上翻停止
clearInterval(MoveTimeObj);
if(GetObj('ISL_Cont').scrollLeft % PageWidth - fill != 0){
Comp = fill - (GetObj('ISL_Cont').scrollLeft % PageWidth);
CompScr();
}else{
MoveLock = false;
}
AutoPlay();
}
function ISL_ScrUp(){ //上翻动作
if(GetObj('ISL_Cont').scrollLeft <= 0){GetObj('ISL_Cont').scrollLeft = GetObj

('ISL_Cont').scrollLeft + GetObj('List1').offsetWidth}
GetObj('ISL_Cont').scrollLeft -= Space ;
}
function ISL_GoDown(){ //下翻
clearInterval(MoveTimeObj);
if(MoveLock) return;
clearInterval(AutoPlayObj);
MoveLock = true;
ISL_ScrDown();
MoveTimeObj = setInterval('ISL_ScrDown()',Speed);
}
function ISL_StopDown(){ //下翻停止
clearInterval(MoveTimeObj);
if(GetObj('ISL_Cont').scrollLeft % PageWidth - fill != 0 ){
Comp = PageWidth - GetObj('ISL_Cont').scrollLeft % PageWidth + fill;
CompScr();
}else{
MoveLock = false;
}
AutoPlay();
}
function ISL_ScrDown(){ //下翻动作
if(GetObj('ISL_Cont').scrollLeft >= GetObj('List1').scrollWidth){GetObj('ISL_Cont').scrollLeft =

GetObj('ISL_Cont').scrollLeft - GetObj('List1').scrollWidth;}
GetObj('ISL_Cont').scrollLeft += Space ;
}
function CompScr(){
var num;
if(Comp == 0){MoveLock = false;return;}
if(Comp < 0){ //上翻
if(Comp < -Space){
   Comp += Space;
   num = Space;
}else{
   num = -Comp;
   Comp = 0;
}
GetObj('ISL_Cont').scrollLeft -= num;
setTimeout('CompScr()',Speed);
}else{ //下翻
if(Comp > Space){
   Comp -= Space;
   num = Space;
}else{
   num = Comp;
   Comp = 0;
}
GetObj('ISL_Cont').scrollLeft += num;
setTimeout('CompScr()',Speed);
}
}
//--><!]]>
</script>
<script type="text/javascript">

    (function(){
        var tmp = 0;
        $('.bm_zpzs_tu a').each(function(){
            var that = $(this);
            $(this).find('img').bind('load',function(){
                tmp = - that.find('img').width() / 2 + 228/2;
                that.css('margin-left',tmp+'px');
                that.find('img').height(366);
            });
            //console.log($(this).find('img').width());
            //if ($(this).find('img').height() > 366){
                tmp = - $(this).find('img').width() / 2 + 228/2;
            //}else {
            //    tmp = - $(this).find('img').width() / 2 + 183;
            //}
           $(this).css('margin-left',tmp+'px');
           $(this).find('img').height(366);
        });
    })();
</script>

<script type="text/javascript">

    (function(){
        var tmp = 0;
        $('.bm_zpzs_tu a').each(function(){
            var that = $(this);
            $(this).find('img').bind('load',function(){
                tmp = - that.find('img').width() / 2 + 228/2;
                that.css('margin-left',tmp+'px');
                that.find('img').height(366);
                that.find('img').removeAttr('width');
            });
            //console.log($(this).find('img').width());
            //if ($(this).find('img').height() > 366){
            tmp = - $(this).find('img').width() / 2 + 228/2;
            //}else {
            //    tmp = - $(this).find('img').width() / 2 + 183;
            //}
            $(this).css('margin-left',tmp+'px');
            $(this).find('img').height(366);
            $(this).find('img').removeAttr('width');
            if ($(this).css('margin-left') == '114px'){
                $(this).css('margin-left','400px');
            }
        });
    })();
</script>

</body>
</html>
