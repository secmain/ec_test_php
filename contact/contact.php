<?php
	session_start();
	session_regenerate_id(true);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>お問い合わせ</title>
	<link rel="stylesheet" href="../css/normalize.css">
	<link rel="stylesheet" href="../common/css/font-awesome/css/all.css"> 
	<link rel="stylesheet" href="../common/css/kaiin_header.css">
	<link rel="stylesheet" href="../common/css/footer.css">
	<link rel="stylesheet" href="../common/css/kaiin_navi.css">
	<link rel="stylesheet" href="../common/css/kaiin_side.css">
	<link rel="stylesheet" href="../css/contact.css">
</head>
<body>
	<?php 
		require_once('../common/html/kaiin_header.php');
		require_once('../common/html/kaiin_navi.php');
		require_once('../common/common.php');
	?>

	<div class="main">
		<div class="main-container">
			<h2 class="main-title">お問い合わせ</h2>
			<form action="contact_check.php" method="post" class="form contact-form">
				<table class="form-table">				
					<tr>
						<th>お名前（必須）： </th>
						<td><input type="text" name="name" value=""><br></td>
					</tr>
					<tr>
						<th>性別（必須）: </th>
						<td class="choose-one-from-two">
							<label><input type="radio" name="seibetsu" value="1">男</label>
							<label><input type="radio" name="seibetsu" value="2">女</label><br>
						</td>
					</tr>
					<tr>
						<th>住所: </th>
						<td><input type="text" name="address" value=""><br></td>
					</tr>
					<tr>
						<th>メールアドレス（必須）: </th>
						<td><input type="text" name="email" value=""><br></td>
					</tr>
					<tr>
						<th>確認用メールアドレス（必須）: </th>
						<td><input type="text" name="email2" value=""><br></td>
					</tr>
					<tr>
						<th>タイトル: </th>
						<td><input type="text" name="subject" value=""><br></td>
					</tr>
					<tr>
						<th>内容（必須）: </th>
						<td><textarea name="content" cols="50" rows="10"></textarea></td>
					</tr>
				</table>
				<input type="button" onclick="history.back()" value="戻る" class="btn">
				<input type="submit" value="送信" class="btn">
			</form>
		</div>
		<?php require_once '../common/html/kaiin_side.php'; ?>
	</div>	
	<?php require_once '../common/html/footer.php'; ?>
</body>
</html>