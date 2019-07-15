<?php
	session_start();
	session_regenerate_id(true);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>商品編集完了</title>
	<link href="../common/css/font-awesome/css/all.css" rel="stylesheet"> 
	<link rel="stylesheet" href="../css/normalize.css">
	<link rel="stylesheet" href="../common/css/common.css">
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
			<h3 class="main-title">商品編集確認</h3>
			<div class="comp-message">
			<?php
				try {
					$pro_code = $_SESSION['pro_code'];
					$pro_name = $_SESSION['pro_name'];
					$pro_price = $_SESSION['pro_price'];
					$pro_file_name = $_SESSION['pro_file_name'];
					$pro_file_path = $_SESSION['pro_file_path'];
					
					$db = connect_db();
					$db->query('set names utf8');

					$sql = 'update mst_product set name=?, price=?, file_name=?, file_path=? where code=?';
					$stmt = $db->prepare($sql);
					$data[] = $pro_name;
					$data[] = $pro_price;
					$data[] = $pro_file_name;
					$data[] = $pro_file_path;
					$data[] = $pro_code;
		
					$stmt->execute($data);

					$db = null;

					print '更新しました <br>';

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