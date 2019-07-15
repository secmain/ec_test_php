<?php
	session_start();
	session_regenerate_id(true);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>会員パスワード修正完了</title>
	<link rel="stylesheet" href="../common/css/font-awesome/css/all.css"> 
	<link rel="stylesheet" href="../css/normalize.css">
	<link rel="stylesheet" href="../common/css/kaiin_header.css">
	<link rel="stylesheet" href="../common/css/footer.css">
	<link rel="stylesheet" href="../common/css/kaiin_navi.css">
	<link rel="stylesheet" href="../common/css/kaiin_side.css">
	<link rel="stylesheet" href="../css/mypage.css">
</head>
<body>
	<?php
		require_once('../common/html/kaiin_header.php');
		require_once('../common/html/kaiin_navi.php');
		require_once('../common/common.php');
	?>

	<div class="main">
		<div class="main-container">
			<h3 class="main-title">パスワード変更完了</h3><br>

			<?php
				try {
					
					$kaiin_code = $_SESSION['kaiin_code'];
					$kaiin_pass = $_SESSION['my_password'];
					
					$kaiin_pass = htmlspecialchars($kaiin_pass);
			

					$db = connect_db();
					$db->query('set names utf8');

					$sql = 'update mst_tbl set password=? where code=?';
					$stmt = $db->prepare($sql);
					$data[] = $kaiin_pass;
					$data[] = $kaiin_code;

					$stmt->execute($data);

					$db = null;

					print '更新しました <br>';

				} catch (Exception $e) {
					print 'system error!!';
					exit();
				}
			?>
			<br><a href="../kaiin_top.php" class="btn">トップ画面へ</a>
			</div>
		<?php require_once('../common/html/kaiin_side.php'); ?>
	</div>
	<?php require_once('../common/html/footer.php'); ?>
</body>
</html>