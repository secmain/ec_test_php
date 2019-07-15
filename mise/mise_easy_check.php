<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>mise_form_check</title>
</head>
<body>
<?php

session_start();
session_regenerate_id(true);
if (isset($_SESSION['member_login']) == false) {
	print 'ログインされていません';
	print '<a href="mise_list.php">商品一覧へ</a>';
	exit();
}

require_once('../common/common.php');

$post = sanitize($_POST);
var_dump($post);
$code = $_SESSION['member_code'];

$dsn = 'mysql:dbname=ec_test_php;host=localhost;';
$user = 'an';
$password = 'password';
$db = new PDO($dsn, $user, $password);
$db->query('set names utf8');

$sql = 'select name, email, postal1, postal2, address, tel from order_member where code = ?';
$stmt = $db->prepare($sql);
$data[] = $code;
$stmt->execute($data);
$rec = $stmt->fetch(PDO::FETCH_ASSOC);

$db = null;

$onamae = $rec['name'];
$email = $rec['email'];
$postal1 = $rec['postal1'];
$postal2 = $rec['postal2'];
$address = $rec['address'];
$tel = $rec['tel'];

print 'お名前<br>';
print $onamae;
print '<br><br>';

print 'メールアドレス<br>';
print $email;
print '<br><br>';

print '郵便番号<br>';
print $postal1 . '-' . $postal2;
print '<br><br>';

print '住所<br>';
print $address;
print '<br><br>';

print '電話番号<br>';
print $tel;
print '<br><br>';


if ($ok_flg === true) {
	print '<form action="mise_kantan_done.php" method="post">';
	print '<input type="hidden" name="onamae" value="'. $onamae .'">';
	print '<input type="hidden" name="email" value="'. $email .'">';
	print '<input type="hidden" name="postal1" value="'. $postal1 .'">';
	print '<input type="hidden" name="postal2" value="'. $postal2 .'">';
	print '<input type="hidden" name="address" value="'. $address .'">';
	print '<input type="hidden" name="tel" value="'. $tel .'">';
	print '<input type="button" onclick="history.back()" value="戻る">';
	print '<input type="submit" value="OK"><br>';
	print '</form>';
} else {
	print '<form>';
	print '<input type="button" onclick="history.back()" value="戻る">';
	print '</form>';
}

?>
</body>
</html>