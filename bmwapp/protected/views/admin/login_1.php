<div class="dl_body">
    <div class="dl_main">
        <div class="dl_main_tu">
            <form id="form_1" class="form-horizontal" action="/index.php/admin/login" method="post">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td height="40" colspan="2" align="center" valign="middle"><img src="/img/bm_user.png" /></td>
                </tr>
                <tr>
                    <td width="29%" height="40" align="right" valign="middle">用户名：</td>
                    <td width="71%" height="40" align="left" valign="middle"><input id="username" name="username" type="text" class="sy_user" value="<?php echo $userinfo;?>"/></td>
                </tr>
                <tr>
                    <td height="40" align="right" valign="middle">密　码：</td>
                    <td height="40" align="left" valign="middle"><input id="password" name="password" type="password" class="sy_user"/></td>
                </tr>
                <tr>
                    <td height="40" align="right" valign="middle"></td>
                    <td height="40" align="left" valign="middle"><div class="sy_dl_an">
                            <input name="" type="button" class="sy_dl_1" value="登 陆" onclick="return form_submit();"/>
                            <input name="" type="button" class="sy_dl_1" value="重 置" onclick="form_return();return false;"/>
                        </div></td>
                </tr>

            </table>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    <?php if (!empty($msg)){?>
    (function(){
        alert('<?php echo $msg;?>');
    })();
    <?php }?>

    function form_return(){
        document.getElementById('username').value = '';
        document.getElementById('password').value = '';
        return ;
    }

    function form_submit(){
        if (document.getElementById('username').value == ''){
            alert('请输入用户名');
            return false;
        }
        if (document.getElementById('password').value == ''){
            alert('请输入密码');
            return false;
        }
        document.forms[0].submit();
        return false;
    }
</script>