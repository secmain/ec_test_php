<?php

require_once '../common/common.php';
require_once '../class/Mise_db.php';

try {
	$member_email = $_POST['email'];
	$member_pass = $_POST['password'];

	#$member_email = htmlspecialchars($member_email);
	#$member_pass = htmlspecialchars($member_pass);

	$member_pass = md5($member_pass);

	$mise_db = new Mise_db();

	$rec = $mise_db->login_check($member_email, $member_pass);

	if ($rec == false) {
		'メールアドレスかパスワードが間違っています';
		header('Location:mise_list.php?error=1');
	} else {
		var_dump($rec);
		session_start();
		$tmp = [];
		$tmp['member_login'] = 1;
		$tmp['member_email'] = $member_email;
		$tmp['member_name'] = $rec['name'];
		$tmp['member_code'] = $rec['code'];
		$_SESSION['member'] = $tmp;

		header('Location:mise_list.php');
	}
} catch (Exception $e) {
	print 'it sysetem error!!!';
	exit();
}

?>