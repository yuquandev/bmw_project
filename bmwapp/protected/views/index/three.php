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
            	<a href="javascript:showDiv3()">登陆 | </a><a href="javascript:showDiv2()">注册</a>
            </div>
        </div>
        <div class="bm_hd_main" id="menuTabcontent012_12">
        	<div class="bm_hd_left"><a href="javascript:showDiv()"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/bm_hd_tp.png" /></a></div>
            <div class="bm_hd_zj">
            <h2>　　　　你的运动宣言有奖活动征集3x</h2><br />
            <span>　　　　参与活动即可获得宝马中国提供的BMW<br />
   　　　精英驾驶培训课程、BMW精美车模、BMW<br />
　　 U盘以及BMW精美钥匙链等。</span><br /><br />
 			<p>　　1.拍摄现场活动照片</p><br />
            <p>　2.使用美图秀秀的BMW3系专属模板进行拼<br />图并保存</p><br />
            <p>3.上传至活动官网参与有奖活动</p>
            </div>
            <div class="bm_hd_yc">
            	<div class="bm_hd_tu"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/bm_hd_tu.jpg" /></div>
            </div>
        </div>
        <div class="bm_hd_main" style="display:none" id="menuTabcontent012_11">
        	<div class="bm_hd_left"><a href="javascript:showDiv()"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/bm_hd_tp.png" /></a></div>
            <div class="bm_hd_zj">
            <h2>　　　　你的运动宣活动征集23x</h2><br />
            <span>　　　　参与活动即可获得宝马中国提供的BMW<br />
   　　　精英驾驶培训课程、BMW精美车模、BMW<br />
　　 U盘以及BMW精美钥匙链等。</span><br /><br />
 			<p>　　1.拍摄现场活动照片</p><br />
            <p>　2.使用美图秀秀的BMW3系专属模板进行拼<br />图并保存</p><br />
            <p>3.上传至活动官网参与有奖活动</p>
            </div>
            <div class="bm_hd_yc">
            	<div class="bm_hd_tu"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/bm_hd_tu.jpg" /></div>
            </div>
        </div>
        <div class="bm_hd_main" id="menuTabcontent012_10" style="display:none">
        	<div class="bm_hd_left"><a href="javascript:showDiv()"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/bm_hd_tp.png" /></a></div>
            <div class="bm_hd_zj">
            <h2>　　　　你的运动宣言有动征集33x</h2><br />
            <span>　　　　　BMW 3系的历史在这里一览无疑，由于脾<br />　　　　气火爆，性格直率，所以被人们常常亲切称为<br />　　　“三哥”。
</span><br /><br />
 			<p>　漂亮的甩尾，灵动的转弯，澎湃的动力，都刺<br />激着你的肾上腺素</p><br />
            <h2>　BMW 3系</h2><br />
            <h2>运动王者 领衔起跑</h2>
            </div>
            <div class="bm_hd_yc">
            	<div class="bm_hd_tu">
                	<div class="bm_3x_st">
                        <div class="bm_3x_bt"><a href="#">运动王者 领衔起跑</a></div>
                        <div class="bm_3x_sp"> <embed height="243" width="401" name="v_36628K" id="video_player_other" allowscriptaccess="always" pluginspage="http://get.adobe.com/cn/flashplayer/" flashvars="url_key=36628K" allowfullscreen="true" quality="hight" src="http://player.pps.tv/player/sid/36628KXUMQSM/v.swf" type="application/x-shockwave-flash" wmode="Opaque"></div>
                	</div>
                </div>
            </div>
        </div>
    </div>
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
        		<li><a href="javascript:;"  id=menuTabmenu013_12 onclick="setTimeout('Show_menuTab013(1,2)',200);"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/bm_hd_ico4.gif" /><span>3系</span></a></li>
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
						<a href="#" target="_blank">
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

<!--注册账号-->

<!--登陆与注册-->



<div id="bg" class="bg" style="display:none;"></div>
<iframe id='popIframe' class='popIframe' frameborder='0' ></iframe>
</body>
</html>
