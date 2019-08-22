<?php
	session_start();
	session_regenerate_id(true);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>myページ編集確認</title>
	<?php require_once('../common/html/kaiin_style.php'); ?>
	<link rel="stylesheet" href="../css/pro_edit.css">
	<script src="../common/js/common.js"></script>
	<script>
		(function () {
			window.addEventListener('load', disp_upfile);
		})();
	</script>
</head>
<body>
	<?php
		require_once('../common/html/kaiin_header.php');
		require_once('../common/html/kaiin_navi.php');
		require_once('../common/common.php');
	?>

	<div class="main">
		<div class="main-container">
			<h3 class="main-title">myページ編集確認</h3>

			<?php
			
				$kaiin_name = $_POST['name'];
				$my_file_tmp = $_FILES['prof_file']['tmp_name'];
				$my_file_name = $_FILES['prof_file']['name'];
				$up_img_dir = getUpFileDir('mypage');

				$kaiin_name = htmlspecialchars($kaiin_name);
				$my_file_path = getUpFileTmpName($my_file_name);
				// file_nameもエスケープが必要
				// $my_file_name = htmlspecialchars($my_file_name);

				$ok_flag = true;
				$file_flag = false;

				if ($kaiin_name == '') {
					print checkGamenDispFieldError('名前が入力されていません');
					$ok_flag = false;
				} else {
					print checkGamenDispField('会員名：　' . $kaiin_name);
				}

				if (is_uploaded_file($my_file_tmp)) {
					$file_flag = true;
				}

				if ($file_flag && !move_uploaded_file($my_file_tmp, $up_img_dir . $my_file_path)) {
					print checkGamenDispFieldError('ファイルのアップロードに失敗しました。');
					$ok_flag = false;
				} else if ($file_flag) {
					print checkGamenDispField('ファイル名：' . $my_file_name);
					print '<div id="image-zone" class="image-zone"></div>';
				}


				if (!$ok_flag) {
					print '<form>';
					print '<input type="button" onclick="history.back()" value="戻る">';
					print '</form>';
				} else {
					$inputs = [
						'my_name' => $kaiin_name,
						'prof_file_name' => $my_file_name,
						'prof_file_path' => $my_file_path
					];
					$_SESSION['my_inputs'] = $inputs;
					print '<form method="post" action="kaiin_edit_mypage_done.php">';
					print '<input type="hidden" id="url" value="' . $up_img_dir . $my_file_path . '">';
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

