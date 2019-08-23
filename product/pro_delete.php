<?php
	session_start();
	session_regenerate_id(true);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>商品削除</title>
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
			<h3 class="main-title">商品削除</h3>
			
			<?php
				try {

					// 認可制御の脆弱性のため
					// $kaiin_code = $kaiin['kaiin_code'];
					$kaiin_code = $_GET['kaiin_code'];

					$pro_code = $_GET['pro_code'];

					//　ここでサニタイジング
					$pro_code = h($pro_code);

					$pro_db = new Product_db();

					$rec = $pro_db->get_product($pro_code);

					// 存在しないコードの場合もありえる(いらない?)
					if (!$rec) {
						print checkGamenDispFieldError('対象の商品が見つかりませんでした。');
						exit();
					// ユーザによる振り分け追加（脆弱性あり）
					} else if ($rec['kaiin_code'] != $kaiin_code) {
						print checkGamenDispFieldError('作成者以外削除することはできません。');
						exit();
					}
					
					// エスケープせず
					$pro_name = $rec['name'];
					$pro_price = $rec['price'];
					$pro_file_name = $rec['file_name'];
					$pro_file_path = $rec['file_path'];
					$pro_img_dir = getUpFileDir('product');

					$_SESSION['product_delete'] = $pro_code;

					unset($pro_db);

				} catch (Exception $e) {
						print 'system error !!!';
						print $e;
						exit();
				} 
			?>

			<div>この商品を削除してもよろしいですか？</div>
			<form action="pro_delete_done.php" method="post">
				<table class="form-table">				
					<tr>
						<th>商品コード：</th>
						<td><?php print $pro_code; ?><br></td>
					</tr>
					<tr>
						<th>商品名：</th>
						<td><?php print $pro_name; ?><br><br></td>
					</tr>
					<tr>
						<th>価格：</th>
						<td><?php print $pro_price . '円'; ?><br><br></td>
					</tr>
					<tr>
						<th>ファイル名：</th>
						<td><?php print $pro_file_name; ?><br><br></td>
					</tr>
					<tr>
						<th>画像：<br></th>
						<td>
							<img src="<?php print $pro_img_dir . basename($pro_file_path); ?>" class="pro-img-file" onerror="this.src='../up_img/no-image.jpg'"><br>
						</td>
					</tr>
				</table>
				<input type="hidden" name="name" value="<?php print $pro_name; ?>">
				<input type="button" onclick="history.back()" value="戻る" class="btn">
				<input type="submit" value="OK" class="btn">
			</form>		
		</div>
		<?php require_once('../common/html/kaiin_side.php'); ?>
	</div>
	<?php require_once('../common/html/footer.php'); ?>
</body>
</html>