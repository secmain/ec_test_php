<?php

try {
	$kaiin_code = $_POST['code'];
	$kaiin_pass = $_POST['password'];

	$kaiin_code = htmlspecialchars($kaiin_code);
	$kaiin_pass = htmlspecialchars($kaiin_pass);

	$kaiin_pass = md5($kaiin_pass);

	$dsn = 'mysql:dbname=ec_test_php;host=localhost;';
	$user = 'an';
	$password = 'password';
	$db = new PDO($dsn, $user, $password);
	$db->query('set names utf8');

	$sql = 'select name from mst_tbl where code = ? and password = ?';
	$stmt = $db->prepare($sql);
	$data = [$kaiin_code, $kaiin_pass];
	$stmt->execute($data);

	$db = null;

	$rec = $stmt->fetch(PDO::FETCH_ASSOC);

	if ($rec == false) {
		print '会員コードかパスワードが間違っています';
		print '<a href="kaiin_login.html">戻る</a>';
	} else {
		session_start();
		$_SESSION['login'] = 1;
		$_SESSION['kaiin_code'] = $kaiin_code;
		$_SESSION['kaiin_name'] = $rec['name'];
		header('Location:../kaiin_top.php');
	}
} catch (Exception $e) {
	print 'it sysetem error!!!';
	exit();
}

?>