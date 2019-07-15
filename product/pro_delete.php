<?php
	session_start();
	session_regenerate_id(true);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>商品削除</title>
	<link rel="stylesheet" href="../common/css/font-awesome/css/all.css"> 
	<link rel="stylesheet" href="../css/normalize.css">
	<link rel="stylesheet" href="../common/css/kaiin_header.css">
	<link rel="stylesheet" href="../common/css/footer.css">
	<link rel="stylesheet" href="../common/css/kaiin_navi.css">
	<link rel="stylesheet" href="../common/css/kaiin_side.css">
	<link rel="stylesheet" href="../css/pro_delete.css">
</head>
<body>
	<?php
		require_once('../common/html/kaiin_header.php');
		require_once('../common/html/kaiin_navi.php');
		require_once('../common/common.php');
	?>
	<div class="main">
		<div class="main-container">
			<h3 class="main-title">商品削除</h3>
			
			<?php
				try {

					$pro_code = $_GET['pro_code'];
					//　ここでサニタイジング
					$pro_code = htmlspecialchars($pro_code);

					$db = connect_db();
					$db->query('set names utf8');

					$sql = 'select code, name, price, file_name, file_path from mst_product where code = ?';
					$stmt = $db->prepare($sql);
					$data = [$pro_code];
					$stmt->execute($data);

					$rec = $stmt->fetch(PDO::FETCH_ASSOC);
					// エスケープせず
					$pro_name = $rec['name'];
					$pro_price = $rec['price'];
					$pro_file_name = $rec['file_name'];
					$pro_file_path = $rec['file_path'];
					$pro_img_dir = getUpFileDir('product');

					$db = null;

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
				<input type="hidden" name="code" value="<?php print $pro_code; ?>">
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