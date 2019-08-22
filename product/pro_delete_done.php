<?php
	session_start();
	session_regenerate_id(true);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>商品削除完了</title>
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
						$pro_code = $_POST['code'];
						$pro_name = $_POST['name'];
						
						/*
							$pro_code = htmlspecialchars($pro_code);
							$pro_name = htmlspecialchars($pro_name);
							$pro_pass = htmlspecialchars($pro_pass);
						*/

						$pro_db = new Product_db();

						$pro_db->delete_product($pro_code);

						unset($pro_db);

						print checkGamenDispField($pro_name . 'を削除しました');

					} catch (Exception $e) {
						print 'system error!!';
						exit();
					}
				?>
			</div>
			<a href="pro_list.php" class="btn">戻る</a>
		</div>
		<?php require_once('../common/html/kaiin_side.php'); ?>
	</div>
	<?php require_once('../common/html/footer.php'); ?>
</body>
</html>