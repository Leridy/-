<?php
require_once '../connect.php';
include './function.php';
check_sign_in();
if (!(isset($_POST['atc-title']) && (!empty($_POST['atc-title'])))) {
	echo "<script>alert('标题不能为空');window.location.href='write-article.php';</script>";
	exit();
}
$title = $_POST['atc-title'];
$author = $_POST['atc-author'];
$summary = $_POST['atc-summary'];
$content = $_POST['atc-content'];
$dateline = time();
$keywords = $_POST['atc-keywords'];
$insertsql = "insert into article(title, author, summary, content, time, keywords) values('$title', '$author', '$summary', '$content', '$dateline' , '$keywords')";
if (mysql_query($insertsql)) {
	echo "<script>alert('发布文章成功');window.location.href='manage-article.php';</script>";
} else {
	echo "<script>alert('发布失败');window.location.href='manage-article.php';</script>";
}
?>
