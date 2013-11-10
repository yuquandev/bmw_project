<script type="text/javascript">
	$(function(){
			$("#focus").hover(function(){$("#focus-prev,#focus-next").show();},function(){$("#focus-prev,#focus-next").hide();});
			$("#focus").slide({ 
				mainCell:"#focus-bar-box ul",
				targetCell:"#focus-title a",
				titCell:"#focus-num a",
				prevCell:"#focus-prev",
				nextCell:"#focus-next",
				effect:"left",
				easing:"easeInOutCirc",
				autoPlay:true,
				delayTime:200
			})
		})
</script>

<div class="bm_index">
	<?php $this->beginContent('//index/nav'); ?>
    <?php $this->endContent(); ?>
    <!--活动细则-->
    <div class="bm_hd">
    	<div class="bm_hd_title">
        	<ul>
        		<li><a href="javascript:;"  class="hymenuon" id=menuTabmenu012_12 onclick="setTimeout('Show_menuTab012(1,2)',200);"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/bm_hd_ico.jpg" /><span><?php if(isset($name_title[0])){ echo $name_title[0];}?></span></a></li>
            	<li><a href="javascript:;" class="hymenuoff" id=menuTabmenu012_11 onclick="setTimeout('Show_menuTab012(1,1)',200);"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/bm_hd_ico2.jpg" /><span><?php if(isset($name_title[1])){ echo $name_title[1];}?></span></a></li>
           		<li><a href="javascript:;" class="hymenuoff" id=menuTabmenu012_10 onclick="setTimeout('Show_menuTab012(1,0)',200);"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/bm_hd_ico3.gif" /><span><?php if(isset($name_title[2])){ echo $name_title[2];}?></span></a></li>
            </ul>
            <div class="bm_dl">
            	 <?php if (empty($this->userinfo)){?>
            	<a href="javascript:com_dialog('login')">登陆 | </a><a href="javascript:com_dialog('reg');">注册</a>
                <?php }else {
                    echo '<a href="/index.php/?uid='.$this->userinfo['uid'].'">'.$this->userinfo['username'].'</a> | <a href="/index.php/user/logout">退出</a>';
                }?>
            </div>
        </div>
        <div class="bm_hd_main bm_hd_main2" id="menuTabcontent012_12">
        	<div class="bm_hd_left">
        	<?php if (!empty($this->userinfo)){?>
        	<a href="javascript:void(0);" onclick="uplade_img(1);">
        	<?php }else {?>
        	<a href="javascript:com_dialog('login')">
        	<?php }?>
        	<img src="<?php echo Yii::app()->request->baseUrl; ?>/img/bm_hd_tp.png" /></a></div>
            <?php if(isset($description[0])){ echo $description[0];}?>
            <div class="bm_hd_yc">
            	<div class="bm_hd_tu2"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/bm_x1_sp.jpg" /></div>
            </div>
        </div>
        <div class="bm_hd_main bm_hd_main2" style="display:none" id="menuTabcontent012_11">
        	<div class="bm_hd_left">
        	<?php if (!empty($this->userinfo)){?>
        	<a href="javascript:void(0);" onclick="uplade_img(1);">
        	<?php }else {?>
        	<a href="javascript:com_dialog('login')">
        	<?php }?>
        	
        	<img src="<?php echo Yii::app()->request->baseUrl; ?>/img/bm_hd_tp.png" /></a></div>
            <?php if(isset($description[1])){ echo $description[1];}?>
            <div class="bm_hd_yc">
            	<div class="bm_hd_tu2"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/bm_x1_sp.jpg" /></div>
            </div>
        </div>
        <div class="bm_hd_main bm_hd_main2" id="menuTabcontent012_10" style="display:none">
        	<div class="bm_hd_left">
        	<?php if (!empty($this->userinfo)){?>
        	<a href="javascript:void(0);" onclick="uplade_img(1);">
        	<?php }else {?>
        	<a href="javascript:com_dialog('login')">
        	<?php }?>
        	
        	<img src="<?php echo Yii::app()->request->baseUrl; ?>/img/bm_hd_tp.png" /></a></div>
            <?php if(isset($description[2])){ echo $description[2];}?>
            <div class="bm_hd_yc">
            	<div class="bm_hd_tu">
                	<div class="bm_3x_st">
                        <div id="focus">
                            <div class="hd">
                            <div class="focus-title" id="focus-title">
                                
                                <?php foreach($video_title as $val):?>
                                <a><?php echo $val;?></a>
                                <?php endforeach;?>
                            </div>
                                </div>
                                <div class="focus-bar-box" id="focus-bar-box">
                                  <ul class="focus-bar">
                                   <?php foreach($video_url as $vdo):?>
                                    <li> <embed height="243" width="401" name="v_36628K" id="video_player_other" allowscriptaccess="always" pluginspage="http://get.adobe.com/cn/flashplayer/" flashvars="url_key=36628K" allowfullscreen="true" quality="hight" src="<?php if(isset($vdo)){ echo $vdo; }?>" type="application/x-shockwave-flash" wmode="Opaque"></li>
                                   <?php endforeach;?>
                                  </ul>
                                </div>
                              <div class="ft">
                                <div class="ftbg"></div>
                                <div id="focus-num" class="change">
                                   
                                    <a class=""></a>
                                    <a class=""></a>
                                    <a class=""></a>
                                   
                                </div>
                              </div>
                            </div>

                	</div>
                </div>
            </div>
        </div>
    </div>
    
    <!--作品展示-->
    <div class="bm_zpzs">
    	<div class="bm_zpzs_title">
        	<span>作品展示</span>
            <a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/one/onemoer"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/bm_zpzs_more.jpg" /></a>
        </div>
        <div class="bm_zpzs_main">
        	
            <?php foreach($works as $key=>$val):?>
        	<div class="bm_zpzs_list">
            	<div class="bm_zpzs_tu2"><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/one/more?&uuid=<?php echo $val['user_id'];?>,<?php echo $val['type'];?>"><img src="<?php echo $val['img_url']; ?>" width="228" height="128"/></a></div>
                <div class="bm_zpzs_zi"><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/one/more?&uuid=<?php echo $val['user_id'];?>,<?php echo $val['type'];?>"><?php echo $val['name'];?></a></div>
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
    <a name="top"></a>
    <div class="bm_wzb">
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
        		<li><a href="javascript:;"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/bm_hd_ico4.gif" /><span>X1</span></a></li>
            	<!--<li><a href="javascript:;" class="hymenuff" id=menuTabmenu013_11 onclick="setTimeout('Show_menuTab013(1,1)',200);"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/bm_hd_ico4.gif" /><span>3系</span></a></li>
           		<li><a href="javascript:;" class="hymenuff" id=menuTabmenu013_10 onclick="setTimeout('Show_menuTab013(1,0)',200);"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/bm_hd_ico4.gif" /><span>5系</span></a></li>-->
            </ul>
        </div>
        <div class="bm_x1_main">
      	    <div id="featureContainer">
				<div id="feature">
		<div id="block">
			<div id="botton-scroll2">
				<ul class="featureUL2">
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
		<!-- /block --><a class="prev2" href="javascript:void();">Previous</a><a class="next2" href="javascript:void();">Next</a>
	</div>
		    </div>
        	
        </div>
        
    </div>
    <!--底部-->
    <?php $this->beginContent('//layouts/footer'); ?>
    <?php $this->endContent(); ?>
</div>

<span id="uplode_img"></span>



<div id="bg" class="bg" style="display:none;"></div>
<iframe id='popIframe' class='popIframe' frameborder='0' ></iframe>
</body>
</html>
