<?php
	session_start();
	session_regenerate_id(true);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>会員編集確認</title>
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
			<h2 class="main-title">会員編集確認</h2>

			<?php
				$kaiin_code = $_POST['code'];
				$kaiin_name = $_POST['name'];
				
				$kaiin_file_tmp = $_FILES['prof_file']['tmp_name'];
				$kaiin_file_name = $_FILES['prof_file']['name'];
				$up_img_dir = getUpFileDir('kaiin');
				$kaiin_file_path = getUpFileTmpName($kaiin_file_name);
				
				// kaiin_codeのサニタイジングがない
				$kaiin_name = htmlspecialchars($kaiin_name);
				$kaiin_pass1 = htmlspecialchars($kaiin_pass1);
				$kaiin_pass2 = htmlspecialchars($kaiin_pass2);
				//

				$ok_flag = true;
				$file_flag = false;

				
				if ($kaiin_code == '') {
					print checkGamenDispFieldError('会員コードが入力されていません');
					$ok_flag = false;
				} else {
					print checkGamenDispField('会員コード：　' . $kaiin_code);
				}

				if ($kaiin_name == '') {
					print checkGamenDispFieldError('名前が入力されていません');
					$ok_flag = false;
				} else {
					print checkGamenDispField('会員名：　' . $kaiin_name);
				}

				if (is_uploaded_file($kaiin_file_tmp)) {
					$file_flag = true;
				}

				if ($file_flag && !move_uploaded_file($kaiin_file_tmp, $up_img_dir . $kaiin_file_path)) {
					print checkGamenDispFieldError('ファイルのアップロードに失敗しました。');
					$ok_flag = false;
				} else if ($file_flag) {
					print checkGamenDispField('ファイル名：' . $kaiin_file_name);
					print '<div id="image-zone" class="image-zone"></div>';
				}

				if (!$ok_flag) {
					print '<form>';
					print '<input type="button" class="btn" onclick="history.back()" value="戻る">';
					print '</form>';
				} else {
					$kaiin_pass = md5($kaiin_pass1);
					// 脆弱性
					print '<form method="post" action="kaiin_edit_done.php">';
					// 認可の脆弱性（予定）
					print '<input type="hidden" name="code" value="' . $kaiin_code . '">';
					print '<input type="hidden" name="name" value="' . $kaiin_name . '">';
					print '<input type="hidden" name="kaiin_file_name" value="' . $kaiin_file_name . '">';
					print '<input type="hidden" name="kaiin_file_path" value="' . $kaiin_file_path . '">';
					print '<input type="button" class="btn" onclick="history.back()" value="戻る">';
					print '<input type="submit" class="btn" value="OK">';
					print '</form>';
				}

			?>
			</div>
		<?php require_once '../common/html/kaiin_side.php'; ?>
	</div>
	<?php require_once '../common/html/footer.php'; ?>
</body>
</html>

