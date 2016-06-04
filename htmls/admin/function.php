<?php
//设置网站的根目录，方便资源定位
$location = "http://" . $_SERVER['HTTP_HOST'] . "/Large-software-design-homework/htmls/";

//输出网页尾部，输出页脚
function show_footer() {
	echo "
        <!--这是自动输出的底部-->
        <footer id=\"footer\">
            <nav class=\"ft-links\">
                <a href=\"#\" class=\"ft-link\">版权声明 </a> ||
                <a href=\"#\" class=\"ft-link\"> 友情链接 </a> ||
                <a href=\"http://www.leridy.pw/blog\" class=\"ft-link\"> LERIDY'S BLOG</a> ||
                <a href=\"http://www.cys.pw\">MARCUS BLOG</a>
            </nav>
            <div class=\"copyright\">
                <span class=\"ft-note\">&copy;2016, <a href=\"http://www.leridy.pw/blog\"> Leridy.pw </a> ALL RIGHTS RESERVED</span>
                <span class=\"ft-note\">POWER BY <i class=\"fa fa-cogs\"></i> LERIDY_LEI,DESIGN BY LERIDY_LEI</span>
            </div>
        </footer>";
}

//获取article的id和title
//在文章内容页中获取上一篇和下一篇的id和title值
//传参为 当前文章的 id值
function get_article_id_title($id) {
	//设置查询数据库中的id和标题，获取id和标题 的sql语句
	$forIdandTitleSql = "select id, title  from article order by time desc";
	//执行查询，返回查询定位符给$forIdandTitleQuery
	$forIdandTitleQuery = mysql_query($forIdandTitleSql);
	//判断$forIdandTitleQuery 是否存在，存在则以 键值对和数值对 的方法将获取值逐条复制给$IdandTitleQuerys
	while ($idandTitleArrays = mysql_fetch_array($forIdandTitleQuery, MYSQL_ASSOC)) {
		//将$idandTitleArrays 数组赋值给 $idandTitleArray .用于后期对比id值
		$idandTitleArray[] = $idandTitleArrays;
	}

	//遍历 $idandTitleArray 以键值对的方式进入循环
	foreach ($idandTitleArray as $key => $value) {
		//判断每次遍历出来的$idandTitleArray的$value 值得id值是否等于 当前文章的id的值
		//若文章的id相等则进入判断，
		if ($value['id'] == $id) {
			//rtv1 返回值 1  rtv2返回值2

			//判断本id存在的数组的上一条数组是否存在，若存在则将该数组赋值给 $rtv1 若不存在则将NULL值赋值给 $rtv1
			$rtv1 = (!isset($idandTitleArray[$key - 1])) ? NULL : $idandTitleArray[$key - 1];
			//判断本id存在的数组的下一条数组是否存在，若存在则将该数组赋值给 $rtv2 若不存在则将NULL值赋值给 $rtv2
			$rtv2 = (!isset($idandTitleArray[$key + 1])) ? NULL : $idandTitleArray[$key + 1];
			//将$rtv1 和 $rtv2 的值组成数组返回
			return array($rtv1, $rtv2);
		}
	}
}

//方法 格式化 文章的 上一篇 下一篇的输出
//传参为 get_article_id_title($id) 方法的返回数组。
function format_article_id($array) {
	//声明变量 用于当传入的值中 标题为空时 的处理数组
	$notice = array('id' => 0, 'title' => ">_< ! 没有啦");
	//判断前一个的id和title是否存在，存在则 将 前一个数组赋值给 $preIdandTitle,否则将$notice 赋值到
	$preIdandTitle = ($array[0] == NULL) ? $notice : $array[0];
	//判断下一个的id和title是否存在，存在则 将 前一个数组赋值给 $preIdandTitle,否则将$notice 赋值到
	$nextIdandTitle = ($array[1] == NULL) ? $notice : $array[1];
	//将上面的数组的各项赋值给 对应 变量 并按格式输出，判断前一篇 或后一篇的 数组中id 是否为0 为零则将连接的输出 替换为 span输出
	$preId = $preIdandTitle['id'];
	$preTitle = $preIdandTitle['title'];
	$nextId = $nextIdandTitle['id'];
	$nextTitle = $nextIdandTitle['title'];
	$link1 = !($preId == 0) ? "<span class=\"atc-link\">上一篇：<a href=\"article.php?id=$preId\" title=\"$preTitle\" >$preTitle </a></span>" : "<span class=\"atc-link\">上一篇：$preTitle </span>";
	$link2 = !($nextId == 0) ? "<span class=\"atc-link\">下一篇：<a href=\"article.php?id=$nextId\" title=\"$nextTitle\" >$nextTitle </a></span>" : "<span class=\"atc-link\">下一篇：$nextTitle </span>";

	$output = $link1 . $link2;
	return $output;
}

//判断是否为搜索
//用于在搜索页中判断是否是当需要搜索时调用的跳转搜索页面
function is_search() {
	//判断keywords 是否存在 和是否为空 若成立 则返回 keywords 。 若不成立则将页面跳转至 首页
	if (isset($_GET['keywords']) && !empty($_GET['keywords'])) {
		return $keywords = $_GET['keywords'];
	} else {
		echo "<script>window.location.href='index.php'</script>";
	}
}

//判断是 tag  还是 搜索
function tag_or_search() {
	//判断是否存在 type传参，若存在则将 type传参赋值给 变量$type 若 type值为 tag 这返回 标签，若为空 或不为tag 则返回搜索
	if (isset($_GET['type'])) {
		$type = $_GET['type'];
		if ($type == "tag") {
			$h = "标签";
		} else {

			$h = "搜索";
		}

	} else {
		$h = "搜索";
	}
	return $h;
}

//获取首页 或搜索页中的数据库查询开始点，用于分页中的单页文章数量控制
function get_sqlStart() {
	//判断是否存在 page的参数，若不存在则返回 0；
	if (!isset($_GET["page"])) {
		return $p = 0;
	} else {
		//若page存在则将page强制类型专化，用于过滤非法传值
		$p = (int) $_GET["page"];
		//若强制转换后的值为0 则返回零，否则返回当前page值减一乘四的结果
		if ($p == 0) {
			return $p = 0;
		} else {
			return $p = ($_GET["page"] - 1) * 4;
		}
	}
}

//获取page的传值，防止非法输入的page传值
function get_page() {
	//判断是否存在 page的参数，若不存在则返回 1；
	if (!isset($_GET["page"])) {
		return $p = 1;
	} else {
		//若page存在则将page强制类型专化，用于过滤非法传值
		$p = (int) $_GET["page"];
		//若强制转换后的值为0 则返回1，否则返回当前page值
		if ($p == 0) {
			return $p = 1;
		} else {
			return $p = $_GET["page"];
		}
	}
}

//分页功能
//传参为$p 当前页的数值，$t总的文章数量，$k 当前页的keyword值
function pagination($p, $t, $k) {
	//首先声明变量$totalPage 并取值为所有文章的数量除以4
	$totalPage = ceil($t / 4);
	//声明变量 $thisPage ，并赋值为当前页面的 路径
	$thisPage = $_SERVER['PHP_SELF'];

/*	if ($p > $totalPage ) {
header('location:' . $thisPage . '?page=' . $totalPage);
}*/

	//检查当前传值中是否存在keywords值 若若不存在 则将变量 $keywords 赋值为空字符串，若存在则赋值为当前 值，以及get请求格式
	if (is_null($k)) {
		$keywords = "";
	} else {
		$keywords = "keywords=" . $k . "&";
	}

	//判断当前页是否为第一页或者为空页，若为空，则退出函数不执行任何输出
	if ($totalPage == 0 || $totalPage == 1) {
		return 1;
		//当总页数大于7时首先输出分页最外层的标签
	} elseif ($totalPage > 7) {
		echo "<div class=\"page-label\"><div class=\"page-lab-bx\">";
		//再判断当前页是否为第一页，若是着输出一个不可被点击的上页符号，若不是则输出 一个指向当前页的上页的连接的翻页符号
		if ($p == 1) {
			echo "<span class=\"ban\"><</span>";
		} else {
			echo "<a href=\"$thisPage?" . $keywords . "page=" . ($p - 1) . "\" title=\"上一页\" class=\"page-item\"><</a>";
		}
		//当$p 小于等于4 时
		if ($p <= 4) {
			//循环执行七次 输出 分页函数，并且传入对应参数。
			for ($i = 1; $i <= 7; $i++) {
				output_pagination($i, $p, $keywords, $thisPage);
			}
			//输出一个省略符
			echo "<span>...</span>";
			//判断 当 当前页大于或等于4 且 当前页小于 总页数减三时
		} elseif ($p >= 4 && $p < $totalPage - 3) {
			//首先输出省略符，在循环执行当前页的前三页至当前页之后三页共七次输出分页函数
			echo "<span>...</span>";
			for ($i = ($p - 3); $i <= ($p + 3); $i++) {
				output_pagination($i, $p, $keywords, $thisPage);
			}
			//输出省略符
			echo "<span>...</span>";
			//当当前页地页码大于 全部页面数减三时
		} elseif ($p >= $totalPage - 3) {
			// 先输出省略符
			echo "<span>...</span>";
			//在执行总页数及前六页的标签，共七次
			for ($i = ($totalPage - 6); $i <= $totalPage; $i++) {
				output_pagination($i, $p, $keywords, $thisPage);
			}
		}
		//当当前页数值等于总页数时，输出一个无法被点击的下一页选项，否则输出一个指向当前页的下一页的链接
		if ($p == $totalPage) {
			echo "<span class=\"ban\">></span>";
		} else {
			echo "<a href=\"$thisPage?" . $keywords . "page=" . ($p + 1) . "\" title=\"下一页\" class=\"page-item\">></a>";
		}
		//输出总页数
		echo "<span class=\"totalPage\">共" . $totalPage . "页</span>";
		//在快捷分页选项卡中输出所有的分页链接
		echo "<div class=\"page-label-select\"><h3 class=\"pagination\">分页 <i class=\"fa fa-sort\"></i><ul class=\"select-list\">";
		for ($i = 1; $i <= $totalPage; $i++) {
			echo "<li class=\"child-item\"><a href=\"$thisPage?" . $keywords . "page=$i\" title=\"第" . $i . "页\">$i</a></li>";
		}
		//输出关闭标签
		echo "</ul></h3></div><!-- 选择跳转分页部分 --></div><!-- 分页部分完结 -->";
		//若总页数小于等于七页则换种方法
	} elseif ($totalPage <= 7) {
		//与前相同
		echo "<div class=\"page-label\">
                    <div class=\"page-lab-bx\">";
		if ($p == 1) {
			echo "<span class=\"ban\"><</span>";
		} else {
			echo "<a href=\"$thisPage?" . $keywords . "page=" . ($p - 1) . "\" title=\"上一页\" class=\"page-item\"><</a>";
		}
		//直接执行所有页次的输出
		for ($i = 1; $i <= $totalPage; $i++) {
			output_pagination($i, $p, $keywords, $thisPage);
		}
		//与前相同
		if ($p == $totalPage) {
			echo "<span class=\"ban\">></span>";
		} else {
			echo "<a href=\"$thisPage?" . $keywords . "page=" . ($p + 1) . "\" title=\"下一页\" class=\"page-item\">></a>";
		}
		echo "<span class=\"totalPage\">共" . $totalPage . "页</span>";
		echo "<div class=\"page-label-select\"><h3 class=\"pagination\">分页 <i class=\"fa fa-sort\"></i><ul class=\"select-list\">";
		for ($i = 1; $i <= $totalPage; $i++) {
			echo "<li class=\"child-item\"><a href=\"$thisPage?" . $keywords . "page=$i\" title=\"第" . $i . "页\">$i</a></li>";
		}
		echo "</ul></h3></div><!-- 选择跳转分页部分 --></div><!-- 分页部分完结 -->";
	}
}

//输出分页项，
//传参 为 $i当前循环序号，$p当前页号，$keywords关键字字符串 ，$thispage 这一页面的路径
function output_pagination($i, $p, $keywords, $thisPage) {
	if ($i != $p) {
		echo "<a href=\"$thisPage?" . $keywords . "page=$i\" title=\"第" . $i . "页\" class=\"page-item\">$i</a>";
	} else {
		echo "<span class=\"current\">$i</span>";
	}
}

//检查是否是重定义（改写）文章
function is_modify_article() {
	//判断是否传入ID值，若未传递 跳转至 文章管理页
	if (!isset($_GET["id"])) {
		echo "<script>window.location.href='manage-article.php'</script>";
	} else {
		//若get的id值不为合法传参也跳入 文章管理页。否则会返回文章的id；
		$p = (int) $_GET["id"];
		if ($p == 0) {
			echo "<script>window.location.href='manage-article.php'</script>";
		} else {
			return $p = $_GET["id"];
		}
	}

}

//判断是否登录
function check_sign_in() {
	session_start();
/*	session_destroy();
return 0;*/

	//判断是否存在cookie中是否存在用户名或密码，若存在将存在的值赋值给相应变量，若不存在则 将空值赋值给相应变量
	$username = isset($_COOKIE['username']) ? $_COOKIE['username'] : NULL;
	$password = isset($_COOKIE['password']) ? $_COOKIE['password'] : NULL;
	// 声明变量，$loginLocation 用于保存登录页的位置
	$loginLocation = $_SERVER['HTTP_HOST'] . "/Large-software-design-homework/htmls/admin/login.php";
	//声明变量，$thisPageLocation 用于储存当前页面的位置
	$thisPageLocation = $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
	if (check_session()) {
		if ($loginLocation == $thisPageLocation) {
			echo "<script>window.location.href='manage-article.php'</script>";
		} else {
			return 1;
		}
	}
	// 若$username 或$password 为Null 则继续判断当前页路径是否为登录页，若不是则将跳转至登录页，并退出
	if ($username == NULL || $password == NULL) {
		if ($thisPageLocation != $loginLocation) {
			echo "<script> alert('请你登录'); window.location.href='login.php'</script>";
			return 1;
		}
	} else {
		//若不是则将$password带入查询是否存在对应的用户名
		$userVSql = "select password from user_table where username = '$username'";
		$query = mysql_query($userVSql);
		$passwordRseult = mysql_fetch_array($query, MYSQL_ASSOC);
		if ($passwordRseult['password'] == $password) {
			$_SESSION['lg-sign'] = 1;
			echo "<script>alert('通过cookie 登录')</script>";
		} elseif ($thisPageLocation != $loginLocation) {
			echo "<script>alert('你还没有登录');window.location.href='login.php'</script>";
		}

	}
}

function check_session() {
	if (isset($_SESSION['lg-sign'])) {
		return $_SESSION['lg-sign'];
	} else {
		return 0;
	}

}
