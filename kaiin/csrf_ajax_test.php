<?php
	function ex($s) {
		echo htmlspecialchars($s, ENT_COMPACT, 'UTF-8');
	}

	session_start();
	$id = $_SESSION["login"];
	$tmpfile = $_FILES['prof_file']['tmp_name'];
	$tofile = $_FILES['prof_file']['name'];

	if (!is_uploaded_file($tmpfile)) {
		die('not file');
	} else if (!move_uploaded_file($tmpfile, "../up_img/$tofile")) {
		die('not able to up file');
	}

	$imgurl = '../up_img/' . urlencode($tofile);
?>

<body>
	id: <?php ex($id); ?>
	以下の画像をアップロードしました。<br>
	<a href="<?php ex($imgurl); ?>">
		<img src="<?php echo urldecode($imgurl); ?>"><?php echo urldecode($imgurl); ?>
	</a>
</body>