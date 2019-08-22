<?php
	session_start();
	session_regenerate_id(true);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>商品NG画面</title>
	<?php require_once('../common/html/pro_style.php'); ?>
</head>
<body>
	<?php
		require_once('../common/html/kaiin_header.php');
		require_once('../common/html/kaiin_navi.php');
		require_once('../common/common.php');
	?>
	<div class="main">
		<div class="main-container">
			<h3 class="main-title">商品が選択されていません。</h3>
			<a href="pro_list.php" class="btn">戻る</a> 
		</div>		
		<?php require_once('../common/html/kaiin_side.php'); ?>
	</div>
	<?php require_once('../common/html/footer.php'); ?>
</body>
</html>