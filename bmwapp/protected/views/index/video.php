<?php $this->beginContent('//index/header'); ?>
        	  <div class="bm_dl"  style="padding-top:0">
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

</body>

</html>
