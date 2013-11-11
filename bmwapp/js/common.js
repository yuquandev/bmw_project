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

function bulid_upload(){
    $('#divFileProgressContainer').html('');
    $('#thumbnails').html('<img style="margin: 5px; vertical-align: middle; opacity: 1;width: 300px;" src="" />');

    var swfu = new SWFUpload({
        // Backend Settings
        upload_url: "/index.php/admin/upload",
        post_params: {},

        // File Upload Settings
        file_size_limit : "5000",
        file_types : "*.jpg;*.png;*.jpeg;*.bmp;",
        file_types_description : "JPG Images; PNG Image",
        file_upload_limit : 0,

        // Event Handler Settings - these functions as defined in Handlers.js
        //  The handlers are not part of SWFUpload but are part of my website and control how
        //  my website reacts to the SWFUpload events.
        swfupload_preload_handler : preLoad,
        swfupload_load_failed_handler : loadFailed,
        file_queue_error_handler : base_fileQueueError,
        file_dialog_complete_handler : fileDialogComplete,
        upload_progress_handler : uploadProgress,
        upload_error_handler : uploadError,
        upload_success_handler : base_upload_success,
        upload_complete_handler : uploadComplete,

        // Button Settings
        //button_image_url : "images/SmallSpyGlassWithTransperancy_17x18.png",
        button_placeholder_id : "spanButtonPlaceholder",
        button_width: 30,
        button_height:22,
        button_text : '<span class="l-btn" >上传</span>',
        button_text_style : '',
        //button_text_top_padding: 0,
        //button_text_left_padding: 18,
        button_window_mode: SWFUpload.WINDOW_MODE.TRANSPARENT,
        button_cursor: SWFUpload.CURSOR.HAND,

        // Flash Settings
        flash_url : "/js/lib/swfupload/swfupload.swf",
        flash9_url : "/js/lib/swfupload/swfupload_fp9.swf",

        custom_settings : {
            upload_target : "divFileProgressContainer",
            //thumbnail_height: 500,
            //thumbnail_width: 500,
            thumbnail_quality: 100
        },

        // Debug Settings
        debug: false
    });
}

function add_error(id,msg){
    $('#'+id).html(msg);
    $('#'+id+'_style').addClass('error');
    return false;
}

function del_error(id){
    $('#'+id).empty();
    $('#'+id+'_style').removeClass('error');
}

function base_fileQueueError(file, errorCode, message) {
    try {
        var imageName = "error.gif";
        var errorName = "";
        if (errorCode === SWFUpload.errorCode_QUEUE_LIMIT_EXCEEDED) {
            errorName = "您上传的图片超过限制";
        }

        if (errorName !== "") {
            add_error(error_banner,errorName);
            return;
        }

        switch (errorCode) {
            case SWFUpload.QUEUE_ERROR.ZERO_BYTE_FILE:
                imageName = "zerobyte.gif";
                add_error(error_banner,'图片尺寸小于1K，请重新选择图片');
                break;
            case SWFUpload.QUEUE_ERROR.FILE_EXCEEDS_SIZE_LIMIT:
                imageName = "toobig.gif";
                add_error(error_banner,'图片尺寸大于500K，请重新选择图片');
                break;
            case SWFUpload.QUEUE_ERROR.ZERO_BYTE_FILE:
                add_error(error_banner,'请上传正确的格式图片');
            case SWFUpload.QUEUE_ERROR.INVALID_FILETYPE:
                add_error(error_banner,'请上传正确的格式图片');
            default:
                //add_error(error_banner,message);
                break;
        }

        //addImage("images/" + imageName);

    } catch (ex) {
        this.debug(ex);
    }

}

function base_upload_success(file, serverData) {
    try {
        var progress = new FileProgress(file,  this.customSettings.upload_target);
        if (serverData) {
            addImage(serverData);
            $('#t_img_url').val(serverData);

            progress.setStatus("Upload Complete.");
            progress.toggleCancel(false);
        } else if(serverData == '') {
            addImage("images/error.gif");
            progress.setStatus("Error.");
            progress.toggleCancel(false);
            alert(serverData);
        }
    } catch (ex) {
        this.debug(ex);
    }
}


//异步获取datagrid字段
function ajax_get_columns(table,title,id){
    init_main();
    id = id || 0;

    console.log(table.substr(0,10));
    if (table.substr(0,10) == 'image_list'){
        $('#main_button').html('<a href="javascript:void(0)" id="add_btn"></a>');
        bulid_button('add_btn','添加');
        $('#add_btn').click(function(){
            add_topic_img(table.substr(11,10));
        });
    }

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
        loadMsg : "加载中...",
        pagination : true,
        rownumbers : false,
        singleSelect : false,
        checkOnSelect : false,
        selectOnCheck : false,
        showHeader : true,
        showFooter : true,
        columns:[columns],
        rowStyler: function(index,row){
            if (table.substr(0,10) == 'image_list'){
                for (var n in row){
                    if (n == 'id'){
                        var tmp = '{id:'+row['id']+',type_id:'+row['type_id']+',name:\''+row['name']+'\',image_url:\''+row['image_url']+'\',status:'+row['status']+'}';
                    }
                    if (n == 'status' && row['status']==1){
                        row['status'] = '已禁用  <a href="javascript:void(0);" onclick="set_image_stat('+row['id']+','+row['status']+');">启用</a>';
                    }else if(n == 'status' && row['status'] == 0){
                        row['status'] = '已启用  <a href="javascript:void(0);" onclick="set_image_stat('+row['id']+','+row['status']+');">禁用</a>';
                    }
                    if (n == 'image_url'){
                        row[n] = '<img src="'+row[n]+'" height="100" />';
                        row['editor'] = '<a href="javascript:void(0);" onclick="add_topic_img('+row['id']+','+tmp+');">修改</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="confirm_dialog('+row['id']+',\'topic_image\')">删除</a>';
                    }

                }
            }

            if (table.substr(0,10) == 'works_list'){
                for (var n in row){
                    if (n == 'id'){

                    }
                    if (n == 'review' && row['review'] == 0){
                        row['review'] = '已通过  <a href="javascript:void(0);" onclick="set_work_stat('+row['id']+','+row['review']+',\'review\');">关闭</a>';
                    }else if (n == 'review' && row['review'] == 1){
                        row['review'] = '未通过  <a href="javascript:void(0);" onclick="set_work_stat('+row['id']+','+row['review']+',\'review\');">开启</a>';
                    }
                    if (n == 'recommend' && row['recommend'] == 0){
                        row['recommend'] = '已推荐  <a href="javascript:void(0);" onclick="set_work_stat('+row['id']+','+row['recommend']+',\'recommend\');">关闭</a>';
                    }else if (n == 'recommend' && row['recommend'] == 1){
                        row['recommend'] = '未推荐  <a href="javascript:void(0);" onclick="set_work_stat('+row['id']+','+row['recommend']+',\'recommend\');">开启</a>';
                    }
                    if (n == 'vote_num'){
                        row['vote_num'] = row['vote_num']+'票  <a href="javascript:void(0);" onclick="">修改</a>';
                    }
                    if (n == 'img_url'){
                        row[n] = '<img src="'+row[n]+'" height="100" />';
                    }
                }
            }

            if(index%2==0){
                return "background-color:#fff";
            }else {
                return "background-color:#eee";
            }
        }
    });
}

//开启汽车分类对话框
function add_car_dialog(type_id,name) {
    type_id = type_id || 0;
    name = name || '';
    if(type_id > 0){
        $('#car_type_name').val(name);
    }
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
                    data: {name : $('#car_type_name').val(),type_id:type_id},
                    dataType: 'text',
                    beforeSend : function(){
                    },
                    error: function(){
                    },
                    success: function(data){
                        location.href = '/index.php/admin';
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
        id = type_id;
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
                                location.href = '/index.php/admin';
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
            $('#main_button').html('<a href="javascript:void(0)" id="update_btn"></a><a href="javascript:void(0)" id="status_btn"></a><a href="javascript:void(0)" id="del_btn"></a>');
            bulid_button('update_btn','修改');
            bulid_button('del_btn','删除');
            if (data.status == 1){
                bulid_button('status_btn','启动');
                var stat = '已关闭';
            }else if (data.status == 0){
                bulid_button('status_btn','关闭');
                var stat = '已开启';
            }
            bulid_button_line();
            bulid_infodata();

            $('#status_btn').click(function(){
                set_nav_stat(data.id,data.status);
            });

            $('#update_btn').click(function(){
                add_nav_dialog(data.type_id,data);
            });

            $('#del_btn').click(function(){
                confirm_dialog(data.id,'topic_nav');
            });


            $('#infodata').html('<table border="1" "><body><tr><td>状态</td><td>'+stat+'</td></tr><tr><td>名称</td><td>'+data['name']+'</td></tr><tr><td>描述</td><td>'+data['description']+'</td></tr><tr><td>资源</td><td>'+data['media_url']+'</td></tr><tr><td>更新时间</td><td>'+data['update_time']+'</td></tr><tr><td>创建时间</td></td><td>'+data['create_time']+'</td></tr></body></table>');
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

//添加图片
function add_topic_img(type_id,info) {
    type_id = type_id || 0;
    info = info || null;
    var act = '';
    var title = '';
    var id = 0;

    bulid_upload();

    if(!!info){
        act = 'set';
        title = '修改图片';
        id = info.id;
        $('#t_img_name').val(info.name);
        $('#t_img_url').val(info.image_url);
        $('#t_img_stat').val(info.status);
        $('#thumbnails').html('<img style="margin: 5px; vertical-align: middle; opacity: 1;width: 200px;" src="'+info.image_url+'" />');
        $('.combo-value').val(info.status);
        //$('#t_img_stat option')[info.status-1].setAttribute('selected','1');
    }else {
        act = 'add';
        title = '新建图片';
        $('#t_img_name').val('');
        $('#t_img_url').val('');
        $('#t_img_stat').val('');
    }

    $('#t_img_dialog').show();
    $('#t_img_dialog').dialog({
        title:title,
        collapsible: false,
        minimizable: false,
        maximizable: false,
        buttons: [{
            text: '提交',
            iconCls: '',
            handler: function() {
                $.ajax({url: '/index.php/admin/addtimg?_n='+ new Date().getTime(),
                    type: 'POST',
                    data: {id:id,type_id:type_id,name : $('#t_img_name').val(),stat: $('.combo-value').val(),image_url: $('#t_img_url').val(),act:act},
                    dataType: 'json',
                    beforeSend : function(){
                    },
                    error: function(){
                    },
                    success: function(data){
                        //location.href = '/index.php/admin';
                        if (data.status == 'success'){
                            if (act == 'add'){
                                //get_nav_info(data.res);
                                $('#dg').datagrid('reload');
                            }else if (act == 'set'){
                                //get_nav_info(info.id);
                                $('#dg').datagrid('reload');
                            }
                            $('#t_img_dialog').dialog('close');
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
                $('#t_img_dialog').dialog('close');
            }
        }]
    });
}

function set_image_stat(id,stat){
    $.ajax({url: '/index.php/admin/imgstat?_n='+ new Date().getTime(),
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
                $('#dg').datagrid('reload');
            }if (data.status == 'fails'){
                alert('提交失败');
            }
        },
        complete : function(){
        }
    });
}

//设置作品
function set_work_stat(id,stat,act){
    $.ajax({url: '/index.php/admin/workstat?_n='+ new Date().getTime(),
        type: 'POST',
        data: {id : id, stat:stat,act:act},
        dataType: 'json',
        beforeSend : function(){
        },
        error: function(){
        },
        success: function(data){
            //location.href = '/index.php/admin';
            if (data.status == 'success'){
                $('#dg').datagrid('reload');
            }if (data.status == 'fails'){
                alert('提交失败');
            }
        },
        complete : function(){
        }
    });
}

function confirm_dialog(id,act){
    $('#dd').show();
    $('#dd').dialog({
        title: '删除提示',
        width: 220,
        height: 130,
        collapsible: false,
        minimizable: false,
        maximizable: false,
        buttons: [{
            text: '确定',
            iconCls: '',
            handler: function() {
                ajax_del_id(id,act);
            }
        }, {
            text: '取消',
            handler: function() {
                $('#dd').dialog('close');
            }
        }]
    });
}

//删除模块
function ajax_del_id(id,act){
    $.ajax({url: '/index.php/admin/ajaxdelid?_n='+ new Date().getTime(),
        type: 'POST',
        data: {id : id, act : act},
        dataType: 'json',
        beforeSend : function(){
        },
        error: function(){
        },
        success: function(data){
            if (data.status == 'success'){
                if (act == 'car_type'){
                    location.href = '/index.php/admin';
                }else if (act == 'topic_nav'){
                    location.href = '/index.php/admin';
                }else if (act == 'topic_image'){
                    $('#dg').datagrid('reload');
                    $('#dd').dialog('close');
                }
                //$('#dg').datagrid('reload');
            }if (data.status == 'fails'){
                alert('提交失败');
            }
        },
        complete : function(){
        }
    });
}

function ajax_reg_admin(){
    $('#regdialog').show();
    $('#regdialog').dialog({
        collapsible: false,
        minimizable: false,
        maximizable: false,
        buttons: [{
            text: '确定',
            iconCls: '',
            handler: function() {
                $.ajax({url: '/index.php/admin/addadmin?_n='+ new Date().getTime(),
                    type: 'POST',
                    data: {username : $('#reg_username').val(), password : $('#reg_password').val()},
                    dataType: 'json',
                    beforeSend : function(){
                    },
                    error: function(){
                    },
                    success: function(data){
                        if (data.status == 'success'){
                                location.href = '/index.php/admin';
                            //$('#dg').datagrid('reload');
                        }if (data.status == 'fails'){
                            alert(data.msg);
                        }
                    },
                    complete : function(){
                    }
                });
            }
        }, {
            text: '取消',
            handler: function() {
                $('#regdialog').dialog('close');
            }
        }]
    });
}















