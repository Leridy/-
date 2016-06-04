<?php
include 'function.php';
require_once '../connect.php';
check_sign_in();
//读取旧信息
$id = is_modify_article();
$query = mysql_query("select * from article where id=$id");
$data = mysql_fetch_assoc($query);
$content = str_replace("", "\t", $data['content']);
$content = str_replace("</p><p class=\"atc-p\">", "\r\n\t", $content);
?>
<!DOCTYPE html>
<html lang="zh-cn">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-COMPATIBLE" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="keywords" content="完全是为了应付作业">
    <meta name="description" content="完全是为了应付作业" />
    <title>修改 | 完全是为了应付作业</title>
    <link rel="stylesheet" type="text/css" href="<?php echo $location; ?>addtionalFonts/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $location; ?>css/style.css">
</head>

<body id="body-wrap">
    <header class="page-header">
        <span class="h-banner hd-l"><img src="<?php echo $location; ?>images/logo.jpeg" class="h-logo"> <a href="#">个人部落格 </a> —— 发布文章</span>
        <nav class="page-nav">
            <ul class="nav-ls">
                <li class="nav-item"><a href="<?php echo $location; ?>index.php" title="首页">首页</a></li>
                <li class="nav-item"><a href="manage-article.php" title="管理文章">管理文章</a></li>
                <li class="nav-item"><a href="write-article.php" title="发布文章" class="active">发布文章</a></li>
                <li class="nav-item"><a href="<?php echo $location; ?>admin/quit.php" title="退出登录">退出登录</a></li>
            </ul>
        </nav>
        <form method="GET" action="<?php echo $location; ?>search.php" class="post-search">
            <label for="s" class="fa fa-search s-lab"></label>
            <input type="text" class="search-inpt" name="keywords" placeholder=" 请输入你的关键词" id="s">
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
                <h1 class="login-h main-title">修改 <?php echo $data['title'] ?> </h1>
            </header>
            <div class="card-box">
                <form action="handle-modify-article.php" method="post" id="write-article">
                    <input type="hidden" name="id" value="<?php echo $data['id'] ?>" AutoComplete="off"/>
                    <label for="w-atc-title" class="w-atc-label">标题：</label>
                    <input type="text" class="w-atc-inpt" name="atc-title" id="w-atc-title" placeholder="请输文章的标题" autofocus value="<?php echo $data['title'] ?>" AutoComplete="off">
                    <label for="w-atc-author" class="w-atc-label">作者：</label>
                    <input type="text" class="w-atc-inpt" name="atc-author" id="w-atc-author" placeholder="这里填写作者名" value="<?php echo $data['author'] ?>" AutoComplete="off">
                    <label for="w-atc-keywords" class="w-atc-label">关键词：</label>
                    <input type="text" class="w-atc-inpt" name="atc-keywords" id="w-atc-keywords" placeholder="这里填写关键词多个请用“,”隔开" value="<?php echo $data['keywords'] ?>" AutoComplete="off">
                    <label for="w-atc-summary" class="w-atc-label">简介：</label>
                    <textarea  maxlength="200"  class="w-atc-textarea" name="atc-summary" id="w-atc-summary" placeholder="在这里输入简介 最多200字"><?php echo $data['summary'] ?></textarea>
                    <label for="w-atc-content" class="w-atc-label">正文：</label>
                    <textarea  maxlength="1500"  class="w-atc-textarea" name="atc-content" id="w-atc-content" placeholder="在这里输入正文内容 最多1500字"><?php echo $content ?></textarea>
                    <input type="submit" class="post-button button" value="马上发布">
                    <input type="reset" class="post-button button" value="全部清空">
                </form>
            </div>
        </main>
        <?php show_footer()?>
    </div>
</body>

</html>
