<?php $this->beginContent('//phone/header'); ?>
    <?php $this->endContent(); ?>
<div class="sjb_body">
	<!--头部-->
	<?php $this->beginContent('//phone/nav'); ?>
    <?php $this->endContent(); ?>
    <!--头部-->
    <!--中间-->
   
    <div class="sjb_main">
    		<?php $this->beginContent('//phone/login_nav'); ?>
    <?php $this->endContent(); ?>
        <div class="clear"></div>
    	<div class="sjb_main_zj">
          <div class="sjb_main_title"></div>
          <div class="sjb_sp">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <form action="/index.php/phone/uplodeimg" method=post enctype="multipart/form-data" onsubmit="return upimg_reg();">
          <tr>
            <td width="30%" height="40" align="right" valign="middle">
            <strong>标题：</strong></td>
            <td width="50%" height="40" align="left" valign="middle">
            <input name="input" name="title" id="title" type="text" class="zck_text4"/>
            </td>
            <td width="20%" height="40" align="left" valign="middle"><span id="img_title" style="color:red;"></span></td>
          </tr>
          <tr>
            <td height="40" align="right" valign="middle">
            <strong>图片地址：</strong></td>
            <td height="40" align="left" valign="middle">
            <input type="file" name="img" id="img" id="brandpic" size="20" />
            </td>
            <td width="6%" height="40" align="left" valign="middle"><span id="img_val" style="color:red;"></span></td>
            <!-- <td height="40" align="left" valign="middle">
            <input name="" type="button" class="zck_ll" value="浏览"/>
            </td> -->
          </tr>
          <tr>
            <td height="100" align="right" valign="middle"><strong>活动宣言：</strong></td>
            <td height="100" align="left" valign="middle">
            <textarea name="content" id="content" title="" cols="" rows="" class="zck_xy"></textarea></td>
            <td height="100" align="left" valign="middle"><span id="img_content" style="color:red;"></span></td>
          </tr>
          <tr>
            <td height="56" align="right" valign="middle">&nbsp;</td>
            <td height="56" align="left" valign="middle">
            <input name="submit" type="submit" class="tck_an" value="立即提交" style="margin-left:0"/></td>
            <td height="56" align="left" valign="middle">&nbsp;</td>
          </tr>
          </form>
        </table>
                
            </div>
        </div>
        
    </div>
    
</div>
</body>
</html>
