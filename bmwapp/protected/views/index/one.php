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
        		<li><a href="javascript:;"  class="hymenuon" id=menuTabmenu012_12 onclick="setTimeout('Show_menuTab012(1,2)',200);"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/bm_hd_ico.jpg" /><span>活动介绍</span></a></li>
            	<li><a href="javascript:;" class="hymenuoff" id=menuTabmenu012_11 onclick="setTimeout('Show_menuTab012(1,1)',200);"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/bm_hd_ico2.jpg" /><span>活动规则</span></a></li>
           		<li><a href="javascript:;" class="hymenuoff" id=menuTabmenu012_10 onclick="setTimeout('Show_menuTab012(1,0)',200);"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/bm_hd_ico3.gif" /><span>视频</span></a></li>
            </ul>
            <div class="bm_dl">
            	<a href="javascript:showDiv3()">登陆 | </a><a href="javascript:showDiv2()">注册</a>
            </div>
        </div>
        <div class="bm_hd_main bm_hd_main2" id="menuTabcontent012_12">
        	<div class="bm_hd_left"><a href="javascript:showDiv()"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/bm_hd_tp.png" /></a></div>
            <div class="bm_hd_zj">
            <h2></h2><br />
            <span>　　　　　 从X1的视角解读随访内容，剪辑病毒视频，<br />
       　　　　 将每个城市不同的自由态度呈现出来。视频将<br />
    　　　 通过积极的、正能量的基调来关联X1以及X1车<br />
　　　主的自由理念以及对城市、对生活的热爱。<br />
　　 通过积极的、正能量的基调来关联X1以及X1车<br />
　　　主的自由理念以及对城市、对生活的热爱。<br /><br /><br /><br /><br /><br />
			<h2>FREEDOM IN CITIES</h2>
            </div>
            <div class="bm_hd_yc">
            	<div class="bm_hd_tu2"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/bm_x1_sp.jpg" /></div>
            </div>
        </div>
        <div class="bm_hd_main bm_hd_main2" style="display:none" id="menuTabcontent012_11">
        	<div class="bm_hd_left"><a href="javascript:showDiv()"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/bm_hd_tp.png" /></a></div>
            <div class="bm_hd_zj">
            <h2></h2><br />
               <span>　　　　　 从X1的视角解读随访内容，剪辑病毒视频，<br />
       　　　　 将每个城市不同的自由态度呈现出来。视频将<br />
    　　　 通过积极的、正能量的基调来关联X1以及X1车<br />
　　　主的自由理念以及对城市、对生活的热爱。<br /><br /><br /><br /><br /><br />
			<h2>FREEDOM IN CITIES</h2>
            </div>
            <div class="bm_hd_yc">
            	<div class="bm_hd_tu2"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/bm_x1_sp.jpg" /></div>
            </div>
        </div>
        <div class="bm_hd_main bm_hd_main2" id="menuTabcontent012_10" style="display:none">
        	<div class="bm_hd_left"><a href="javascript:showDiv()"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/bm_hd_tp.png" /></a></div>
            <div class="bm_hd_zj">
            <h2></h2><br />
            <span>　　　　　 从X1的视角解读随访内容，剪辑病毒视频，<br />
       　　　　 将每个城市不同的自由态度呈现出来。视频将<br />
    　　　 通过积极的、正能量的基调来关联X1以及X1车<br />
　　　主的自由理念以及对城市、对生活的热爱。<br /><br /><br /><br /><br /><br />
			<h2>FREEDOM IN CITIES</h2>
            </div>
            <div class="bm_hd_yc">
            	<div class="bm_hd_tu">
                	<div class="bm_3x_st">
                        <div id="focus">
                            <div class="hd">
                            <div class="focus-title" id="focus-title">
                                <a href="#">Movement of Kings</a>
                                <a href="#">the launching</a>
                                <a href="#">Movement of Kings</a>
                            </div>
                                </div>
                                <div class="focus-bar-box" id="focus-bar-box">
                                  <ul class="focus-bar">
                                    <li><a href="#"> <embed height="243" width="401" name="v_36628K" id="video_player_other" allowscriptaccess="always" pluginspage="http://get.adobe.com/cn/flashplayer/" flashvars="url_key=36628K" allowfullscreen="true" quality="hight" src="http://player.pps.tv/player/sid/36628KXUMQSM/v.swf" type="application/x-shockwave-flash" wmode="Opaque"></a></li>
                                    <li><a href="#"> <embed height="243" width="401" name="v_36628K" id="video_player_other" allowscriptaccess="always" pluginspage="http://get.adobe.com/cn/flashplayer/" flashvars="url_key=36628K" allowfullscreen="true" quality="hight" src="http://player.pps.tv/player/sid/36628KXUMQSM/v.swf" type="application/x-shockwave-flash" wmode="Opaque"></a></li>
                                    <li><a href="#"> <embed height="243" width="401" name="v_36628K" id="video_player_other" allowscriptaccess="always" pluginspage="http://get.adobe.com/cn/flashplayer/" flashvars="url_key=36628K" allowfullscreen="true" quality="hight" src="http://player.pps.tv/player/sid/36628KXUMQSM/v.swf" type="application/x-shockwave-flash" wmode="Opaque"></a></li>
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
					<li class="featureBox">
					<div class="box2">
						<a href="sctpx11.html" target="_blank">
						<img alt="Paracletos" src="<?php echo Yii::app()->request->baseUrl; ?>/img/bm_x1_pic2.jpg" width="265" height="176">
						</a></div>
					<!-- /box --></li>
					<li class="featureBox">
					<div class="box">
						<a href="sctpx11.html" target="_blank">
						<img alt="Natural Touch Soap" src="<?php echo Yii::app()->request->baseUrl; ?>/img/bm_x1_pic2.jpg"  width="265" height="176">
						</a></div>
					<!-- /box --></li>
					<li class="featureBox">
					<div class="box2">
						<a href="#" target="_blank">
						<img alt="LRTK" src="<?php echo Yii::app()->request->baseUrl; ?>/img/bm_x1_pic.jpg" width="265" height="176">
						</a></div>
					<!-- /box --></li>
					<li class="featureBox">
					<div class="box2">
						<a href="#" target="_blank">
						<img alt="Natalie Reid" src="<?php echo Yii::app()->request->baseUrl; ?>/img/bm_x1_pic.jpg" width="265" height="176">
						</a></div>
					<!-- /box --></li>
					<li class="featureBox">
					<div class="box2">
						<a href="#" target="_blank">
						<img alt="酷站代码" src="<?php echo Yii::app()->request->baseUrl; ?>/img/bm_x1_pic2.jpg" width="265" height="176">
						</a></div>
					<!-- /box --></li>
					<li class="featureBox">
					<div class="box2">
						<a href="#" target="_blank">
						<img alt="Catherine Sherwood" src="<?php echo Yii::app()->request->baseUrl; ?>/img/bm_x1_pic.jpg"  width="265" height="176">
						</a></div>
					<!-- /box --></li>
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





<div id="bg" class="bg" style="display:none;"></div>
<iframe id='popIframe' class='popIframe' frameborder='0' ></iframe>
</body>
</html>
