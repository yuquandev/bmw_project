<div class="container-fluid">
    <div class="row-fluid">

        <div class="row-fluid">
            <div class="span12 center login-header">
                <h2 style="font-size: 30px;padding-top: 20px;color:#e24800; "><span>BMW to CMS<span></span></h2>
            </div><!--/span-->
        </div><!--/row-->

        <div class="row-fluid" style="opacity: 0.9;">
            <div class="well span5 center login-box" style="background: #fff;">
                <div class="alert alert-info">
                    <?php echo $msg;?>
                </div>
                <form class="form-horizontal" action="/index.php/admin/login" method="post">
                    <fieldset>
                        <div class="input-prepend" title="Username" data-rel="tooltip">
                            <span class="add-on"><i class="icon-user"></i></span><input autofocus class="input-large span10" name="username" id="username" type="text" value="<?php echo $userinfo;?>" style="height:20px;width:150px;" />
                        </div>
                        <div class="clearfix"></div>

                        <div class="input-prepend" title="Password" data-rel="tooltip">
                            <span class="add-on"><i class="icon-lock"></i></span><input class="input-large span10" name="password" id="password" type="password" value="<?php echo $password;?>" style="height:20px;width:150px;" />
                        </div>
                        <div class="clearfix"></div>

                        <div class="input-prepend">
                            <label class="remember" for="remember"></label>
                        </div>
                        <div class="clearfix"></div>

                        <p class="center span5">
                            <button type="submit" class="btn btn-primary">Login</button>
                        </p>
                    </fieldset>
                </form>
            </div><!--/span-->
        </div><!--/row-->
    </div><!--/fluid-row-->

</div>