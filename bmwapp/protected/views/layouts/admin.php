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
    </style>
</head>
<body class="easyui-layout" style="width:100%;height:100%">
<div data-options="region:'north'" style="overflow: hidden">
    <div style="padding:5px;border:1px solid #ddd">
        <a href="javascript:void(0);" class="easyui-linkbutton" data-options="plain:true" style="" onclick="add_car_dialog();">新建专题</a>
        <a href="javascript:void(0);" class="easyui-linkbutton" data-options="plain:true" style="" onclick=";">新建管理员</a>
        <a href="/index.php/admin/logout" class="easyui-linkbutton" data-options="plain:true" style="float:right;">退出</a>
        <a style="float:right;padding-top: 8px;"><?php echo $this->user_info['username'];?></a>
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
                <li style="padding-bottom: 10px;">[<a href="javascript:void(0);" onclick="">专题名称修改</a>]</li>
                <li style="padding-bottom: 10px;">[<a href="javascript:void(0);" onclick="add_nav_dialog(<?php echo $v['type_id'];?>);">新建导航</a>]</li>
                <?php foreach ($this->nav_list as $kk=>$vv){
                    if ($vv['type_id'] == $v['type_id']){?>
                        <li style="padding-bottom: 10px;">&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="get_nav_info(<?php echo $vv['id'];?>);"><?php echo $vv['name'];?></a></li>
                    <?php }
                }?>
                <li style="padding-top: 10px; padding-bottom: 10px;"><a href="javascript:void(0);" onclick="ajax_get_columns('image_list_<?php echo $v['type_id'];?>','<?php echo $v['name'];?>图片列表');">图片列表 - <?php echo $v['name'];?></a></li>
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
    <input id="car_type_name" type="text" class="easyui-validatebox" required="true" runat="server" /><br />
</div>
<div id="nav_dialog" style="display:none;padding:10px;width:400px;" title="新建导航">
    <label class="lbInfo">名称：</label>
    <input id="nav_name" type="text" class="easyui-validatebox" required="true" runat="server" /><br />
    <label class="lbInfo">描述：</label>
    <textarea id="nav_des" type="text" class="easyui-validatebox" style="width:300px;height:200px;" required="true" runat="server" ></textarea><br />
    <label class="lbInfo">资源：</label>
    <input id="nav_resource" type="text" class="easyui-validatebox" required="true" runat="server" /><br />
</div>
<div id="t_img_dialog" style="display:none;padding:10px;width:400px;" title="新建图片">
    <label class="lbInfo">名称：</label>
    <input id="t_img_name" type="text" class="easyui-validatebox" required="true" runat="server" /><br />
    <label class="lbInfo">状态：</label>
    <select id="t_img_stat" class="easyui-combobox" name="dept" >
        <option value="1">关闭</option>
        <option value="2">开启</option>
    </select><br />
    <label class="lbInfo">上传图片：</label><div id="divFileProgressContainer"></div><br />
    <div><a href="javascript:void(0)" id="add_btn" class="l-btn" group="" ><span class="l-btn-left"><span class="l-btn-text"><div id="spanButtonPlaceholder"></div></span></span></a></div>
    <div id="thumbnails" >
        <img style="margin: 5px; vertical-align: middle; opacity: 1;width: 200px;" src="" />
    </div>
    <input id="t_img_url"  type="hidden" class="easyui-validatebox"  required="true" runat="server" /><br />
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
</script>

</body>
</html>