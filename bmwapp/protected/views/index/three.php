<?php $this->beginContent('//index/header'); ?>
<?php $this->endContent(); ?>
<script src=" http://tjs.sjs.sinajs.cn/open/api/js/wb.js?appkey=3168919025" type="text/javascript" charset="utf-8"></script>
<script>
$().ready(function(){
  $(".banner").hide();
  $(".featureBox").mouseover(function(){
	  $(this).find(".banner").show();
  });
  $(".featureBox").mouseout(function(){
	  $(this).find(".banner").hide();
  });
});
</script>
<SCRIPT language=javascript>
if(document.all){
var tags=document.all.tags("a")
for (var i=0;i<tags.length;i++)
tags(i).outerHTML=tags(i).outerHTML.replace(">"," hidefocus=true>")}
</SCRIPT>
<div class="bm_index">
    <?php $this->beginContent('//index/nav'); ?>
    <?php $this->endContent(); ?>
    <!--活动细则-->
    <div class="bm_hd">
    	<div class="bm_hd_title">
        	<ul>
        		<li><a href="javascript:;"  class="hymenuon" id=menuTabmenu012_11 onclick="setTimeout('Show_menuTab012(1,1)',200);"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/bm_hd_ico.jpg" /><span>活动介绍</span></a></li>
            	<li><a href="javascript:;" class="hymenuoff" id=menuTabmenu012_10 onclick="setTimeout('Show_menuTab012(1,0)',200);"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/bm_hd_ico2.jpg" /><span>活动规则</span></a></li>
           		<li><a href="#top" class="hymenuoff"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/bm_hd_ico5.jpg" /><span>作品展示</span></a></li>
            </ul>
            <div class="bm_dl">
            	 <?php if (empty($this->userinfo)){?>
            	    <a href="javascript:com_dialog('login');">登陆 | </a><a href="javascript:com_dialog('reg');">注册</a>
                <?php }else { ?>
                    欢迎您，<?php echo $this->userinfo['username'] ?>&nbsp;<a href="/index.php/index/more?uuid=-1,<?php echo $this->userinfo['uid'];?>,2,center#works"><span style="color:red;">查看作品</span></a> | <a href='/index.php/user/logout'>退出</a>
                <?php }?>
            </div>
        </div>
        <div class="bm_hd_main" id="menuTabcontent012_11" style="background:url(/img/bm_hd_bg1.jpg) no-repeat">
        	<div class="bm_hd_left" >
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/img/bm_hd_tp.png" border="0" usemap="#Map"  hidefocus="true"/>
                <map name="Map" id="Map" >
                <?php if (!empty($this->userinfo)){?>
        	    <area shape="poly" coords="78,98,56,98,40,71,22,37,23,22,58,16,104,19,125,22,130,31,129,42,96,96" href="javascript:void(0);" onclick="com_dialog('uploads');" onfocus="blur(this);"/>
                <?php }else {?>
        	    <area shape="poly" coords="78,98,56,98,40,71,22,37,23,22,58,16,104,19,125,22,130,31,129,42,96,96" href="javascript:void(0);" onclick="com_dialog('login');" onfocus="blur(this);"/>
                <?php }?>
               </map>
           </div>
        	
        	<div class="bm_hd_zj" style="left:0px;width:500px">
            </div>

            <div class="bm_hd_yc">
            	<div class="bm_hd_tu"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/bm_hd_tu.jpg" /></div>
            </div>
        </div>
        <div class="bm_hd_main" id="menuTabcontent012_10" style="background:url(/img/bm_hd_bg2.jpg) no-repeat; display:none;">
        	
        	<div class="bm_hd_left">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/img/bm_hd_tp.png" border="0" usemap="#Map" hidefocus="true"/>
                <map name="Map" id="Map">
                <?php if (!empty($this->userinfo)){?>
        	    <area shape="poly" coords="78,98,56,98,40,71,22,37,23,22,58,16,104,19,125,22,130,31,129,42,96,96" href="javascript:void(0);" onclick="com_dialog('uploads');"  onfocus="blur(this);"/>
                <?php }else {?>
        	    <area shape="poly" coords="78,98,56,98,40,71,22,37,23,22,58,16,104,19,125,22,130,31,129,42,96,96" href="javascript:void(0);" onclick="com_dialog('login');" onfocus="blur(this);"/>
                <?php }?>
               </map>
           </div>

            <div class="bm_hd_zj">
            </div>


            <div class="bm_hd_yc">
            	<div class="bm_hd_tu"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/bm_hd_tu2.jpg" /></div>
            </div>
        </div>
        
    </div>
    <!--活动细则-->
    <!--人车交互-->

    <!--作品展示-->
    <div class="bm_zpzs">
    	<div class="bm_zpzs_title">
        	<span>作品展示</span> <a name="top"></a>
            <a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/index/threemoer#works"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/bm_zpzs_more.jpg" /></a>
        </div>
          <div class="bm_zpzs_main">
        	<?php foreach($works as $key=>$val):?>
        	<div class="bm_zpzs_list" style="position: relative;">
            	<div class="bm_zpzs_tu" style="position: relative;background: url(/js/lazyload/grey.gif) no-repeat center center;"><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/index/more?&uuid=<?php echo $val['id'];?>,<?php echo $val['user_id'];?>,<?php echo $val['type'];?>,b#works"><img src="<?php echo $val['new_img_path']; ?>" width="228" height="366"/></a></div>
                <a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/index/more?&uuid=<?php echo $val['id'];?>,<?php echo $val['user_id'];?>,<?php echo $val['type'];?>,b#works"><div style="position: absolute;width: 228px;height: 366px;background: none;border: 3px solid #fff;top: 0px;margin: 1px;"></div></a>
                <div class="bm_zpzs_zi"><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/index/more?&uuid=<?php echo $val['id'];?>,<?php echo $val['user_id'];?>,<?php echo $val['type'];?>,b#works"><?php echo $val['name'];?></a></div>
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
           
        </div>
        <div class="bm_wzb_main">   

     <wb:topic topmid="z8ClGsZa8" column="n" border="n" title="BMW%20%E6%96%B03%E7%B3%BB%20%E8%BF%90%E5%8A%A8%E7%8E%8B%E8%80%85%20%E9%A2%86%E8%A1%94%E8%B5%B7%E8%B7%91" width="978" height="1165" tags="%E5%A4%A9%E7%94%9F%E8%BF%90%E5%8A%A8%E7%8E%8B%2C%E6%88%91%E7%9A%84%E7%A5%9E%E9%A9%AC%E7%85%A7%2C%E5%AE%9D%E9%A9%AC%E7%AC%91%E8%84%B8%E5%A2%99" language="zh_cn" version="base" footbar="y" url="http%3A%2F%2Fwww.bmw3-sport.com" filter="n" ></wb:topic>

        </div>
    </div>
    <!--X1-->
    <div class="bm_x1">
    	
        <div class="bm_hd_title3">
        	<ul>
                <div class="bm_jcts_left"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/bm_hd_ico4.gif" style="padding-left:10px;"/><span >精彩图赏</span></div>
                <div class="bm_jcts_you" style="margin-right:37px"><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/index/flow#flow"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/more.png" /></a></div>
            </ul>
        </div>
        <div class="bm_x1_main" id="menuTabcontent013_12">
        	<div id="featureContainer">
				<div id="feature">
		<div id="block">
			<div id="botton-scroll">
				<ul class="featureUL">
					<li class="featureBox">
					<div class="box">
						<a href="http://blu004150.chinaw3.com/ts/sctpx.html#flow" target="_blank">
						<img alt="Paracletos" src="/pic/IMG_01.jpg" width="265" height="176">
						</a></div>
                      <div class="banner">
						<a  href="http://blu004150.chinaw3.com/ts/sctpx.html#flow">赛前培训营 北京</a>
						</div>
					<!-- /box --></li>
					<li class="featureBox">
					<div class="box">
						<a href="http://blu004150.chinaw3.com/ts/sctpx2.html#flow" target="_blank">
						<img alt="Natural Touch Soap" src="/pic/IMG_02.jpg" width="265" height="176">
						</a></div>
                         <div class="banner">
						<a  href="http://blu004150.chinaw3.com/ts/sctpx2.html#flow">赛前培训营 上海</a>
						</div>
					<!-- /box --></li>
					<li class="featureBox">
					<div class="box">
						<a href="http://blu004150.chinaw3.com/ts/sctpx3.html#flow" target="_blank">
						<img alt="LRTK" src="/pic/IMG_03.jpg" width="265" height="176" >
						</a></div>
                        <div class="banner">
						<a  href="http://blu004150.chinaw3.com/ts/sctpx3.html#flow">沙桐</a>
						</div>
					<!-- /box --></li>
					<li class="featureBox">
					<div class="box">
						<a href="http://blu004150.chinaw3.com/ts/sctpx4.html#flow" target="_blank">
						<img alt="Natalie Reid" src="/pic/IMG_04.jpg" width="265" height="176">
						</a></div>
                        <div class="banner">
						<a  href="http://blu004150.chinaw3.com/ts/sctpx4.html#flow">于嘉</a>
						</div>
					<!-- /box --></li>
					<li class="featureBox">
					<div class="box">
						<a href="http://blu004150.chinaw3.com/ts/sctpx5.html#flow" target="_blank">
						<img alt="Natural Touch Soap" src="/pic/IMG_05.jpg" width="265" height="176">
						</a></div>
                        <div class="banner">
						<a  href="http://blu004150.chinaw3.com/ts/sctpx5.html#flow">328Li</a>
						</div>
					<!-- /box --></li>
					<li class="featureBox">
					<div class="box">
						<a href="http://blu004150.chinaw3.com/ts/sctpx6.html#flow" target="_blank">
						<img alt="Catherine Sherwood" src="/pic/IMG_06.jpg"  width="265" height="176">
						</a></div>
                        <div class="banner">
						<a  href="http://blu004150.chinaw3.com/ts/sctpx6.html#flow">宝马车主 Arthur Li</a>
						</div>
					<!-- /box --></li>
                    <li class="featureBox">
					<div class="box">
						<a href="http://blu004150.chinaw3.com/ts/sctpx7.html#flow" target="_blank">
						<img alt="Catherine Sherwood" src="/pic/IMG_07.jpg"  width="265" height="176">
						</a></div>
                        <div class="banner">
						<a  href="http://blu004150.chinaw3.com/ts/sctpx7.html#flow">宝马车主 Coco Yan</a>
						</div>
					<!-- /box --></li>
                    <li class="featureBox">
					<div class="box">
						<a href="http://blu004150.chinaw3.com/ts/sctpx8.html#flow" target="_blank">
						<img alt="Catherine Sherwood" src="/pic/IMG_08.jpg"  width="265" height="176">
						</a></div>
                        <div class="banner">
						<a  href="http://blu004150.chinaw3.com/ts/sctpx8.html#flow">宝马车主 Wennie Gao</a>
						</div>
					<!-- /box --></li>
  
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
<div class="bm_tp_tck mydiv"  id="popDiv5" style="display:none;">
        <div class="bm_tck_title">
        <span>提示</span>
        <a href="javascript:closeDiv5();">X</a></div>
        <div class="bm_tck_main2">
        <div class="bm_main_sm2">
        <img src="/img/bm_tck_pic.jpg" />
        <span>恭喜你，投票成功！<br />(分享微博，有更多礼品哦！)</span>
        </div>
        <div class="bm_main_an2">
        <input name="" type="button" class="bm_tck_an2" value="确 定" onclick="closeDiv5();"/>
        <wb:share-button count="n" type="button" size="big" style="float:left"></wb:share-button>
        </div>
        </div>
</div>
<span id="popmsg"></span>

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
//--><!]]></script>

</body>
</html>
