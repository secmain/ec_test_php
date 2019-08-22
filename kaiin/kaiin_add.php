<?php
	session_start();
	session_regenerate_id(true);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<?php require_once('../common/html/kaiin_style.php'); ?>
	<link rel="stylesheet" href="../css/kaiin_add.css">
	<title>会員追加</title>
</head>
<body>
	<?php
		require_once('../common/html/kaiin_header.php');
		require_once('../common/html/kaiin_navi.php');
		require_once('../common/common.php');
	?>

	<div class="main">
		<div class="main-container">
			<h3 class="main-title">会員追加</h3>
			<form method="post" action="kaiin_add_check.php" enctype="multipart/form-data">
				<center>
					<table class="form-table">				
						<tr>
							<th>会員名を入力してください（必須）</th>
							<td><input type="text" name="name"><br></td>
						</tr>
						<tr>
							<th>画像をアップロードしてください<br></th>
							<td>
								<input type="file" name="prof_file" size="10">
							</td>
						</tr>
						<tr>
							<th>パスワードを入力してください<br>（必須）</th>
							<td><input type="password" name="password1"></td>
						</tr>
						<tr>
							<th>パスワードを再度入力してください<br>（必須）</th>
							<td><input type="password" name="password2"></td>
						</tr>
					</table>
				</center>
				<input type="button" onclick="history.back()" value="戻る" class="btn">
				<input type="submit" value="送信" class="btn">
			</form>					
		</div>
		<?php require_once '../common/html/kaiin_side.php'; ?>
	</div>
	<?php require_once('../common/html/footer.php'); ?>
</body>
</html>

