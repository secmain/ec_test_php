<?php
	session_start();
	session_regenerate_id(true);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>お問い合わせ送信完了</title>
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
			<div class="comp-message">
				<?php

					// お問い合わせ送信先mailアドレス取得
					$email_address = get_env('DOTENV_CONTACT_ADDRESS');

					try {
						$inputs = $_SESSION['contact_inputs'];
						$name = $inputs['name'];
						$seibetsu = $inputs['seibetsu'];
						$address = $inputs['address'];
						$email = $inputs['email'];
						$subject = $inputs['subject'];
						$content = $inputs['content'];

						// osコマンドインジェクションの脆弱性のため、あえて、このような形でメールを送る
						$send_mail = 'echo \'';
						$send_mail .= $content;
						$send_mail .= '\' | mail ';
						if ($subject) {
							$send_mail .= ' -s "' . $subject . '"';
						}
						// 送信元
						$send_mail .= ' -r ' . $email;
						$send_mail .= ' ';
						// 送り先（システム）
						$send_mail .= $email_address;

						system($send_mail, $ret_val);

						print checkGamenDispField('メールを送信しました');
			

					} catch (Exception $e) {
						print 'system error!!';
						exit();

					}
				?>
			</div>
			<form action="../kaiin_top.php" method="post">
					<input type="submit" value="トップページへ" class="btn">
			</form>
		</div>
		<?php require_once('../common/html/kaiin_side.php'); ?>
	</div>
	<?php require_once('../common/html/footer.php'); ?>
</body>
</html>