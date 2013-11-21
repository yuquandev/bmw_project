<?php $this->beginContent('//phone/header'); ?>
<?php $this->endContent(); ?>
<div class="sjb_body">
	<!--头部-->

        <?php $this->beginContent('//phone/nav'); ?>
    <?php $this->endContent(); ?>
   
    <!--中间-->
    <div class="sjb_main">
    	<?php $this->beginContent('//phone/login_nav'); ?>
    <?php $this->endContent(); ?>
        <div class="clear"></div>
    	<div class="sjb_main_zj">
        	<div class="sjb_main_title"></div>
            <div class="bm_zpzs_main" >
            	<div class="bm_sjb_zptext">
                	<div class="bm_zptext_tu">
                	<img src="<?php echo $getone['img_url'];?>" /></div>
                    <div class="bm_zptext_zi">
                    	<h2><?php echo $getone['name'];?></h2>
                        <p style="width:295;">
                        <?php echo $getone['description'];?>
                        </p>
                <?php if( $getone['review'] == 1){?>   
                <div class="bm_zpzs_zi"><span style="color:red;">审核状态:<?php if($getone['review'] == 0){echo '审核已通过';}else{ echo '审核未通过';}?></span></div>
                <?php }else{?>
                <div class="bm_zpzs_zan bm_zpzs_zan2">
                	<a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/phone/phonevote?wid=<?php echo $getone['id'];?>" style="display:block;left"><input name="" type="button" class="bm_tp_an" value="投票" /></a>
                    <span><?php echo $getone['vote_num'];?></span>
                </div>
                <?php }?>
                    </div>
                    <div class="sjbzp_sp">
                    	<p>上一个作品：<a href="<?php if( isset($up_getone['id'] )){?> <?php echo Yii::app()->request->baseUrl; ?>/index.php/phone/show?id=<?php echo $up_getone['id'];?>,phone#pagePhone<?php }else{ echo '#'; }?>"><?php echo $up_getone['name'];?></a></p>
                        <p>下一个作品：<a href="<?php if( isset($down_getone['id'] )){?><?php echo Yii::app()->request->baseUrl; ?>/index.php/phone/show?id=<?php echo $down_getone['id'];?>,phone#pagePhone<?php }else{ echo '#'; }?>"><?php echo $down_getone['name'];?></a></p>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    
</div>
</body>
</html>