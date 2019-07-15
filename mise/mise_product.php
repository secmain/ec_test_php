<?php
	session_start();
	session_regenerate_id(true);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>商品詳細</title>
	<?php require_once('../common/html/mise_style.php'); ?>
	<link rel="stylesheet" href="../css/pro_disp.css">
</head>
<body>
<?php
	
	require_once('../common/html/mise_header.php');
	require_once('../common/html/mise_navi.php');
	require_once('../class/Mise_db.php');

	try {

		$pro_code = $_GET['pro_code'];
		//　ここでサニタイジング
		// $pro_code = htmlspecialchars($pro_code);

		$mise_db = new Mise_db();

		$rec = $mise_db->get_shohin($pro_code);
		$pro_name = $rec['name'];
		$pro_price = $rec['price'];
		$pro_file_name = $rec['file_name'];
		$pro_file_path = $rec['file_path'];
		$pro_img_dir = getUpFileDir('product');

	} catch (Exception $e) {
		print 'system error !!!';
		print $e;
		exit();
	} 
?>
	<div class="main">
		<div class="main-container">
			<h3 class="main-title">商品詳細</h3>
			<table class="form-table">				
				<tr>
					<th>商品コード：</th>
					<td><?php print $pro_code ?><br></td>
				</tr>
				<tr>
					<th>商品名：</th>
					<td><?php print $pro_name ?><br><br></td>
				</tr>
				<tr>
					<th>価格：</th>
					<td><?php print $pro_price . '円' ?><br><br></td>
				</tr>
				<tr>
					<th>画像：<br></th>
					<td>
						<img src="<?php print $pro_img_dir . basename($pro_file_path); ?>" class="pro-img-file" onerror="this.src='../up_img/no-image.jpg'"><br>
						<?php print $pro_file_name; ?>
					</td>
				</tr>
			</table>
			<input type="button" onclick="history.back()" value="戻る" class="btn">
			<input type="button" onclick="location.href='mise_cartin.php?pro_code=<?php print $pro_code; ?>'" value="カートに入れる" class="btn">
		</div>
		<?php require_once('../common/html/mise_side.php'); ?>
	</div>
	<?php require_once('../common/html/footer.php'); ?>
</body>
</html>