<?php
	session_start();
	session_regenerate_id(true);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>会員修正完了</title>
	<link href="../common/css/font-awesome/css/all.css" rel="stylesheet"> 
	<link rel="stylesheet" href="../css/normalize.css">
	<link rel="stylesheet" href="../common/css/common.css">
	<link rel="stylesheet" href="../common/css/kaiin_header.css">
	<link rel="stylesheet" href="../common/css/footer.css">
	<link rel="stylesheet" href="../common/css/kaiin_navi.css">
	<link rel="stylesheet" href="../common/css/kaiin_side.css">
	<link rel="stylesheet" href="../css/kaiin_edit.css">
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
						$kaiin_code = $_POST['code'];
						$kaiin_name = $_POST['name'];
						$kaiin_pass = $_POST['password'];
						
						$kaiin_code = htmlspecialchars($kaiin_code);
						$kaiin_name = htmlspecialchars($kaiin_name);
						$kaiin_pass = htmlspecialchars($kaiin_pass);

						$db = connect_db();
						$db->query('set names utf8');

						$sql = 'update mst_tbl set name=?, password=? where code=?';
						$stmt = $db->prepare($sql);
						$data[] = $kaiin_name;
						$data[] = $kaiin_pass;
						$data[] = $kaiin_code;

						$stmt->execute($data);

						$db = null;

						print $kaiin_name . 'を更新しました <br>';

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