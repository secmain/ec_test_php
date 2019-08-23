<?php
	session_start();
	session_regenerate_id(true);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>商品編集完了</title>
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
			<h3 class="main-title">商品編集完了</h3>
			<div class="comp-message">
			<?php
				try {
					$inputs = $_SESSION['product_inputs'];
					
					$pro_code = $inputs['code'];
					/*
					$pro_name = $inputs['pro_name'];
					$pro_price = $inputs['pro_price'];
					$pro_category = $inputs['pro_cate'];
					$pro_file_name = $inputs['pro_file_name'];
					$pro_file_path = $inputs['pro_file_path'];
					*/
					
					$pro_db = new Product_db();

					/*
					$data = [
						'name' => $pro_name,
						'price' => $pro_price,
						'file_name' => $pro_file_name,
						'file_path' => $pro_file_path,
						'category' => $pro_category,
					];
					*/

					// $pro_db->up_product($pro_code, $data);
					$pro_db->up_product($pro_code, $inputs);
					
					unset($pro_db);

					print checkGamenDispField('更新しました');

				} catch (Exception $e) {
					print 'system error!!';
					exit();
				}
			?>
			</div>
		</div>
		<?php require_once('../common/html/kaiin_side.php'); ?>
	</div>
	<?php require_once('../common/html/footer.php'); ?>
</body>
</html>