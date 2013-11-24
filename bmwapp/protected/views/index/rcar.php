<?php $this->beginContent('//index/header'); ?>
<?php $this->endContent(); ?>
<style>
.bmw_a_loading { display: block; background:url(/js/lazyload/grey.gif) no-repeat center center; }
</style>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/Scripts/swfobject_modified.js"></script> 

</head>
<body>
<div class="bm_index">
	<?php $this->beginContent('//index/nav'); ?>
    <?php $this->endContent(); ?>
    <!--作品展示-->
    <div class="bm_rcjh">
    	<div class="bm_zpzs_title">
        	<span>人车交互</span>
        </div>
 <a name="rche"></a>
<div class="bm_rcjh_main">
<!--<img src="/img/bm_rcjh.jpg" />-->



<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="980" height="570">
    <param name="movie" value="/flash/loading.swf">
    <param name="quality" value="high">
    <embed src="/flash/loading.swf" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="980" height="570"></embed>
</object>




</div>
</div>
<div class="clear"></div>
</div>
    <!--底部-->
    <?php $this->beginContent('//index/footer'); ?>
    <?php $this->endContent(); ?>
</div>
<!--上传图片-->
<div id="bg" class="bg" style="display:none;"></div>
<iframe id='popIframe' class='popIframe' frameborder='0' ></iframe>
</body>
</html>

