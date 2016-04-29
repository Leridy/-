<?php
require_once '../connect.php';
include './function.php';
check_sign_in();
$id = $_GET['id'];
$deletesql = "delete from article where id=$id";
if (mysql_query($deletesql)) {
	echo "<script>alert('删除文章成功');window.location.href='manage-article.php';</script>";
} else {
	echo "<script>alert('删除文章失败');window.location.href='manage-article.php';</script>";
}
?>