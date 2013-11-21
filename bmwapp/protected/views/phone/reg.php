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
                <td width="28%" height="42" align="right" valign="middle"><strong>邮箱：</strong></td>
                <td height="42" colspan="2" align="left" valign="middle">
                <input name="" type="text" class="zck_text3" id="reg_username" onblur="onblureg('user');"/></td>
                </tr>
                <tr>
                     <td width="28%" height="22" align="right" valign="middle"></td>
                    <td height="22" colspan="2" align="left" valign="middle">
                    <div class="tck_pd tck_pd2">
                       <span id="reg_name"></span>
                    </div></td>
               </tr>
              
                <!--
                <tr>
                  	<td width="28%" height="42" align="right" valign="middle"><strong>真实姓名：</strong></td>
                	<td height="42" colspan="2" align="left" valign="middle">
                	<input name="" type="text" class="zck_text3" id="reg_nickname" onblur="onblureg();"/></td>
                	</tr>
                	<tr>
                   <td width="28%" height="22" align="right" valign="middle"></td>
                   <td height="22" colspan="2" align="left" valign="middle"><div class="tck_pd tck_pd2">
                   <span id="reg_nkname"></span></div></td>
               </tr>-->
              
              <tr>
                <td height="42" align="right" valign="middle"><strong>手机：</strong></td>
                <td height="42" colspan="2" align="left" valign="middle">
                <input name="" type="text" class="zck_text3" id="reg_telephone" onblur="onblureg();"/></td>
                </tr>
        	  <tr>
                     <td width="28%" height="22" align="right" valign="middle"></td>
                    <td height="22" colspan="2" align="left" valign="middle">
                    <div class="tck_pd tck_pd2">
                    <span id="reg_phone"></span></div></td>
                  </tr>
              <tr>
                <td height="42" align="right" valign="middle"><strong>设置密码：</strong></td>
                <td height="42" colspan="2" align="left" valign="middle">
                <input name="" type="password" class="zck_text3" id="reg_password" onblur="onblureg();"/></td>
                </tr>
          <tr>
                     <td width="28%" height="32" align="right" valign="middle"></td>
                    <td height="32" colspan="2" align="left" valign="middle">
                    <div class="tck_pd tck_pd2">
                    <span id="reg_pwd"></span></div></td>
                  </tr>
              <tr>
                <td height="42" align="right" valign="middle"><strong>确认密码：</strong></td>
                <td height="42" colspan="2" align="left" valign="middle">
                <input name="" type="password" id="reg_password_confim" class="zck_text3" onblur="onblureg();"/>
                </td>
                </tr>
          		<tr>
                     <td width="28%" height="22" align="right" valign="middle"></td>
                    <td height="22" colspan="2" align="left" valign="middle">
                    <div class="tck_pd tck_pd2">
                    <span id="reg_cpwd"></span></div></td>
                  </tr>
              <tr>
                <td height="50" align="right" valign="middle"><strong>验证码：</strong></td>
                <td height="50" colspan="2" align="left" valign="middle">
                <input name="" type="text" id="vcode_value"  class="zck_text3" style="width:30%;float:left;"/>
                <a href="javascript:void(0);" onclick="lvcode();"><img src="/index.php/api/vcode" id="vcode" style="float:left;margin-left:17px;"/></a>
                </td>
                </tr>
          <tr>
                    <td width="28%" height="32" align="right" valign="middle"></td>
                    <td height="32" colspan="2" align="left" valign="middle"><div class="tck_pd tck_pd2">
                    
                    <span id="reg_vcode"><strong style="color:#ff0000">*</strong>点击图片更换验证码</span>
                    
                    </div>
                    </td>
                  </tr>
              <tr>
                <td height="42" align="right" valign="middle">&nbsp;</td>
                <td width="46%" height="42" align="left" valign="middle">
                <input name="" type="button" class="tck_an" value="立即注册" onclick="onblureg();"/></td>
                <td width="26%" height="42" align="left" valign="middle">&nbsp;</td>
          </tr>
      </table>
                
            </div>
        </div>
        
    </div>
    
</div>
</body>
</html>
