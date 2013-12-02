<?php $this->beginContent('//index/header'); ?>
<?php $this->endContent(); ?>
<div class="bm_index">
	<?php $this->beginContent('//index/nav'); ?>
    <?php $this->endContent(); ?>
    <!--作品展示-->
    <div class="bm_cpzs">
    	<div class="bm_cpzs_title">
        	<div class="bm_cpzs_zi"><span style="float:left"><?php if($center =='center'){?>我上传的作品<?php }else{ ?>作品展示<?php }?></div></span>
        	  <div class="bm_dl"  style="padding-top:0">
            	 <?php if (empty($this->userinfo)){?>
            	    <a href="javascript:com_dialog('login');">登陆 | </a><a href="javascript:com_dialog('reg');">注册</a>
                <?php }else { ?>
                    欢迎您，<?php echo $this->userinfo['username'] ?>&nbsp;<a href="/index.php/index/more?uuid=-1,<?php echo $this->userinfo['uid'];?>,2,center"><span style="color:red;">查看作品</span></a> | <a href='/index.php/user/logout'>退出</a>
                <?php }?>
            </div>
        </div> 
             <div class="bm_cpzs_main">
            		<!--作品展示-->
   <div class="MainBg">
	<div class="OriginalPicBorder">
		<div id="OriginalPic"><a name="works"></a>
			<div id="aPrev" class="CursorL"></div>
			<div id="aNext" class="CursorR"></div>
            <?php if( empty($works_user_list) ){?>
                <div class="HS15">
                <strong style="color:red;">
                       	您还没有上传作品,您可以现在 :<a href="javascript:void(0);" onclick="com_dialog('uploads');" style="color:blue;"/>上传作品</a> 
                       	                      
                       	                      
                </strong>
                </div>
            <?php }else{?>
			<?php foreach($works_user_list as $key=>$val):?>
            <p class="Hidden">
              <span class="Summary FlLeft">
                <span class="bm_nr">
                  <span class="bm_wz2">
					<strong><?php echo $val['name'];?></strong><br />作者：<?php echo $val['username'];?><br /><strong style="color:red;">票数:<span  id="vote_<?php echo $val['id']?>"><?php echo $val['vote_num']?></span></strong><br /><strong style="font-size:14px">运动宣言：</strong><br /><?php echo $val['description'];?> 
					</span>

					<span>
					<?php  if($center =='center'){?>
                     <span style="color:red">状态：<?php if($val['review'] == 0 ){echo '审核通过'; }else{ echo '正在审核中';}?></span>
                    <?php }else{?>
						<input  type="button" class="bm_tp" value="投票" onclick="top_vote(<?php echo $val['id']?>,<?php echo $val['vote_num']?>);"/>
     				<?php }?>
					</span>		
				</span>
				</span>
				<span class="SliderPicBorder FlRight"><img src="<?php echo $val['img_url'];?>" /></span>
				<span class="Clearer"></span>
				<span class="More">
				</span>
				</p>
			<?php endforeach;?>
           
            
            
        </div>
        	 <!-- JiaThis Button BEGIN -->
<div class="jiathis_style_24x24" style="width:100%;overflow:hidden; height:28px;"> 
	<a class="jiathis_button_weixin"></a>
	<a class="jiathis_button_tsina"></a>
	<a class="jiathis_button_tqq"></a>
</div>
<script type="text/javascript" src="http://v3.jiathis.com/code_mini/jia.js" charset="utf-8"></script>
<!-- JiaThis Button END -->
	</div>

	<div class="SpaceLine"></div>
	
	<div class="HS15"></div>
	

	<div class="ThumbPicBorder">
	    <a name="footerimg"></a>
		<img src="<?php echo Yii::app()->request->baseUrl; ?>/img/ArrowL.jpg" id="btnNext" class="FlLeft" style="cursor:pointer;padding-top:40px;" />
		<div class="jCarouselLite FlLeft">
			<ul id="ThumbPic">
				<?php foreach($works_user_list as $key=>$val):?>
				<li rel='<?php echo $key+1?>' style="height:150px;"><img src="<?php echo $val['img_url'];?>#footer" /></li>
				<?php endforeach;?>
			</ul>
			<div class="Clearer"></div>
		</div>
		<img src="<?php echo Yii::app()->request->baseUrl; ?>/img/ArrowR.jpg" id="btnPrev" class="FlLeft" style="cursor:pointer; padding-top:40px;" />
		<div class="Clearer"></div>
	</div>
 <?php }?>
    <a name="footer"></a>
	<div class="HS15"></div>
	
</div>
                    <!--作品展示-->
           
    </div>
    
   <?php $this->beginContent('//index/footer'); ?>
      <?php $this->endContent(); ?>
</div>
<script type="text/javascript">
//缩略图滚动事件
$(".jCarouselLite").jCarouselLite({
	btnNext: "#btnNext .footerimg",
	btnPrev: "#btnPrev .footerimg",
	scroll: 1,
	speed: 114,
	circular: false,
	visible: 7
});
</script>

<script type="text/javascript">
var currentImage;
var currentIndex = -1;

//显示大图(参数index从0开始计数)
function showImage(index){

	//更新当前图片页码
	$(".CounterCurrent").html(index + 1);

	//隐藏或显示向左向右鼠标手势
	var len = $('#OriginalPic img').length;
	if(index == len - 1){
		$("#aNext").hide();
	}else{
		$("#aNext").show();
	}

	if(index == 0){
		$("#aPrev").hide();
	}else{
		$("#aPrev").show();
	}

	//显示大图            
	if(index < $('#OriginalPic img').length){
		var indexImage = $('#OriginalPic p')[index];

		//隐藏当前的图
		if(currentImage){
			if(currentImage != indexImage){
				$(currentImage).css('z-index', 2);	
				$(currentImage).fadeOut(0,function(){
					$(this).css({'display':'none','z-index':1})
				});
			}
		}

		//显示用户选择的图
		$(indexImage).show().css({'opacity': 0.4});
		$(indexImage).animate({opacity:1},{duration:200});

		//更新变量
		currentImage = indexImage;
		currentIndex = index;

		//移除并添加高亮
		$('#ThumbPic img').removeClass('active');
		$($('#ThumbPic img')[index]).addClass('active');

		//设置向左向右鼠标手势区域的高度                        
		//var tempHeight = $($('#OriginalPic img')[index]).height();
		//$('#aPrev').height(tempHeight);
		//$('#aNext').height(tempHeight);
           $("html").scrollTop("2000");
		$("body").scrollTop("2000");

	}
}

//下一张
function ShowNext(){
	var len = $('#OriginalPic img').length;
	var next = currentIndex < (len - 1) ? currentIndex + 1 : 0;
	showImage(next);
}

//上一张
function ShowPrep(){
	var len = $('#OriginalPic img').length;
	var next = currentIndex == 0 ? (len - 1) : currentIndex - 1;
	showImage(next);
}

//下一张事件
$("#aNext").click(function(){
	ShowNext();
	if($(".active").position().left >= 144 * 5){
		$("#btnNext").click();
	}
});

//上一张事件
$("#aPrev").click(function(){
	ShowPrep();
	if($(".active").position().left <= 144 * 5){
		$("#btnPrev").click();
	}
});

//初始化事件
$(".OriginalPicBorder").ready(function(){
	ShowNext();

	//绑定缩略图点击事件
	$('#ThumbPic li').bind('click',function(e){
		var count = $(this).attr('rel');
		showImage(parseInt(count) - 1);
	});
});
</script>
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
<span id="uplode_img"></span>

<!--注册账号-->
<div id="com_dialog"></div>
<!--登陆与注册-->
<!--投票成功-->
<span id="popmsg"></span>
<span id="popmsg2"></span>
<div id="com_dialog"></div>
<!--登陆与注册-->
<!--投票成功-->
<div id="bg" class="bg" style="display:none;"></div>
<iframe id='popIframe' class='popIframe' frameborder='0' ></iframe>
</body>
</html>
