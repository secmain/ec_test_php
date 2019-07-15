<?php
	session_start();
	session_regenerate_id(true);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>会員修正完了</title>
	<link rel="stylesheet" href="../common/css/font-awesome/css/all.css"> 
	<link rel="stylesheet" href="../css/normalize.css">
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
			<h3 class="main-title">myページ編集完了</h3>

			<?php
				try {
					$kaiin_code = $_SESSION['kaiin_code'];
					$kaiin_name = $_SESSION['my_name'];
					$my_file_name = $_SESSION['my_file_name'];
					$my_file_path = $_SESSION['my_file_path'];
					
					$kaiin_name = htmlspecialchars($kaiin_name);
					// file_nameもエスケープが必要
					// $file_name = htmlspecialchars($file_name);


					$db = connect_db();
					$db->query('set names utf8');

					$sql = 'update mst_tbl set name=?, prof_file_name=?, prof_file_path=? where code=?';
					$stmt = $db->prepare($sql);
					$data[] = $kaiin_name;
					$data[] = $my_file_name;
					$data[] = $my_file_path;
					$data[] = $kaiin_code;

					$stmt->execute($data);

					$db = null;

					// セッションの会員名も更新
					$_SESSION['kaiin_name'] = $kaiin_name;
					print $kaiin_name . 'を更新しました <br>';
					print '<a href="../kaiin_top.php" class="btn">トップ画面へ</a>';

				} catch (Exception $e) {
					print 'system error!!';
					exit();

				}
			?>
		</div>
		<?php require_once('../common/html/kaiin_side.php'); ?>
	</div>
	<?php require_once('../common/html/footer.php'); ?>
</body>
</html>