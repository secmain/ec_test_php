<div class="cate-sidebar">
<?php
	require_once('../class/Mise_db.php');

	$mise_db = new Mise_db();
	$shohins = $mise_db->get_shohins('category');
	$gategorys = $mise_db->get_category();
	print '<ul>';
	foreach ($gategorys as $i => $rec) {
		print '<li>' . $rec['id'] . ': ' . $rec['text'] . '</li>';
		print '<ul>';
		foreach ($shohins as $j => $shohin) {
			if ($rec['id'] == $shohin['category']) {
				print '<a href="mise_product.php?pro_code=' . $shohin['code'] . '"><li class="category-shohin">' . $shohin['name'] . '</li></a>';	
			}			
		}
		print '</ul>';
	}
	print '</ul>';
?>
</div>
