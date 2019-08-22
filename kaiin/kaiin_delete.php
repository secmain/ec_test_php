<?php
	session_start();
	session_regenerate_id(true);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>会員削除</title>
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

	<div class="main" class="clear-fix">
		<div class="main-container">
			<h3 class="main-title">会員削除</h3>
			<?php
				try {

					$kaiin_code = $_GET['kaiin_code'];
					//　ここでサニタイジング必要(A)
					// $kaiin_code = htmlspecialchars($kaiin_code);
					$kaiin_db = new Kaiin_db();

					$rec = $kaiin_db->get_kaiin($kaiin_code);
					
					unset($kaiin_db);

					$kaiin_name = $rec['name'];
					$kaiin_file_name = $rec['prof_file_name'];
					$kaiin_file_path = $rec['prof_file_path'];
					$kaiin_img_dir = getUpFileDir('kaiin');

				} catch (Exception $e) {
						print 'system error !!!';
						print $e;
						exit();
				} 
			?>
			
			<!-- (A) -->
			<div>このを削除してもよろしいですか？</div><br>
			<table class="form-table">				
				<tr>
					<th>会員コード：</th>
					<td><?php print $kaiin_code; ?><br></td>
				</tr>
				<tr>
					<th>名前：</th>
					<td><?php print $kaiin_name; ?><br></td>
				</tr>
				<tr>
					<th>画像：<br></th>
					<td>
						<img src="<?php print $kaiin_img_dir . basename($kaiin_file_path); ?>" class="my-profile" onerror="this.src='../up_img/no-image.jpg'" alt="<?php print $kaiin_file_name; ?>">
					</td>
				</tr>
			</table>
			<br>
			
			<form action="kaiin_delete_done.php" method="post">
				<!-- (A) -->
				<input type="hidden" name="code" value="<?php print $kaiin_code; ?>">
				<input type="hidden" name="name" value="<?php print $kaiin_name; ?>">
				<input type="button" class="btn" onclick="history.back()" value="戻る">
				<input type="submit" class="btn" value="OK">
			</form>
			</div>
		<?php require_once '../common/html/kaiin_side.php'; ?>
	</div>
	<?php require_once '../common/html/footer.php'; ?>
</body>
</html>