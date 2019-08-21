<?php
	session_start();
	session_regenerate_id(true);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>myページ</title>
	<?php require_once('../common/html/kaiin_style.php'); ?>
	<link rel="stylesheet" href="../css/kaiin_edit.css">
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
			<h2 class="main-title">myページ</h2><br>
			<?php

				try {
					
					$kaiin_code = $_SESSION['kaiin']['kaiin_code'];			

					$kaiin_db = new Kaiin_db();

					$rec = $kaiin_db->get_kaiin($kaiin_code);

					$kaiin_name = $rec['name'];
					// XSSの脆弱性残す
					$my_file_name = $rec['prof_file_name'];
					$my_file_path = $rec['prof_file_path'];
					$my_img_dir = getUpFileDir('mypage');

					unset($kaiin_db);

				} catch (Exception $e) {
						print 'system error !!!';
						print $e;
						exit();
				} 
			?>
			
			<form action="kaiin_edit_mypage_check.php" method="post" enctype="multipart/form-data">
				<input type="hidden" name="code" value="<?php print $kaiin_code; ?>">
				<table class="form-table">				
					<tr>
						<th>会員コード：</th>
						<td><?php print $kaiin_code ?><br></td>
					</tr>
					<tr>
						<th>名前：</th>
						<td><input type="text" name="name" value="<?php print $kaiin_name; ?>"><br></td>
					</tr>
					<tr>
						<th>画像：<br></th>
						<td>
							<img src="<?php print $my_img_dir . basename($my_file_path); ?>" class="my-img-file" onerror="this.src='../up_img/no-image.jpg'" alt="<?php print $my_file_name; ?>"><br>
							<input type="file" name="prof_file">
						</td>
					</tr>
					<tr>
						<th>パスワード：<br></th>
						<td>
							<a href="kaiin_password_change.php">変更</a>
						</td>
					</tr>
				</table>
				<input type="button" onclick="history.back()" value="戻る" class="btn">
				<input type="button" onclick="location.href='./kaiin_mypage_output.php?kaiin_code=<?php print $kaiin_code; ?>'" value="プロフィール出力" class="btn">
				<input type="submit" value="送信" class="btn">
			</form>
		</div>
		<?php require_once('../common/html/kaiin_side.php'); ?>
	</div>
	<?php require_once('../common/html/footer.php'); ?>
</body>
</html>