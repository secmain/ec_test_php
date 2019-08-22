<?php
	session_start();
	session_regenerate_id(true);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>商品参照</title>
	<?php require_once('../common/html/pro_style.php'); ?>
	<link rel="stylesheet" href="../css/pro_disp.css">
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
			<h3 class="main-title">商品参照</h3>

			<?php
				try {

					$pro_code = $_GET['pro_code'];
					//　ここでサニタイジング
					// $pro_code = htmlspecialchars($pro_code);

					$pro_db = new Product_db();

					$rec = $pro_db->get_product($pro_code);
					$pro_name = $rec['name'];
					$pro_price = $rec['price'];
					$pro_file_name = $rec['file_name'];
					$pro_file_path = $rec['file_path'];
					$up_img_dir = getUpFileDir('product');

					unset($pro_db);

				} catch (Exception $e) {
						print 'system error !!!';
						print $e;
						exit();
				} 
			?>

			<table class="form-table">				
				<tr>
					<th>商品コード：</th>
					<td><?php print $pro_code ?><br></td>
				</tr>
				<tr>
					<th>名前：</th>
					<td><?php print $pro_name ?><br><br></td>
				</tr>
				<tr>
					<th>価格：</th>
					<td><?php print $pro_price . '円' ?><br><br></td>
				</tr>
				<tr>
					<th>画像：<br></th>
					<td>
						<img src="<?php print $up_img_dir . basename($pro_file_path); ?>" class="pro-img-file" onerror="this.src='../up_img/no-image.jpg'"><br>
					</td>
				</tr>
			</table>
			<input type="button" onclick="history.back()" value="戻る" class="btn">
		</div>
		<?php require_once('../common/html/kaiin_side.php'); ?>
	</div>
	<?php require_once('../common/html/footer.php'); ?>
</body>
</html>