<?php
	session_start();
	session_regenerate_id(true);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>商品編集確認</title>
	<?php require_once('../common/html/pro_style.php'); ?>
	<link rel="stylesheet" href="../css/pro_edit.css">
	<script src="../common/js/common.js"></script>
	<script>
		(function () {
			window.addEventListener('load', disp_upfile);
		})();
	</script>
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
			<h3 class="main-title">商品編集確認</h3>

			<?php
				$post = sanitize($_POST);
				// $pro_code = $post['code'];
				$pro_code = $_SESSION['product_inputs']['code'];
				$pro_name = $post['name'];
				$pro_price = $post['price'];
				$pro_cate = $post['category'];
				$pro_file_name = $_FILES['pro_img_file']['name'];
				$pro_file_tmp = $_FILES['pro_img_file']['tmp_name'];
				$pro_file_path = getUpFileTmpName($_FILES['pro_img_file']['name']);

				$pro_file_name = h($pro_file_name);
				$pro_img_dir = getUpFileDir('product');

				$pro_db = null;

				$ok_flag = true;
				$file_flag = false;

				if ($pro_code == '') {
					print checkGamenDispFieldError('商品コードがありません');
					$ok_flag = false;
				} else {
					print checkGamenDispField('商品コード：　' . $pro_code);
				}

				if ($pro_name == '') {
					print checkGamenDispFieldError('名前が入力されていません');
					$ok_flag = false;
				} else {
					print checkGamenDispField('商品名：　' . $pro_name);
				}

				if ($pro_price == '') {
					print checkGamenDispFieldError('価格が入力されていません');
					$ok_flag = false;
				} else {
					print checkGamenDispField('価格：　' . $pro_price . '円');
				}

				if ($pro_cate) {
					$pro_db = new Product_db();
					$category = $pro_db->get_category($pro_cate);
					if ($category) {
						print checkGamenDispField('カテゴリー　：　' . $category['text']);		
					} else {
						print checkGamenDispFieldError('カテゴリーの値が不正です');
						$ok_flag = false;
					}
				}

				if (is_uploaded_file($pro_file_tmp)) {
					$file_flag = true;
				}

				if ($file_flag && !move_uploaded_file($pro_file_tmp, $pro_img_dir . $pro_file_path)) {
					print checkGamenDispFieldError('ファイルのアップロードに失敗しました。');
					$ok_flag = false;
				} else if ($file_flag) {
					print checkGamenDispField('ファイル名：　' . $pro_file_name);
					print '<div id="image-zone" class="image-zone"></div>';
				}

				if (!$ok_flag) {
					print '<form>';
					print '<input type="button" onclick="history.back()" value="戻る" class="btn">';
					print '</form>';
				} else {
					print '<form method="post" action="pro_edit_done.php">';
					$inputs['name'] = $pro_name;
					$inputs['price'] = $pro_price;
					$inputs['category'] = $pro_cate;
					$inputs['file_name'] = $pro_file_name;
					$inputs['file_path'] = $pro_file_path;
					$old_product = $_SESSION['product_inputs'];
					$_SESSION['product_inputs'] = array_merge($old_product, $inputs);
					print '<input type="hidden" id="url" value="' . $pro_img_dir . $pro_file_path . '">';
					print '<input type="button" onclick="history.back()" value="戻る" class="btn">';
					print '<input type="submit" value="OK" class="btn">';
					print '</form>';
				}

			?>
		</div>
		<?php require_once('../common/html/kaiin_side.php'); ?>
	</div>
	<?php require_once('../common/html/footer.php'); ?>
</body>
</html>

