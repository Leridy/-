<?php

include 'function.php';
require_once '../connect.php';
check_sign_in();

$sql = "select * from article order by time desc";
$query = mysql_query($sql);
if ($query && mysql_num_rows($query)) {
	while ($row = mysql_fetch_assoc($query)) {
		$data[] = $row;
	}
} else {
	$data = array();
}

?>
<!DOCTYPE html>
<html lang="zh-cn">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-COMPATIBLE" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="keywords" content="完全是为了应付作业">
    <meta name="description" content="完全是为了应付作业" />
    <title>管理文章 | 完全是为了应付作业</title>
    <link rel="stylesheet" type="text/css" href="<?php echo $location; ?>addtionalFonts/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $location; ?>css/style.css">
</head>

<body id="body-wrap">
    <header class="page-header">
        <span class="h-banner hd-l"><img src="<?php echo $location; ?>images/logo.jpeg" class="h-logo"> <a href="#">个人部落格 </a> —— 管理文章</span>
        <nav class="page-nav">
            <ul class="nav-ls">
                <li class="nav-item"><a href="<?php echo $location; ?>index.php" title="首页">首页</a></li>
                <li class="nav-item"><a href="manage-article.php" title="管理文章" class="active">管理文章</a></li>
                <li class="nav-item"><a href="write-article.php" title="发布文章">发布文章</a></li>
                <li class="nav-item"><a href="<?php echo $location; ?>admin/quit.php" title="退出登录">退出登录</a></li>
            </ul>
        </nav>
        <form method="GET" action="<?php echo $location; ?>search.php" class="post-search">
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
            <header id="login-header" class="main-header manage-atc">
                <h1 class="login-h main-title">管理文章 </h1>
            </header>
            <div class="card-box">
                <table class="manage-article-table" cellspacing="2" cellpadding="8">
                    <tbody>
                        <tr>
                            <th class="i-th">文章id</th>
                            <th class="t-th">标题</th>
                            <th class="o-th">操作</th>
                        </tr>
                        <?php
if (!empty($data)) {
	foreach ($data as $value) {
		?>
                    <tr>
                      <td> <?php echo $value['id'] ?></td>
                      <td> <a href="<?php echo $location; ?>article.php?id=<?php echo $value['id'] ?>" title='<?php echo $value['title'] ?>'><?php echo $value['title'] ?></a></td>
                        <td><a href="<?php echo $location; ?>admin/delete-article-handle.php?id=<?php echo $value['id'] ?>" class="mng-atc-link link">删除</a> <a href="<?php echo $location; ?>admin/modify-article.php?id=<?php echo $value['id'] ?>" class="mng-atc-link link">编辑</a></td>
                     </tr>
                    <?php
}
}
?>
                </tbody>
            </table>
            </div>
        </main>
        <?php show_footer()?>
    </div>
</body>

</html>
