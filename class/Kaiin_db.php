<?php

require_once('../common/common.php');

class Kaiin_db {
	
	private $db;

	function __construct() {
		$this->db = connect_db();
		$this->db->query('set names utf8');
	}

	function get_kaiins() {
		$sql = 'select code, name, prof_file_name, prof_file_path from mst_tbl';
		$stmt = $this->db->prepare($sql);
		$stmt->execute();

		$ret = [];
		$i = 0;
		while ($rec = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$ret[$i++] = [
				'code' => $rec['code'],
				'name' => $rec['name'],
				'prof_file_name' => $rec['prof_file_name'],
				'prof_file_path' => $rec['prof_file_path'],
			];
		}

		return $ret;
	}

	function __destruct() {
		$this->db = null;
	}
}