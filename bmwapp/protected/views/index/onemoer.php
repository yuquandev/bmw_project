<div class="bm_index">
	<?php $this->beginContent('//index/nav'); ?>
    <?php $this->endContent(); ?>

    
    <!--作品展示-->
    <div class="bm_zpzs">
    	<div class="bm_zpzs_title">
        	<span>作品展示</span>
        </div>
        <a name ="toppage"></a>
        <div class="bm_zpzs_main">
        	
           
             <?php foreach($works as $key=>$val):?>
        	<div class="bm_zpzs_list">
            	<div class="bm_zpzs_tu2"><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/one/more?&uuid=<?php echo $val['user_id'];?>,<?php echo $val['type'];?>"><img src="<?php echo $val['img_url']; ?>" width="228" height="366"/></a></div>
                <div class="bm_zpzs_zi"><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/one/more?&uuid=<?php echo $val['user_id'];?>,<?php echo $val['type'];?>"><?php echo $val['name'];?></a></div>
                <div class="bm_zpzs_zan">
                	<input onclick="top_vote(<?php echo $val['id']?>,<?php echo $val['vote_num']?>);" type="button" class="bm_tp_an" value="投票"/>
                    <span  id="vote_<?php echo $val['id']?>"><?php echo $val['vote_num']?></span>
                </div>
            </div>
            <?php endforeach;?>  
        </div>
         
            <?php echo $page;?>
        
        
        <div class="clear"></div>
    </div>
    
    
    
    <!--底部-->
   <?php $this->beginContent('//index/footer'); ?>
    <?php $this->endContent(); ?>
</div>





<div id="bg" class="bg" style="display:none;"></div>
<iframe id='popIframe' class='popIframe' frameborder='0' ></iframe>
</body>
</html>
