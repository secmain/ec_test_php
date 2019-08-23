<?php
	session_start();
	session_regenerate_id(true);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>商品一覧</title>
	<?php require_once('../common/html/pro_style.php'); ?>
	<link rel="stylesheet" href="../css/pro_list.css">
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
			<h2 class="main-title">商品一覧</h2>
			<?php
				try {
					$pro_db = new Product_db();
					$categorys = $pro_db->get_categorys();

					$cate = isset($_GET['category']) ? $_GET['category'] : null;
					$products = $pro_db->get_products($cate);

					unset($pro_db);

				} catch (Exception $e) {
						print 'system error !!!';
						print $e;
						exit();
				}
			?> 
			<center>
			<form method="get" action="" class="category-select">
				カテゴリー：&nbsp;&nbsp;
				<select name="category" id="pro_category">
					<option value="">指定なし</option>
					<?php
						foreach ($categorys as $i => $category) {
							print '<option value="' . $category['id'] . '">' . $category['text'] . '</option>';
						}
					?>
				</select>
				<button>絞り込み検索</button>
			</form>
			</center>
			<form action="pro_branch.php" method="post" class="pro-list-form">
				<div class="products">

	<?php

			$up_img_dir = getUpFileDir('product');

			foreach ($products as $i => $product) {
				print '<label>';
				print '<div class="product">';
				print '<img src="' . $up_img_dir . $product['file_path'] . '" class="product-image" onerror="this.src=\'../up_img/no-image.jpg\'"><br>';
				print '<input type="radio" name="pro_code" value="' . $product['code'] . '">';
				print $product['name'] . ' ';
				print '[' . $product['price'] . '円]<br>';
				print '作成者：　' . $product['kaiin_name'];
				print '</div>';
				print '</label>';
			}

	?>
				</div>
				<input type="hidden" name="kaiin_code" value="<?php print $_SESSION['kaiin']['kaiin_code']; ?>">
				<input type="submit" name="add" value="追加" class="btn">
				<input type="submit" name="disp" value="参照" class="btn">
				<input type="submit" name="edit" value="修正" class="btn">
				<input type="submit" name="delete" value="削除" class="btn">
			</form>
		</div>
		<?php require_once('../common/html/kaiin_side.php'); ?>
	</div>
	<?php require_once('../common/html/footer.php'); ?>
</body>
</html>