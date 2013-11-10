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
			
        <?php if( !empty($one_img) ):?>    
			<p class="Hidden">
                <span class="SliderPicBorder2 FlRight"><img src="<?php echo $one_img['image_url']?>" /></span>
                 <span class="Clearer"></span>
				<span class="More"></span>
			</p>
		<?php endif;?>
		    
        <?php  foreach($all_img as $key=>$val):?>    
			<p class="Hidden">
                <span class="SliderPicBorder2 FlRight"><img src="<?php echo $val['image_url']?>" /></span>
                 <span class="Clearer"></span>
				<span class="More"></span>
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
		        <?php if( !empty($one_img) ):?> 	    
                   <li rel='1'><img src="<?php echo $one_img['image_url'];?>" /></li>
		        <?php endif;?>
		        <?php  foreach($all_img as $key=>$val):?> 
				<li rel='<?php if(!empty($one_img)){ echo $key + 2;}else{echo $key + 1;}?>'><img src="<?php echo $val['image_url'];?>" /></li>
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
    
    <!--底部-->
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
</body>
</html>