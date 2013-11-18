	<div class="sjb_top">
    <div class="sjb_top_logo">
        <img src="<?php echo Yii::app()->request->baseUrl; ?>/img/phone/sjb_main_pic.jpg" />
    </div>
    </div>
    <div class="sjb_qh" id="nav">
            	<ul>
  <li  <?php if($this->nav == 1): echo $this->style; endif;?> >
    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  class="mb">
    	<tr>
    		<td width="30%" align="center"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/phone/bm_hd_ico.jpg" /></td>
    		<td width="70%"><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/phone">活动介绍</a></td>
  		</tr>
   </table>
   </li>
 <li <?php if($this->nav == 2): echo $this->style; endif;?>> 
  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  class="mb">
  <tr>
    <td width="30%" align="center"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/phone/bm_hd_ico2.jpg" /></td>
    <td width="70%"><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/phone/rule">活动规则</a></td>
  </tr>
</table>
</li>
  
<li <?php if($this->nav == 3): echo $this->style; endif;?>><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="mb">
  <tr>
    <td width="30%" align="center"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/phone/bm_hd_ico3.gif" /></td>
    <td width="70%"><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/phone/upimg">图片上传</a></td>
  </tr>
</table>
</li>
 
 <li <?php if($this->nav == 4): echo $this->style; endif;?>><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="mb">
  <tr>
    <td width="30%" align="center"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/phone/zpxd.jpg" /></td>
    <td width="70%"><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/phone/works">作品展示</a></td>
  </tr>
</table>
</li>
           </ul>
            </div>