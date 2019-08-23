<?php
	session_start();
	session_regenerate_id(true);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>会員参照</title>
	<?php require_once('../common/html/kaiin_style.php'); ?>
	<link rel="stylesheet" href="../css/kaiin_edit.css">
</head>
<body>
	<?php

		require_once('../common/html/kaiin_header.php');
		require_once('../common/html/kaiin_navi.php');
		require_once('../common/common.php');
		require_once('../class/Kaiin_db.php');

		try {

			$kaiin_code = $_GET['kaiin_code'];
			//　ここでサニタイジング
			// $kaiin_code = htmlspecialchars($kaiin_code);

			$kaiin_db = new Kaiin_db();

			$rec = $kaiin_db->get_kaiin($kaiin_code);

			$kaiin_name = $rec['name'];
			$kaiin_file_name = $rec['prof_file_name'];
			$kaiin_file_path = $rec['prof_file_path'];
			$up_img_dir = getUpFileDir('kaiin');

			unset($kaiin_db);

		} catch (Exception $e) {
				print 'system error !!!';
				print $e;
				exit();
		} 
	?>

	<div class="main">
		<div class="main-container">
			<h2 class="main-title">会員参照</h2>
			<div><b>スタッフ</b></div>
			<table class="form-table">				
				<tr>
					<th>会員コード：</th>
					<td><?php print $kaiin_code ?><br></td>
				</tr>
				<tr>
					<th>名前：</th>
					<td><input type="text" name="name" value="<?php print $kaiin_name; ?>"><br></td>
				</tr>
				<tr>
					<th>画像：<br></th>
					<td>
						<img src="<?php print $up_img_dir . basename($kaiin_file_path); ?>" class="kaiin-img-file" onerror="this.src='../up_img/no-image.jpg'" alt="<?php print $kaiin_file_name; ?>"><br>
					</td>
				</tr>
			</table>
			<button onclick="history.back()" class="btn">戻る</button>
		</div>
		<?php require_once '../common/html/kaiin_side.php'; ?>
	</div>
	<?php require_once '../common/html/footer.php'; ?>
</body>
</html>