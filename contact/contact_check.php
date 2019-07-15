<?php
	session_start();
	session_regenerate_id(true);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>お問い合わせ内容確認</title>
	<link rel="stylesheet" href="../css/normalize.css">
	<link rel="stylesheet" href="../common/css/font-awesome/css/all.css"> 
	<link rel="stylesheet" href="../common/css/kaiin_header.css">
	<link rel="stylesheet" href="../common/css/footer.css">
	<link rel="stylesheet" href="../common/css/kaiin_navi.css">
	<link rel="stylesheet" href="../common/css/kaiin_side.css">
	<link rel="stylesheet" href="../css/contact.css">
</head>

<body>
	<?php 
		require_once('../common/html/kaiin_header.php');
		require_once('../common/html/kaiin_navi.php');
		require_once('../common/common.php');
	?>

	<div class="main">
		<div class="main-container">
			<h2 class="main-title">内容確認</h2>

			<?php

				// email以外の項目もエスケープの方式変換によってはosコマンドインジェクションの脆弱性が生まれる可能性あり
				$post = sanitize($_POST);
				$name = $post['name'];
				$seibetsu = $post['seibetsu'];
				$address = $post['address'];
				$email = $post['email'];
				$email2 = $post['email2'];
				$subject = $post['subject'];
				$content = $post['content'];

				$ok_flag = true;

				if ($name == '') {
					print checkGamenDispFieldError('名前が入力されていません');
					$ok_flag = false;
				} else {
					print checkGamenDispField('お名前：　' . $name);
				}

				if ($seibetsu == '') {
					print checkGamenDispFieldError('性別が入力されていません');
					$ok_flag = false;
				} else {
					print checkGamenDispField('性別：　' . $seibetsu);
				}

				if ($address) {
					print checkGamenDispField('住所：　' . $address);
				}

				// 脆弱性のため、正規表現チェックに漏れ
				// if (preg_match('/^[\.\-\w]+@[\.\-\w]+\.([a-z]+)$/', $email) == 0) {
				if (preg_match('/^[\.\-\w]+@[\.\-\w]+\.([a-z]+)/', $email) == 0) {
					print checkGamenDispFieldError('メールアドレスを正確に入力してください。');
					$ok_flag = false;
				} else if ($email !== $email2) {
					print checkGamenDispFieldError('メールアドレスが一致しません');
					$ok_flag = false;
				} else {
					print checkGamenDispField('メールアドレス: ' . $email);
				}

				if ($subject) {
					print checkGamenDispField('タイトル：　' . $subject);
				}

				if ($content == '') {
					print checkGamenDispFieldError('内容が入力されていません');
					$ok_flag = false;
				} else {
					print checkGamenDispField('内容：　' . $content);
				}

				if (!$ok_flag) {
					print '<form>';
					print '<input type="button" onclick="history.back()" value="戻る">';
					print '</form>';
				} else {
					$_SESSION['name'] = $name;
					$_SESSION['seibetsu'] = $seibetsu;
					$_SESSION['address'] = $address;
					$_SESSION['email'] = $email;
					$_SESSION['subject'] = $subject;
					$_SESSION['content'] = $content;
					print '<form method="post" action="contact_done.php">';
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

