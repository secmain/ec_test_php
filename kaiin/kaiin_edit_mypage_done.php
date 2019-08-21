<?php
	session_start();
	session_regenerate_id(true);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>会員修正完了</title>
	<?php require_once('../common/html/kaiin_style.php'); ?>
	<link rel="stylesheet" href="../css/kaiin_edit.css">
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
			<h3 class="main-title">myページ編集完了</h3>

			<?php
				try {
					$input = $_SESSION['my_inputs'];
					$kaiin_code = $_SESSION['kaiin']['kaiin_code'];
					$kaiin_name = $input['my_name'];
					$my_file_name = $input['my_file_name'];
					$my_file_path = $input['my_file_path'];
					
					$kaiin_name = htmlspecialchars($kaiin_name);
					// file_nameもエスケープが必要
					// $file_name = htmlspecialchars($file_name);


					$kaiin_db = new Kaiin_db();
					
					$kaiin_db->up_kaiin(
						$kaiin_code, 
						[
							'name' => $kaiin_name,
							'prof_file_name' => $my_file_name,
							'prof_file_path' => $my_file_path,
						]);

					unset($kaiin_db);

					// セッションの会員名も更新
					$_SESSION['kaiin']['kaiin_name'] = $kaiin_name;
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