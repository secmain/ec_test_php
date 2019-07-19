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
	<title>ログアウト</title>
	<?php require_once('../common/html/mise_style.php'); ?>
	<style>
		.main-title {
			text-align: center;
			font-weight: normal;
			padding-top: 50px;
		}

		.link-btn {
			text-align: center;
		}
	</style>
</head>
<body>
	<?php
		require_once('../common/html/mise_header.php');
		require_once('../common/html/mise_navi.php');
		require_once('../common/common.php');
		require_once('../class/Mise_db.php');
	?>

	<div class="main">
		<div class="main-container">
			<h3 class="main-title">ログアウトしました</h3>
	
			<div class="link-btn"><a href="mise_list.php" class="btn">商品一覧へ</a></div>
		</div>
	</div>
</body>
</html>