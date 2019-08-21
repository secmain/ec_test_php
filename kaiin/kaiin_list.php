<?php
	session_start();
	session_regenerate_id(true);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>会員リスト</title>
	<?php require_once('../common/html/kaiin_style.php'); ?>
	<link rel="stylesheet" href="../css/kaiin_list.css">
</head>
<body>
	<?php 
		require_once('../common/html/kaiin_header.php');
		require_once('../common/html/kaiin_navi.php');
		require_once('../common/common.php');
	?>

	<div class="main">
		<div class="main-container">
			<h2 class="main-title">会員一覧</h2>
			<form action="kaiin_branch.php" method="post" class="form kaiin-list-form">
				<div class="kaiin-zone">
	<?php
		try {

			require_once('../class/Kaiin_db.php');

			$kaiin_db = new Kaiin_db();

			$recs = $kaiin_db->get_kaiins();

			foreach ($recs as $i => $rec) {
				print '<label>';
				print '<div class="kaiin-box">';
				print '<img src="' . $my_img_dir . basename($kaiin_file_name) . '" class="kaiin-image" onerror="this.src=\'../up_img/no-image.jpg\'" alt="' . $kaiin_file_name . '"><br>';
				print '<input type="radio" name="kaiin_code" value="' . $rec['code'] . '" id ="' . $rec['code'] . '">';
				print $rec['name'];
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
				<input type="submit" class="btn" name="add" value="追加">
				<input type="submit" class="btn" name="disp" value="参照">
				<input type="submit" class="btn" name="edit" value="修正">
				<input type="submit" class="btn" name="delete" value="削除">
				<input type="button" onclick="location.href='./kaiin_output.php'" value="出力" class="btn">
			</form>
		</div>
		<?php require_once '../common/html/kaiin_side.php'; ?>
	</div>
	<?php require_once '../common/html/footer.php'; ?>
</body>
</html>