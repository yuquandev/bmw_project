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
</head>
<body class="easyui-layout" style="width:100%;height:100%">
<div data-options="region:'north'" style="overflow: hidden">
    <div style="padding:5px;border:1px solid #ddd">
        <a href="javascript:void(0);" class="easyui-linkbutton" data-options="plain:true" style="" onclick="add_car_dialog();">新建专题</a>
        <a href="/index.php/admin/logout" class="easyui-linkbutton" data-options="plain:true" style="float:right;">退出</a>
    </div>
</div>
<div data-options="region:'south',split:true" style="height:50px;"></div>
<div data-options="region:'west',split:true" title="" style="width:200px;">
    <div class="easyui-accordion" data-options="fit:true,border:false" >
        <!--<div title="专题管理" data-options="" style="padding:10px;">
            <ul id="tt" class="easyui-tree"
                url="/index.php/admin/treedata">
            </ul>
        </div>-->
        <?php foreach ($this->car_list as $k=>$v){?>
            <div title="专题页 - <?php echo $v['name'];?>" data-options="" style="padding:10px;">
                <li style="padding-bottom: 10px;">[<a href="javascript:void(0);" onclick="add_nav_dialog(<?php echo $v['type_id'];?>);">新建导航</a>]</li>
                <?php foreach ($this->nav_list as $kk=>$vv){
                    if ($vv['type_id'] == $v['type_id']){?>
                        <li style="padding-bottom: 10px;"><a href="javascript:void(0);" onclick="get_nav_info(<?php echo $vv['id'];?>);"><?php echo $vv['name'];?></a></li>
                    <?php }
                }?>
                <li style="padding-top: 10px; padding-bottom: 10px;"><a href="javascript:void(0);" onclick="">图片列表 - <?php echo $v['name'];?></a></li>
            </div>
        <?php } ?>
        <div title="作品管理" data-options="" style="padding:10px;">
            <li style="padding-bottom: 10px;"><a href="javascript:void(0);" onclick="ajax_get_columns('works_list','用户作品列表');">用户作品列表</a></li>
        </div>
        <div title="用户管理" data-options="" style="overflow:auto;padding:10px;">
            <li style="padding-bottom: 10px;"><a href="javascript:void(0);" onclick="ajax_get_columns('user_list','用户列表');">用户列表</a></li>
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