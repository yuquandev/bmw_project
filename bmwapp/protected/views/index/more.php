<script type="text/javascript">
function top_vote(wid,num)
{
	var url = '/index.php/api/vote';
	$.ajax({'url':url,'async':false,'data':{'wid':wid},'dataType':'json',
	'success':function(rs){
	    if(rs == 1){

            $('#vote_'+wid).html(parseInt(num) + 1);
            alert('投票成功');
            
    	}else if(rs == 2){
	    	alert('投票失败');
	    }else{
            alert('你已经投过该作品了');
	    }
	}
	});
}
</script>
<div class="bm_index">
	<?php $this->beginContent('//index/nav'); ?>
    <?php $this->endContent(); ?>
    <!--作品展示-->
    <div class="bm_cpzs">
    	<div class="bm_cpzs_title">
        	<div class="bm_cpzs_zi">作品展示</div>
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
                     <span><input  type="button" class="bm_tp" value="投票" onclick="top_vote(<?php echo $val['id']?>,<?php echo $val['vote_num']?>);"/></span>		
                     <span class="wb_fx">
                     <span class="bshare-custom">
                     <a title="分享到QQ空间" class="bshare-qzone"></a><a title="分享到新浪微博" class="bshare-sinaminiblog"></a><a title="分享到人人网" class="bshare-renren"></a><a title="分享到腾讯微博" class="bshare-qqmb"></a><a title="分享到网易微博" class="bshare-neteasemb"></a><a title="更多平台" class="bshare-more bshare-more-icon more-style-addthis"></a></span><script type="text/javascript" charset="utf-8" src="http://static.bshare.cn/b/buttonLite.js#style=-1&amp;uuid=&amp;pophcol=2&amp;lang=zh"></script><script type="text/javascript" charset="utf-8" src="http://static.bshare.cn/b/bshareC0.js"></script>
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
    
   <?php $this->beginContent('//layout/footer'); ?>
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

</body>
</html>
