function com_dialog(act){

    var login_html = ['<div class="zc_tck mydiv" id="popDiv3" style="display:none;">',
        '<div class="zc_tck_title"><span>登陆与注册</span><a href="javascript:closeDiv3()"><img src="/img/bm_gb.jpg" /></a></div>',
        '<div class="zc_tck_main2"><table width="100%" border="0" cellspacing="0" cellpadding="0">',
                '<tr>',
                    '<td height="58" colspan="2"><input name="textfield" id="bm_username" type="text" class="zck_text2"   value="请输入邮箱登陆" onfocus="if (value ==\'请输入邮箱登陆\'){value =\'\'}" onblur="if (value ==\'\'){value=\'请输入邮箱登陆\'}"/></td>',
                '</tr>',
                '<tr>',
                    '<td height="58" colspan="2"><input name="textfield" id="bm_password" type="text" class="zck_text2"    value="请输入密码" onfocus="if (value ==\'请输入密码\'){value =\'\'}" onblur="if (value ==\'\'){value=\'请输入密码\'}"/></td>',
                '</tr>',
                '<tr>',
                    '<td width="35%" height="32"><input name="" type="checkbox" value="" class="zck_k"/><div class="zck_zi">两周内自动登录</div></td>',
                    '<td width="65%" height="32"><div class="zck_wj"><a href="#">其它方式登陆 | </a><a href="#">忘记密码？</a></div></td>',
                '</tr>',
                '<tr>',
                    '<td height="50"><input name="" type="button" class="tck_an2" value="立即登陆" onclick="bm_login();" /></td>',
                    '<td height="50"><input name="" type="button" class="tck_zc" value="注 册"/></td>',
                '</tr>',
            '</table>',
        '</div>',
    '</div>'].join('');

    var reg_html = '<div class="zc_tck mydiv" id="popDiv2"  style="display:none;">'+
        '<div class="zc_tck_title"><span>注册账号</span><a href="javascript:closeDiv2()"><img src="/img/bm_gb.jpg" /></a></div>'+
        '<div class="zc_tck_main">'+
            '<table width="100%" border="0" cellspacing="0" cellpadding="0">'+
                '<tr>'+
                    '<td width="13%" height="42" align="right" valign="middle"><strong>用户名：</strong></td>'+
                    '<td width="42%" height="42" align="left" valign="middle"><input name="" type="text" class="zck_text3"/></td>'+
                    '<td width="45%" height="42" align="left" valign="middle"><div class="tck_pd tck_pd2"><img src="images/tck_pic.jpg" style="display:none"/><span>请输入用户或邮箱</span></div></td>'+
                '</tr>'+
        '<tr>'+
        '<td height="42" align="right" valign="middle"><strong>姓名：</strong></td>'+
        '<td height="42" align="left" valign="middle"><input name="" type="text" class="zck_text3"/></td>'+
        '<td height="42" align="left" valign="middle"><div class="tck_pd tck_pd2"><img src="images/tck_pic.jpg" style="display:none"/><span>请输入真实姓名</span></div></td>'+
        '</tr>'+
                '<tr>'+
                    '<td height="42" align="right" valign="middle"><strong>手机：</strong></td>'+
                    '<td height="42" align="left" valign="middle"><input name="" type="text" class="zck_text3"/></td>'+
                    '<td height="42" align="left" valign="middle"><div class="tck_pd tck_pd2"><img src="images/tck_pic.jpg" style="display:none"/><span>请输入手机号码</span></div></td>'+
                '</tr>'+
                '<tr>'+
                    '<td height="42" align="right" valign="middle"><strong>设置密码：</strong></td>'+
                    '<td height="42" align="left" valign="middle"><input name="" type="password" class="zck_text3"/></td>'+
                    '<td height="42" align="left" valign="middle"><div class="tck_pd2"><img src="images/tck_pic.jpg" style="display:none"/><span>密码长度8~16位，数字、字母、<br />字符至少包含两种</span></div></td>'+
                '</tr>'+
                '<tr>'+
                    '<td height="42" align="right" valign="middle"><strong>确认密码：</strong></td>'+
                    '<td height="42" align="left" valign="middle"><input name="" type="password" class="zck_text3"/></td>'+
                    '<td height="42" align="left" valign="middle"><div class="tck_pd2"><img src="images/tck_pic.jpg" style="display:none"/><span></span></div></td>'+
                '</tr>'+
                '<!--<tr>'+
                    '<td height="50" align="right" valign="middle"><strong>验证码：</strong></td>'+
                    '<td height="50" align="left" valign="middle"><input name="" type="text" class="zck_text3" style="width:85px;float:left;"/><img src="images/tck_yzm.jpg" style="float:left;margin-left:17px;"/></td>'+
                    '<td height="50" align="left" valign="middle"><div class="tck_pd"><img src="images/tck_pic.jpg" style="display:none"/><span>点击图片刷新验证码</span></div></td>'+
                '</tr>-->'+
                '<tr>'+
                    '<td height="42" align="right" valign="middle">&nbsp;</td>'+
                    '<td height="42" align="left" valign="middle"><input name="" type="button" class="tck_an" value="立即注册"/></td>'+
                    '<td height="42" align="left" valign="middle">&nbsp;</td>'+
                '</tr>'+
            '</table>'+
        '</div>'+
    '</div>';


    if (act == 'login'){
        $('#com_dialog').html(login_html);
        showDiv3();
    }else if (act == 'reg'){
        $('#com_dialog').html(reg_html);
        showDiv2();
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
                location.href = location.href;
            }else if(data['status'] == 'falis'){
                alert(data['msg']);
            }
        },
        complete : function(){
        }
    });
}