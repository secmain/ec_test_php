<?php
	session_start();
	session_regenerate_id(true);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>商品追加</title>
	<link rel="stylesheet" href="../common/css/font-awesome/css/all.css"> 
	<link rel="stylesheet" href="../css/normalize.css">
	<link rel="stylesheet" href="../common/css/kaiin_header.css">
	<link rel="stylesheet" href="../common/css/footer.css">
	<link rel="stylesheet" href="../common/css/kaiin_navi.css">
	<link rel="stylesheet" href="../common/css/kaiin_side.css">
	<link rel="stylesheet" href="../css/pro_add.css">
</head>
<body>
	<?php
		require_once('../common/html/kaiin_header.php');
		require_once('../common/html/kaiin_navi.php');
		require_once('../common/common.php');
	?>

	<div class="main">
		<div class="main-container">
			<h2 class="main-title">商品追加</h2>
			<form method="post" action="pro_add_check.php" enctype="multipart/form-data" class="pro-add-form">
				商品名を入力してください<br>
				<input type="text" name="name"><br>
				金額を入力してください<br>
				<input type="text" name="price"><br>
				カテゴリーを選択してください<br>
				<input type="text" name="category"><br>
				画像をえらんでください。<br>
				<input type="file" name="pro_img"><br>
				<input type="button" onclick="history.back()" value="戻る" class="btn">
				<input type="submit" value="送信" class="btn">
			</form>
		</div>
		<?php require_once '../common/html/kaiin_side.php'; ?>
	</div>
	
	<?php require_once '../common/html/footer.php'; ?>

</body>
</html>

