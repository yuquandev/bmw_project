<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" type="text/css" href="/js/easyui-1.3.4/themes/bootstrap/easyui.css">
    <link rel="stylesheet" type="text/css" href="/js/easyui-1.3.4/themes/icon.css">
    <script type="text/javascript" src="/js/easyui-1.3.4/jquery.min.js"></script>
    <script type="text/javascript" src="/js/easyui-1.3.4/jquery.easyui.min.js"></script>
    <script type="text/javascript" src="/js/common.js"></script>
    <script type="text/javascript" src="/js/lib/swfupload/swfupload.js"></script>
    <script type="text/javascript" src="/js/lib/project.handlers.js"></script>
    <style>
        #infodata td {padding:10px;}
        .datagrid-row-selected {background: #fff;color:#333;}
        .panel-body {background:none; }
        #main_button {background-color: #ffffff;}
        .panel-body .accordion-body li {list-style: none;}
        .panel-body .accordion-body li a {text-decoration: none; color: #666;}
        .panel-body .accordion-body li a:hover { color: #0044cc;}
        .bmw_nav_a {color:#ddd;font-weight: 600; text-decoration: none;padding:0 8px 0 8px; font-size: 14px;text-shadow: 0 1px 1px #000; text-transform: uppercase;}
        a.bmw_nav_a:hover {color: #fff;text-shadow: 0 1px 1px #ddd;}
        .datagrid-body {background: #fff; }
    </style>
</head>
<body class="easyui-layout" style="width:100%;height:100%">
<div id="stage_flash" style="display:block;  position: absolute;">
    <embed type="application/x-shockwave-flash" src="/img/cms/brakeenergy_Overview_bg.swf" width="1024" height="634" style="undefined" id="mainFlashMovie" name="mainFlashMovie" bgcolor="#ffffff" quality="autohigh" allowscriptaccess="sameDomain" wmode="transparent" flashvars="prm_corelib=/img/cms/bmw_as3_corelib_1_1.swf&amp;prm_components=/img/cms/bmw_as3_components_2_0.swf">
</div>
<div id="bmw_north" data-options="region:'north'" style="overflow: hidden;">
    <div id="bmw_cms_nav" style="padding:5px;border:1px solid #ddd;padding-top: 30px;padding-left: 10px; height:26px; background: none; ;">
        <a href="javascript:void(0);" class="bmw_nav_a" data-options="plain:true" style="" onclick="add_car_dialog();">新建专题</a>
        <a href="javascript:void(0);" class="bmw_nav_a" data-options="plain:true" style="" onclick="ajax_reg_admin();">新建管理员</a>
        <a href="javascript:void(0);" class="bmw_nav_a" data-options="plain:true" style="" onclick="location.href='/';">访问站点</a>
        <a href="javascript:void(0);" class="bmw_nav_a" data-options="plain:true" style="" onclick="window.location.reload();">刷新页面</a>
        <a href="/index.php/admin/logout" class="easyui-linkbutton"  style="float:right;">退出</a>
        <a class="easyui-linkbutton" style="float:right;"><?php echo $this->user_info['username'];?></a>
        <div style="clear: both;"></div>
    </div>
</div>
<div data-options="region:'south',split:true" style="height:0px;"></div>
<div data-options="region:'west',split:true" title="" style="width:200px;">
    <div class="easyui-accordion" data-options="fit:true,border:false" >
        <!--<div title="专题管理" data-options="" style="padding:10px;">
            <ul id="tt" class="easyui-tree"
                url="/index.php/admin/treedata">
            </ul>
        </div>-->
        <?php foreach ($this->car_list as $k=>$v){?>
            <div title="专题页 - <?php echo $v['name'];?>" data-options="" style="padding:10px;">
                <li style="padding-bottom: 10px;border-bottom: 1px solid #666;">[<a href="javascript:void(0);" onclick="add_car_dialog(<?php echo $v['type_id'];?>,'<?php echo $v['name'];?>');">修改专题</a>]  <!--[<a href="javascript:void(0);" onclick="confirm_dialog(<?php echo $v['type_id'];?>,'car_type');">删除专题</a>]--></li>
                <li style="padding-top: 10px;padding-bottom: 10px;">[<a href="javascript:void(0);" onclick="add_nav_dialog(<?php echo $v['type_id'];?>);">新建导航</a>]</li>
                <?php foreach ($this->nav_list as $kk=>$vv){
                    if ($vv['type_id'] == $v['type_id']){?>
                        <li style="padding-bottom: 10px;">&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="get_nav_info(<?php echo $vv['id'];?>);"><?php echo $vv['name'];?></a></li>
                    <?php }
                }?>
                <li style="padding-top: 10px; padding-bottom: 10px;border-top: 1px solid #666;"><a href="javascript:void(0);" onclick="ajax_get_columns('image_list_<?php echo $v['type_id'];?>','<?php echo $v['name'];?>图片列表');">图片列表 - <?php echo $v['name'];?></a></li>
            </div>
        <?php } ?>
        <div title="用户作品管理" data-options="" style="padding:10px;">
            <?php foreach ($this->car_list as $k=>$v){?>
                <li style="padding-bottom: 10px;"><a href="javascript:void(0);" onclick="ajax_get_columns('works_list_<?php echo $v['type_id'];?>','<?php echo $v['name'];?>作品列表');"><?php echo $v['name'];?>作品列表</a></li>
            <?php } ?>
        </div>
        <div title="用户管理" data-options="" style="overflow:auto;padding:10px;">
            <li style="padding-bottom: 10px;"><a href="javascript:void(0);" onclick="ajax_get_columns('user_list','用户列表');">用户列表</a></li>
            <li style="padding-bottom: 10px;"><a href="javascript:void(0);" onclick="ajax_get_columns('admin_list','管理员列表');">管理员列表</a></li>
        </div>

    </div>
</div>
<div data-options="region:'center'"><!-- region:'center',title:'Main Title',iconCls:'icon-ok',border:false -->
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
<div id="t_img_dialog" style="display:none;padding:10px;width:400px;" title="新建图片">
    <label class="lbInfo">名称：</label>
    <input id="t_img_name" type="text" class="" required="true" runat="server" /><br />
    <label class="lbInfo">状态：</label>
    <select id="t_img_stat" class="easyui-combobox" name="dept" >
        <option value="1">关闭</option>
        <option value="0">开启</option>
    </select><br />
    <label class="lbInfo">上传图片：</label><div id="divFileProgressContainer"></div><br />
    <div><a href="javascript:void(0)" id="add_btn" class="l-btn" group="" ><span class="l-btn-left"><span class="l-btn-text"><div id="spanButtonPlaceholder"></div></span></span></a></div>
    <div id="thumbnails" >
        <img style="margin: 5px; vertical-align: middle; opacity: 1;width: 200px;" src="" />
    </div>
    <input id="t_img_url"  type="hidden" class=""  required="true" runat="server" /><br />
</div>
<div id="dd" style="display: none;"><div style="padding: 18px;">确定要删除吗？</div></div>
<div id="regdialog" style="display:none;padding:10px;width:400px;" title="管理员注册">
    <label class="lbInfo">用户名：</label>
    <input id="reg_username" type="text" class="" required="true" runat="server" /><br />
    <label class="lbInfo">密  码：</label>
    <input id="reg_password" type="password" class="" required="true" runat="server" /><br />
</div>
<div id="idModuls" style="position: absolute;top:0px;z-index: 1000;right:150px;">
    <img src="/img/cms/id_moduls.png" alt="">
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
</script>

</body>
</html>