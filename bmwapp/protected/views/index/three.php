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
                    <a href="/index.php/index/more?&uuid=<?php echo $this->userinfo['uid'];?>,2,center"><?php echo $this->userinfo['username'] ?></a> | <a href='/index.php/user/logout'>退出</a>
                <?php }?>
            </div>
        </div>
        <div class="bm_hd_main" id="menuTabcontent012_12">
<<<<<<< .mine
        	<div class="bm_hd_left">
        	<?php if (!empty($this->userinfo)){?>
        	<a href="javascript:void(0);" onclick="com_dialog('uploads');">
        	<?php }else {?>
        	<a href="javascript:com_dialog('login');">
        	<?php }?>
        	<img src="<?php echo Yii::app()->request->baseUrl; ?>/img/bm_hd_tp.png" /></a></div>
            <div class="bm_hd_zj">
            <h2>　　　　你的运动宣言有奖活动征集</h2><br />
            <span>　　　　　　参与活动即可获得宝马中国提供的BMW<br />　　　　　新3系精美车模、BMW U盘以及BMW精美<br />　　　　钥匙链等。</span><br /><br />
 			<p>　　　1.拍摄现场活动照片。</p><br />
            <p>　　2.使用美图秀秀的BMW3系专属模板进行拼　　　　　图并保存。</p><br />
            <p>3.上传至活动官网参与有奖活动。</p>
            </div>
=======
        	<div class="bm_hd_left"><a href="javascript:showDiv()"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/bm_hd_tp.png" /></a></div>
            <div class="bm_hd_zj">
            <h2>　　　　你的运动宣言有奖活动征集</h2><br />
            <span>　　　　　　参与活动即可获得宝马中国提供的BMW<br />　　　　　新3系精美车模、BMW U盘以及BMW精美<br />　　　　钥匙链等。</span><br /><br />
 			<p>　　　1.拍摄现场活动照片。</p><br />
            <p>　　2.使用美图秀秀的BMW3系专属模板进行拼　　　　　图并保存。</p><br />
            <p>3.上传至活动官网参与有奖活动。</p>
            </div>
>>>>>>> .r127
            <div class="bm_hd_yc">
            	<div class="bm_hd_tu"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/bm_hd_tu.jpg" /></div>
            </div>
        </div>
        <div class="bm_hd_main" style="display:none" id="menuTabcontent012_11">
        	<div class="bm_hd_left"><a href="javascript:showDiv()"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/bm_hd_tp.png" /></a></div>
            <div class="bm_hd_zj">
            <h2>　　　　活动时间：11月15-12月2日</h2><br />
 			<p>　　　　　　1.登陆美图秀秀，下载BMW专属海报模　　　　　　板，将生活中带有运动元素的图片进行拼图。</p><br />
            <p>　　　2.图片拼好后保存至手机，并上传至活动官<br />　　网参与活动。</p><br />
            <p>　3.用户浏览官方网站，对喜欢的图片进行<br />　投票。</p><br />
            <p>4.奖项评选将根据得票数量由高到低进行<br />评选。</p>
            </div>
            <div class="bm_hd_yc">
            	<div class="bm_hd_tu"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/bm_hd_tu.jpg" /></div>
            </div>
        </div>
        <div class="bm_hd_main" id="menuTabcontent012_10" style="display:none">
<<<<<<< .mine
        	<div class="bm_hd_left"><a href="javascript:showDiv()"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/bm_hd_tp.png" /></a></div>
            <div class="bm_hd_zj">
            <h2>　　　你的运动宣言有动征集33x</h2><br />
            <span>　　　　　BMW 3系的历史在这里一览无疑，由于脾<br />　　　　气火爆，性格直率，所以被人们常常亲切称为<br />　　　“三哥”。
</span><br /><br />
 			<p>　漂亮的甩尾，灵动的转弯，澎湃的动力，都刺<br />激着你的肾上腺素</p><br />
            <h2>　BMW 3系</h2><br />
            <h2>运动王者 领衔起跑</h2>
            </div>
              <div class="bm_hd_yc">
=======
        	<div class="bm_hd_left"><a href="javascript:showDiv()"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/bm_hd_tp.png" /></a></div>
            <div class="bm_hd_zj">
            <h2>　　　你的运动宣言有动征集33x</h2><br />
            <span>　　　　　BMW 3系的历史在这里一览无疑，由于脾<br />　　　　气火爆，性格直率，所以被人们常常亲切称为<br />　　　“三哥”。
</span><br /><br />
 			<p>　漂亮的甩尾，灵动的转弯，澎湃的动力，都刺<br />激着你的肾上腺素</p><br />
            <h2>　BMW 3系</h2><br />
            <h2>运动王者 领衔起跑</h2>
            </div>
            <div class="bm_hd_yc">
>>>>>>> .r127
            	<div class="bm_hd_tu">
                	<div class="bm_3x_st">
<<<<<<< .mine
=======
                        <div class="bm_3x_bt"><a href="#">运动王者 领衔起跑</a></div>
>>>>>>> .r127
                        <div class="bm_3x_sp">
<<<<<<< .mine
                            <div class="pilot">
                                <div class="pilotmain">
                                    <div class="pilotleft" onmousedown="ISL_GoUp()" onmouseup="ISL_StopUp()" onmouseout="ISL_StopUp()"></div>
                                    <div class="pilotpic" id="ISL_Cont">
                                        <div class="ScrCont">
                                            <div id="List1">
                                            <ul>
                                                <li><div class="wz_js"><a href="#">运动王者 领衔起跑</a></div><embed height="243" width="400" name="v_36628K" id="video_player_other" allowscriptaccess="always" pluginspage="http://get.adobe.com/cn/flashplayer/" flashvars="url_key=36628K" allowfullscreen="true" quality="hight" src="http://player.pps.tv/player/sid/36628KXUMQSM/v.swf" type="application/x-shockwave-flash" wmode="Opaque"></li>
                                                  <li><div class="wz_js"><a href="#">运动王者 领dffdf衔起跑</a></div><embed height="243" width="400" name="v_36628K" id="video_player_other" allowscriptaccess="always" pluginspage="http://get.adobe.com/cn/flashplayer/" flashvars="url_key=36628K" allowfullscreen="true" quality="hight" src="http://player.pps.tv/player/sid/36628KXUMQSM/v.swf" type="application/x-shockwave-flash" wmode="Opaque"></li>
                                                 <li><div class="wz_js"><a href="#">运动王者 领衔fddffd起跑</a></div><embed height="243" width="400" name="v_36628K" id="video_player_other" allowscriptaccess="always" pluginspage="http://get.adobe.com/cn/flashplayer/" flashvars="url_key=36628K" allowfullscreen="true" quality="hight" src="http://player.pps.tv/player/sid/36628KXUMQSM/v.swf" type="application/x-shockwave-flash" wmode="Opaque"></li>
							     					 <li><div class="wz_js"><a href="#">运动王者 领ffdfdd衔起跑</a></div><embed height="243" width="400" name="v_36628K" id="video_player_other" allowscriptaccess="always" pluginspage="http://get.adobe.com/cn/flashplayer/" flashvars="url_key=36628K" allowfullscreen="true" quality="hight" src="http://player.pps.tv/player/sid/36628KXUMQSM/v.swf" type="application/x-shockwave-flash" wmode="Opaque"></li>
							      						<li><div class="wz_js"><a href="#">运动王者 领衔ffdfd起跑</a></div><embed height="243" width="400" name="v_36628K" id="video_player_other" allowscriptaccess="always" pluginspage="http://get.adobe.com/cn/flashplayer/" flashvars="url_key=36628K" allowfullscreen="true" quality="hight" src="http://player.pps.tv/player/sid/36628KXUMQSM/v.swf" type="application/x-shockwave-flash" wmode="Opaque"></li>
                                                   <li><div class="wz_js"><a href="#">运动王sfsdf者 领衔起跑</a></div><embed height="243" width="400" name="v_36628K" id="video_player_other" allowscriptaccess="always" pluginspage="http://get.adobe.com/cn/flashplayer/" flashvars="url_key=36628K" allowfullscreen="true" quality="hight" src="http://player.pps.tv/player/sid/36628KXUMQSM/v.swf" type="application/x-shockwave-flash" wmode="Opaque"></li>
                                                 <li><div class="wz_js"><a href="#">运动王者 领衔起跑</a></div><embed height="243" width="400" name="v_36628K" id="video_player_other" allowscriptaccess="always" pluginspage="http://get.adobe.com/cn/flashplayer/" flashvars="url_key=36628K" allowfullscreen="true" quality="hight" src="http://player.pps.tv/player/sid/36628KXUMQSM/v.swf" type="application/x-shockwave-flash" wmode="Opaque"></li>
                                                <div class="clear"></div>
                                            </ul>
                                            </div>
                                      	    <div id="List2"></div>
                                        </div>
                                    </div>
                                    <div class="pilotright" onmousedown="ISL_GoDown()" onmouseup="ISL_StopDown()" onmouseout="ISL_StopDown()"></div>
                                </div>
                            </div>
                        	
=======
                            <div class="pilot">
                                <div class="pilotmain">
                                    <div class="pilotleft" onmousedown="ISL_GoUp()" onmouseup="ISL_StopUp()" onmouseout="ISL_StopUp()"></div>
                                    <div class="pilotpic" id="ISL_Cont">
                                        <div class="ScrCont">
                                            <div id="List1">
                                            <ul>
                                                  <li><embed height="243" width="400" name="v_36628K" id="video_player_other" allowscriptaccess="always" pluginspage="http://get.adobe.com/cn/flashplayer/" flashvars="url_key=36628K" allowfullscreen="true" quality="hight" src="http://player.pps.tv/player/sid/36628KXUMQSM/v.swf" type="application/x-shockwave-flash" wmode="Opaque"></li>
                                                  <li><embed height="243" width="400" name="v_36628K" id="video_player_other" allowscriptaccess="always" pluginspage="http://get.adobe.com/cn/flashplayer/" flashvars="url_key=36628K" allowfullscreen="true" quality="hight" src="http://player.pps.tv/player/sid/36628KXUMQSM/v.swf" type="application/x-shockwave-flash" wmode="Opaque"></li>
                                                  <li><embed height="243" width="400" name="v_36628K" id="video_player_other" allowscriptaccess="always" pluginspage="http://get.adobe.com/cn/flashplayer/" flashvars="url_key=36628K" allowfullscreen="true" quality="hight" src="http://player.pps.tv/player/sid/36628KXUMQSM/v.swf" type="application/x-shockwave-flash" wmode="Opaque"></li>
                                                  <li><embed height="243" width="400" name="v_36628K" id="video_player_other" allowscriptaccess="always" pluginspage="http://get.adobe.com/cn/flashplayer/" flashvars="url_key=36628K" allowfullscreen="true" quality="hight" src="http://player.pps.tv/player/sid/36628KXUMQSM/v.swf" type="application/x-shockwave-flash" wmode="Opaque"></li>
                                                  <li><embed height="243" width="400" name="v_36628K" id="video_player_other" allowscriptaccess="always" pluginspage="http://get.adobe.com/cn/flashplayer/" flashvars="url_key=36628K" allowfullscreen="true" quality="hight" src="http://player.pps.tv/player/sid/36628KXUMQSM/v.swf" type="application/x-shockwave-flash" wmode="Opaque"></li>
                                                   <li><embed height="243" width="400" name="v_36628K" id="video_player_other" allowscriptaccess="always" pluginspage="http://get.adobe.com/cn/flashplayer/" flashvars="url_key=36628K" allowfullscreen="true" quality="hight" src="http://player.pps.tv/player/sid/36628KXUMQSM/v.swf" type="application/x-shockwave-flash" wmode="Opaque"></li>
                                                 <li><embed height="243" width="400" name="v_36628K" id="video_player_other" allowscriptaccess="always" pluginspage="http://get.adobe.com/cn/flashplayer/" flashvars="url_key=36628K" allowfullscreen="true" quality="hight" src="http://player.pps.tv/player/sid/36628KXUMQSM/v.swf" type="application/x-shockwave-flash" wmode="Opaque"></li>
                                                <div class="clear"></div>
                                            </ul>
                                            </div>
                                      	    <div id="List2"></div>
                                        </div>
                                    </div>
                                    <div class="pilotright" onmousedown="ISL_GoDown()" onmouseup="ISL_StopDown()" onmouseout="ISL_StopDown()"></div>
                                </div>
                            </div>
                        	
>>>>>>> .r127
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
            	<div class="bm_zpzs_tu"><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/index/more?&uuid=<?php echo $val['user_id'];?>,<?php echo $val['type'];?>"><img src="<?php echo $val['img_url']; ?>" width="228" height="366"/></a></div>
                <div class="bm_zpzs_zi"><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/index/more?&uuid=<?php echo $val['user_id'];?>,<?php echo $val['type'];?>"><?php echo $val['name'];?></a></div>
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
    <a name="top"></a>
    	<div class="bm_zpzs_title">
        	<span>微直播</span>
        </div>
        <div class="bm_wzb_main">
      <wb:topic column="n" border="y" width="978" height="910" tags="mmw%2CM.M.W" color="333333%2Cffffff%2C0078b6%2Ccccccc%2C333333%2Cfafeff%2C0078b6%2Ccccccc%2C%2Ce9f4fb" language="zh_cn" version="base" refer="y" footbar="y" url="http%3A%2F%2Fbaidu.com" filter="n" ></wb:topic>
        </div>
    </div>
    <!--X1-->
    <div class="bm_x1">
    	<div class="bm_hd_title">
        	<ul  style="width:122px">
        		<li><a href="javascript:;"  id=menuTabmenu013_12 onclick="setTimeout('Show_menuTab013(1,2)',200);"><img src="images/bm_hd_ico4.gif" /><span>3系</span></a></li>
             </ul>
        </div>
        <div class="bm_x1_main" id="menuTabcontent013_12">
        	<div id="featureContainer">
				<div id="feature">
		<div id="block">
			<div id="botton-scroll">
				<ul class="featureUL">
					<?php foreach($image_list as $key=>$val):?>
					<li class="featureBox">
					<div class="box">
						<a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/index/footerlg?id=<?php echo $val['id']?>,<?php echo $val['type_id']?>" target="_blank">
						<img alt="Catherine Sherwood" src="<?php echo $val['image_url'];?>"  width="265" height="176">
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
    <?php $this->beginContent('//layout/footer'); ?>
    <?php $this->endContent(); ?>
</div>
<!--上传图片-->
<span id="uplode_img"></span>
<input type="hidden" id="ty_id" value="<?php echo $this->type;?>">
<!--登陆与注册-->
<div id="com_dialog"></div>
<!--投票成功-->
<span id="popmsg"></span>

<div id="bg" class="bg" style="display:none;"></div>
<iframe id='popIframe' class='popIframe' frameborder='0' ></iframe>
</body>
</html>

