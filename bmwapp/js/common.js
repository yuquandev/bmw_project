function init_main(){
    $('#main_view').html('<div id="main_button"></div><div id="infodata"></div><div id="dg" class="easyui-datagrid" ></div>');
}

function bulid_button(id,text){
    $('#'+id).html(text);
    $('#'+id).linkbutton({
    });
    $('#'+id).css('margin','10px');
}

function bulid_button_line(){
    $('#main_button').css('border-bottom','2px solid #eee');
}

function bulid_infodata(){
    $('#infodata').css('padding','10px');
}

//异步获取datagrid字段
function ajax_get_columns(table,title,id){
    init_main();
    id = id || 0;
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

            reload_datagrid(table,title,columns,id);
        },
        complete : function(){
        }
    });
}


//异步获取datagrid数据
function reload_datagrid(table,title,columns,id){
    console.log(table);
    $('#dg').datagrid({
        title : title,
        url:'/index.php/admin/datajson?act='+table+'&id='+id,
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

//开启汽车分类对话框
function add_car_dialog() {
    $('#mydialog').show();
    $('#mydialog').dialog({
        collapsible: false,
        minimizable: false,
        maximizable: false,
        buttons: [{
            text: '提交',
            iconCls: '',
            handler: function() {
                $.ajax({url: '/index.php/admin/addcardtype?_n='+ new Date().getTime(),
                    type: 'POST',
                    data: {name : $('#car_type_name').val()},
                    dataType: 'text',
                    beforeSend : function(){
                    },
                    error: function(){
                    },
                    success: function(data){
                        //location.href = '/index.php/admin';
                    },
                    complete : function(){
                    }
                });
            }
        }, {
            text: '取消',
            handler: function() {
                $('#mydialog').dialog('close');
            }
        }]
    });
}

//添加导航对话框
function add_nav_dialog(type_id,info) {
    type_id = type_id || 0;
    info = info || null;
    var act = '';
    var title = '';
    var id = 0;
    if(!!info){
        id = info.id;
        act = 'set';
        title = '修改导航';
        $('#nav_name').val(info.name);
        $('#nav_des').val(info.description);
        $('#nav_resource').val(info.media_url);
    }else {
        id = type_id
        act = 'add';
        title = '新建导航';
        $('#nav_name').val('');
        $('#nav_des').val('');
        $('#nav_resource').val('');
    }
    $('#nav_dialog').show();
    $('#nav_dialog').dialog({
        title:title,
        collapsible: false,
        minimizable: false,
        maximizable: false,
        buttons: [{
            text: '提交',
            iconCls: '',
            handler: function() {
                $.ajax({url: '/index.php/admin/addnav?_n='+ new Date().getTime(),
                    type: 'POST',
                    data: {id:id,name : $('#nav_name').val(),des: $('#nav_des').val(),resource: $('#nav_resource').val(),act:act},
                    dataType: 'json',
                    beforeSend : function(){
                    },
                    error: function(){
                    },
                    success: function(data){
                        //location.href = '/index.php/admin';
                        if (data.status == 'success'){
                            if (act == 'add'){
                                get_nav_info(data.res);
                            }else if (act == 'set'){
                                get_nav_info(info.id);
                            }
                            $('#nav_dialog').dialog('close');
                        }if (data.status == 'fails'){
                            alert('提交失败');
                        }
                    },
                    complete : function(){
                    }
                });
            }
        }, {
            text: '取消',
            handler: function() {
                $('#nav_dialog').dialog('close');
            }
        }]
    });
}

//展示导航数据
function get_nav_info(id){
    init_main();
    $.ajax({url: '/index.php/admin/navinfo?_n='+ new Date().getTime(),
        type: 'POST',
        data: {id:id},
        dataType: 'json',
        beforeSend : function(){
        },
        error: function(){
            //location.href = '/index.php/admin';
        },
        success: function(data){
            //location.href = '/index.php/admin';
            $('#main_button').html('<a href="javascript:void(0)" id="update_btn"></a><a href="javascript:void(0)" id="status_btn"></a>');
            bulid_button('update_btn','更新');
            if (data.status == 1){
                bulid_button('status_btn','启动');
            }else if (data.status == 2){
                bulid_button('status_btn','关闭');
            }
            bulid_button_line();
            bulid_infodata();

            $('#status_btn').click(function(){
                set_nav_stat(data.id,data.status);
            });

            $('#update_btn').click(function(){
                add_nav_dialog(data.type_id,data);
            });

            $('#infodata').html('<table border="1" "><body><tr><td>名称</td><td>'+data['name']+'</td></tr><tr><td>描述</td><td>'+data['description']+'</td></tr><tr><td>资源</td><td>'+data['media_url']+'</td></tr><tr><td>更新时间</td><td>'+data['update_time']+'</td></tr><tr><td>创建时间</td></td><td>'+data['create_time']+'</td></tr></body></table>');
        },
        complete : function(){
        }
    });
}

function set_nav_stat(id,stat){
    $.ajax({url: '/index.php/admin/navstat?_n='+ new Date().getTime(),
        type: 'POST',
        data: {id : id, stat:stat},
        dataType: 'json',
        beforeSend : function(){
        },
        error: function(){
        },
        success: function(data){
            //location.href = '/index.php/admin';
            if (data.status == 'success'){
                get_nav_info(id);
            }if (data.status == 'fails'){
                alert('提交失败');
            }
        },
        complete : function(){
        }
    });
}













