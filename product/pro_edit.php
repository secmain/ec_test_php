<?php
	session_start();
	session_regenerate_id(true);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>商品編集入力</title>
	<link rel="stylesheet" href="../common/css/font-awesome/css/all.css"> 
	<link rel="stylesheet" href="../css/normalize.css">
	<link rel="stylesheet" href="../common/css/kaiin_header.css">
	<link rel="stylesheet" href="../common/css/footer.css">
	<link rel="stylesheet" href="../common/css/kaiin_navi.css">
	<link rel="stylesheet" href="../common/css/kaiin_side.css">
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
			<h3 class="main-title">商品編集</h3>
			<?php
				try {

					$pro_code = $_GET['pro_code'];
					//　ここでサニタイジング
					// $pro_code = h($pro_code);

					$db = connect_db();
					$db->query('set names utf8');

					$sql = 'select code, name, price, file_name, file_path from mst_product where code = ?';
					$stmt = $db->prepare($sql);
					$data = [$pro_code];
					$stmt->execute($data);

					$rec = $stmt->fetch(PDO::FETCH_ASSOC);

					// 存在しないコードの場合もありえる
					if (!$rec) {
						print checkGamenDispFieldError('対象の商品が見つかりませんでした。');
						exit();
					}
					$pro_name = $rec['name'];
					$pro_price = $rec['price'];
					// xssの可能性あり
					$pro_file_path = $rec['file_path'];

					/* fileの更新
					なし⇒なし　〇
					なし⇒あり　〇
					あり⇒なし　削除ボタン？
					あり⇒あり　対策必要
					あり⇒あり（変更あり）　〇
					*/

					$pro_img_dir = getUpFileDir('product');

					$db = null;

				} catch (Exception $e) {
						print 'system error !!!';
						print $e;
						exit();
				} 
			?>
		

			<form action="pro_edit_check.php" method="post" enctype="multipart/form-data">
				<table class="form-table">				
					<tr>
						<th>商品コード：</th>
						<td><?php print $pro_code ?><br></td>
						<td><input type="hidden" name="code" value="<?php print $pro_code; ?>"><br></td>
					</tr>
					<tr>
						<th>名前：</th>
						<td><input type="text" name="name" value="<?php print $pro_name; ?>"><br><br></td>
					</tr>
					<tr>
						<th>価格：</th>
						<td><input type="text" name="price" value="<?php print $pro_price; ?>"><br><br></td>
					</tr>
					<tr>
						<th>カテゴリー：</th>
						<td><input type="text" name="category" value="<?php print $category; ?>"><br><br></td>
					</tr>
					<tr>
						<th>画像：<br></th>
						<td>
							<img src="<?php print $pro_img_dir . $pro_file_path; ?>" class="pro-img-file" onerror="this.src='../up_img/no-image.jpg'"><br>
							<input type="file" name="pro_img_file" size="10" value="<?php print $pro_img_dir . $pro_file_path; ?>">
						</td>
					</tr>
				</table>				
				
				<input type="button" onclick="history.back()" value="戻る" class="btn">
				<input type="submit" value="送信" class="btn">
			</form>
		</div>

		<?php require_once('../common/html/kaiin_side.php'); ?>
	</div>
	<?php require_once('../common/html/footer.php'); ?>
</body>
</html>