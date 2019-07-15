<?php
	session_start();
	session_regenerate_id(true);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>パスワード変更確認</title>
	<link rel="stylesheet" href="../common/css/font-awesome/css/all.css"> 
	<link rel="stylesheet" href="../css/normalize.css">
	<link rel="stylesheet" href="../common/css/kaiin_header.css">
	<link rel="stylesheet" href="../common/css/footer.css">
	<link rel="stylesheet" href="../common/css/kaiin_navi.css">
	<link rel="stylesheet" href="../common/css/kaiin_side.css">
	<link rel="stylesheet" href="../css/mypage.css">
</head>
<body>
	<?php
		require_once('../common/html/kaiin_header.php');
		require_once('../common/html/kaiin_navi.php');
		require_once('../common/common.php');
	?>

	<div class="main">
		<div class="main-container">
			<h3 class="main-title">パスワード変更確認</h3><br>

			<?php
			$kaiin_pass1 = $_POST['password1'];
			$kaiin_pass2 = $_POST['password2'];

			$kaiin_pass1 = htmlspecialchars($kaiin_pass1);
			$kaiin_pass2 = htmlspecialchars($kaiin_pass2);
			//

			$ok_flag = true;

			if ($kaiin_pass1 == '' || $kaiin_pass2 == '') {
				print checkGamenDispFieldError('パスワードが入力されていません');
				$ok_flag = false;
			} else if ($kaiin_pass1 !== $kaiin_pass2) {
				print checkGamenDispFieldError('パスワードが一致しません');
				$ok_flag = false;
			}

			if (!$ok_flag) {
				print '<form>';
				print '<input type="button" onclick="history.back()" value="戻る">';
				print '</form>';
			} else {
				// 後でハッシュの方式変える
				$kaiin_pass = md5($kaiin_pass1);
				print '<div>変更しますか？</div><br>';
				print '<form method="post" action="kaiin_password_change_done.php">';
				$_SESSION['my_password'] = $kaiin_pass;
				print '<input type="button" onclick="history.back()" value="戻る" class="btn">';
				print '<input type="submit" value="OK" class="btn">';
				print '</form>';
			}

			?>
		</div>
		<?php require_once('../common/html/kaiin_side.php'); ?>
	</div>
	<?php require_once('../common/html/footer.php'); ?>
</body>
</html>

