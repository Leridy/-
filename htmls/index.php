<?php
include './admin/function.php';
require_once 'connect.php';
$p = get_sqlStart();

$page = get_page();

$sql = "select * from article where id order by time desc limit " . $p . ",4";
$query = mysql_query($sql);
if ($query && mysql_num_rows($query)) {
	while ($row = mysql_fetch_assoc($query)) {
		$data[] = $row;
	}
}

$totalSql = "select * from article where id";
$totalNum = mysql_num_rows(mysql_query($totalSql));

?>
<!DOCTYPE html>
<html lang="zh-cn">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-COMPATIBLE" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="keywords" content="完全是为了应付作业">
    <meta name="description" content="完全是为了应付作业" />
    <title>我的博客 | 完全是为了应付作业</title>
    <link rel="stylesheet" type="text/css" href="<?php echo $location; ?>addtionalFonts/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $location; ?>css/style.css">
</head>

<body id="body-wrap">
    <header class="page-header">
        <span class="h-banner hd-l"><img src="./images/logo.jpeg" class="h-logo"> <a href="#">个人部落格 </a> —— 想写就写</span>
        <nav class="page-nav">
            <ul class="nav-ls">
                <li class="nav-item"><a href="<?php echo $location; ?>index.php" title="首页" class="active" >首页</a></li>
                <li class="nav-item"><a href="#" title="关于">关于</a></li>
                <li class="nav-item"><a href="#" title="留言板">留言板</a></li>
                <li class="nav-item"><a href="<?php echo $location; ?>friendlink.php" title="友链">友链</a></li>
            </ul>
        </nav>
        <form method="GET" action="search.php" class="post-search">
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
        <main id="main">
            <?php
if (empty($data)) {
	echo "<article  class=\"atc-entry card-box\">
                        <header class=\"atc-h\">
                        <h1 class=\"atc-c-t\">(￣o￣) . z Z 博主偷懒，没有内容</h1>
                        <span class=\"atc-info\"><i class=\"fa fa-user\"></i> 勤劳的程序猿</span>
                        <span class=\"atc-info\"><i class=\"fa fa-calendar\"></i> 盘古开天辟地之时</span>
                        </header>
                        <section class=\"atc-r\">
                        欢迎你的到来，这里是互联网中的一隅，暂时没有相关内容被添加。如果你看到了提醒请联系博主添加相关内容 ;-) 。
                        </section>
                        <a href=\"mailto://admin@leridy.pw\" title=\"联系博主\" class=\"atc-ra\"><i class=\"fa fa-envelope\"></i> 联系博主 +</a>
                        </article>";
} else {
	foreach ($data as $value) {
		?>

                <article id="post-<?php echo $value['id'] ?>" class="atc-entry card-box">
                <header class="atc-h">
                    <h1 class="atc-c-t"><a href="article.php?id=<?php echo $value['id'] ?>"><?php echo $value['title'] ?></a></h1>
                    <span class="atc-info"><i class="fa fa-user"></i> <?php echo $value['author'] ?></span>
                    <span class="atc-info"><i class="fa fa-calendar"></i> <?php echo date("Y-m-d", $value['time']) ?></span>
                </header>
                <section class="atc-r">
                    <?php echo $value['summary'] ?>
                </section>
                <a href="article.php?id=<?php echo $value['id'] ?>" title="阅读全文" class="atc-ra">查看全文 +</a>
            </article>
            <?php
}
}
?>

            <?php pagination($page, $totalNum, NULL)?>
        </main>
        <div id="sidebar">
            <aside class="widget widget-webmaster-info">
                <header class="widget-h">博主信息</header>
                <div class="ms-info-bx">
                    <img src="./images/logo.jpeg" alt="博主头像" class="ms-info-logo">
                    <span class="ms-info">笔名：乐余地</span>
                    <span class="ms-info">职业：前端狗</span>
                    <span class="ms-info">格言：不要怕难</span>
                    <span class="ms-info">邮箱：admin@leridy.pw</span>
                    <span class="ms-info">博客：www.leridy.pw/blog</span>
                </div>
            </aside>
            <aside class="widget widget-tag">
                <header class="widget-h">标签</header>
                <div class="w-tag-grp">
                    <a href="#" class="w-tag">今日新闻</a>
                    <a href="#" class="w-tag">做博客</a>
                    <a href="#" class="w-tag">真好玩</a>
                    <a href="#" class="w-tag">长知识</a>
                    <a href="#" class="w-tag">9524</a>
                    <a href="#" class="w-tag">公益</a>
                    <a href="#" class="w-tag">前端知识</a>
                    <a href="#" class="w-tag">末日谣言</a>
                    <a href="#" class="w-tag">跑男</a>
                    <a href="#" class="w-tag">离南京</a>
                    <a href="#" class="w-tag">西更饿</a>
                    <a href="#" class="w-tag">明天加油</a>
                    <a href="#" class="w-tag">今日新闻</a>
                    <a href="#" class="w-tag">做博客</a>
                    <a href="#" class="w-tag">真好玩</a>
                    <a href="#" class="w-tag">长知识</a>
                    <a href="#" class="w-tag">9524</a>
                    <a href="#" class="w-tag">公益</a>
                    <a href="#" class="w-tag">前端知识</a>
                    <a href="#" class="w-tag">末日谣言</a>
                    <a href="#" class="w-tag">跑男</a>
                    <a href="#" class="w-tag">离南京</a>
                    <a href="#" class="w-tag">西更饿</a>
                    <a href="#" class="w-tag">明天加油</a>
                    <a href="#" class="w-tag">今日新闻</a>
                    <a href="#" class="w-tag">做博客</a>
                    <a href="#" class="w-tag">真好玩</a>
                    <a href="#" class="w-tag">长知识</a>
                    <a href="#" class="w-tag">9524</a>
                </div>
            </aside>
            <aside class="widget widget-random-post">
                <header class="widget-h">随机推荐</header>
                <ul class="w-rpost">
                    <li class="w-rpost-item"><a href="#" title="1">占位文章标题</a></li>
                    <li class="w-rpost-item"><a href="#" title="2">占位文章标题</a></li>
                    <li class="w-rpost-item"><a href="#" title="3">占位文章标题</a></li>
                    <li class="w-rpost-item"><a href="#" title="4">占位文章标题</a></li>
                    <li class="w-rpost-item"><a href="#" title="5">占位文章标题</a></li>
                    <li class="w-rpost-item"><a href="#" title="6">占位文章标题</a></li>
                </ul>
            </aside>
            <aside class="widget widget-donate">
                <header class="widget-h">捐赠博主</header>
                <img src="<?php echo $location; ?>images/zhbewm.png" class="w-zhbewm">
                <span class="w-note">你的资助将会让博客建设的更加完善</span>
            </aside>
        </div>
    <?php show_footer()?>
    </div>
</body>

</html>
