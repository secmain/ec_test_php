<?php
	session_start();
	session_regenerate_id(true);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>商品購入確認</title>
	<?php require_once('../common/html/mise_style.php'); ?>
	<link rel="stylesheet" href="../css/pro_edit.css">
	<style>
		.error {
			color:red;
		}
	</style>
</head>
<body>
	<?php
		require_once('../common/html/mise_header.php');
		require_once('../common/html/mise_navi.php');
		require_once('../common/common.php');
	?>

	<div class="main">
		<div class="main-container">
			<h3 class="main-title">商品購入確認</h3>

			<?php
				$post = sanitize($_POST);
				$onamae = $post['name'];
				$email = $post['email'];
				$postal1 = $post['postal1'];
				$postal2 = $post['postal2'];
				$address = $post['address'];
				$tel = $post['tel'];
				$chumon = $post['chumon'];
				$pass = $post['pass'];
				$pass2 = $post['pass2'];
				$danjo = $post['danjo'];
				$birth = $post['birth'];

				$csrf_token = createCsrftoken();
				$_SESSION['csrf_token'] = $csrf_token;


				$ok_flg = true;

				// メール改ざんの脆弱性
				if ($onamae == '') {
					print checkGamenDispFieldError('お名前が入力されていません。');
					$ok_flg = false;
				} else {
					print 'お名前<br>';
					print $onamae;
					print '<br><br>';
				}

				// メールヘッダーインジェクション対策
				if (preg_match('/^[\.\-\w]+@[\.\-\w]+\.([a-z]+)$/', $email) == 0) {
					print checkGamenDispFieldError('メールアドレスを正確に入力してください。');
					$ok_flg = false;
				} else {
					print 'メールアドレス<br>';
					print $email;
					print '<br><br>';
				}

				if (preg_match('/^\d{3}$/', $postal1) == 0) {
					print checkGamenDispFieldError('郵便番号（前）は半角数字3文字で入力してください。');
					$ok_flg = false;
				} else {
					print '郵便番号<br>';
					print $postal1 . '-' . $postal2;
					print '<br><br>';
				}

				if (preg_match('/^\d{4}$/', $postal2) == 0) {
					print checkGamenDispFieldError('郵便番号（後）は半角数字4文字で入力してください。');
					$ok_flg = false;
				}

				// 脆弱性あり
				if ($address == '') {
					print checkGamenDispFieldError('住所が入力されていません。');
					$ok_flg = false;
				} else {
					print '住所<br>';
					print $address;
					print '<br><br>';
				}

				if (preg_match('/^\d{2,5}-?\d{2,5}-?\d{4,5}$/', $tel) == 0) {
					print checkGamenDispFieldError('電話番号を正確に入力してください。');
					$ok_flg = false;
				} else {
					print '電話番号<br>';
					print $tel;
					print '<br><br>';
				}

				# 脆弱性入れる
				if ($chumon == 'chumontouroku') {
					$pass_check = passwordCheck($pass, $pass2);
					if ($pass_check != 'ok') {
						print $pass_check;
						$ok_flg = false;
					}

					print '性別<br>';
					if ($danjo == 'man') {
						print '男性';
					} else {
						print '女性';
					}

					print '<br><br>';

					// SQLインジェクション
					print '生まれ年<br>';
					print $birth;
					print '年代';
					print '<br><br>';

					$mem_file_tmp = $_FILES['prof_file']['tmp_name'];
					$mem_file_name = $_FILES['prof_file']['name'];
					$mem_file_path = getUpFileTmpName($mem_file_name);
					$up_img_dir = getUpFileDir('mypage');

					# 画像アップ処理
					if (is_uploaded_file($mem_file_tmp)) {
						$file_flag = true;
					}

					if ($file_flag && !move_uploaded_file($mem_file_tmp, $up_img_dir . $mem_file_path)) {
						print checkGamenDispFieldError('ファイルのアップロードに失敗しました。');
						$ok_flag = false;
					} else if ($file_flag) {
						print checkGamenDispField('ファイル名：' . $mem_file_name);
						print '<div id="image-zone" class="image-zone"></div>';
					}
				}

				if ($ok_flg === true) {
					print '<form action="mise_form_done.php" method="post">';
					$inputs = [];
					$inputs['name'] = $onamae;
					$inputs['email'] = $email;
					$inputs['postal1'] = $postal1;
					$inputs['postal2'] = $postal2;
					$inputs['address'] = $address;
					$inputs['tel'] = $tel;
					$inputs['chumon'] = $chumon;
					$inputs['password'] = $pass;
					$inputs['danjo'] = $danjo;
					$inputs['birth'] = $birth;
					$inputs['mem_file_name'] = $mem_file_name;
					$inputs['mem_file_path'] = $mem_file_path;
					$_SESSION['inputs'] = $inputs;
					/* sessionへ格納にする　脆弱性減らす
					print '<input type="hidden" name="name" value="'. $onamae .'">';
					print '<input type="hidden" name="email" value="'. $email .'">';
					print '<input type="hidden" name="postal1" value="'. $postal1 .'">';
					print '<input type="hidden" name="postal2" value="'. $postal2 .'">';
					print '<input type="hidden" name="address" value="'. $address .'">';
					print '<input type="hidden" name="tel" value="'. $tel .'">';
					print '<input type="hidden" name="chumon" value="'. $chumon .'">';
					print '<input type="hidden" name="password" value="'. $pass .'">';
					print '<input type="hidden" name="danjo" value="'. $danjo .'">';
					print '<input type="hidden" name="birth" value="'. $birth .'">';
					*/
					//　メールヘッダーインジェクション用に
					print '<input type="hidden" name="email" value="'. $email .'">';
					print '<input type="hidden" name="csrf_token" value="'. $csrf_token .'">';
					print '<input type="button" onclick="history.back()" value="戻る" class="btn">';
					print '<input type="submit" value="OK" class="btn"><br>';
					print '</form>';
				} else {
					print '<form>';
					print '<input type="button" onclick="history.back()" value="戻る" class="btn">';
					print '</form>';
				}

			?>

		</div>
		<?php require_once('../common/html/mise_side.php'); ?>
	</div>
	<?php require_once('../common/html/footer.php'); ?>
</body>
</html>