<?php
	session_start();
	session_regenerate_id(true);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>商品編集入力</title>
	<?php require_once('../common/html/pro_style.php'); ?>
	<link rel="stylesheet" href="../css/pro_edit.css">
</head>
<body>
	<?php
		require_once('../common/html/kaiin_header.php');
		require_once('../common/html/kaiin_navi.php');
		require_once('../common/common.php');
		require_once('../class/Product_db.php');
	?>

	<div class="main">
		<div class="main-container">
			<h3 class="main-title">商品編集</h3>
			<?php
				try {

					$kaiin = $_SESSION['kaiin'];
					// 認可制御の脆弱性のため
					// $kaiin_code = $kaiin['kaiin_code'];
					$kaiin_code = $_GET['kaiin_code'];

					$pro_code = $_GET['pro_code'];

					//　ここでサニタイジング
					// $pro_code = h($pro_code);

					$pro_db = new Product_db();

					$rec = $pro_db->get_product($pro_code);
					$categorys = $pro_db->get_categorys();

					// 存在しないコードの場合もありえる(いらない?)
					if (!$rec) {
						print checkGamenDispFieldError('対象の商品が見つかりませんでした。');
						exit();
					// ユーザによる振り分け追加（脆弱性あり）
					} else if ($rec['kaiin_code'] != $kaiin_code) {
						print checkGamenDispFieldError('作成者以外編集することはできません。');
						exit();
					}

					$_SESSION['product_inputs'] = $rec;

					$pro_name = $rec['name'];
					$pro_price = $rec['price'];
					$pro_category = $rec['category'];
					// xssの可能性あり
					$pro_file_path = $rec['file_path'];

					/* fileの更新
					なし⇒なし　〇
					なし⇒あり　〇
					あり⇒なし　削除ボタン？
					あり⇒あり　対策必要
					あり⇒あり（変更あり）　〇
					*/

					$pro_img_dir = getUpFileDir('product');

					unset($pro_db);

				} catch (Exception $e) {
						print 'system error !!!';
						print $e;
						exit();
				} 
			?>
		

			<form action="pro_edit_check.php" method="post" enctype="multipart/form-data">
				<table class="form-table">				
					<tr>
						<th>商品コード：</th>
						<td><?php print $pro_code ?><br></td>
						<td><input type="hidden" name="code" value="<?php print $pro_code; ?>"><br></td>
					</tr>
					<tr>
						<th>名前：</th>
						<td><input type="text" name="name" value="<?php print $pro_name; ?>"><br><br></td>
					</tr>
					<tr>
						<th>価格：</th>
						<td><input type="text" name="price" value="<?php print $pro_price; ?>"><br><br></td>
					</tr>
					<tr>
						<th>カテゴリー：</th>
						<td>
							<select name="category">
								<option value="0"></option>
								<?php
									foreach ($categorys as $i => $category) {
										$selected = '';
										if ($category['id'] == $pro_category) {
											$selected = 'selected';
										}
										print sprintf(
											'<option value="%s" %s>%s</option>',
											$category['id'],
											$selected,
											$category['text']
										);										
									}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<th>画像：<br></th>
						<td>
							<img src="<?php print $pro_img_dir . $pro_file_path; ?>" class="pro-img-file" onerror="this.src='../up_img/no-image.jpg'"><br>
							<input type="file" name="pro_img_file" size="10" value="<?php print $pro_img_dir . $pro_file_path; ?>">
						</td>
					</tr>
				</table>				
				
				<input type="button" onclick="history.back()" value="戻る" class="btn">
				<input type="submit" value="送信" class="btn">
			</form>
		</div>

		<?php require_once('../common/html/kaiin_side.php'); ?>
	</div>
	<?php require_once('../common/html/footer.php'); ?>
</body>
</html>