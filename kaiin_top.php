<?php
	session_start();
	session_regenerate_id(true);
?>
<!DOCTYPE html>
<html lang="jp">
<head>
	<meta charset="UTF-8">
	<title>トップページ</title>
	<link href="common/css/font-awesome/css/all.css" rel="stylesheet"> 
	<link rel="stylesheet" href="common/css/header.css">
	<link rel="stylesheet" href="common/css/navi.css">
	<link rel="stylesheet" href="common/css/footer.css">
	<link rel="stylesheet" href="css/kaiin_top.css">
</head>
<body>
	<?php
		require_once('common/html/header.php');
		require_once('common/html/navi.php');
		require_once('common/common.php');
	?>
	
	<div class="main">
		<div class="main-container">
			<table class="link-table">
				<tr>
					<td class="link-box">
						<a href="./kaiin/kaiin_edit_mypage.php">
							<i class="fas fa-address-card fa-custom-em"></i>
							<div class="link-text">myページ</div>
						</a>
					</td>
					<td class="link-box">
						<a href="./kaiin/kaiin_list.php">	
							<i class="far fa-address-card fa-custom-em"></i>
							<div class="link-text">会員管理</div>
						</a>
					</td>
				</tr>
				<tr class="dummy" style="height: 100px;"></tr>
				<tr>
					<td class="link-box">
						<a href="./product/pro_list.php">
							<i class="fas fa-apple-alt fa-custom-em"></i>
							<div class="link-text">商品管理</div>
						</td>
					<td class="link-box">
						<a href="./order/order_download.php">
							<i class="fas fa-file-download fa-custom-em"></i>
							<div class="link-text">注文ダウンロード</div>
						</a>
					</td>
				</tr>
			</table>
		</div>
	</div>

	<?php require_once 'common/html/footer.php'; ?>
</body>
</html>

