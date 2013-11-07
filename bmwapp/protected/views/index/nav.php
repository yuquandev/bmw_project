<?php if($this->nav == '2x'){?>
        	<div class="bm_top_3x">
            <?php }elseif($this->nav == '1x' ){?>
            <div class="bm_top">
            <?php }else{?>
            <div class="bm_top_3x">

<?php }?>
    	<div class="bm_top_logo">
        	<ul>
            	<li><a href="#"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/logo1.jpg" /></a></li>
                <li><a href="#"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/logo2.jpg" /></a></li>
            </ul>
        </div>
        <!--导航-->
        <div class="bm_top_nav">
        	<?php if($this->nav == '2x'){?>
        	<div class="bm_nav_main">
        	<?php }elseif($this->nav == '1x' ){?>
            <div class="bm_nav_main bm_nav_main2">
            <?php }else{?>
            <div class="bm_nav_main">
            <?php }?>
            	<a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php"><?php if($this->nav == '2x'){?><strong>3系</strong><?php }else{ ?>3系<?php }?></a>
                <a href="#top">微直播</a>
                <a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/index/one"><?php if($this->nav == '1x'){?><strong>X1</strong><?php }else{ ?>X1<?php }?></a>
                <a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/index/five"><?php if($this->nav == '5x'){?><strong>5系</strong><?php }else{ ?>5系<?php }?></a>
                <a href="#">进入官网</a>
                </ul>
            </div>
         </div>
        <!--导航结束-->
</div>
