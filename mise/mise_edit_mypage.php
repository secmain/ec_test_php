<?php
	session_start();
	session_regenerate_id(true);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>myページ</title>
	<?php require_once('../common/html/mise_style.php'); ?>
	<link rel="stylesheet" href="../css/common.css">
	<link rel="stylesheet" href="../css/member_edit.css">
</head>
<body>
	<?php
		require_once('../common/html/mise_header.php');
		require_once('../common/html/mise_navi.php');
		require_once('../common/common.php');
		require_once('../class/Mise_db.php');
	?>
	
	<div class="main">
		<div class="main-container">
			<h2 class="main-title">myページ</h2><br>
			<?php

				try {
					
					$member = $_SESSION['member'];
					$member_code = $member['member_code'];			

					$mise_db = new Mise_db();

					$rec = $mise_db->get_member($member_code);

					// XSSの脆弱性残す
					$my_file_name = $rec['mem_file_name'];
					$my_file_path = $rec['mem_file_path'];
					$my_img_dir = getUpFileDir('mise_mypage');

					unset($mise_db);

				} catch (Exception $e) {
						print 'system error !!!';
						print $e;
						exit();
				} 
			?>
			
			<form action="mise_edit_mypage_check.php" method="post" enctype="multipart/form-data">
				<input type="hidden" name="code" value="<?php print $member_code; ?>">
				<table class="form-table">				
					<tr>
						<th>メンバーID：</th>
						<td><?php print $member_code ?><br></td>
					</tr>
					<tr>
						<th>名前：</th>
						<td><input type="text" name="name" value="<?php print $rec['name']; ?>"><br></td>
					</tr>
					<tr>
						<th>メールアドレス</th>
						<td><input type="text" name="email" class="lg-input-box" value="<?php print $rec['email']; ?>"></td>
					</tr>
					<tr>
						<th>郵便番号</th>
						<td>
							<input type="text" name="postal1" class="sm-input-box" value="<?php print $rec['postal1']; ?>">-
							<input type="text" name="postal2" class="sm-input-box" value="<?php print $rec['postal2']; ?>">
						</td>
					</tr>
					<tr>
						<th>住所</th>
						<td><input type="text" name="address" class="lg-input-box" value="<?php print $rec['address']; ?>"></td>
					</tr>
					<tr>
						<th>電話番号</th>
						<td><input type="text" name="tel" class="lg-input-box" value="<?php print $rec['tel']; ?>"></td>
					</tr>
					<tr>
						<th>画像：<br></th>
						<td>
							<img src="<?php print $my_img_dir . basename($my_file_path); ?>" class="my-img-file" onerror="this.src='../up_img/no-image.jpg'" alt="<?php print $my_file_name; ?>"><br>
							<input type="file" name="my_file">
						</td>
					</tr>
					<tr>
						<th>パスワード：<br></th>
						<td>
							<a href="member_password_change.php">変更</a>
						</td>
					</tr>
				</table>
				<input type="button" onclick="history.back()" value="戻る" class="btn">
				<input type="button" onclick="location.href='./mise_mypage_output.php?member_code=<?php print $member_code; ?>'" value="プロフィール出力" class="btn">
				<input type="submit" value="送信" class="btn">
			</form>
		</div>
		<?php require_once('../common/html/mise_side.php'); ?>
	</div>
	<?php require_once('../common/html/footer.php'); ?>
</body>
</html>