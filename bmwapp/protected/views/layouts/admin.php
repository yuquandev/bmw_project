<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" type="text/css" href="/js/easyui-1.3.4/themes/default/easyui.css">
    <link rel="stylesheet" type="text/css" href="/js/easyui-1.3.4/themes/icon.css">
    <script type="text/javascript" src="/js/easyui-1.3.4/jquery.min.js"></script>
    <script type="text/javascript" src="/js/easyui-1.3.4/jquery.easyui.min.js"></script>
</head>
<body class="easyui-layout" style="width:100%;height:100%">
<div data-options="region:'north'" style="overflow: hidden">
    <div style="padding:5px;border:1px solid #ddd">
        <a href="#" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-add'">新建数据库</a>
        <a href="#" class="easyui-menubutton" data-options="menu:'#mm1',iconCls:'icon-redo'">导入</a>
        <a href="#" class="easyui-menubutton" data-options="menu:'#mm2',iconCls:'icon-undo'">导出</a>
        <a href="#" class="easyui-menubutton" data-options="menu:'#mm3',iconCls:'icon-search'">执行SQL</a>
        <a href="/index.php/admin/logout" class="easyui-linkbutton" data-options="plain:true">退出</a>
    </div>
    <div id="mm1" style="width:150px;">
        <div data-options="iconCls:'icon-undo'">Undo</div>
        <div data-options="iconCls:'icon-redo'">Redo</div>
        <div class="menu-sep"></div>
        <div>Cut</div>
        <div>Copy</div>
        <div>Paste</div>
        <div class="menu-sep"></div>
        <div>
            <span>Toolbar</span>
            <div style="width:150px;">
                <div>Address</div>
                <div>Link</div>
                <div>Navigation Toolbar</div>
                <div>Bookmark Toolbar</div>
                <div class="menu-sep"></div>
                <div>New Toolbar...</div>
            </div>
        </div>
        <div data-options="iconCls:'icon-remove'">Delete</div>
        <div>Select All</div>
    </div>
    <div id="mm2" style="width:100px;">
        <div>Help</div>
        <div>Update</div>
        <div>About</div>
    </div>
    <div id="mm3" class="menu-content" style="background:#f0f0f0;padding:10px;text-align:left">
        <img src="http://www.jeasyui.com/images/logo1.png" style="width:150px;height:50px">
        <p style="font-size:14px;color:#444;">Try jQuery EasyUI to build your modern, interactive, javascript applications.</p>
    </div>
</div>
<div data-options="region:'south',split:true" style="height:50px;"></div>
<div data-options="region:'west',split:true" title="" style="width:200px;">
    <ul id="tt" class="easyui-tree" url="/index.php/test/treedata">
        <li><a href="javascript:void(0);" onclick="ajax_get_columns('user_list','用户列表');">用户管理</a></li>
        <li><a href="javascript:void(0);" onclick="ajax_get_columns(1);">首页banner</a></li>
        <li><a href="javascript:void(0);" onclick="ajax_get_columns(1);">3系</a></li>
        <li><a href="javascript:void(0);" onclick="ajax_get_columns(1);">5系</a></li>
        <li><a href="javascript:void(0);" onclick="ajax_get_columns(1);">X1</a></li>
        <li><a href="javascript:void(0);" onclick="ajax_get_columns(1);">用户作品管理</a></li>
        <li><a href="javascript:void(0);" onclick="ajax_get_columns(1);">用户作品管理</a></li>
    </ul>
</div>
<div data-options="region:'center',title:'Main Title',iconCls:'icon-ok'">
    <?php echo $content;?>
</div>
<script type="text/javascript">
    /*$('#tt').tree({
        onClick: function(node){
            //console.log(node);
            //alert(node.text);  // alert node text property when clicked
            if(!node.hasOwnProperty('state')){
                ajax_get_columns(node.id);
            }
        }
    });*/

    function ajax_get_columns(table,title){
        var columns = [{field:"ck",checkbox:true}];
        $.ajax({url: '/index.php/admin/columns?_n='+ new Date().getTime(),
            type: 'POST',
            data:{act:table},
            dataType: 'json',
            beforeSend : function(){
            },
            error: function(){
            },
            success: function(data){
                for (var n in data){
                    if(data[n]){
                        columns.push({field:data[n]['field'],title:data[n]['title'],width:100});
                    }
                }
                //console.log(columns);

                reload_datagrid(table,title,columns);
            },
            complete : function(){
            }
        });
    }

    function reload_datagrid(table,title,columns){
        console.log(table);
        $('#dg').datagrid({
            title : title,
            url:'/index.php/admin/datajson?act='+table,
            striped : true,
            method : "post",
            nowrap : false,
            idField : "3",
            loadMsg : "努力加载中...",
            pagination : true,
            rownumbers : false,
            singleSelect : false,
            checkOnSelect : false,
            selectOnCheck : false,
            showHeader : true,
            showFooter : true,
            columns:[columns],
            rowStyler: function(index,row){
                if(index%2==0){
                    //return "background-color:#EEEEFF";
                }
            }
        });
    }
</script>

</body>
</html>