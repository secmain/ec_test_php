<?php
	session_start();
	session_regenerate_id(true);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>会員追加完了</title>
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
			<h3 class="main-title">myページ追加完了</h3>
			<?php

				try {
					$kaiin_obj = $_SESSION['kaiin_add'];
					$kaiin_name = $kaiin_obj['name'];
					$kaiin_pass = $kaiin_obj['password'];
					// 廃止
					// $kaiin_kubun = $kaiin_obj['kanri'];
					$prof_file_name = $kaiin_obj['prof_file_name'];
					$prof_file_path = $kaiin_obj['prof_file_path'];
					
					$kaiin_name = h($kaiin_name);
					$kaiin_pass = h($kaiin_pass);

					$kaiin_db = new Kaiin_db();
					
					$data = [$kaiin_name, $kaiin_pass, $prof_file_name, $prof_file_path];

					$kaiin_db->add_kaiin($data);

					unset($kaiin_db);

					print '<div class="kanryo-msg">' . $kaiin_name . 'を追加しました </div><br>';

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