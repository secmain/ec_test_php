<?php
	session_start();
	session_regenerate_id(true);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>myページ編集確認</title>
	<?php require_once('../common/html/mise_style.php'); ?>
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
		require_once('../common/html/mise_header.php');
		require_once('../common/html/mise_navi.php');
		require_once('../common/common.php');
	?>

	<div class="main">
		<div class="main-container">
			<h3 class="main-title">myページ編集確認</h3>

			<?php
				$post = sanitize($_POST);
				/*
				$onamae = $post['name'];
				$email = $post['email'];
				$postal1 = $post['postal1'];
				$postal2 = $post['postal2'];
				$address = $post['address'];
				$tel = $post['tel'];
				*/

				$csrf_token = createCsrftoken();
				$_SESSION['csrf_token'] = $csrf_token;
				$member_name = $post['name'];
				$my_file_tmp = $_FILES['my_file']['tmp_name'];
				$my_file_name = $_FILES['my_file']['name'];
				$up_img_dir = getUpFileDir('mise_mypage');

				$member_name = htmlspecialchars($member_name);
				$my_file_path = getUpFileTmpName($my_file_name);
				// file_nameもエスケープが必要
				// $my_file_name = htmlspecialchars($my_file_name);

				$ok_flag = true;
				$file_flag = false;

				if ($member_name == '') {
					print checkGamenDispFieldError('名前が入力されていません');
					$ok_flag = false;
				} else {
					print checkGamenDispField('会員名：　' . $member_name);
				}

				// メールヘッダーインジェクション対策
				if (preg_match('/^[\.\-\w]+@[\.\-\w]+\.([a-z]+)$/', $post['email']) == 0) {
					print checkGamenDispFieldError('メールアドレスを正確に入力してください。');
					$ok_flg = false;
				} else {
					print 'メールアドレス<br>';
					print $post['email'];
					print '<br><br>';
				}

				if (preg_match('/^\d{3}$/', $post['postal1']) == 0) {
					print checkGamenDispFieldError('郵便番号（前）は半角数字3文字で入力してください。');
					$ok_flg = false;
				} else {
					print '郵便番号<br>';
					print $post['postal1'] . '-' . $post['postal2'];
					print '<br><br>';
				}

				if (preg_match('/^\d{4}$/', $post['postal2']) == 0) {
					print checkGamenDispFieldError('郵便番号（後）は半角数字4文字で入力してください。');
					$ok_flg = false;
				}

				// 脆弱性あり
				if ($post['address'] == '') {
					print checkGamenDispFieldError('住所が入力されていません。');
					$ok_flg = false;
				} else {
					print '住所<br>';
					print $post['address'];
					print '<br><br>';
				}

				if (preg_match('/^\d{2,5}-?\d{2,5}-?\d{4,5}$/', $post['tel']) == 0) {
					print checkGamenDispFieldError('電話番号を正確に入力してください。');
					$ok_flg = false;
				} else {
					print '電話番号<br>';
					print $post['tel'];
					print '<br><br>';
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
					$_SESSION['member_info'] = $post;
					$_SESSION['member_info']['my_file_path'] = $up_img_dir . $my_file_path;
					$_SESSION['member_info']['my_file_name'] = $my_file_name;
					print '<form method="post" action="mise_edit_mypage_done.php">';
					print '<input type="hidden" id="url" value="' . $up_img_dir . $my_file_path . '">';
					print '<input type="button" onclick="history.back()" value="戻る" class="btn">';
					print '<input type="submit" value="OK" class="btn">';
					print '</form>';
				}

			?>

		</div>
		<?php require_once('../common/html/mise_side.php'); ?>
	</div>
	<?php require_once('../common/html/footer.php'); ?>
</body>
</html>

