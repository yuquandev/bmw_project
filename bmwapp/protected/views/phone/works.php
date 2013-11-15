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
            	
            	<?php foreach($works as $key=>$val):?>
            	<div class="bm_zpzs_list">
            	<div class="bm_zpzs_tu"><a href=""><img src="<?php echo Yii::app()->request->baseUrl; ?><?php echo $val['img_url'];?>" width="130" height="193"/></a></div>
                <div class="bm_zpzs_zi"><a href=""><?php echo Yii::app()->request->baseUrl; ?><?php echo $val['name'];?></a></div>
                <div class="bm_zpzs_zan">
                	<a href="" style="display:block;left">
                    <input onclick="top_vote(<?php echo $val['id']?>,<?php echo $val['vote_num']?>);" type="button" class="bm_tp_an" value="投票"/>
                    </a>
                    <span  id="vote_<?php echo $val['id']?>"><?php echo $val['vote_num']?></span>
                </div>
                </div>
                <?php endforeach;?>
            </div>
        </div>
        
    </div>
    
</div>
</body>
</html>
