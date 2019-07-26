<?php
	session_start();
	session_regenerate_id(true);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>会員修正完了</title>
	<?php require_once('../common/html/mise_style.php'); ?>
</head>
<body>
	<?php
		require_once('../common/html/mise_header.php');
		require_once('../common/html/mise_navi.php');
		require_once('../class/Mise_db.php');
	?>

	<div class="main">
		<div class="main-container">
			<h3 class="main-title">myページ編集完了</h3>

			<?php
				try {
					$kaiin_code = $_SESSION['kaiin_code'];
					$kaiin_name = $_SESSION['my_name'];
					$my_file_name = $_SESSION['my_file_name'];
					$my_file_path = $_SESSION['my_file_path'];
					
					$kaiin_name = htmlspecialchars($kaiin_name);
					// file_nameもエスケープが必要
					// $file_name = htmlspecialchars($file_name);


					$mise_db = new Mise_db();

					$mise_db->execute($data);

					$db = null;

					// セッションの会員名も更新
					$_SESSION['kaiin_name'] = $kaiin_name;
					print $kaiin_name . 'を更新しました <br>';
					print '<a href="../kaiin_top.php" class="btn">トップ画面へ</a>';

				} catch (Exception $e) {
					print 'system error!!';
					exit();

				}
			?>
		</div>
		<?php require_once('../common/html/kaiin_side.php'); ?>
	</div>
	<?php require_once('../common/html/footer.php'); ?>
</body>
</html>