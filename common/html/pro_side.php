<div class="sidebar">
	<ul>
		<li><a href="<?php print (empty($_SERVER["HTTPS"]) ? "http://" : "https://") . $_SERVER["HTTP_HOST"] . '/ec_php/kaiin_top.php'; ?>">トップページ</a></li>
		<li><a href="<?php print (empty($_SERVER["HTTPS"]) ? "http://" : "https://") . $_SERVER["HTTP_HOST"] . '/ec_php/kaiin/kaiin_edit_mypage.php'; ?>">myページ</a></li>
		<li><a href="<?php print (empty($_SERVER["HTTPS"]) ? "http://" : "https://") . $_SERVER["HTTP_HOST"] . '/ec_php/kaiin/kaiin_list.php'; ?>">会員管理</a></li>
		<li><a href="<?php print (empty($_SERVER["HTTPS"]) ? "http://" : "https://") . $_SERVER["HTTP_HOST"] . '/ec_php/product/pro_list.php'; ?>">商品管理</a></li>
		<li><a href="<?php print (empty($_SERVER["HTTPS"]) ? "http://" : "https://") . $_SERVER["HTTP_HOST"] . '/ec_php/order/order_download.php'; ?>">注文書ダウンロード</a></li>
	</ul>
</div>