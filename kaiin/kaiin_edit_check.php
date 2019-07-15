<?php
	session_start();
	session_regenerate_id(true);
	if (isset($_SESSION['login']) == false) {
		print 'ログインされていません。';
		print '<a href="../kaiin_login/kaiin_login.html">ログイン画面へ</a>';
		exit();
	} else {
		print $_SESSION['kaiin_name'];
		print 'さんログイン中<br>';
		print '<br>';
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
$kaiin_code = $_POST['code'];
$kaiin_name = $_POST['name'];

// kaiin_codeのサニタイジングがない
$kaiin_name = htmlspecialchars($kaiin_name);
$kaiin_pass1 = htmlspecialchars($kaiin_pass1);
$kaiin_pass2 = htmlspecialchars($kaiin_pass2);
//

$ok_flag = true;

require_once '../common/common.php';
var_dump(make_bread($_SERVER['PHP_SELF']));

if ($kaiin_code == '') {
	print '会員コードが入力されていません<br>';
	$ok_flag = false;
} else {
	print '会員コード：　' . $kaiin_code . '<br>';
}

if ($kaiin_name == '') {
	print '名前が入力されていません<br>';
	$ok_flag = false;
} else {
	print '会員名：　' . $kaiin_name . '<br>';
}

if ($kaiin_pass1 == '') {
	print 'パスワードが入力されていません<br>';
	$ok_flag = false;
} else if ($kaiin_pass1 !== $kaiin_pass2) {
	print 'パスワードが一致しません<br>';
	$ok_flag = false;
}

if (!$ok_flag) {
	print '<form>';
	print '<input type="button" onclick="history.back()" value="戻る">';
	print '</form>';
} else {
	$kaiin_pass = md5($kaiin_pass1);
	print '<form method="post" action="kaiin_edit_done.php">';
	print '<input type="hidden" name="code" value="' . $kaiin_code . '">';
	print '<input type="hidden" name="name" value="' . $kaiin_name . '">';
	print '<input type="hidden" name="password" value="' . $kaiin_pass . '">';
	print '<input type="button" onclick="history.back()" value="戻る">';
	print '<input type="submit" value="OK">';
	print '</form>';
}

?>
</body>
</html>

