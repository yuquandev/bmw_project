<div class="bm_index">
	<?php $this->beginContent('//index/nav'); ?>
    <?php $this->endContent(); ?>
    <!--作品展示-->
    <div class="bm_cpzs">
    	<div class="bm_cpzs_title">
        	<div class="bm_cpzs_zi"><?php if($center =='center'){?>我上传的作品<?php }else{ ?>作品展示<?php }?></div>
        	
        </div> 
             <div class="bm_cpzs_main">
            		<!--作品展示-->
                    	<div class="MainBg">
	<div class="OriginalPicBorder">
		<div id="OriginalPic">
			<div id="aPrev" class="CursorL"></div>
			<div id="aNext" class="CursorR"></div>
			<?php foreach($works_user_list as $key=>$val):?>
			<p class="Hidden">
				<span class="Summary FlLeft">
                	<span class="bm_nr">
                    <span class="bm_wz2">
                    <strong><?php echo $val['name'];?></strong><br />作者：<?php echo $val['username'];?><br />票数：<span  id="vote_<?php echo $val['id']?>"><?php echo $val['vote_num']?></span><br /><?php echo $val['description'];?>
                    </span>
                    <span>
                    <?php  if($center =='center'){?>
                       <span style="color:red">状态：<?php if($val['review'] == 0 ){echo '审核通过'; }else{ echo '审核未通过';}?></span>
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
            <span class="wb_fx">
                <!-- Baidu Button BEGIN -->
				<div id="bdshare" class="bdshare_t bds_tools get-codes-bdshare">
				<span class="bds_more">分享到：</span>
				<a class="bds_qzone"></a>
				<a class="bds_tsina"></a>
				<a class="bds_tqq"></a>
				<a class="bds_renren"></a>
				<a class="bds_t163"></a>
				<a class="shareCount"></a>
				</div>
				<script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=1285861" ></script>
				<script type="text/javascript" id="bdshell_js"></script>
				<script type="text/javascript">
				document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000)
				</script>
				<!-- Baidu Button END -->
			</span>
        </div>
	</div>
	
	<div class="SpaceLine"></div>
	
	<div class="HS15"></div>
	

	<div class="ThumbPicBorder">
		<img src="<?php echo Yii::app()->request->baseUrl; ?>/img/ArrowL.jpg" id="btnPrev" class="FlLeft" style="cursor:pointer;" />
		<div class="jCarouselLite FlLeft">
			<ul id="ThumbPic">
				<?php foreach($works_user_list as $key=>$val):?>
				<li rel='<?php echo $key+1;?>'><img src="<?php echo $val['img_url'];?>" /></li>
				<?php endforeach;?>
			</ul>
			<div class="Clearer"></div>
		</div>
		<img src="<?php echo Yii::app()->request->baseUrl; ?>/img/ArrowR.jpg" id="btnNext" class="FlLeft" style="cursor:pointer;" />
		<div class="Clearer"></div>
	</div>

	<div class="HS15"></div>
	
</div>
                    <!--作品展示-->
            </div>
    </div>
    
   <?php $this->beginContent('//index/footer'); ?>
      <?php $this->endContent(); ?>
</div>
<script type="text/javascript">
//缩略图滚动事件
$(".jCarouselLite").jCarouselLite({
	btnNext: "#btnNext",
	btnPrev: "#btnPrev",
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
<span id="popmsg"></span>
</body>
</html>
