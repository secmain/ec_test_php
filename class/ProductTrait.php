<?php

trait ProductTrait {

	public function get_shohin($db, $code) {
		$sql = 'select code, name, price, file_name, file_path from mst_product where code = ?';
		$stmt = $db->prepare($sql);
		$data = [$code];
		$stmt->execute($data);

		return $stmt->fetch(PDO::FETCH_ASSOC);
	}
	
}