<?php
	session_start();
	session_regenerate_id(true);
/*
	// Csrf対策
	if ($_POST['csrf_token'] != $_SESSION['csrf_token']) {
		print '不正な操作が行われました。';
		exit();
	}
	unset($_SESSION['csrf_token']);
*/
?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>商品購入完了</title>
	<?php require_once('../common/html/mise_style.php'); ?>
	<link rel="stylesheet" href="../css/pro_disp.css">
</head>
<body>
	<?php
		require_once('../common/common.php');
		require_once('../common/html/mise_header.php');
		require_once('../common/html/mise_navi.php');
	?>
	<div class="main">
		<div class="main-container">

			<h3 class="main-title">購入手続き</h3>
			<?php
				require_once('../class/Mise_db.php');

				try {	

					$member_info;
					$is_login = isset($_SESSION['member_login']) && $_SESSION['member_login'] == 1;
					
					$mise_db = new Mise_db();

					if ($is_login) {
						$member_info = $mise_db->get_order($_SESSION['member_code']);
					} else {
						$member_info = sanitize($_SESSION['inputs']);	
					}

					$onamae = $member_info['name'];
					//　メールヘッダーインジェクションように
					// seven pay式？
					$email = $_POST['email'];
					// $email = $member_info['email'];
					$postal1 = $member_info['postal1'];
					$postal2 = $member_info['postal2'];
					$address = $member_info['address'];
					$tel = $member_info['tel'];
					$chumon = $member_info['chumon'];
					$pass = $member_info['password'];
					$danjo = $member_info['danjo'];
					$birth = $member_info['birth'];
					$mem_file_name = $member_info['mem_file_name'];
					$mem_file_path = $member_info['mem_file_path'];
var_dump($member_info);

					print $onamae . '様<br>';
					print 'ご注文ありがとう<br>';
					print $email . 'にメールを送りましたので、ご確認お願いします。<br>';
					print '商品は以下の住所へ発送させていただきます。<br>';
					print $postal1 . '-' . $postal2 . '<br>';
					print $address . '<br>';
					print $tel . '<br>';

					$honbun = '';
					$honbun .= $onamae . "様　\nこのたびはご注文ありがとうございました。\n";
					$honbun .= "\n";
					$honbun .= "ご注文商品\n";
					$honbun .= "-------------\n";

					$cart = $_SESSION['cart'];
					
					foreach ($cart as $code => $cnt) {
						$rec = $mise_db->get_shohin($code);

						$name = $rec['name'];
						$price = $rec['price'];
						$shokei = $price * $cnt;

						$honbun .= $name . '';
						$honbun .= $price . '円　x';
						$honbun .= $cnt . '個　=';
						$honbun .= $shokei . "円\n";
					}

					// トランザクション開始
					$mise_db->beginTransaction();
					// 排他制御のため、テーブルロック
					if (!$is_login && $chumon == 'chumontouroku') {
						$mise_db->lock_tables([Mise_db::MEM_TABLE, Mise_db::ORDER_TABLE, Mise_db::ORDER_PRODUCT_TABLE], 'write');
					} else {
						$mise_db->lock_tables([Mise_db::ORDER_TABLE, Mise_db::ORDER_PRODUCT_TABLE], 'write');
					}
					
					$last_member = 0;

					if (!$is_login && $chumon == 'chumontouroku') {
						// メンバー情報登録
						$mise_db->insert_table(Mise_db::MEM_TABLE, [
							'password' => $pass,
							'name' => $onamae,
							'email' => $email,
							'postal1' => $postal1,
							'postal2' => $postal2,
							'tel' => $tel,
							'address' => $address,
							'birth' => $birth,
							'danjo' => $danjo == 'man' ? 1 : 2,
							'mem_file_name' => $mem_file_name,
							'mem_file_path' => $mem_file_path,
						]);
						$last_member = $mise_db->get_last_ins_id();

					} else if ($is_login) {
						$last_member = $_SESSION['member_code'];
					}

					// 注文情報登録
					$mise_db->insert_table(Mise_db::ORDER_TABLE, [
						'password' => $last_member,
						'name' => $onamae,
						'email' => $email,
						'postal1' => $postal1,
						'postal2' => $postal2,
						'tel' => $tel,
						'address' => $address,
					]);

					$last_code = $mise_db->get_last_ins_id();

					foreach ($cart as $code => $cnt) {
						// 注文情報登録
						$mise_db->insert_table(Mise_db::ORDER_PRODUCT_TABLE, [
							'code_sale' => $last_code,
							'code_product' => $code,
							'quantity' => $cnt,
						]);
					}

					$mise_db->unlock_tables();
					unset($mise_db);


					if (!$is_login && $chumon == 'chumontouroku') {
						print '会員登録が完了しました。<br>';
						print '次回からメールアドレスとパスワードでログインください<br>';
						print 'ご注文が簡単にできるようなります<br>';
						print '<br>';
					}

					$honbun .= "送料は無料です。\n";
					$honbun .= "-------------------\n";
					$honbun .= "\n";
					$honbun .= "代金は以下の口座にお振込みください。\n";
					$honbun .= "テスト銀行　テスト支店　口座1111111111\n";
					$honbun .= "入金確認が取れ次第、梱包、発送させていただきます。\n";
					$honbun .= "\n";
					$honbun .= "------------------◇\n";
					$honbun .= "　～〇〇農園～　\n";
					$honbun .= "\n";
					$honbun .= "〇〇県〇市\n";
					$honbun .= "電話：　22222222\n";
					$honbun .= "FAX：　33333333333\n";
					$honbun .= "\n";

					if (!$is_login && $chumon == 'chumontouroku') {
						$honbun .= "会員登録が完了しました。\n";
						$honbun .= "次回からメールアドレスとパスワードでログインください\n";
						$honbun .= "ご注文が簡単にできるようなります\n";
						$honbun .= "\n";
					}

					$honbun .= "------------------◇\n";


					$title = 'ご注文ありがとうございます。';
					$header = 'From:info@';
					$custom_honbun = html_entity_decode($honbun, ENT_QUOTES, 'UTF-8');
					mb_language('Japanese');
					mb_internal_encoding('UTF-8');
					mb_send_mail($email, $title, $custom_honbun, $header);

					// miseあて
					$title = '注文がありました。';
					$header = 'From:info@';
					$mise_honbun = html_entity_decode($honbun, ENT_QUOTES, 'UTF-8');
					mb_language('Japanese');
					mb_internal_encoding('UTF-8');
					// miseあてemail
					mb_send_mail('test@email.cocooom.jpp', $title, $mise_honbun, $header);

					// カートを削除
					clearCart();


				} catch (Exception $e) {
					print $e;
					print 'ただいま障害によりご迷惑をおかけしています。';
					exit();
				}

			?>
			<br><a href="mise_list.php" class="btn">商品画面へ</a>
			</div>
		<?php require_once('../common/html/mise_side.php'); ?>
	</div>
	<?php require_once('../common/html/footer.php'); ?>
</body>
</html>