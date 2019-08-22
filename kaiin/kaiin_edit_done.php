<?php
	session_start();
	session_regenerate_id(true);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>会員修正完了</title>
	<?php require_once('../common/html/kaiin_style.php'); ?>
</head>
<body>
	<?php
		require_once('../common/html/kaiin_header.php');
		require_once('../common/html/kaiin_navi.php');
		require_once('../common/common.php');
		require_once('../class/Kaiin_db.php');
	?>

	<div class="main">
		<div class="main-container">
			<h3 class="main-title">会員修正完了</h3>
				<?php
					try {

						$post = sanitize($_POST);
						$kaiin_code = $post['code'];
						$kaiin_name = $post['name'];
						$kaiin_file_name = $post['kaiin_file_name'];
						$kaiin_file_path = $post['kaiin_file_path'];

						$kaiin_db = new Kaiin_db();
						
						$data = [
							'name' => $kaiin_name,
							'prof_file_name' => $kaiin_file_name,
							'prof_file_path' => $kaiin_file_path,
						];

						$kaiin_db->up_kaiin($kaiin_code, $data);

						unset($kaiin_db);

						print checkGamenDispField($kaiin_name . 'を更新しました');

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