<?php
	session_start();
	session_regenerate_id(true);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<link href="../common/css/font-awesome/css/all.css" rel="stylesheet"> 
	<link rel="stylesheet" href="../css/normalize.css">
	<link rel="stylesheet" href="../common/css/common.css">
	<link rel="stylesheet" href="../common/css/kaiin_header.css">
	<link rel="stylesheet" href="../common/css/footer.css">
	<link rel="stylesheet" href="../common/css/kaiin_navi.css">
	<link rel="stylesheet" href="../common/css/kaiin_side.css">
	<link rel="stylesheet" href="../css/kaiin_edit.css">
	<title>会員修正</title>
</head>
<body>
<?php
		require_once('../common/html/kaiin_header.php');
		require_once('../common/html/kaiin_navi.php');
		require_once('../common/common.php');

		try {

			//　XSSの脆弱性のため、サニタイジングしない
			// $kaiin_code = htmlspecialchars($kaiin_code);
			$kaiin_code = $_GET['kaiin_code'];			

			$db = connect_db();
			$db->query('set names utf8');

			$sql = 'select code, name from mst_tbl where code = ?';
			$stmt = $db->prepare($sql);
			$data = [$kaiin_code];
			$stmt->execute($data);

			$rec = $stmt->fetch(PDO::FETCH_ASSOC);
			$kaiin_name = $rec['name'];

			$db = null;

		} catch (Exception $e) {
				print 'system error !!!';
				print $e;
				exit();
		} 
?>
	<div class="main" class="clear-fix">
		<div class="main-container">
			<h3 class="main-title">スタッフ修正</h3>
			<center>	
				<form action="kaiin_edit_check.php" method="post" enctype="multipart/form-data">
					<table class="form-table">				
						<tr>
							<th>スタッフコード：</th>
							<td><?php print $kaiin_code; ?><br></td>
							<td><input type="hidden" name="code" value="<?php print $kaiin_code; ?>"><br></td>
						</tr>
						<tr>
							<th>会員区分：</th>
							<td><?php print $rec['kanrisha'] ? '管理者' : '一般' ?><br><br></td>
						</tr>
						<tr>
							<th>名前：</th>
							<td><input type="text" name="name" value="<?php print $kaiin_name; ?>"><br><br></td>
						</tr>
						<tr>
							<th>画像：<br></th>
							<td>
								<img src="" class="my-profile"><br>
								<input type="file" name="prof_file" size="10">
							</td>
						</tr>
					</table>
					<input type="button" onclick="history.back()" value="戻る" class="btn">
					<input type="submit" value="送信" class="btn">
				</form>
			</center>
		</div>
		<?php require_once '../common/html/kaiin_side.php'; ?>
	</div>
	<?php require_once '../common/html/footer.php'; ?>
</body>
</html>