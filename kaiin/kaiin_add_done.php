<?php
	session_start();
	session_regenerate_id(true);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>会員追加完了</title>
	<link rel="stylesheet" href="../common/css/font-awesome/css/all.css"> 
	<link rel="stylesheet" href="../css/normalize.css">
	<link rel="stylesheet" href="../common/css/kaiin_header.css">
	<link rel="stylesheet" href="../common/css/footer.css">
	<link rel="stylesheet" href="../common/css/kaiin_navi.css">
	<link rel="stylesheet" href="../common/css/kaiin_side.css">
	<link rel="stylesheet" href="../css/pro_edit.css">
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
					$kaiin_obj = $_SESSION['kaiin_obj'];
					$kaiin_name = $kaiin_obj['name'];
					$kaiin_pass = $kaiin_obj['password'];
					$kaiin_kubun = $kaiin_obj['kanri'];
					$prof_file_name = $kaiin_obj['prof_file_name'];
					$prof_file_path = $kaiin_obj['prof_file_path'];
					
					$kaiin_name = h($kaiin_name);
					$kaiin_pass = h($kaiin_pass);

					$db = connect_db();
					$db->query('set names utf8');

					$sql = 'insert into mst_tbl(name, password, kanrisha_flg, prof_file_name, prof_file_path) values(?,?,?,?,?)';
					$stmt = $db->prepare($sql);
					$data = [$kaiin_name, $kaiin_pass, $kaiin_kubun, $prof_file_name, $prof_file_path];

					$stmt->execute($data);

					$db = null;

					print $kaiin_name . 'を追加しました <br>';

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