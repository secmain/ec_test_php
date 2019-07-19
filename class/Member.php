<?php

class Member {

	private $is_login;

	function __construct() {
		$this->db = connect_db();
		$this->db->query('set names utf8');
		$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}

}