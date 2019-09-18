<?php
	session_start();
	session_regenerate_id(true);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>xmlファイルサンプルダウンロード</title>
	<?php require_once('../common/html/pro_style.php'); ?>
	<link rel="stylesheet" href="../css/pro_edit.css">
</head>
<body>
	<?php
	
		require_once('../common/html/kaiin_header.php');
		require_once('../common/html/kaiin_navi.php');
		require_once('../common/common.php');

		$pPath = '../add_product_sample.xml';

		//-- ファイルが読めない時はエラー
	    if (!is_readable($pPath)) { die($pPath); }

	    //-- Content-Type
	    header('Content-Type: application/xml');

	    //-- ウェブブラウザが独自にMIMEタイプを判断する処理を抑止する
	    header('X-Content-Type-Options: nosniff');

	    //-- ダウンロードファイルのサイズ
	    header('Content-Length: ' . filesize($pPath));

	    //-- ダウンロード時のファイル名
	    header('Content-Disposition: attachment; filename="' . basename($pPath) . '"');

	    //-- keep-aliveを無効にする
	    header('Connection: close');

	    //-- readfile()の前に出力バッファリングを無効化する
	    while (ob_get_level()) { ob_end_clean(); }

	    //-- 出力
	    readfile($pPath);

	    //-- 最後に終了させるのを忘れない
	    exit;
		
	?>
</body>