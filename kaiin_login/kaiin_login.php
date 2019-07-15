<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>会員ログイン</title>
	<link rel="stylesheet" href="../css/normalize.css">
	<link rel="stylesheet" href="../css/login.css">
</head>
<body>
	<?php
		require_once('../common/html/header.php');
		require_once('../common/common.php');
	?>
	<div class="main">
		<h1 class="login">ログイン</h1>
		<form action="kaiin_login_check.php" method="post" class="form kaiin-login-form clearfix">
			<span class="label">会員コード: </span>
			<input type="text" name="code"><br>
			<span class="label">パスワード: </span>
			<input type="password" name="password"><br>
			<br>
			<button class="btn login-btn" onclick="">ログイン</button>
			<br><br>
		</form>
	</div>

	<?php require_once 'common/html/footer.php'; ?>
</body>
</html>