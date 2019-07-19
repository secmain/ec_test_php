<div class="sidebar">
	<ul>
		<li><a href="<?php print (empty($_SERVER["HTTPS"]) ? "http://" : "https://") . $_SERVER["HTTP_HOST"] . '/ec_php/mise/mise_list.php'; ?>">商品一覧<i class="fas fa-shopping-bag"></i></a></li>
		<li><a href="<?php print (empty($_SERVER["HTTPS"]) ? "http://" : "https://") . $_SERVER["HTTP_HOST"] . '/ec_php/mise/mise_cartlook.php'; ?>">カートを見る<i class="fas fa-shopping-cart"></i></a></li>
		<li><a href="<?php print (empty($_SERVER["HTTPS"]) ? "http://" : "https://") . $_SERVER["HTTP_HOST"] . '/ec_php/mise/clear_cart.php'; ?>">カートを空にする<i class="fas fa-shopping-cart cart-clear-icon"></i></a></li>
		<li><a href="<?php print (empty($_SERVER["HTTPS"]) ? "http://" : "https://") . $_SERVER["HTTP_HOST"] . '/ec_php/mise/mise_form.php'; ?>">購入手続き<i class="fas fa-cash-register"></i></a></li>
	</ul>
</div>