<?php

	session_start();
	session_regenerate_id(true);
	
	require_once '../common/common.php';

?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>ショップ</title>
	<?php require_once('../common/html/mise_style.php'); ?>
	<link rel="stylesheet" href="../common/css/mise_side_cate.css">
	<style>
		.product {
			float: left;
			width: 48%;
			height: 200px;
			position: relative;
		}

		.product a {
			display: block;
			position: absolute;
			top: 10px;
			left: 10px;
			width: 100%;
			height: 150px;
			transition: 0.5s;
		}

		.product .product-name {
			position: absolute;
			top: 60%;
			left: 5px;
		}

		.product a:hover {
			opacity: 0.5;
		}

		.pro-img-file {
			display: block;
			width: 90%;
			height: 90%;
		}

		.main-container {
			width: 65%;
			float: left;
			padding-bottom: 50px;
		}

		.main-title {
			text-align: center;
		}
	</style>
</head>
<body>
	<?php
		require_once('../common/html/mise_header.php');
		require_once('../common/html/mise_navi.php');
		require_once('../class/Mise_db.php');
	?>
	
	<div class="main">
		<?php require_once('../common/html/mise_side_cate.php'); ?>
		<div class="main-container clearfix">
			<h3 class="main-title">商品一覧</h3>
			<div class="products" style="margin: 0 auto; width: 90%;">
		
		<?php

			$mise_db = new Mise_db();

			$shohins = $mise_db->get_shohins();
			$pro_img_dir = getUpFileDir('mise');

			foreach ($shohins as $i => $shohin) {
				print '<div class="product">';
				print '<a href="mise_product.php?pro_code=' . $shohin['code'] . '">';
				print '<img src="' . $pro_img_dir . basename($shohin['file_path']) . '" class="pro-img-file" onerror="this.src=\'../up_img/no-image.jpg\'"><br>';
				print '<span class="product-name">' . $shohin['name'] . '</span>';
				print '<span class="product-price">' . $shohin['price'] . '円</span>';
				print '</a>';
				print '</div>';
			}
		?>
			</div>
		</div>

		<?php require_once('../common/html/mise_side.php'); ?>
	</div>
	<?php require_once('../common/html/footer.php'); ?>
</body>
</html>
