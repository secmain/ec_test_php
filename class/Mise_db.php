<?php

require_once('../common/common.php');

class Mise_db {
	
	private $db;

	const MEM_TABLE = 'order_member';
	const ORDER_TABLE = 'order_tbl';
	const ORDER_PRODUCT_TABLE = 'order_product_tbl';

	function __construct() {
		$this->db = connect_db();
		$this->db->query('set names utf8');
		$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}

	function login_check($id, $password) {
		$sql = 'select code, name from order_member where email = ? and password = ?';
		$stmt = $this->db->prepare($sql);
		$data = [$id, $password];
		$stmt->execute($data);

		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	function get_shohins($order = null) {
		$columns = [
			'code',
			'name',
			'price',
			'file_name',
			'file_path',
			'category',
		];

		$str_column = implode(', ', $columns);

		if ($order == null) {
			// デフォルトの並び
			$order = 'datetime desc';
		}

		$sql = sprintf('select %s from mst_product order by %s', $str_column, $order);
		$stmt = $this->db->prepare($sql);
		$stmt->execute();

		$ret = [];
		while ($rec = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$tmp = [];
			foreach ($columns as $key => $col) {
				$tmp[$col] = $rec[$col];
			}
			$ret[] = $tmp;
		}
		return $ret;
	}

	function get_shohin($code) {
		$sql = 'select code, name, price, file_name, file_path from mst_product where code = ?';
		$stmt = $this->db->prepare($sql);
		$data = [$code];
		$stmt->execute($data);

		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	function get_category() {

		$columns = [
			'id',
			'text'
		];

		$str_column = implode(', ', $columns);

		$sql = sprintf('select %s from pro_category order by id', $str_column);
		$stmt = $this->db->prepare($sql);
		$stmt->execute();

		$ret = [];
		while ($rec = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$tmp = [];
			foreach ($columns as $key => $col) {
				$tmp[$col] = $rec[$col];
			}
			$ret[] = $tmp;
		}
		return $ret;
	}

	function get_member($id) {
		$sql = 'select * from order_member where code = ?';
		$stmt = $this->db->prepare($sql);
		$stmt->execute([$id]);

		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	function lock_tables($tables, $mode) {
		$str_table = '';
		foreach ($tables as $i => $table) {
			$str_table .= $table . ' ' . $mode . ',';
		}
		$sql = 'lock tables ' . substr($str_table, 0, -1);
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
	}

	function insert_table($table, $params) {

		$table_name;
		switch ($table) {
			case self::MEM_TABLE:
			case self::ORDER_TABLE:
			case self::ORDER_PRODUCT_TABLE:
				$table_name = $table;
				break;
			default:
				// error
				break;
		}
		// 挿入に使うパラメータ類を使いやすい形へ変換
		$ret = $this->create_insert_param($params);
		$sql = sprintf(
			'insert into %s(%s) values(%s)',
			$table_name,
			$ret['str_column'],
			$ret['str_question']
		);

		$stmt = $this->db->prepare($sql);
		$stmt->execute($ret['values']);
	}

	// プライベートなので、このクラス内からのみ呼び出し可能
	private function create_insert_param($params) {
		$vals = [];
		$str_col = '';
		$str_qs = '';

		foreach ($params as $key => $val) {
			$str_col .= $key;
			$str_col .= ',';
			$str_qs .= '?,';
			$vals[] = $val;
		}

		$ret = [
			'str_column' => substr($str_col, 0, -1),
			'str_question' => substr($str_qs, 0, -1),
			'values' => $vals,
		];

		return $ret;
	}

	function get_last_ins_id() {
		$sql = 'select last_insert_id() as last_id';
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$rec = $stmt->fetch(PDO::FETCH_ASSOC);
		return $rec['last_id'];
	}

	function unlock_tables() {
		$sql = 'unlock tables';
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
	}

	function beginTransaction() {
		$this->db->beginTransaction();
	}

	function rollback() {
		$this->db->rollback();
	}

	function commit() {
		$this->db->commit();
	}

	function __destruct() {
		$this->db = null;
	}
}