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
	<link rel="stylesheet" href="../common/css/font-awesome/css/all.css"> 
	<link rel="stylesheet" href="../css/normalize.css">
	<link rel="stylesheet" href="../common/css/kaiin_header.css">
	<link rel="stylesheet" href="../common/css/footer.css">
	<link rel="stylesheet" href="../common/css/kaiin_navi.css">
	<link rel="stylesheet" href="../common/css/kaiin_side.css">
</head>
<body>
	<?php
		require_once('../common/html/kaiin_header.php');
		require_once('../common/html/kaiin_navi.php');
		require_once('../common/common.php');
	?>
	aaaaaaaaaaaa
	ログアウトしました。<br>
	<a href="../kaiin_login/kaiin_login.php">ログイン画面へ</a>
</body>
</html>