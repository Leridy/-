<?php
require_once '../connect.php';
session_start();
if (isset($_POST['adminname']) || isset($_POST['adm-password'])) {
	$username = $_POST['adminname'];
	$password = $_POST['adm-password'];
	$userVSql = "select password from user_table where username = '$username'";
	$query = mysql_query($userVSql);
	$passwordRseult = mysql_fetch_array($query, MYSQL_ASSOC);
	if ($passwordRseult['password'] == $password && $passwordRseult['password'] != NULL) {
		$_SESSION['lg-sign'] = 1;
		setcookie('username', $username, time() + 3600);
		setcookie('password', $password, time() + 3600);

		echo "<script>alert('通过用户名 密码 登录 登陆成功');window.location.href='manage-article.php'</script>";
	} else {
		echo "<script>alert('用户名或密码有误" . $username . "');window.location.href='login.php'</script>";
	}
} else {
	echo "<script>alert('用户名或密码有误2');window.location.href='login.php'</script>";
}

?>