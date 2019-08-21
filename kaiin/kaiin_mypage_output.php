<?php
	
	// 直アクセスでダウンロード可能（認証制御の脆弱性）
		
	require_once('../common/common.php');
	require_once('../class/Kaiin_db.php');

	try {
				
		// $kaiin_code = $_SESSION['kaiin_code'];			
		$kaiin_code = $_GET['kaiin_code'];

		$kaiin_db = new Kaiin_db();
						
		// 1レコードしかない前提
		$rec = $kaiin_db->get_kaiin($kaiin_code);
		$kaiin_name = $rec['name'];
		$my_file_name = $rec['prof_file_name'];

		//CSV文字列生成
	    $csvstr = "";
	    $csvstr .= $kaiin_code . ",";
		$csvstr .= $kaiin_name . ",";
	    $csvstr .= $my_file_name;
		 
	    //CSV出力
	    $fileNm = sprintf('profile_%03d.csv', $kaiin_code);
	    header('Content-Type: text/csv');
	    header('Content-Disposition: attachment; filename='.$fileNm);
	    echo mb_convert_encoding($csvstr, "SJIS", "UTF-8"); //Shift-JISに変換したい場合のみ

		unset($kaiin_db);

	} catch (Exception $e) {
		print 'system error !!!';
		print $e;
		exit();
	} 
?>