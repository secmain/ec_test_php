<?php
	session_start();
	session_regenerate_id(true);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>数量変更処理</title>
	<link href="../common/css/font-awesome/css/all.css" rel="stylesheet"> 
	<link rel="stylesheet" href="../css/normalize.css">
	<link rel="stylesheet" href="../common/css/mise_header.css">
	<link rel="stylesheet" href="../common/css/footer.css">
	<link rel="stylesheet" href="../common/css/mise_navi.css">
	<link rel="stylesheet" href="../common/css/mise_side.css">
	<link rel="stylesheet" href="../common/css/mise_side_cate.css">
	<link rel="stylesheet" href="../css/pro_disp.css">
</head>
<body>
	<?php
		require_once('../common/html/mise_header.php');
		require_once('../common/html/mise_navi.php');
		require_once('../common/common.php');
	?>

	<div class="main">
		<div class="main-container">
			<h3 class="main-title">数量変更処理</h3>
	
			<?php
				$post = sanitize($_POST);
				$cart = $_SESSION['cart'];

				$max = $post['max'];
				$i = 0;
				foreach ($cart as $code => $cnt) {
					$tmp_item = $post['count_' . $i];
					if (preg_match("/^\d+$/", $tmp_item) == 0) {
						print '数量に誤りがあります。<br><br>';
						print '<a href="mise_cartlook.php">カートに戻る</a>';
						exit();
					}
					if ($tmp_item < 1 || $tmp_item > 10) {
						print '数量は必ず1個以上、10個までです。<br><br>';
						print '<a href="mise_cartlook.php">カートに戻る</a>';
						exit();	
					}
					$cart[$code] = $post['count_' . $i];

					// 削除処理
					if (isset($_POST['sakujo_' . $i]) == true) {
						unset($cart[$code]);
					}
					$i++;
				}

				$_SESSION['cart'] = $cart;

				header('Location:mise_cartlook.php');
			?>
		</div>
		<?php require_once('../common/html/mise_side.php'); ?>
	</div>
	<?php require_once('../common/html/footer.php'); ?>
</body>
</html>