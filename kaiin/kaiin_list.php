<?php
	session_start();
	session_regenerate_id(true);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>会員リスト</title>
	<link rel="stylesheet" href="../css/normalize.css">
	<link rel="stylesheet" href="../common/css/font-awesome/css/all.css"> 
	<link rel="stylesheet" href="../common/css/kaiin_header.css">
	<link rel="stylesheet" href="../common/css/footer.css">
	<link rel="stylesheet" href="../common/css/kaiin_navi.css">
	<link rel="stylesheet" href="../common/css/kaiin_side.css">
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
			$db = connect_db();
			$db->query('set names utf8');

			$sql = 'select code, name, prof_file_name, prof_file_path from mst_tbl';
			$stmt = $db->prepare($sql);

			$stmt->execute();

			$db = null;

			while (true) {
				$rec = $stmt->fetch(PDO::FETCH_ASSOC);
				if ($rec == false) {
						break;
				}
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