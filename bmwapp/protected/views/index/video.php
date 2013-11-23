<?php $this->beginContent('//index/header'); ?>
<?php $this->endContent(); ?>
<style>
.bmw_a_loading { display: block; background:url(/js/lazyload/grey.gif) no-repeat center center; }
</style>
</head>
<body>
<div class="bm_index">
	<?php $this->beginContent('//index/nav'); ?>
    <?php $this->endContent(); ?>
    <div class="bm_cpzs">
<div class="bm_cpzs_title">
        	<div class="bm_cpzs_zi">
        	<span style="float:left">精彩视频</span></div>
        	  <div class="bm_dl"  style="padding-top:0">
              <?php if (empty($this->userinfo)){?>
            	    <a href="javascript:com_dialog('login');">登陆 | </a><a href="javascript:com_dialog('reg');">注册</a>
                <?php }else { ?>
                    欢迎您，<?php echo $this->userinfo['username'] ?>&nbsp;<a href="/index.php/index/more?uuid=-1,<?php echo $this->userinfo['uid'];?>,2,center"><span style="color:red;">查看作品</span></a> | <a href='/index.php/user/logout'>退出</a>
                <?php }?>
            </div>
        </div>
<div class="bm_spss_main">
            		<!--作品展示-->
                    <h1><?php echo $get_one_video_info['name'];?></h1>
                    <div class="bm_spss_main">
                    	<embed src="<?php echo $get_one_video_info['video_url'];?>" allowFullScreen="true" quality="high" width="980" height="530" align="middle" allowScriptAccess="always" type="application/x-shockwave-flash"></embed>
                    </div>
                    <div class="bm_spss_wz">
                    <?php echo $get_one_video_info['description'];?>
                    </div>
                    <!--作品展示-->
            </div>
        <div class="clear"></div>
        
      </div>
    </div>
    <!--底部-->
 <?php $this->beginContent('//index/footer'); ?>
    <?php $this->endContent(); ?>
</div>
<span id="uplode_img"></span>
<input type="hidden" id="ty_id" value="2">
<!--注册账号-->
<div id="com_dialog"></div>
<!--登陆与注册-->
<!--投票成功-->
<span id="popmsg"></span>
<span id="popmsg2"></span>
<div id="bg" class="bg" style="display:none;"></div>
<iframe id='popIframe' class='popIframe' frameborder='0' ></iframe>


</body>

</html>

