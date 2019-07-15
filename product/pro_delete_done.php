<?php
	session_start();
	session_regenerate_id(true);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>商品削除完了</title>
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

						$db = connect_db();
						$db->query('set names utf8');

						$sql = 'delete from mst_product where code=?';
						$stmt = $db->prepare($sql);
						$data[] = $pro_code;

						$stmt->execute($data);

						$db = null;

						print $pro_name . 'を削除しました <br>';

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