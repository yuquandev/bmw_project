<div class="sjb_dl">
              <?php if (empty($this->userinfo)){?>
            	     <a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/phone/reg">注册 | </a>
        	         <a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/phone/login">登陆</a>
              <?php }else { ?>
                    <!--  <a href="/index.php/phone/more?uuid=<?php echo $this->userinfo['uid'];?>"><?php echo $this->userinfo['username'] ?></a> | <a href='/index.php/user/logout'>退出</a>-->
                             欢迎您，<?php if( strlen($this->userinfo['username']) > 12 ){echo  substr($this->userinfo['username'],0,8).'..';}else{ echo $this->userinfo['username'];}  ?>&nbsp;<a href="/index.php/phone/works?uuid=<?php echo $this->userinfo['uid'];?>,phone"><span style="color:red;">查看作品</span></a> | <a href='/index.php/user/logout'>退出</a>
              <?php }?>



</div>