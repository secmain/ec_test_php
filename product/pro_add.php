<?php
	session_start();
	session_regenerate_id(true);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>商品追加</title>
	<?php require_once('../common/html/pro_style.php'); ?>
	<link rel="stylesheet" href="../css/pro_edit.css">
</head>
<body>
	<?php
	
		require_once('../common/html/kaiin_header.php');
		require_once('../common/html/kaiin_navi.php');
		require_once('../common/common.php');
		require_once('../class/Product_db.php');

		$pro_db = new Product_db();

		$categorys = $pro_db->get_categorys();

		unset($pro_db);
	?>

	<div class="main">
		<div class="main-container">
			<h2 class="main-title">商品追加</h2>
			<form method="post" action="pro_add_check.php" enctype="multipart/form-data" class="pro-add-form">
				<table class="form-table">				
					<tr>
						<th>名前：</th>
						<td><input type="text" name="name" value=""><br><br></td>
					</tr>
					<tr>
						<th>価格：</th>
						<td><input type="text" name="price" value=""><br><br></td>
					</tr>
					<tr>
						<th>カテゴリー：</th>
						<td>
							<select name="category">
								<option value="0"></option>
								<?php
									foreach ($categorys as $i => $category) {
										print sprintf(
											'<option value="%s">%s</option>',
											$category['id'],
											$category['text']
										);										
									}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<th>説明：</th>
						<td>
							<textarea name="descript" cols="30" rows="5"></textarea>
						</td>
					</tr>
					<tr>
						<th>画像：<br></th>
						<td>
							<input type="file" name="pro_img_file" size="10" value="<?php print $pro_img_dir . $pro_file_path; ?>">
						</td>
					</tr>
				</table>

				<table class="form-table">				
					<tr>
						<th>xmlファイルで登録：<br></th>
						<td>
							<input type="file" name="up_xml_file" size="10">
						</td>
					</tr>
				</table>

				<input type="button" onclick="history.back()" value="戻る" class="btn">
				<input type="button" onclick="location.href='sample_xml_download.php'" value="sample" class="btn">
				<input type="submit" value="送信" class="btn">
			</form>
		</div>
		<?php require_once '../common/html/kaiin_side.php'; ?>
	</div>
	
	<?php require_once '../common/html/footer.php'; ?>

</body>
</html>

