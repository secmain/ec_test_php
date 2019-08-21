<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>Login errror!!!</title>
	<?php require_once('../common/html/kaiin_style.php'); ?>
	<link rel="stylesheet" href="../css/common.css">
</head>
<body>
	<div class="main">
		<div class="main-container">
			<h3 class="main-title">商品購入確認</h3>
			<?php

				require_once('../class/Kaiin_db.php');

				try {
					$kaiin_code = $_POST['code'];
					$kaiin_pass = $_POST['password'];

					$kaiin_code = htmlspecialchars($kaiin_code);
					$kaiin_pass = htmlspecialchars($kaiin_pass);

					$kaiin_pass = md5($kaiin_pass);

					$kaiin_db = new Kaiin_db();

					$rec = $kaiin_db->login_check($kaiin_code, $kaiin_pass);

					unset($kaiin_db);

					if ($rec == false) {
						print '会員コードかパスワードが間違っています';
						print '<br><br>';
						print '<a href="kaiin_login.php" class="btn">戻る</a>';
					} else {
						session_start();
						$kaiin = [
							'login' => 1,
							'kaiin_code' => $kaiin_code,
							'kaiin_name' => $rec['name'],
						];
						$_SESSION['kaiin'] = $kaiin;
						header('Location:../kaiin_top.php');
					}
				} catch (Exception $e) {
					print 'it sysetem error!!!';
					exit();
				}

			?>
		</div>
	</div>
	<?php require_once('../common/html/footer.php'); ?>
</body>
</html>