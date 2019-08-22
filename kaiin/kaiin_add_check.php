<?php
	session_start();
	session_regenerate_id(true);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<?php require_once('../common/html/kaiin_style.php'); ?>
	<link rel="stylesheet" href="../css/kaiin_add.css">
	<script src="../common/js/common.js"></script>
	<script>
		(function () {
			window.addEventListener('load', disp_upfile);
		})();
	</script>
	<title>会員追加確認</title>
</head>
<body>

	<?php
		require_once('../common/html/kaiin_header.php');
		require_once('../common/html/kaiin_navi.php');
		require_once('../common/common.php');
	?>

	<div class="main">
		<div class="main-container">
			<h3 class="main-title">会員追加確認</h3>
			<?php

			$post = sanitize($_POST);
			$kaiin_name = $post['name'];
			$kaiin_pass1 = $post['password1'];
			$kaiin_pass2 = $post['password2'];
			$kanri = $post['kanri'];
			$tmp_file = $_FILES['prof_file']['tmp_name'];
			$prof_file_name = $_FILES['prof_file']['name'];
			$prof_file_path = getUpFileTmpName($prof_file_name);
			$prof_img_dir = getUpFileDir('kaiin');

			// file_nameもエスケープが必要　linuxから<img ～>のファイル名をアップできるため
			$prof_file_name = h($prof_file_name);

			$ok_flag = true;

			// 名前のチェック
			if ($kaiin_name == '') {
				print checkGamenDispFieldError('会員名が入力されていません');
				$ok_flag = false;
			} else {
				print checkGamenDispField('会員名：　' . $kaiin_name);
			}

			// パスワードのチェック
			if ($kaiin_pass1 == '') {
				print checkGamenDispFieldError('パスワードが入力されていません');
				$ok_flag = false;
			} else if ($kaiin_pass1 !== $kaiin_pass2) {
				print checkGamenDispField('パスワードが一致しません');
				$ok_flag = false;
			}

			// 管理者区分選択のチェック
			/*
			$kanri_kubuns = getKanrikubun();
			if (!isset($kanri_kubuns[$kanri])) {
				print checkGamenDispFieldError('管理区分に不正な値が入力されました。');
				$ok_flag = false;
			}
			*/

			// アップロードファイルの処理
			if (is_uploaded_file($tmp_file)) {
				$file_flag = true;
			}

			//if ($file_flag && !move_uploaded_file($tmp_file, $prof_img_dir . basename($file_name))) {
			if ($file_flag && !move_uploaded_file($tmp_file, $prof_img_dir . $prof_file_name)) {
				print checkGamenDispFieldError('ファイルのアップロードに失敗しました。');
				$ok_flag = false;
			} else if ($file_flag) {
				// あえてファイル名表示
				print checkGamenDispField('ファイル名：　' . $pro_file_name);
				print '<div id="image-zone" class="image-zone"></div>';
			}

			if (!$ok_flag) {
				print '<form>';
				print '<input type="button" onclick="history.back()" value="戻る">';
				print '</form>';
			} else {
				// csrfの脆弱性を作るため、トークンを飛ばさない
				$kaiin_pass = md5($kaiin_pass1);
				$kaiin_obj = [];
				$kaiin_obj['name'] = $kaiin_name;
				$kaiin_obj['password'] = $kaiin_pass;
				// 廃止
				// $kaiin_obj['kanri'] = $kanri;
				$kaiin_obj['prof_file_name'] = $prof_file_name;
				$kaiin_obj['prof_file_path'] = $prof_file_path;
				$_SESSION['kaiin_add'] = $kaiin_obj;
				print 'この内容で登録しますか？';
				print '<form method="post" action="kaiin_add_done.php">';
				print '<input type="hidden" id="url" value="' . $pro_img_dir . $pro_file_path . '">';
				print '<input type="button" onclick="history.back()" value="戻る" class="btn">';
				print '<input type="submit" value="OK" class="btn">';
				print '</form>';
			}

		?>
		</div>
		<?php require_once '../common/html/kaiin_side.php'; ?>
	</div>
	<?php require_once('../common/html/footer.php'); ?>
</body>
</html>

