<?php
	session_start();
	session_regenerate_id(true);
	if (isset($_SESSION['member_login']) == false) {
		print 'ログインされていません';
		print '<a href="mise_list.php">商品一覧へ</a>';
		exit();
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
<?php

try {
	require_once('../common/common.php');

	$post = sanitize($_POST);

	$onamae = $post['onamae'];
	$email = $post['email'];
	$postal1 = $post['postal1'];
	$postal2 = $post['postal2'];
	$address = $post['address'];
	$tel = $post['tel'];


	print $onamae . '様<br>';
	print 'ご注文ありがとう<br>';
	print $email . 'にメールを送りましたので、ご確認お願いします。<br>';
	print '商品は以下の住所へ発送させていただきます。<br>';
	print $postal1 . '-' . $postal2 . '<br>';
	print $address . '<br>';
	print $tel . '<br>';

	$honbun = '';
	$honbun .= $onamae . "様　\nこのたびはご注文ありがとうございました。\n";
	$honbun .= "\n";
	$honbun .= "ご注文商品\n";
	$honbun .= "-------------\n";

	$cart = $_SESSION['cart'];
	$count = $_SESSION['count'];
	$max = count($cart);

	$dsn = 'mysql:dbname=ec_test_php;host=localhost';
	$user = 'an';
	$password = 'password';
	$dbh = new PDO($dsn, $user, $password);
	$dbh->query('SET NAMES utf8');
var_dump($post);
	for ($i = 0; $i < $max; $i++) {
		$sql = 'select name, price from mst_product where code=?';
		$stmt = $dbh->prepare($sql);
		$data[0] = $cart[$i];
		$stmt->execute($data);

		$rec = $stmt->fetch(PDO::FETCH_ASSOC);

		$name = $rec['name'];
		$price = $rec['price'];
		$kakaku[] = $price;
		$suryo = $count[$i];
		$shokei = $price * $suryo;

		$honbun .= $name . '';
		$honbun .= $price . '円　x';
		$honbun .= $suryo . '個　=';
		$honbun .= $shokei . "円\n";
	}

	$sql = 'lock tables order_tbl, order_product_tbl write';
	$stmt = $dbh->prepare($sql);
	$stmt->execute();

	$last_member = $_SESSION['member_code'];

	$sql = 'insert into order_tbl(code_member, name, email, postal1, postal2, address, tel) values(?,?,?,?,?,?,?)';
	$stmt = $dbh->prepare($sql);
	$data = [];
	$data[] = $last_member;
	$data[] = $onamae;
	$data[] = $email;
	$data[] = $postal1;
	$data[] = $postal2;
	$data[] = $address;
	$data[] = $tel;
	$stmt->execute($data);

	$sql = 'select last_insert_id()';
	$stmt = $dbh->prepare($sql);
	$stmt->execute();
	$rec = $stmt->fetch(PDO::FETCH_ASSOC);
	$lastcode = $rec['LAST_INSERT_ID()'];

	for ($i = 0; $i < $max; $i++) {
		$sql = 'insert into order_product_tbl(code_sale, code_product, price, quantity) values(?,?,?,?)';
		$stmt = $dbh->prepare($sql);
		$data = [];
		$data[] = $lastcode;
		$data[] = $cart[$i];
		$data[] = $kakaku[$i];
		$data[] = $count[$i];
		$stmt->execute($data);
	}

	$sql = 'unlock tables';
	$stmt = $dbh->prepare($sql);
	$stmt->execute();

	$dbh = null;


	$honbun .= "送料は無料です。\n";
	$honbun .= "-------------------\n";
	$honbun .= "\n";
	$honbun .= "代金は以下の口座にお振込みください。\n";
	$honbun .= "テスト銀行　テスト支店　口座1111111111\n";
	$honbun .= "入金確認が取れ次第、梱包、発送させていただきます。\n";
	$honbun .= "\n";
	$honbun .= "◇◇◇◇◇◇◇◇◇◇◇◇◇◇◇◇◇◇◇\n";
	$honbun .= "　～安心野菜の〇〇農園～　\n";
	$honbun .= "\n";
	$honbun .= "〇〇県〇市\n";
	$honbun .= "電話：　22222222\n";
	$honbun .= "FAX：　33333333333\n";
	$honbun .= "\n";

	$honbun .= "◇◇◇◇◇◇◇◇◇◇◇◇◇◇◇◇◇◇◇\n";

	// print '<br>';
	// print nl2br($honbun);

	/*
	$title = 'ご注文ありがとうございます。';
	$header = 'From:info@';
	$honbun = html_entity_decode($honbun, $ENT_QUOTES, 'UTF-8');
	mb_language('Japanese');
	mb_internal_encoding('UTF-8');
	mb_send_mail($email, $title, $honbun, $header);

	// miseあて
	$title = '注文がありました。';
	$header = 'From:info@';
	$honbun = html_entity_decode($honbun, $ENT_QUOTES, 'UTF-8');
	mb_language('Japanese');
	mb_internal_encoding('UTF-8');
	// miseあてemail
	mb_send_mail('test@email.cocooom.jpp', $title, $honbun, $header);
	*/

} catch (Exception $e) {
	print $e;
	print 'ただいま障害によりご迷惑をおかけしています。';
	exit();
}

?>
<a href="mise_list.php">商品画面へ</a>

</body>
</html>