<?php
	session_start();
	session_regenerate_id(true);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>パスワード変更</title>
	<?php require_once('../common/html/kaiin_style.php'); ?>
</head>
<body>
	<?php
		require_once('../common/html/kaiin_header.php');
		require_once('../common/html/kaiin_navi.php');
		require_once('../common/common.php');
	?>

	<div class="main">
		<div class="main-container">
			<h3 class="main-title">パスワード変更</h3><br>
			
			<form action="kaiin_password_change_check.php" method="post">
					<!-- CSRFの脆弱性のため、変更前パスワードもワンタイムトークンもつけない -->
					パスワード：	
					<input type="password" name="password1"><br><br>
					パスワード確認用：
					<input type="password" name="password2"><br><br>
					<input type="button" onclick="history.back()" value="戻る" class="btn">
					<input type="submit" value="送信" class="btn">
			</form>
		</div>
		<?php require_once('../common/html/kaiin_side.php'); ?>
	</div>
	<?php require_once('../common/html/footer.php'); ?>
</body>
</html>