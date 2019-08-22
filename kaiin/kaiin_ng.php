<?php
	session_start();
	session_regenerate_id(true);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>NG</title>
	<?php require_once('../common/html/kaiin_style.php'); ?>
</head>
<body>
	
	<?php
		require_once('../common/html/kaiin_header.php');
		require_once('../common/html/kaiin_navi.php');
		require_once('../common/common.php');
	?>

	<div class="main" class="clear-fix">
		<div class="main-container">
			<h3 class="main-title">会員が選択されていません。</h3>
			<a href="kaiin_list.php" class="btn">戻る</a> 
		</div>
		<?php require_once('../common/html/kaiin_side.php'); ?>
	</div>
	<?php require_once('../common/html/footer.php'); ?>
</body>
</html>