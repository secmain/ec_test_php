<?php
	session_start();
	session_regenerate_id(true);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>購入手続き</title>
	<?php require_once('../common/html/mise_style.php'); ?>
	<link rel="stylesheet" href="../css/pro_disp.css">
	<style>
		.hidden-area {
			display: none;
		}

		.ng-message {
			margin: 20px;
		}
	</style>
	<script>
		function init() {
			addEventListener('change', disp_change, false);

			function disp_change() {
				var trs = document.getElementsByClassName('hidden-area');
				var radio = document.getElementsByName('chumon');
				if (radio[1].checked) {
					Array.prototype.forEach.call(trs, function(tr) {
						tr.style.display = 'table-row';
					});
				} else {
					Array.prototype.forEach.call(trs, function(tr) {
						tr.style.display = 'none';
					});
				}
			}
		}
	</script>
</head>

<body onload="init()">
	<?php
		require_once('../common/html/mise_header.php');
		require_once('../common/html/mise_navi.php');
		require_once('../common/common.php');
		require_once('../class/Mise_db.php');
	?>

	<div class="main">
		<div class="main-container">
			<h3 class="main-title">購入手続き</h3>
			<form action="mise_form_check.php" method="post">
				<?php

					if (!isset($_SESSION['cart']) || !count($_SESSION['cart'])) {
						print '<div class="ng-message">カートに商品が入っていません</div>';
						print '<input type="button" onclick="history.back()" value="戻る" class="btn">';
						exit();
					}

					$onamae = '';
					$email = '';
					$postal1 = '';
					$postal2 = '';
					$address = '';
					$tel = '';

					// メンバーログインチェック
					$is_login = isset($_SESSION['member']) && $_SESSION['member']['member_login'] == 1;
					// メンバーログイン時
					if ($is_login) {

						$mise_db = new Mise_db();
						$member = $_SESSION['member'];
						// メンバー情報取得
						$rec = $mise_db->get_member($member['member_code']);

						$onamae = $rec['name'];
						$email = $rec['email'];
						$postal1 = $rec['postal1'];
						$postal2 = $rec['postal2'];
						$address = $rec['address'];
						$tel = $rec['tel'];

						unset($rec);
						unset($mise_db);
					}				

				?>
				<table class="form-table">				
					<tr>
						<th>お名前</th>
						<td><input type="text" name="name" class="lg-input-box" value="<?php print $onamae; ?>"></td>
					</tr>
					<tr>
						<th>メールアドレス</th>
						<td><input type="text" name="email" class="lg-input-box" value="<?php print $email; ?>"></td>
					</tr>
					<tr>
						<th>郵便番号</th>
						<td>
							<input type="text" name="postal1" class="sm-input-box" value="<?php print $postal1; ?>">-
							<input type="text" name="postal2" class="sm-input-box" value="<?php print $postal2; ?>">
						</td>
					</tr>
					<tr>
						<th>住所</th>
						<td><input type="text" name="address" class="lg-input-box" value="<?php print $address; ?>"></td>
					</tr>
					<tr>
						<th>電話番号</th>
						<td><input type="text" name="tel" class="lg-input-box" value="<?php print $tel; ?>"></td>
					</tr>
					
					<?php if (!$is_login) { ?>
					<tr>
						<th></th>
						<td>
							<label><input type="radio" name="chumon" value="chumonkonkai" checked>今回だけの注文</label>
							<label><input type="radio" name="chumon" value="chumontouroku">会員登録して注文</label>
						</td>
					</tr>
					<?php } ?>
					
					<tr class="hidden-area">
						<th></th>
						<td>会員登録する方は以下の項目も入力してください。</td>
					</tr>
					<tr class="hidden-area">
						<th>画像<br></th>
						<td>
							<input type="file" name="prof_file">
						</td>
					</tr>
					<tr class="hidden-area">
						<th>パスワード</th>
						<td><input type="password" name="pass" class="md-input-box"></td>
					</tr>
					<tr class="hidden-area">
						<th>パスワード確認</th>
						<td><input type="password" name="pass2" class="md-input-box"></td>
					</tr>
					<tr class="hidden-area">
						<th>性別</th>
						<td>
							<label class="seibetsu"><input type="radio" name="danjo" value="man" checked>男性</label>
							<label class="seibetsu"><input type="radio" name="danjo" value="woman" checked>女性</label>
						</td>
					</tr>
					<tr class="hidden-area">
						<th>生まれ年</th>
						<td>
							<select name="birth">
								<option value="1910">1910年代</option>
								<option value="1920">1920年代</option>
								<option value="1930">1930年代</option>
								<option value="1940">1940年代</option>
								<option value="1950">1950年代</option>
								<option value="1960">1960年代</option>
								<option value="1970">1970年代</option>
								<option value="1980" selected>1980年代</option>
								<option value="1990">1990年代</option>
								<option value="2000">2000年代</option>
								<option value="2100">2100年代</option>
							</select>
						</td>
					</tr>
					</div>
				</table>
				
				<input type="button" onclick="history.back()" value="戻る" class="btn">
				<input type="submit" value="OK" class="btn">
				
			</form>
		</div>
		<?php require_once('../common/html/mise_side.php'); ?>
	</div>
	<?php require_once('../common/html/footer.php'); ?>
</body>
</html>