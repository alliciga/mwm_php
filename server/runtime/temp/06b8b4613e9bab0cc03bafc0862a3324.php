<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:94:"/Volumes/Data/ZCloudWS/SivaProject/SivaBase/server/public/../application/admin/view/login.html";i:1504710387;}*/ ?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title>登录</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="/static/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="/static/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="/static/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="/static/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css" />
        <link href="/static/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->

        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="/static/global/css/components-rounded.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="/static/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN PAGE LEVEL STYLES -->
        <link href="/static/pages/css/login.min.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="favicon.ico" /> </head>
    <!-- END HEAD -->

    <body class=" login">
        <!-- BEGIN LOGO -->
        <div class="logo">
            <a href="http://zcloud.link">
                <img src="/static/pages/img/zcloud-logo-big1.png" alt="" height="60" width="150" /> </a>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN LOGIN -->
        <div class="content">
            <!-- BEGIN LOGIN FORM -->
            <form class="login-form" action="<?php echo url('doLogin'); ?>" method="post">
                <h3 class="form-title font-green">欢迎使用Siva平台</h3>
                <div class="alert alert-danger display-hide">
                    <button class="close" data-close="alert"></button>
                    <span> 输入用户名及密码 </span>
                </div>
                <div class="alert display-hide">
                    <button class="close" data-close="alert"></button>
                    <span name="msg">  </span>
                </div>
                <div class="form-group">
                    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                    <label class="control-label visible-ie8 visible-ie9">用户名</label>
                    <input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="用户名" name="username" /> </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">密  码</label>
                    <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="密  码" name="password" /> </div>
                <div class="form-actions">
                    <button type="submit" class="btn green btn-block">登  录</button>
                    <label class="rememberme check">
                        <input type="checkbox" name="remember" value="1" />记住我 </label>

                </div>
                <div class="create-account">
                    <p>
                        <a href="javascript:;" id="contact-btn" class="uppercase">联系管理员</a>
                    </p>
                </div>
            </form>
            <!-- END LOGIN FORM -->

        </div>
        <div class="copyright"> 2017 &copy; ZCloudTeam.</div>
        <!--[if lt IE 9]>
<script src="/static/global/plugins/respond.min.js"></script>
<script src="/static/global/plugins/excanvas.min.js"></script>
<![endif]-->
        <!-- BEGIN CORE PLUGINS -->
        <script src="/static/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="/static/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="/static/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="/static/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
        <script src="/static/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="/static/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="/static/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
        <script src="/static/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="/static/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
        <script src="/static/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="/static/global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->


        <script src="/static/admin/js/jquery.form.js" type="text/javascript"></script>

        <script src="/static/pages/scripts/login.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <!-- END THEME LAYOUT SCRIPTS -->
    </body>

</html>