<?php
	session_start();
	session_regenerate_id(true);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>会員パスワード修正完了</title>
	<?php require_once('../common/html/kaiin_style.php'); ?>
</head>
<body>
	<?php
		require_once('../common/html/kaiin_header.php');
		require_once('../common/html/kaiin_navi.php');
		require_once('../common/common.php');
		require_once('../class/Kaiin_db.php');
	?>

	<div class="main">
		<div class="main-container">
			<h3 class="main-title">パスワード変更完了</h3><br>

			<?php
				try {
					
					$kaiin_code = $_SESSION['kaiin']['kaiin_code'];
					$kaiin_pass = $_SESSION['my_password'];
					
					$kaiin_db = new Kaiin_db();

					$kaiin_db->chpwd_kaiin($kaiin_code, $kaiin_pass);
					
					unset($kaiin_db);

				} catch (Exception $e) {
					print 'system error!!';
					exit();
				}
			?>
			<div>更新しました</div><br>
			<br><a href="../kaiin_top.php" class="btn">トップ画面へ</a>
			</div>
		<?php require_once('../common/html/kaiin_side.php'); ?>
	</div>
	<?php require_once('../common/html/footer.php'); ?>
</body>
</html>