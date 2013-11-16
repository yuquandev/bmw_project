<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" type="text/css" href="/js/jquery-easyui-1.3.2/themes/bootstrap/easyui.css">
    <link rel="stylesheet" type="text/css" href="/js/jquery-easyui-1.3.2/themes/icon.css">
    <script type="text/javascript" src="/js/jquery-easyui-1.3.2/jquery-1.8.0.min.js"></script>
    <script type="text/javascript" src="/js/jquery-easyui-1.3.2/jquery.easyui.min.js"></script>
    <script type="text/javascript" src="/js/common.js"></script>
    <script type="text/javascript" src="/js/lib/swfupload/swfupload.js"></script>
    <script type="text/javascript" src="/js/lib/project.handlers.js"></script>
    <style>
        #infodata td {padding:10px;}
        .datagrid-row-selected {background: #fff;color:#333;}
        .panel-body {background:none; }
        #main_button {background-color: #ffffff;}
        .bmw_acc_li {list-style: none; padding-left:8px;padding-top: 8px;padding-bottom: 8px; background: #fff; color: #000; cursor: pointer;}
        .bmw_acc_li a {text-decoration: none; color: #000; }
        /*.bmw_acc_li a {text-decoration: none; color: #666;}
        .bmw_acc_li a:hover { color: #0044cc;}*/
        .bmw_nav_a {color:#ddd;font-weight: 600; text-decoration: none;padding:0 8px 0 8px; font-size: 14px;text-shadow: 0 1px 1px #000; text-transform: uppercase;}
        a.bmw_nav_a:hover {color: #fff;text-shadow: 0 1px 1px #ddd;}
        .datagrid-body {background: #fff;}
        #infodata {background: #fff;border-left:2px solid #eee;}
        .nav_tbl_info {background: #fff;}
        .nav_tbl_info .left {float: left;width:100px;font-size: 16px;color:#0044cc;font-weight: bold;padding-top: 20px; text-align: right;padding-right:10px; min-height: 20px;}
        .nav_tbl_info .right {float: left;width:550px;font-size: 16px;color:#666; padding-top: 20px; min-height:20px;}
        .datagrid-btable {}
        .datagrid-htable {}
        .datagrid-header-inner {}
        .combo-p {height:38px; background: #fff;}
    </style>
</head>
<body style="width: 100%;height:100%;text-align: center;margin:0 auto; background: #eee;" >
<div style="position: relative;width: 960px;height: 100%; margin: 0 auto;text-align: left;padding:0px;">
<div id="stage_flash" style="display:block;  position: absolute;">
    <embed type="application/x-shockwave-flash" src="/img/cms/brakeenergy_Overview_bg.swf" width="960" height="634" style="undefined" id="mainFlashMovie" name="mainFlashMovie" bgcolor="#ffffff" quality="autohigh" allowscriptaccess="sameDomain" wmode="transparent" flashvars="prm_corelib=/img/cms/bmw_as3_corelib_1_1.swf&amp;prm_components=/img/cms/bmw_as3_components_2_0.swf">
</div>
<div id="bmw_north" data-options="region:'north'" style="overflow: hidden;position: absolute; width: 960px;">
    <div id="bmw_cms_nav" style="padding:5px;border:1px solid #ddd;padding-top: 30px;padding-left: 10px; height:26px; background: none; ;">
        <!--<a href="javascript:void(0);" class="bmw_nav_a" data-options="plain:true" style="" onclick="add_car_dialog();">新建专题</a>-->
        <a href="javascript:void(0);" class="bmw_nav_a" data-options="plain:true" style="" onclick="ajax_reg_admin();">新建管理员</a>
        <a href="/" class="bmw_nav_a" data-options="plain:true" style="" target="_blank" ">访问站点</a>
        <a href="javascript:void(0);" class="bmw_nav_a" data-options="plain:true" style="" onclick="window.location.reload();">刷新页面</a>
        <a href="/index.php/admin/logout" class="bmw_nav_a"  style="float:right;">退出</a>
        <div style="clear: both;"></div>
    </div>
</div>

<!--<div data-options="region:'south',split:true" style="height:0px;"></div>-->
<div data-options="region:'west',split:true" title="" style="width:200px;min-height:572px; position: absolute;top:63px;">
    <div class="easyui-accordion" data-options="fit:true,border:false" >
        <!--<div title="专题管理" data-options="" style="padding:10px;">
            <ul id="tt" class="easyui-tree"
                url="/index.php/admin/treedata">
            </ul>
        </div>-->
        <?php foreach ($this->car_list as $k=>$v){?>
            <div title="专题页 - <?php echo $v['name'];?>" data-options="" style="padding:10px;">
                <!--<li onclick="add_car_dialog(<?php echo $v['type_id'];?>,'<?php echo $v['name'];?>');" class="bmw_acc_li" style="border-bottom: 1px solid #bbb;"><a href="javascript:void(0);" >[修改专题]</a>  [<a href="javascript:void(0);" onclick="confirm_dialog(<?php echo $v['type_id'];?>,'car_type');">删除专题</a>]</li>-->
                <!--<li onclick="add_nav_dialog(<?php echo $v['type_id'];?>);" class="bmw_acc_li" ><a href="javascript:void(0);" >[新建导航]</a></li>-->
                <?php #foreach ($this->nav_list as $kk=>$vv){
                    if ($vv['type_id'] == $v['type_id']){?>
                        <!--<li onclick="get_nav_info(<?php echo $vv['id'];?>);" class="bmw_acc_li" style="">&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" ><?php echo $vv['name'];?></a></li>-->
                    <?php }
                #}?>
                <!--<li onclick="add_video_dialog(<?php echo $v['type_id'];?>);" class="bmw_acc_li" style="border-top: 1px solid #bbb"><a href="javascript:void(0);" >[新建视频]</a></li>-->
                <?php #foreach ($this->video_list as $kk=>$vv){
                    #if ($vv['type_id'] == $v['type_id']){?>
                        <!--<li onclick="get_video_info(<?php echo $vv['id'];?>);" class="bmw_acc_li" style="">&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" ><?php echo $vv['name'];?></a></li>-->
                    <?php #}
                #}?>
                <li onclick="ajax_get_columns('video_list_<?php echo $v['type_id'];?>','<?php echo $v['name'];?>视频列表');" class="bmw_acc_li" style="pborder-top: 1px solid #bbb;"><a href="javascript:void(0);" >视频列表 - <?php echo $v['name'];?></a></li>
                <li onclick="ajax_get_columns('image_list_<?php echo $v['type_id'];?>','<?php echo $v['name'];?>底部轮播图');" class="bmw_acc_li" style="pborder-top: 1px solid #bbb;"><a href="javascript:void(0);" >底部轮播图 - <?php echo $v['name'];?></a></li>
            </div>
        <?php } ?>
        <div title="用户作品管理" data-options="" style="padding:10px;">
            <?php foreach ($this->car_list as $k=>$v){?>
                <li onclick="ajax_get_columns('works_list_<?php echo $v['type_id'];?>','<?php echo $v['name'];?>作品列表');" class="bmw_acc_li" ><a href="javascript:void(0);" ><?php echo $v['name'];?>作品列表</a></li>
            <?php } ?>
        </div>
        <div title="用户管理" data-options="" style="overflow:auto;padding:10px;">
            <li onclick="ajax_get_columns('user_list','用户列表');" class="bmw_acc_li"><a href="javascript:void(0);" >用户列表</a></li>
            <li onclick="ajax_get_columns('admin_list','管理员列表');" class="bmw_acc_li" ><a href="javascript:void(0);" >管理员列表</a></li>
        </div>

    </div>
</div>
<div data-options="region:'center'" style="position: absolute;left:200px;top:63px;width:760px;"><!-- region:'center',title:'Main Title',iconCls:'icon-ok',border:false -->
    <div style="padding:5px;border:1px solid #ddd;display: none;"></div>
    <?php echo $content;?>
</div>
<div id="mydialog" style="display:none;padding:10px;width:400px;" title="新建专题">
    <label class="lbInfo">专题名称：</label>
    <input id="car_type_name" type="text" class="" required="true" runat="server" /><br />
</div>
<div id="nav_dialog" style="display:none;padding:10px;width:400px;" title="新建导航">
    <label class="lbInfo">名称：</label>
    <input id="nav_name" type="text" class="" required="true" runat="server" /><br />
    <label class="lbInfo">描述：</label>
    <textarea id="nav_des" type="text" class="" style="width:300px;height:200px;" required="true" runat="server" ></textarea><br />
    <label class="lbInfo">资源：</label>
    <input id="nav_resource" type="text" class="" required="true" runat="server" /><br />
</div>
<div id="nav_dialog_" style="display:none;padding:10px;width:400px;" title="新建导航">
    <label class="lbInfo_">视频名称：</label>
    <input id="nav_name_" type="text" class="" required="true" runat="server" /><br />
    <label class="lbInfo">视频地址：</label>
    <input id="nav_des_" type="text" class="" required="true" runat="server" style="width:260px;" /><br />
    <label class="lbInfo">视频链接：</label>
    <input id="nav_resource_" type="text" class="" required="true" runat="server" style="width:260px;" /><br />
</div>
<div id="t_img_dialog" style="display:none;padding:10px;width:400px;" title="新建图片">
    <label class="lbInfo">名&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;称：</label>
    <input id="t_img_name" type="text" class="" required="true" runat="server" /><br />
    <label class="lbInfo">状&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;态：</label>
    <select id="t_img_stat" class="easyui-combobox" name="dept" >
        <option value="1">关闭</option>
        <option value="0">开启</option>
    </select><br />
    <label class="lbInfo">上传图片：<input id="t_img_file" type="text" value="" /><div id="divFileProgressContainer" style="display: none;"></div><a style="vertical-align:middle;" href="javascript:void(0)" id="add_btn" class="l-btn" group="" ><span class="l-btn-left"><span class="l-btn-text"><div id="spanButtonPlaceholder"></div></span></span></a></label><br />
    <div id="error_banner"></div>
    <div id="thumbnails" >
        <img style="margin: 5px; vertical-align: middle; opacity: 1;width: 200px; height: 200px;" src="" />
    </div>
    <input id="t_img_url"  type="hidden" class=""  required="true" runat="server" /><br />
</div>
<div id="dd" style="display: none;"><div style="padding: 18px;">确定要删除吗？</div></div>
<div id="regdialog" style="display:none;padding:10px;width:400px;" title="管理员注册">
    <label class="lbInfo">用户名：</label>
    <input id="reg_username" type="text" class="" required="true" runat="server" /><br />
    <label class="lbInfo">密&nbsp;&nbsp;&nbsp;&nbsp;码：</label>
    <input id="reg_password" type="password" class="" required="true" runat="server" /><br />
</div>
<div id="vote_dialog" style="display:none;padding:10px;width:400px;" title="修改投票">
    <label class="lbInfo">投票数：</label>
    <input id="vote_num_id" type="text" class="" required="true" runat="server" /><br />
</div>
<div id="idModuls" style="position: absolute;top:0px;z-index: 1000;right:64px;">
    <img src="/img/cms/id_moduls.png" alt="">
</div>
</div>
<script type="text/javascript">
    $('#tt').tree({
        onClick: function(node){
            //console.log(node);
            //alert(node.text);  // alert node text property when clicked
            if(!node.hasOwnProperty('state')){
                ajax_get_columns('topic_list',node.text,node.id);
            }
        }
    });
    /*
    $('#bmw_cms_nav').bind('mouseover',function(){
        $(this).css('opacity', '1');
    });
    $('#bmw_cms_nav').bind('mouseout',function(){
        $(this).css('opacity', '0.84');
    });
*/

    $('.bmw_acc_li').each(function(){
        var tmp = $(this);
        $(this).bind('mouseover',function(){
            tmp.css('background-color','#0081c2');
            tmp.find('a').css('color','#ffffff');
        });
        $(this).bind('mouseout',function(){
            tmp.css('background-color','#ffffff');
            tmp.find('a').css('color','#000000');
        });
    });

</script>

</body>
</html>