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
                    '<!--<td width="65%" height="32"><div class="zck_wj"><a href="#">其它方式登陆 | </a><a href="#">忘记密码？</a></div></td>-->',
                '</tr>',
                '<tr>',
                '<span id="login_text"></span>',
                '</tr>',
                '<tr>',
                    '<td height="50"><input name="" type="button" class="tck_an2" value="立即登陆" onclick="bm_login();" /></td>',
                    '<td height="50"><input name="" type="button" class="tck_zc" value="注 册" onclick="com_dialog(\'reg\');"/></td>',
                '</tr>',
            '</table>',
        '</div>',
    '</div>'].join('');

    var reg_html =  ['<div class="zc_tck mydiv" id="popDiv2"  style="display:none;">',
              	   	 '<div class="zc_tck_title"><span>注册账号</span><a href="javascript:closeDiv2()"><img src="/img/bm_gb.jpg" /></a></div>',
                     '<div class="zc_tck_main" style="padding-top:5px;">',
               	     '<table width="100%" border="0" cellspacing="0" cellpadding="0">',
                     '<tr>',
                     '<td width="13%" height="42" align="right" valign="middle">',
           			 '<strong>用户名：</strong>',
           			 '</td>',
                     '<td width="42%" height="42" align="left" valign="middle">',
           			 '<input name="" id="reg_username" type="text" class="zck_text3" onblur="bm_reg();"/>',
           			 '</td>',
                     '<td width="45%" height="42" align="left" valign="middle">',
           			 '<div class="tck_pd tck_pd2">',
           			 '<span id="reg_name"></span></div></td>',
                     '</tr>',
           			 '<tr>',  
           			 '<td width="13%" height="42" align="right" valign="middle"><strong> 真实姓名：</strong></td>',
                     '<td width="42%" height="42" align="left" valign="middle"><input id="reg_nickname" name="" onblur="bm_reg();" type="text" class="zck_text3"/></td>',
                     '<td width="45%" height="42" align="left" valign="middle"><div class="tck_pd tck_pd2"><span id="reg_nkname"></span></div></td></tr>',
                     '<tr>',
                     '<td height="42" align="right" valign="middle"><strong>手机：</strong></td>',
                     '<td height="42" align="left" valign="middle"><input name="" id="reg_telephone" onblur="bm_reg();" type="text" class="zck_text3"/></td>',
                     '<td height="42" align="left" valign="middle"><div class="tck_pd tck_pd2"><span id="reg_phone"></span></div></td>',
                     '</tr>',
                     '<tr>',
                     '<td height="42" align="right" valign="middle"><strong>设置密码：</strong></td>',
                     '<td height="42" align="left" valign="middle"><input name="" type="password" id="reg_password" onblur="bm_reg();" class="zck_text3"/></td>',
                     '<td height="42" align="left" valign="middle"><div class="tck_pd2"><span id="reg_pwd"></span></div></td>',
                     '</tr>',
                     '<tr>',
                     '<td height="42" align="right" valign="middle"><strong>确认密码：</strong></td>',
                     '<td height="42" align="left" valign="middle"><input name="" type="password" id="reg_password_confim" class="zck_text3" onblur="bm_reg();"/></td>',
                     '<td height="42" align="left" valign="middle"><div class="tck_pd2"><span id="reg_cpwd"></span></div></td>',
                     '</tr>',
                     '<tr>',
                     '<td height="50" align="right" valign="middle"><strong>验证码：</strong></td>',
                     '<td height="50" align="left" valign="middle"><input name="" id="vcode_value" type="text" class="zck_text3" style="width:85px;float:left;"/><a href="javascript:void(0);" onclick="lvcode();"><img src="/index.php/api/vcode" id="vcode" style="float:left;margin-left:17px;"/></a></td>',
                     '<td height="50" align="left" valign="middle"><div class="tck_pd"><span id="reg_vcode">点击图片刷新验证码</span></div></td>',
                     '</tr>',
                     '<tr>',
                     '<td height="42" align="right" valign="middle">&nbsp;</td>',
                     '<td height="42" align="left" valign="middle"><input name="" type="button" class="tck_an" onclick="bm_reg();"  value="立即注册"/></td>',
                     '<td height="42" align="left" valign="middle">&nbsp;</td>',
                     '</tr>',
                     '</table>',
                     '</div>',
                     '</div>'].join('');

    var uploads_html = ['<style>.progressName {display: none;} .progressBarComplete{background: #0099ff;height:3px;width:276px;}</style><div class="zc_tck mydiv" id="popDiv" style="display:none;">',
        '<div class="zc_tck_title"><span>上传图片</span><a href="javascript:closeDiv()"><img src="/img/bm_gb.jpg" /></a></div>',
        '<div class="zc_tck_main3">',
        '<table width="100%" border="0" cellspacing="0" cellpadding="0">',
        '<tr>',
        '<td width="15%" height="40" align="right" valign="middle"><strong>标题：</strong></td>',
        '<td width="59%" height="40" align="left" valign="middle"><input name="" id="bmw_title" type="text" class="zck_text4"/></td>',
        '<td width="26%" height="40" align="left" valign="middle"><span id="pop_title" style="color:red;"></span></td>',
        '</tr>',
        '<tr>',
        '<td height="40" align="right" valign="middle"><strong>图片地址：</strong></td>',
        '<td height="40" align="left" valign="middle"><input name="" type="text" class="zck_text4" id="bm_uploads_name"/><input type="hidden" id="bm_uploads_url" value="" /></td>',
        '<td width="30%" height="26"><span id="progressBarStatus_loding"></span><div id="spanButtonPlaceholder"></div><span id="pop_img" style="color:red;"></span></td>',
        '</tr>',
        '<tr><td width="15%" align="right" valign="top"></td><td width="59%" align="left" valign="middle"><div id="divFileProgressContainer" ></div></td></tr>',
        '<tr>',
        '<td width="15%" height="40" align="right" valign="top"><strong>活动宣言：</strong></td>',
        '<td width="59%" height="40" align="left" valign="middle"><textarea name="" id="textconten"  cols="" rows="" class="zck_xy"></textarea></td>',
        '<td width="26%" height="40" align="left" valign="middle"><div id="thumbnails" style="width:100px;height:100px;" ><img style="margin: 5px; vertical-align: middle; opacity: 1;width: 100px;" src="" /></div></td>',
        '</tr>',
        '</table>',
        '<div style="padding-left: 80px;margin-top:15px;"><input name="" type="button" class="tck_an" value="立即提交" style="margin-left:0" onclick="uplodedata();"/>',
            '</div></div>',
        '</div>'].join('');

    if (act == 'login'){
        $('#com_dialog').html(login_html);
        showDiv3();
    }else if (act == 'reg'){
        $('#com_dialog').html(reg_html);
        showDiv2();
    }else if (act = 'uploads'){
        $('#uplode_img').html(uploads_html);
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
            	$("#login_text").html('<span style="color:red;">'+data['msg']+'</span>');
            }
        },
        complete : function(){
        }
    });
}
function bm_reg(){
	
    if( $("#reg_username").val() == '' )
    {
    	 $("#reg_name").html('<img src="/img/tck_pic.jpg" />请输入用户名'); 
    	 return false;
    }else{
    	 $("#reg_name").html('<img src="/img/bm_tck_dg.jpg" />');
    }
	if( $("#reg_nickname").val() == '' )
    {
    	 $("#reg_nkname").html('<img src="/img/tck_pic.jpg" />请输入真实姓名');
    	 return false;
    }else{
    	$("#reg_nkname").html('<img src="/img/bm_tck_dg.jpg" />');
    }
	if( $("#reg_telephone").val() == '' )
    {
    	 $("#reg_phone").html('<img src="/img/tck_pic.jpg" />请输入手机号');
    	 return false;
    }else{
    	var regphone = /1(?:[38]\d|4[57]|5[01256789])\d{8}/;
        if(!regphone.test($("#reg_telephone").val()))
        {
        	$("#reg_phone").html('<img src="/img/tck_pic.jpg" />请输入有效的手机号');
            return false;
        }
    	$("#reg_phone").html('<img src="/img/bm_tck_dg.jpg" />');
    }
	if( $("#reg_password").val() == '' ){
    	$("#reg_pwd").html('<img src="/img/tck_pic.jpg" />请输入密码');
   	    return false;
    }else{
    	var eig_pwd =  /^(?!\D+$)(?![^a-zA-Z]+$)\S{8,16}$/; 
    	if(!eig_pwd.test($("#reg_password").val()))
   	    {
   	    	$("#reg_pwd").html('<img src="/img/tck_pic.jpg" />密码长度8~16位,包含数字、字母');
   	        return false;
   	    }
    	$("#reg_pwd").html('<img src="/img/bm_tck_dg.jpg" />');
    }
	if( $("#reg_password_confim").val() == '' ){
    	$("#reg_cpwd").html('<img src="/img/tck_pic.jpg" />请再次请输入密码');
   	    return false;
    }else{
    	$("#reg_cpwd").html('<img src="/img/bm_tck_dg.jpg" />');
    }
	if($("#reg_password").val() != $("#reg_password_confim").val())
	{
	 	$("#reg_cpwd").html('<img src="/img/tck_pic.jpg" />俩次输入的密码不一样');
   	    return false;
    }else{
    	$("#reg_cpwd").html('<img src="/img/bm_tck_dg.jpg" />');
    }
	

	if($("#vcode_value").val() == '')
    {   
		$("#reg_vcode").html('<img src="/img/tck_pic.jpg" />请输入验证码');
   	    return false;
    }else{
    	var url = '/index.php/api/regvcode?_j='+ new Date().getTime();
    	$.ajax({'url':url,'async':false,'data':{'vcode':$("#vcode_value").val()},'dataType':'json',
    	'success':function(rs){
    	       if( rs.status == 'false' )
               {
                  var vcode = false;	   
                  $("#reg_vcode").html('<img src="/img/tck_pic.jpg" />请输入正确的验证码');
               }else{  
            	  $("#reg_vcode").html('<img src="/img/bm_tck_dg.jpg" />');
               }
    	   }     
    	});
    	if( vcode == false ) return false;
    	
    }
	
	
	
	$.ajax({url: '/index.php/user/ajax_join?_n='+ new Date().getTime(),
        type: 'POST',
        data: {username : $('#reg_username').val(),nickname:$('#reg_nickname').val(), password : $('#reg_password').val(),password_confim : $('#reg_password_confim').val(),telephone: $('#reg_telephone').val()},
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
            	closeDiv2();
            	pop_msg(data['msg']);
            }
        },
        complete : function(){
        }
    });
}

function add_error(id,msg){
    $('#'+id).html(msg);
    $('#'+id).css('color','#ff0000');
    return false;
}

function uplodedata()
{
    var title = $("#bmw_title").val();	
    var file  = $("#bm_uploads_url").val();
    var text  = $("#textconten").val();
    var ty    = $("#ty_id").val();
    if(title == ''){
    	 $("#pop_title").html('请填写作品标题!'); 
    	 return false;
    }else{
    	$("#pop_title").html('<img src="/img/bm_tck_dg.jpg" />');
    }
    if(file == ''){
    	$("#pop_img").html('请上传作品!');
    	return false;
    }else{
    	$("#pop_img").html('<img src="/img/bm_tck_dg.jpg" />');
    }
    if(text ==''){
      	$("#pop_text").html('请描述活动宣言!');
    //	return false;
    }else{
    	$("#pop_text").html('<img src="/img/bm_tck_dg.jpg" />');
    }
    var url = '/index.php/api/uplodewords?_j='+ new Date().getTime();
	$.ajax({'url':url,'data':{'title':title,'file':file,'text':text,'type':ty},type: 'POST','dataType':'json',
	'success':function(rs){
	    if(rs.status =='true'){
	    	 $("#popDiv").css('display','none');
	    	 pop_msg('上传成功，请等待审核!');
	    	 //window.location.relode();
	    }else{
	    	 pop_msg('上传失败，请重新上传!');
	    }
	}
	});
    
   return  false;
}
function bulid_upload(){
    $('#divFileProgressContainer').html('');
    $('#thumbnails').html('<img style="margin: 5px; vertical-align: middle; opacity: 1;width: 100px;" src=""/>');
    var swfu = new SWFUpload({
        // Backend Settings
        upload_url: "/index.php/index/uploads",
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
        upload_progress_handler : base_uploadProgress,
        upload_error_handler : uploadError,
        upload_success_handler : base_upload_success,
        upload_complete_handler : base_uploadComplete,

        // Button Settings
        button_image_url : "/img/bm_tp_pic.jpg",
        button_placeholder_id : "spanButtonPlaceholder",
        button_width :53,
        button_height:29,
        button_text : '<span class="upload_button">浏       览</span>',
        button_text_style : '.upload_button{border:1px solid #a0a0a2; font-size:12px; color:#FFFFFF;  text-align:center;}',
        button_text_top_padding: 8,
        //button_text_left_padding: 18,
        button_window_mode: SWFUpload.WINDOW_MODE.TRANSPARENT,
        button_cursor: SWFUpload.CURSOR.HAND,

        // Flash Settings
        flash_url : "/js/lib/swfupload/swfupload.swf",
        flash9_url : "/js/lib/swfupload/swfupload_fp9.swf",

        custom_settings : {
            upload_target : "divFileProgressContainer",
            //thumbnail_height: 200,
            //thumbnail_width: 200,
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
            add_error('pop_img',errorName);
            return;
        }

        switch (errorCode) {
            case SWFUpload.QUEUE_ERROR.ZERO_BYTE_FILE:
                imageName = "zerobyte.gif";
                add_error('pop_img','图片尺寸小于1K，请重新选择图片');
                break;
            case SWFUpload.QUEUE_ERROR.FILE_EXCEEDS_SIZE_LIMIT:
                imageName = "toobig.gif";
                add_error('pop_img','图片尺寸大于500K，请重新选择图片');
                break;
            case SWFUpload.QUEUE_ERROR.ZERO_BYTE_FILE:
                add_error('pop_img','请上传正确的格式图片');
            case SWFUpload.QUEUE_ERROR.INVALID_FILETYPE:
                add_error('pop_img','请上传正确的格式图片');
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
            //$('#divFileProgressContainer').css("display","none");
            $('#bm_uploads_name').val($('.progressName').html());
            $('#bm_uploads_url').val(serverData);
            $('#popDiv').css('height','380px');
            $('#thumbnails img')[0].style.width='100px';
            $('#thumbnails img')[0].style.height='90px';
            progress.setStatus("文件上传成功");
            progress.toggleCancel(false,this);
        } else if(serverData == '') {
        	
        	//addImage("images/error.gif");
            
            progress.toggleCancel(false,this);
            //alert(serverData);
        }
    } catch (ex) {
        this.debug(ex);
    }
}

function base_uploadProgress(file, bytesLoaded) {

    try {
        $('.progressBarStatus').show();
        $('#progressBarStatus_loding').show().html('<img src="/img/loading.gif" width="20" height="20">');
        
        var percent = Math.ceil((bytesLoaded / file.size) * 100);
        var progress = new FileProgress(file,  this.customSettings.upload_target);
        progress.setProgress(percent);
        progress.setStatus("上传中...");
        progress.toggleCancel(true, this);
    } catch (ex) {
        this.debug(ex);
    }
}

function base_uploadComplete(file) {
    try {
        /*  I want the next upload to continue automatically so I'll call startUpload here */
        if (this.getStats().files_queued > 0) {
            this.startResizedUpload(this.getFile(0).ID, this.customSettings.thumbnail_width, this.customSettings.thumbnail_height, SWFUpload.RESIZE_ENCODING.JPEG, this.customSettings.thumbnail_quality, false);
        } else {
            var progress = new FileProgress(file,  this.customSettings.upload_target);
            $('#progressBarStatus_loding').hide();
            progress.setComplete();
            progress.setStatus("上传成功");
            progress.toggleCancel(false);
        }
    } catch (ex) {
        this.debug(ex);
    }
}

//投票
function top_vote(wid,num)
{
	var url = '/index.php/api/vote?_j=' + new Date().getTime();
	$.ajax({'url':url,'async':false,'data':{'wid':wid},'dataType':'json',
	'success':function(rs){
	    if(rs == 1){

            $('#vote_'+wid).html(parseInt(num) + 1);
            pop_msg('恭喜你，投票成功!');
            //pop_msg2();
    	}else if(rs == 2){
    		pop_msg('投票失败，请不要恶意投票!');
	    }else{
	    	pop_msg('你已经投过票了!');
	    }
	}
	});
}
//更换验证码
function lvcode()
{
	document.getElementById('vcode').src='/index.php/api/vcode?_j='+Math.random();	
}



function pop_msg(msg)
{
    var pop = ['<div class="bm_tp_tck mydiv" id="popDiv4" style="display">',
               '<div class="bm_tck_title"><span>提示</span><a href="javascript:closeDiv4()">X</a></div>',
               '<div class="bm_tck_main">',
	           '<div class="bm_main_sm">',
               '<img src="/img/bm_tck_pic.jpg" />',
	           '<span>'+msg+'</span>',
	           '</div>',
               '<div class="bm_main_an">',
               '<input  type="button" class="bm_tck_an" value="确 定" onclick="closeDiv4();" /></div>',
               '</div>',
               '</div>'].join('');	
   $("#popmsg").html(pop);     
}

//加分享提示
function pop_msg2()
{
    var pop = ['<div class="bm_tp_tck mydiv"  id="popDiv5" style="display:block;">',
               	'<div class="bm_tck_title">',
     			'<span>提示</span>',
     			'<a href="javascript:closeDiv5();">X</a></div>',
     			'<div class="bm_tck_main2">',
     			'<div class="bm_main_sm2">',
     			'<img src="/img/bm_tck_pic.jpg" />',
     			'<span>恭喜你，投票成功！<br />(分享此图片，有更多礼品哦！)</span>',
     			'</div>',
     			'<div class="bm_main_an2">',
     			'<input name="" type="button" class="bm_tck_an2" value="确 定" onclick="closeDiv5();"/>',
                '<wb:share-button addition="simple" type="button"></wb:share-button>',
     			'</div>',
                '</div>',
'</div>'].join('');	
   $("#popmsg2").html(pop);     
}

