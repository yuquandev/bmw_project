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
	<div class="bm_top">
    	<div class="bm_top_logo">
        	<ul>
            	<li><a href="#"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/logo1.jpg" /></a></li>
                <li><a href="#"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/logo2.jpg" /></a></li>
            </ul>
        </div>
        <!--导航-->
        <div class="bm_top_nav">
        	<div class="bm_nav_main">
            	<ul>
            	<a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php"><strong>X1</strong></a>
                <a href="#">微直播</a>
                <a href="#">3系</a>
                <a href="#">5系</a>
                <a href="#">上传图片</a>
                </ul>
            </div>
        </div>
        <!--导航结束-->
    </div>
    <!--活动细则-->
    <div class="bm_hd">
    	<div class="bm_hd_title">
        	<ul>
        		<li><a href="javascript:;"  class="hymenuon" id=menuTabmenu012_12 onclick="setTimeout('Show_menuTab012(1,2)',200);"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/bm_hd_ico.jpg" /><span>活动介绍</span></a></li>
            	<li><a href="javascript:;" class="hymenuoff" id=menuTabmenu012_11 onclick="setTimeout('Show_menuTab012(1,1)',200);"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/bm_hd_ico2.jpg" /><span>活动规则</span></a></li>
           		<li><a href="javascript:;" class="hymenuoff" id=menuTabmenu012_10 onclick="setTimeout('Show_menuTab012(1,0)',200);"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/bm_hd_ico3.gif" /><span>视频</span></a></li>
            </ul>
            <div class="bm_dl">
            	<a href="#">登陆 | </a><a href="#">注册</a>
            </div>
        </div>
        <div class="bm_hd_main" id="menuTabcontent012_12">
        	<div class="bm_hd_left"><a href="javascript;"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/bm_hd_tp.png" /></a></div>
            <div class="bm_hd_zj"><?php echo $contentdis['description'];?></div>
            <div class="bm_hd_yc"></div>
        </div>
        <div class="bm_hd_main" style="display:none" id="menuTabcontent012_11">
        	<div class="bm_hd_left"><a href="javascript;"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/bm_hd_tp.png" /></a></div>
            <div class="bm_hd_zj">2013年，BMW X之旅再度更多放大放大噶重磅起航，纵行北欧，</div>
            <div class="bm_hd_yc"></div>
        </div>
        <div class="bm_hd_main" id="menuTabcontent012_10" style="display:none">
        	<div class="bm_hd_left"><a href="javascript;"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/bm_hd_tp.png" /></a></div>
            <div class="bm_hd_zj">2013年，BMW X之旅再度更多放大放大噶重磅起航，纵行北欧，</div>
            <div class="bm_hd_yc"></div>
        </div>
    </div>
    <!--作品展示-->
    <div class="bm_zpzs">
    	<div class="bm_zpzs_title">
        	<span>作品展示</span>
            <a href="#"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/bm_zpzs_more.jpg" /></a>
        </div>
        <div class="bm_zpzs_main">
        	<?php foreach($works as $key=>$val):?>
        	<div class="bm_zpzs_list">
            	<div class="bm_zpzs_tu"><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/index/more?wid=<?php echo $val['id'];?>"><img width="235" height="135" src="<?php echo Yii::app()->request->baseUrl; ?><?php echo $val['img_url']?>" /></a></div>
                <div class="bm_zpzs_zi"><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/index/more?wid=<?php echo $val['id'];?>"><?php echo $val['name']?>(<span  id="vote_<?php echo $val['id']?>"><?php echo $val['vote_num']?></span>)</a></div>
                <div class="bm_zpzs_zan"><a href="javascript:void(0);" onclick="top_vote(<?php echo $val['id']?>,<?php echo $val['vote_num']?>);"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/bm_zpzs_z.jpg" /></a></div>
            </div>
            <?php endforeach;?>
        </div>
    </div>
    <div class="clear"></div>
    <!--微直播-->
    <div class="bm_wzb">
    	<div class="bm_zpzs_title">
        	<span>微直播</span>
            <a href="#"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/bm_zpzs_more.jpg" /></a>
        </div>
        <div class="bm_wzb_main">
      <!-- <wb:topic column="n" border="y" width="978" height="910" tags="mmw%2CM.M.W" color="333333%2Cffffff%2C0078b6%2Ccccccc%2C333333%2Cfafeff%2C0078b6%2Ccccccc%2C%2Ce9f4fb" language="zh_cn" version="base" refer="y" footbar="y" url="http%3A%2F%2Fbaidu.com" filter="n" ></wb:topic> -->
        </div>
    </div>
    <!--X1-->
    <div class="bm_x1">
    	<div class="bm_hd_title">
        	<ul>
        		<li><a href="javascript:;" class="hymenuon" id=menuTabmenu013_12 onclick="setTimeout('Show_menuTab013(1,2)',200);"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/bm_hd_ico.jpg" /><span>X1</span></a></li>
            	<li><a href="javascript:;" class="hymenuff" id=menuTabmenu013_11 onclick="setTimeout('Show_menuTab013(1,1)',200);"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/bm_hd_ico2.jpg" /><span>3系</span></a></li>
           		<li><a href="javascript:;" class="hymenuff" id=menuTabmenu013_10 onclick="setTimeout('Show_menuTab013(1,0)',200);"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/bm_hd_ico3.gif" /><span>5系</span></a></li>
            </ul>
        </div>
        <div class="bm_x1_main" id="menuTabcontent013_12">
        <div id="featureContainer">
		<div id="feature">
		<div id="block">
			<div id="botton-scroll">
				<ul class="featureUL">
					<?php foreach($bmw_x1 as $key=>$val):?>
					<li class="featureBox">
					<div class="box">
						<a  target="_blank">
						<img alt="Paracletos" src="<?php echo $val['image_url'];?>" width="265" height="176" alt="<?php echo $val['name'];?>">
						</a></div>
					<!-- /box -->
					</li>
					<?php endforeach;?>
					
				</ul>
			</div>
			<!-- /botton-scroll -->
		</div>
		<!-- /block --><a class="prev" href="javascript:void();">Previous</a><a class="next" href="javascript:void();">Next</a>
	</div>
	</div>
        </div>
        <div class="bm_x1_main" id="menuTabcontent013_11" style="display:none">
        	<div id="featureContainer">
				<div id="feature">
		<div id="block">
			<div id="botton-scroll">
				<ul class="featureUL">
					<?php foreach($bmw_x3 as $key=>$val):?>
					<li class="featureBox">
					<div class="box">
						<a  target="_blank">
						<img alt="Paracletos" src="<?php echo $val['image_url'];?>" width="265" height="176" alt="<?php echo $val['name'];?>">
						</a></div>
					<!-- /box -->
					</li>
					<?php endforeach;?>
					<li class="featureBox">
					<div class="box">
						<a href="#" target="_blank">
						<img alt="Catherine Sherwood" src="<?php echo Yii::app()->request->baseUrl; ?>/img/bm_x1_pic.jpg"  width="265" height="176">
						</a></div>
					<!-- /box --></li>
				</ul>
			</div>
			<!-- /botton-scroll --></div>
		<!-- /block --><a class="prev" href="javascript:void();">Previous</a><a class="next" href="javascript:void();">Next</a>
	</div>
		    </div>
        </div>
        <div class="bm_x1_main" id="menuTabcontent013_10" style="display:none">
        	<div id="featureContainer">
				<div id="feature">
		<div id="block">
			<div id="botton-scroll">
				<ul class="featureUL">
			        <?php foreach($bmw_x5 as $key=>$val):?>
					<li class="featureBox">
					<div class="box">
						<a  target="_blank">
						<img alt="Paracletos" src="<?php echo $val['image_url'];?>" width="265" height="176" alt="<?php echo $val['name'];?>">
						</a></div>
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
   




