<?php
	session_start();
	session_regenerate_id(true);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>商品追加完了</title>
	<?php require_once('../common/html/pro_style.php'); ?>
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
			<div class="comp-message">
			<?php
				try {
					$pro_name = $_POST['pro_name'];
					$pro_price = $_POST['pro_price'];
					$pro_cate = $_POST['pro_category'];
					$file_name = $_POST['pro_file_name'];
					$file_path = $_POST['pro_file_path'];
					
					$pro_db = new Product_db();

					$data = [
						'name' => $pro_name,
						'price' => $pro_price,
						'file_name' => $file_name,
						'file_path' => $file_path,
						'category' => $pro_cate
					];
				
					$pro_db->add_product($data);

					unset($pro_db);

					print checkGamenDispField($pro_name . 'を追加しました');

				} catch (Exception $e) {
					print 'system error!!';
					exit();

				}
			?>
			</div>
			<a href="./pro_list.php" class="btn">戻る</a>
		</div>
		<?php require_once('../common/html/kaiin_side.php'); ?>
	</div>
	<?php require_once('../common/html/footer.php'); ?>
</body>
</html>