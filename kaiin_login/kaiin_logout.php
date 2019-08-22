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
	<?php require_once('../common/html/kaiin_style.php'); ?>
	<style>
		.main-container {
			width: 100%;
			margin: 0 auto;
		}
	</style>
</head>
<body>
	<?php
		require_once('../common/html/kaiin_header.php');
		require_once('../common/common.php');
	?>
	<div class="main">
		<div class="main-container">
			<h3 class="main-title">ログアウトしました</h3><br>
	
			<a href="../kaiin_login/kaiin_login.php" class="btn">ログイン画面へ</a>
		</div>
	</div>
	<?php require_once('../common/html/footer.php'); ?>
</body>
</html>