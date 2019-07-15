<?php
$_SESSION = array();
if (isset($_COOKIE[session_name()]) == true) {
	setcookie(session_name(), '', time()-42000, '/');
}
@session_destroy();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>logout</title>
</head>
<body>
	ログアウトしました。<br>
	<a href="mise_list.php">商品一覧へ</a>
</body>
</html>