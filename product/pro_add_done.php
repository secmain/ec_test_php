<?php
	session_start();
	session_regenerate_id(true);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>商品追加完了</title>
	<link rel="stylesheet" href="../common/css/font-awesome/css/all.css"> 
	<link rel="stylesheet" href="../css/normalize.css">
	<link rel="stylesheet" href="../common/css/kaiin_header.css">
	<link rel="stylesheet" href="../common/css/footer.css">
	<link rel="stylesheet" href="../common/css/kaiin_navi.css">
	<link rel="stylesheet" href="../common/css/kaiin_side.css">
	<link rel="stylesheet" href="../css/pro_add.css">
</head>
<body>

	<?php
		require_once('../common/html/kaiin_header.php');
		require_once('../common/html/kaiin_navi.php');
		require_once('../common/common.php');
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
					
					$db = connect_db();
					$db->query('set names utf8');

					$sql = 'insert into mst_product(name, price, file_name, file_path, category) values(?, ?, ?, ?, ?)';
					$stmt = $db->prepare($sql);
					$data = [$pro_name, $pro_price, $file_name, $file_path, $pro_cate];
				
					$stmt->execute($data);

					$db = null;

					print $pro_name . 'を追加しました';

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