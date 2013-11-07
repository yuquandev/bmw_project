//异步获取datagrid字段
function ajax_get_columns(table,title,id){
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
                $('#mydialog').dialog('取消');
            }
        }]
    });
}

//添加导航对话框
function add_nav_dialog(type_id) {
    $('#nav_dialog').show();
    $('#nav_dialog').dialog({
        collapsible: false,
        minimizable: false,
        maximizable: false,
        buttons: [{
            text: '提交',
            iconCls: '',
            handler: function() {
                alert('提交数据');
                $.ajax({url: '/index.php/admin/addnav?_n='+ new Date().getTime(),
                    type: 'POST',
                    data: {id:type_id,name : $('#nav_name').val(),des: $('#nav_des').val(),resource: $('#nav_resource').val()},
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
                $('#nav_dialog').dialog('取消');
            }
        }]
    });
}

function get_nav_info(id){
    $.ajax({url: '/index.php/admin/navinfo?_n='+ new Date().getTime(),
        type: 'POST',
        data: {id:id},
        dataType: 'text',
        beforeSend : function(){
        },
        error: function(){
        },
        success: function(data){
            //location.href = '/index.php/admin';
            $('#infodata').html(data);
        },
        complete : function(){
        }
    });
}
