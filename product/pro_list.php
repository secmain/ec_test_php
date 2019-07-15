<?php
	session_start();
	session_regenerate_id(true);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>商品一覧</title>
	<link rel="stylesheet" href="../common/css/font-awesome/css/all.css"> 
	<link rel="stylesheet" href="../css/normalize.css">
	<link rel="stylesheet" href="../common/css/kaiin_header.css">
	<link rel="stylesheet" href="../common/css/footer.css">
	<link rel="stylesheet" href="../common/css/kaiin_navi.css">
	<link rel="stylesheet" href="../common/css/kaiin_side.css">
	<link rel="stylesheet" href="../css/pro_list.css">
</head>
<body>
	<?php
		require_once('../common/html/kaiin_header.php');
		require_once('../common/html/kaiin_navi.php');
		require_once('../common/common.php');

		try {
			$db = connect_db();
		} catch (Exception $e) {
				print 'system error !!!';
				print $e;
				exit();
		} 
	?>
	
	<div class="main">
		<div class="main-container">
			<h2 class="main-title">商品一覧</h2>
			<center>
			<form method="get" action="" class="category-select">
				カテゴリー：&nbsp;&nbsp;
				<select name="category" id="pro_category">
					<option value="">指定なし</option>
					<?php
						try {
							$cate_sql = 'select id, text from pro_category';
							$stmt = $db->prepare($cate_sql);
							$stmt->execute();

							while ($rec = $stmt->fetch(PDO::FETCH_ASSOC)) {
								print '<option value="' . $rec['id'] . '">' . $rec['text'] . '</option>';
							}
						} catch (Exception $e) {
							print 'system error !!!';
							print $e;
							exit();					
						}
					?>
				</select>
				<button>絞り込み検索</button>
			</form>
			</center>
			<form action="pro_branch.php" method="post" class="pro-list-form">
				<div class="products">

	<?php
		try {

			// $db = connect_db();

			// SQLインジェクション脆弱性のため
			$sql = 'select code, name, price, file_path from mst_product';
			if (isset($_GET['category']) && intval($_GET['category'])) {
				$sql .= ' where category = ' . $_GET['category'];
			}

			$stmt = $db->prepare($sql);

			$stmt->execute();

			$db = null;

			$up_img_dir = getUpFileDir('product');


			while (true) {
				$rec = $stmt->fetch(PDO::FETCH_ASSOC);
				if ($rec == false) {
						break;
				}
				print '<label>';
				print '<div class="product">';
				print '<img src="' . $up_img_dir . $rec['file_path'] . '" class="product-image" onerror="this.src=\'../up_img/no-image.jpg\'"><br>';
				print '<input type="radio" name="pro_code" value="' . $rec['code'] . '">';
				print $rec['name'] . '<br>';
				print $rec['price'] . '円<br>';
				print '</div>';
				print '</label>';
			}

		} catch (Exception $e) {
				print 'system error !!!';
				print $e;
				exit();
		} 
	?>
				</div>
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