<?php

		require_once('../common/common.php');
		try {
				
			// $kaiin_code = $_SESSION['kaiin_code'];			
			$kaiin_code = $_GET['kaiin_code'];

			$db = connect_db();
			$db->query('set names utf8');

			$sql = 'select code, name, prof_file_name, prof_file_path from mst_tbl where code = ?';
			$stmt = $db->prepare($sql);
			$data = [$kaiin_code];
			$stmt->execute($data);
			
			// 1レコードしかない前提
			$rec = $stmt->fetch(PDO::FETCH_ASSOC);
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

			$db = null;

		} catch (Exception $e) {
			print 'system error !!!';
			print $e;
			exit();
		} 
	?>