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
            <div class="sjb_sp">
           		<table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
            <td height="58" colspan="2"><input name="textfield" id="bm_username" type="text" class="zck_text2" value="请输入用户名" onfocus="if (value =='请输入用户名'){value =''}" onblur="if (value ==''){value='请输入用户名'}"/></td>
          </tr>
          <tr>
            <td height="58" colspan="2"><input name="textfield" id="bm_password" type="password" class="zck_text2"    value="请输入密码" onfocus="if (value =='请输入密码'){value =''}" onblur="if (value ==''){value='请输入密码'}"/></td>
          </tr>
          <tr>
            <td width="46%" height="32" valign="middle"><input name="" type="checkbox" value="" class="zck_k"/><div class="zck_zi">两周内自动登录</div></td>
            <td width="54%" height="32" valign="middle"><div class="zck_wj"><!-- <a href="#">其它方式登陆 | </a><a href="#">忘记密码？</a> --></div></td>
          </tr>
          <tr>
            <td height="50" valign="middle"><input name="" type="button" class="tck_an2" value="立即登陆" onclick="bm_login();"/></td>
           <!--  <td height="50" valign="middle"><input name="" type="button" class="tck_zc" value="注 册"/></td> -->
          </tr>
        </table>
                
            </div>
        </div>
        
    </div>
    
</div>
</body>
</html>
