<?php $this->beginContent('//phone/header'); ?>
    <?php $this->endContent(); ?>
<div class="sjb_body">
	<!--头部-->
	 <?php $this->beginContent('//phone/nav'); ?>
        <?php $this->endContent(); ?>
<!--中间-->
    <div class="sjb_main">
    
    
    
<script>
function locationfro()
{
   var url = '<?php echo $url;?>';
   window.location= url;
}
</script>    
 <?php if(empty($msg)):?>
 <script>
   locationfro();
 </script> 
 <?php endif?>       
        
        <div class="clear"></div>
    	<div class="sjb_main_zj">
        	<div class="sjb_main_title"></div>
            <div class="bm_zpzs_main" >
				
<div class="bm_tp_tck">
    <div class="bm_tck_main">
    	<div class="bm_main_sm"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/phone/bm_tck_pic.jpg" /><span><?php echo $msg;?></span></div>
        <div class="bm_main_an"><input name="" type="button" class="bm_tck_an" value="确 定" onclick="locationfro();"/></div>
    </div>
</div>

            </div>
        </div>
        
    </div>
    
</div>
</body>
</html>
