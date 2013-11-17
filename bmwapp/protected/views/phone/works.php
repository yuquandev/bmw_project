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
            
            <div class="bm_zpzs_main" name="pagePhone">
            	
            	<?php foreach($works as $key=>$val):?>
            	<div class="bm_zpzs_list">
            	<div class="bm_zpzs_tu"><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/phone/show?id=<?php echo $val['id'];?>,phone"><img src="<?php echo Yii::app()->request->baseUrl; ?><?php echo $val['img_url'];?>" width="130" height="193"/></a></div>
                <div class="bm_zpzs_zi"><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/phone/show?id=<?php echo $val['id'];?>,phone"><?php echo Yii::app()->request->baseUrl; ?><?php echo $val['name'];?></a></div>
                <div class="bm_zpzs_zan">
                	<a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/phone/phonevote?wid=<?php echo $val['id'];?>" style="display:block;left">
                    <input type="button" class="bm_tp_an" value="投票"/>
                    </a>
                    <span><?php echo $val['vote_num']?></span>
                </div>
                </div>
                <?php endforeach;?>
            </div>
            <?php echo $page;?>
        </div>
        
    </div>
    
</div>
</body>
</html>
