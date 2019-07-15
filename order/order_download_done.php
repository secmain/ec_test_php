<?php
	session_start();
	session_regenerate_id(true);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>注文書ダウンロード出力</title>
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
			<h3 class="main-title">注文書ダウンロード</h3>
			<br>
			<a href="order.csv" class="btn">ダウンロード</a>
			<a onclick="history.back()" class="btn">戻る</a>
		</div>
		<?php require_once('../common/html/kaiin_side.php'); ?>
	</div>
	<?php require_once('../common/html/footer.php'); ?>	

	<?php

		
		// yearに脆弱性
		$year = $_POST['year'];
		$month = sprintf('%02d', intval($_POST['month']));
		$day = sprintf('%02d', intval($_POST['day']));

		$sql = '
		select 
			ot.code,
			ot.date,
			ot.code_member,
			ot.name as ot_name,
			ot.email,
			ot.postal1,
			ot.postal2,
			ot.address,
			ot.tel,
			mp.name as mst_name,
			opt.code_product,
			opt.price,
			opt.quantity
		from
			order_tbl ot,
			order_product_tbl opt,
			mst_product mp
		where
			ot.code = opt.code and
			opt.code_product = mp.code and 
			substr(ot.date, 1, 4) = ' . $year . ' and 
			substr(ot.date, 6, 2) = ' . $month . ' and 
			substr(ot.date, 9, 2) = ' . $day .
		' order by ot.date';

	var_dump($sql);
		$dsn = 'mysql:dbname=ec_test_php;host=localhost;';
		$user = 'an';
		$password = 'password';
		$db = new PDO($dsn, $user, $password);
		$db->query('set names utf8');

		$stmt = $db->query($sql);
		
		/* 脆弱性をつくるためプリペアードステートメントは使わない
		$stmt = $db->prepare($sql);
		$data[] = $year;
		$data[] = $month;
		$data[] = $day;
		$stmt->execute($data);
		*/

		$dbh = null;

		$csv = '注文コード,日付,会員番号,お名前,メール,郵便番号,住所,TEL,商品コード,商品名,価格,数量';
		$csv .= "\n";

		while (true) {
			$rec = $stmt->fetch(PDO::FETCH_ASSOC);
			if ($rec == false) {
				break;
			}
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

		$file = fopen('./order.csv', 'w');
		$csv = mb_convert_encoding($csv, 'SJIS', 'UTF-8');
		print nl2br($csv);
		var_dump($file);
		fputs($file, $csv);
		fclose($file);

	?>
</body>
</html>