<?php
	session_start();
	session_regenerate_id(true);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>注文情報ダウンロード</title>
	<?php require_once('../common/html/kaiin_style.php'); ?>
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
			<h3 class="main-title">注文書ダウンロード日付選択</h3>
	
			ダウンロードしたい注文日を選んでください。
			<form action="order_download_done.php" method="post">
				<?php pull_year(); ?>年

				<?php pull_month(); ?>月

				<?php pull_day(); ?>日<br>
				
				<input type="submit" value="download" class="btn">
					
			</form>
		</div>
		<?php require_once('../common/html/kaiin_side.php'); ?>
	</div>
	<?php require_once('../common/html/footer.php'); ?>
</body>
</html>

