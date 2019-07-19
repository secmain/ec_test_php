<?php
	session_start();
	session_regenerate_id(true);
?>

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

		.notlogin-btn {
			margin-top: 20px;
		}

		.error-msg {
			font-weight: bold;
			color: red;
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
			
			<?php if (isset($_SESSION['mise_login_error'])) { ?>
				<div class="error-msg"><?php print $_SESSION['mise_login_error']; ?></div>
			<?php unset($_SESSION['mise_login_error']);} ?>
			<form action="member_login_check.php" method="post">
				<div class="input">登録メールアドレス</div>
				<input type="text" name="email"><br>
				<div class="input">パスワード</div>
				<input type="password" name="password"><br>
				<br>
				<input type="submit" value="ログイン" class="btn">
				<div class="notlogin-btn">
					<input type="button" onclick="location.href='mise_list.php'" value="ログインせずに購入" class="btn">
				</div>
			</form>
		</div>
	</div>
</body>
</html>