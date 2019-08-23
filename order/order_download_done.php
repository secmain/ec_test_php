<?php
	session_start();
	session_regenerate_id(true);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>注文書ダウンロード出力</title>
	<?php require_once('../common/html/kaiin_style.php'); ?>
	<link rel="stylesheet" href="../css/pro_edit.css">
</head>
<body>
	<?php
		require_once('../common/html/kaiin_header.php');
		require_once('../common/html/kaiin_navi.php');
		require_once('../common/common.php');
		require_once('../class/Kaiin_db.php');

		$kaiin = $_SESSION['kaiin'];
		$file_name = $kaiin['kaiin_name'] . '_' . uniqid() . $kaiin['kaiin_code'] . '.csv';
	?>
	<div class="main">
		<div class="main-container">
			<h3 class="main-title">注文書ダウンロード</h3>
			<br>
			<a href="<?php print $file_name; ?>" class="btn middle">ダウンロード</a>
			<a onclick="history.back()" class="btn">戻る</a>
		</div>
		<?php require_once('../common/html/kaiin_side.php'); ?>
	</div>
	<?php require_once('../common/html/footer.php'); ?>	

	<?php

		
		$kaiin_db = new Kaiin_db();

		$recs = $kaiin_db->get_kaiin_data($_POST['year'], $_POST['month'], $_POST['day']);

		/* 脆弱性をつくるためプリペアードステートメントは使わない
		$stmt = $db->prepare($sql);
		$data[] = $year;
		$data[] = $month;
		$data[] = $day;
		$stmt->execute($data);
		*/

		unset($kaiin_db);

		$csv = '注文コード,日付,会員番号,お名前,メール,郵便番号,住所,TEL,商品コード,商品名,価格,数量';
		$csv .= "\n";

		foreach ($recs as $i => $rec) {
		 	$csv .= $rec['code'];
			$csv .= ',';
			$csv .= $rec['date'];
			$csv .= ',';
			$csv .= $rec['code_member'];
			$csv .= ',';
			$csv .= $rec['ot_name'];
			$csv .= ',';
			$csv .= $rec['email'];
			$csv .= ',';
			$csv .= $rec['postal1'] . '-' . $rec['postal2'];
			$csv .= ',';
			$csv .= $rec['address'];
			$csv .= ',';
			$csv .= $rec['tel'];
			$csv .= ',';
			$csv .= $rec['code_product'];
			$csv .= ',';
			$csv .= $rec['mst_name'];
			$csv .= ',';
			$csv .= $rec['price'];
			$csv .= ',';
			$csv .= $rec['quantity'];
			$csv .= "\n";
		}

		$file = fopen('./' . $file_name, 'w');
		$csv = mb_convert_encoding($csv, 'SJIS', 'UTF-8');
		fputs($file, $csv);
		fclose($file);

	?>
</body>
</html>