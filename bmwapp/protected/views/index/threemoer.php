<?php $this->beginContent('//index/header'); ?>

<?php $this->endContent(); ?>
<div class="bm_index">
    <?php $this->beginContent('//index/nav'); ?>
    <?php $this->endContent(); ?>
    <!--作品展示-->
    <div class="bm_zpzs">
    	<div class="bm_zpzs_title">
        	<span style="float:left">作品展示</span>
        	
        </div>
       
        <div class="bm_zpzs_main">
        	 <a name="works"></a>
        	<?php foreach($works as $key=>$val):?>
        	<div class="bm_zpzs_list" style="position: relative;">
            	<div class="bm_zpzs_tu" style="position: relative;background: url(/js/lazyload/grey.gif) no-repeat center center;"><a style="position: absolute;width:366px;"><img src="<?php echo $val['img_url']; ?>" width="" height="366"/></a></div>
                <a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/index/more?&uuid=<?php echo $val['id'];?>,<?php echo $val['user_id'];?>,<?php echo $val['type'];?>,b#works"><div style="
    position: absolute;
    width: 228px;
    height: 366px;
    background: none;
    border: 3px solid #fff;
    top: 0px;
    margin: 1px;
"></div></a>
                <div class="bm_zpzs_zi"><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/index/more?&uuid=<?php echo $val['id'];?>,<?php echo $val['user_id'];?>,<?php echo $val['type'];?>,b"><?php echo $val['name'];?></a></div>
                <div class="bm_zpzs_zan">
                	<input onclick="top_vote(<?php echo $val['id']?>,<?php echo $val['vote_num']?>);" type="button" class="bm_tp_an" value="投票"/>
                    <span  id="vote_<?php echo $val['id']?>"><?php echo $val['vote_num']?></span>
                </div>
            </div>
            <?php endforeach;?>  
        </div>
       <?php echo $page;?>
       <div class="clear"></div>
    </div>
    <div class="clear"></div>
     <?php $this->beginContent('//index/footer'); ?>
    <?php $this->endContent(); ?>
   
</div>

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

		$("html").scrollTop("550");
		$("body").scrollTop("550");
    })();
</script>
<!--上传图片-->
<span id="uplode_img"></span>
<input type="hidden" id="ty_id" value="<?php echo $this->type;?>">
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
<!--注册账号-->
<span id="popmsg"></span>
<span id="popmsg2"></span>
<!--登陆与注册-->
<div id="com_dialog"></div>
<div id="bg" class="bg" style="display:none;"></div>
<iframe id='popIframe' class='popIframe' frameborder='0' ></iframe>
</body>
</html>
