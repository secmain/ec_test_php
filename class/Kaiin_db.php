<?php

require_once('../common/common.php');

class Kaiin_db {
	
	private $db;

	function __construct() {
		$this->db = connect_db();
		$this->db->query('set names utf8');
		// エラー出力画面のため
		$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
	}

	function get_kaiins() {
		// $sql = 'select code, name, prof_file_name, prof_file_path from mst_tbl';
		$sql = 'select * from mst_tbl';
		$stmt = $this->db->prepare($sql);
		$stmt->execute();

		$ret = [];
		while ($rec = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$ret[] = $rec;
		}

		return $ret;
	}

	function get_kaiin($id) {
		$sql = 'select * from mst_tbl where code = ?';
		$data = [$id];
		$stmt = $this->db->prepare($sql);
		$stmt->execute($data);

		return $stmt->fetch(PDO::FETCH_ASSOC);
	}	

	function login_check($id, $pass) {
		$sql = 'select * from mst_tbl where code = ? and password = ?';
		$data = [$id, $pass];
		$stmt = $this->db->prepare($sql);
		$stmt->execute($data);

		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	function get_kaiin_data($year, $month, $day) {
		// yearに脆弱性
		$year = $year;
		$month = sprintf('%02d', intval($month));
		$day = sprintf('%02d', intval($day));

		$sql = '
		select 
			ot.code,
			ot.date,
			ot.code_member,
			ot.name as ot_name,
			ot.email,
			ot.postal1,
			ot.postal2,
			ot.address,
			ot.tel,
			mp.name as mst_name,
			mp.price,
			opt.code_product,
			opt.quantity
		from
			order_tbl ot,
			order_product_tbl opt,
			mst_product mp
		where
			ot.code = opt.code and
			opt.code_product = mp.code and 
			substr(ot.date, 1, 4) = ' . $year . ' and 
			substr(ot.date, 6, 2) = ' . $month . ' and 
			substr(ot.date, 9, 2) = ' . $day .
		' order by ot.date';

		$stmt = $this->db->prepare($sql);
		$stmt->execute();

		// $stmt->debugDumpParams();

		$ret = [];
		while ($rec = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$ret[] = $rec;
		}
		return $ret;
	}

	function add_kaiin($params) {
		$sql = 'insert into mst_tbl(name, password, prof_file_name, prof_file_path) values(?,?,?,?)';
		$stmt = $this->db->prepare($sql);
		$stmt->execute($params);
	}

	function delete_kaiin($id) {
		$sql = 'delete from mst_tbl where code=?';
		$data = [$id];
		$stmt = $this->db->prepare($sql);
		
		return $stmt->execute($data);
	}

	function up_kaiin($id, $params) {
		$data = [];
		$columns = [
			'name',
			'prof_file_name',
			'prof_file_path',
		];
		foreach ($columns as $col) {
			if (isset($params[$col])) {
				$data[] = $params[$col];
			} else {
				$data[] = null;
			}
		}
		$data[] = $id;
		$sql = 'update mst_tbl set name=?, prof_file_name=?, prof_file_path=? where code=?';
		$stmt = $this->db->prepare($sql);
		$stmt->execute($data);		
	}

	function chpwd_kaiin($id, $pwd) {
		$sql = 'update mst_tbl set password=? where code=?';
		$stmt = $this->db->prepare($sql);
		$stmt->execute([$pwd, $id]);		
	}

	function __destruct() {
		$this->db = null;
	}
}