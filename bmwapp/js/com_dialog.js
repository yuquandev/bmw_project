function com_dialog(act){

    var login_html = ['<div class="zc_tck mydiv" id="popDiv3" style="display:none;">',
        '<div class="zc_tck_title"><span>登陆与注册</span><a href="javascript:closeDiv3()"><img src="/img/bm_gb.jpg" /></a></div>',
        '<div class="zc_tck_main2"><table width="100%" border="0" cellspacing="0" cellpadding="0">',
                '<tr>',
                    '<td height="58" colspan="2"><input name="textfield" id="bm_username" type="text" class="zck_text2"   value="请输入邮箱登陆" onfocus="if (value ==\'请输入邮箱登陆\'){value =\'\'}" onblur="if (value ==\'\'){value=\'请输入邮箱登陆\'}"/></td>',
                '</tr>',
                '<tr>',
                    '<td height="58" colspan="2"><input name="textfield" id="bm_password" type="password" class="zck_text2"    value="请输入密码" onfocus="if (value ==\'请输入密码\'){value =\'\'}" onblur="if (value ==\'\'){value=\'请输入密码\'}"/></td>',
                '</tr>',
                '<tr>',
                    '<td width="35%" height="32"><input name="" type="checkbox" value="" class="zck_k"/><div class="zck_zi">两周内自动登录</div></td>',
                    '<td width="65%" height="32"><div class="zck_wj"><a href="#">其它方式登陆 | </a><a href="#">忘记密码？</a></div></td>',
                '</tr>',
                '<tr>',
                    '<td height="50"><input name="" type="button" class="tck_an2" value="立即登陆" onclick="bm_login();" /></td>',
                    '<td height="50"><input name="" type="button" class="tck_zc" value="注 册" onclick="com_dialog(\'reg\');"/></td>',
                '</tr>',
            '</table>',
        '</div>',
    '</div>'].join('');

    var reg_html = ['<div class="zc_tck mydiv" id="popDiv2"  style="display:none; height:auto;">',
        '<div class="zc_tck_title"><span>注册账号</span><a href="javascript:closeDiv2()"><img src="/img/bm_gb.jpg" /></a></div>',
        '<div class="zc_tck_main"><table width="100%" border="0" cellspacing="0" cellpadding="0">',
                '<tr><td width="13%" height="42" align="right" valign="middle"><strong>用户名：</strong></td>',
                    '<td width="42%" height="42" align="left" valign="middle"><input id="reg_username" name="" type="text" class="zck_text3"/></td>',
                    '<td width="45%" height="42" align="left" valign="middle"><div class="tck_pd tck_pd2"><img src="images/tck_pic.jpg" style="display:none"/><span>请输入用户或邮箱</span></div></td></tr>',
        '<tr><td height="42" align="right" valign="middle"><strong>姓名：</strong></td>',
        '<td height="42" align="left" valign="middle"><input id="reg_nickname" name="" type="text" class="zck_text3"/></td>',
        '<td height="42" align="left" valign="middle"><div class="tck_pd tck_pd2"><img src="images/tck_pic.jpg" style="display:none"/><span>请输入真实姓名</span></div></td>',
        '</tr><tr><td height="42" align="right" valign="middle"><strong>手机：</strong></td>',
                    '<td height="42" align="left" valign="middle"><input id="reg_telephone" name="" type="text" class="zck_text3"/></td>',
                    '<td height="42" align="left" valign="middle"><div class="tck_pd tck_pd2"><img src="images/tck_pic.jpg" style="display:none"/><span>请输入手机号码</span></div></td></tr>',
                '<tr><td height="42" align="right" valign="middle"><strong>设置密码：</strong></td>',
                    '<td height="42" align="left" valign="middle"><input id="reg_password" name="" type="password" class="zck_text3"/></td>',
                    '<td height="42" align="left" valign="middle"><div class="tck_pd2"><img src="images/tck_pic.jpg" style="display:none"/><span>密码长度8~16位，数字、字母、<br />字符至少包含两种</span></div></td></tr>',
                '<tr><td height="42" align="right" valign="middle"><strong>确认密码：</strong></td>',
                    '<td height="42" align="left" valign="middle"><input id="reg_password_confim" name="" type="password" class="zck_text3"/></td>',
                    '<td height="42" align="left" valign="middle"><div class="tck_pd2"><img src="images/tck_pic.jpg" style="display:none"/><span></span></div></td>',
                '</tr><!--<tr><td height="50" align="right" valign="middle"><strong>验证码：</strong></td>'+
                    '<td height="50" align="left" valign="middle"><input name="" type="text" class="zck_text3" style="width:85px;float:left;"/><img src="images/tck_yzm.jpg" style="float:left;margin-left:17px;"/></td>',
                    '<td height="50" align="left" valign="middle"><div class="tck_pd"><img src="images/tck_pic.jpg" style="display:none"/><span>点击图片刷新验证码</span></div></td></tr>-->',
                '<tr><td height="42" align="right" valign="middle">&nbsp;</td>',
                    '<td height="42" align="left" valign="middle"><input onclick="bm_reg();return false;" name="" type="button" class="tck_an" value="立即注册"/></td>',
                    '<td height="42" align="left" valign="middle">&nbsp;</td></tr>',
            '</table>',
        '</div>',
    '</div>'].join('');

    var uploads_html = ['<div class="zc_tck mydiv" id="popDiv" style="display:none;">',
        '<div class="zc_tck_title"><span>上传图片</span><a href="javascript:closeDiv()"><img src="/img/bm_gb.jpg" /></a></div>',
        '<div class="zc_tck_main3">',
        '<table width="100%" border="0" cellspacing="0" cellpadding="0">',
        '<tr>',
        '<td width="15%" height="40" align="right" valign="middle"><strong>标题：</strong></td>',
        '<td width="59%" height="40" align="left" valign="middle"><input name="" type="text" class="zck_text4"/></td>',
        '<td width="26%" height="40" align="left" valign="middle">&nbsp;</td>',
        '</tr>',
        '<tr>',
        '<td height="40" align="right" valign="middle"><strong>图片地址：</strong></td>',
        '<td height="40" align="left" valign="middle"><div id="divFileProgressContainer" style="display: none;"></div><input name="" type="text" class="zck_text4" id="bm_uploads_name"/><input type="hidden" id="bm_uploads_url" value="" /></td>',
        '<td height="40" align="left" valign="middle"><div id="spanButtonPlaceholder"></div></td>',
        '</tr>',
        '<tr>',
        '<td height="100" align="right" valign="top"><strong>活动宣言：</strong></td>',
        '<td height="100" align="left" valign="middle"><textarea name="" cols="" rows="" class="zck_xy"></textarea></td>',
        '<td height="100" align="left" valign="middle">&nbsp;</td>',
        '</tr>',
        '</table>',
        '<div style="padding-left: 80px;"><input name="" type="button" class="tck_an" value="立即提交" style="margin-left:0" />',
            '<div id="thumbnails" >',
            '<img style="margin: 5px; vertical-align: middle; opacity: 1;width: 200px;" src="" /></div>',
            '</div></div>',
        '</div>'].join('');

    if (act == 'login'){
        $('#com_dialog').html(login_html);
        showDiv3();
    }else if (act == 'reg'){
        $('#com_dialog').html(reg_html);
        showDiv2();
    }else if (act = 'uploads'){
        $('#com_dialog').html(uploads_html);
        showDiv();
        bulid_upload();
    }
}

function bm_login(){
    $.ajax({url: '/index.php/user/ajax_login?_n='+ new Date().getTime(),
        type: 'POST',
        data: {username : $('#bm_username').val(), password : $('#bm_password').val()},
        dataType: 'json',
        beforeSend : function(){
        },
        error: function(){
        },
        success: function(data){
            if (data['status'] == 'success'){
                //alert(data['msg']);
                window.location.reload();
            }else if(data['status'] == 'falis'){
                alert(data['msg']);
            }
        },
        complete : function(){
        }
    });
}
function bm_reg(){
    $.ajax({url: '/index.php/user/ajax_join?_n='+ new Date().getTime(),
        type: 'POST',
        data: {username : $('#reg_username').val(),nickname:$('reg_nickname').val(), password : $('#reg_password').val(),password_confim : $('#reg_password_confim').val(),telephone: $('#reg_telephone').val()},
        dataType: 'json',
        beforeSend : function(){
        },
        error: function(){
        },
        success: function(data){
            if (data['status'] == 'success'){
                //alert(data['msg']);
                window.location.reload();
            }else if(data['status'] == 'falis'){
                alert(data['msg']);
            }
        },
        complete : function(){
        }
    });
}

function uplodedata()
{
    var title = $("#bmw_title").val();	
    var file  = $("#img_file").val();
    var text  =  $("#bmw_text").val();
    if(title == ''){
        alert('请输入标题'); return false;
    }
    if(file == ''){
        alert('请长传张图片吧'); return false;
    }
    if(text ==''){
    	alert('说点什么吧。'); return false;
    }
    
    
    false;
}

function bulid_upload(){
    $('#divFileProgressContainer').html('');
    $('#thumbnails').html('<img style="margin: 5px; vertical-align: middle; opacity: 1;width: 300px;" src="" />');

    var swfu = new SWFUpload({
        // Backend Settings
        upload_url: "/index.php/index/uploads",
        post_params: {},

        // File Upload Settings
        file_size_limit : "500",
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
        button_width: 53,
        button_height:28,
        button_text : '<span class="zck_ll"  >上传</span>',
        button_text_style : '',
        button_text_top_padding: 8,
        //button_text_left_padding: 18,
        button_window_mode: SWFUpload.WINDOW_MODE.TRANSPARENT,
        button_cursor: SWFUpload.CURSOR.HAND,

        // Flash Settings
        flash_url : "/js/lib/swfupload/swfupload.swf",
        flash9_url : "/js/lib/swfupload/swfupload_fp9.swf",

        custom_settings : {
            upload_target : "divFileProgressContainer",
            thumbnail_height: 200,
            thumbnail_width: 200,
            thumbnail_quality: 100
        },

        // Debug Settings
        debug: false
    });
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
            $('#divFileProgressContainer').css("display","none");
            $('#bm_uploads_name').val($('.progressName').html());
            $('#bm_uploads_url').val(serverData);
            $('#popDiv').css('height','444px');
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
