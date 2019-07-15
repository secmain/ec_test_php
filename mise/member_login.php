<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>お客様ログイン</title>
	<?php require_once('../common/html/mise_style.php'); ?>
	<link rel="stylesheet" href="../css/member_login.css">
	<style>
		.main {
			background-color: #f0f8ff;
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
			<h3 class="main-title">ログイン</h3>
			
			<?php if (isset($_SESSION['errors'])) { ?>
				<div class="error-msg">メールアドレスかパスワードが間違っています</div>
				<a href="member_login.html" class="btn">戻る</a>
			<?php } ?>
			<form action="member_login_check.php" method="post">
				<div class="input">登録メールアドレス</div>
				<input type="text" name="email"><br>
				<div class="input">パスワード</div>
				<input type="password" name="password"><br>
				<br>
				<input type="submit" value="ログイン" class="btn">
			</form>
		</div>
	</div>
	<?php require_once('../common/html/footer.php'); ?>
</body>
</html>