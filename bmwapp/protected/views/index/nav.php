<?php if($this->nav == '1x'){?>
<div class="bm_top">
<?php }else{?>
<div class="bm_top_3x">
<?php }?>
    	
    	<div class="bm_top_logo">
        	<ul>
            	<li><a href="#"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/logo.png" /></a></li>
            </ul>
        </div>
        <!--导航-->
        <div class="bm_top_nav">
        	<div class="bm_nav_main">
            	<ul>
            	    <?php if($this->nav == '1x'){?>
                	<li  class="bm_x1t bm_x1t_on"><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/one"></a></li>
                	<?php }else{?>
                	<li  class="bm_3xt bm_3xt_on"><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php"></a></li>
                    <?php }?>
                    <li class="bm_x2"> <a href="#top"></a></li>
                    <li class="bm_x3">  <a href="#">进入官网</a></li>
                </ul>
            </div>
        </div>
        <!--导航结束-->
    </div>


