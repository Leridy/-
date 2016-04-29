<?php
require_once '../connect.php';
include './function.php';
check_sign_in();

?>
<!DOCTYPE html>
<html lang="zh-cn">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-COMPATIBLE" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="keywords" content="完全是为了应付作业">
    <meta name="description" content="完全是为了应付作业" />
    <title>登录博客 | 完全是为了应付作业</title>
    <link rel="stylesheet" type="text/css" href="<?php echo $location; ?>/addtionalFonts/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $location; ?>/css/style.css">
</head>

<body id="body-wrap">
    <header class="page-header">
        <span class="h-banner hd-l"><img src="<?php echo $location; ?>/images/logo.jpeg" class="h-logo"> <a href="#">个人部落格 </a> —— 后台管理</span>
        <nav class="page-nav">
            <ul class="nav-ls">
                <li class="nav-item"><a href="<?php echo $location; ?>/index.php" title="首页">首页</a></li>
                <li class="nav-item"><a href="#" title="关于">关于</a></li>
                <li class="nav-item"><a href="#" title="留言板">留言板</a></li>
                <li class="nav-item"><a href="<?php echo $location; ?>/friendlink.php" title="友链">友链</a></li>
            </ul>
        </nav>
        <form method="GET" action="<?php echo $location; ?>/search.php" class="post-search">
            <label for="s" class="fa fa-search s-lab"></label>
            <input type="text" class="search-inpt" name="keywords" placeholder=" 请输入你的关键词" id="s" AutoComplete="off">
        </form>
        <ul class="social-icon hd-r">
            <span class="flm">关注我：</span>
            <li class="s-icon">
                <a href="#" title="weibo" class="fa fa-weibo"></a>
            </li>
            <li class="s-icon">
                <a href="#" title="github" class="fa fa-github"></a>
            </li>
            <li class="s-icon">
                <a href="#" title="facebook" class="fa fa-facebook-official"></a>
            </li>
            <li class="s-icon">
                <a href="#" title="twitter" class="fa fa-twitter"></a>
            </li>
            <li class="s-icon">
                <a href="#" title="google plus" class="fa fa-google-plus"></a>
            </li>
        </ul>
    </header>
    <div id="container">
        <main id="main" class="adm-main">
            <header id="login-header" class="main-header">
                <h1 class="login-h main-title">管理员登录</h1>
            </header>
            <div class="card-box">
                <form action="login_handle.php" method="post" id="login-box">
                    <label for="adminname" class="lg-label">账户：</label>
                    <input type="text" class="lg-inpt" name="adminname" id="adminname" placeholder="请输入管理员账户" AutoComplete="off">
                    <label for="adm-password" class="lg-label">密码：</label>
                    <input type="password" class="lg-inpt" name="adm-password" id="adm-password" placeholder="请输入管理员密码" AutoComplete="off">
                    <label for="v-code" class="lg-label">验证码：</label>
                    <input type="text" class="lg-inpt" name="Vcode" id="v-code" placeholder="请输入下方验证码" maxlength="4" AutoComplete="off">
                    <a href="#" class="v-code"><img src="#" alt="验证码" class="v-code"></a><span class="lg-notice">点击图片刷新验证码</span>
                    <input type="submit" class="lg-button button" value="登录">
                    <input type="reset" class="lg-button button" value="重置">
                </form>
            </div>
        </main>
        <?php show_footer()?>
    </div>
</body>

</html>
