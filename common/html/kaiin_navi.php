<?php require_once '../common/common.php'; ?>
<div class="nav-container">

	<div class="login-info">
		<?php
			if (isset($_SESSION['kaiin']) == false || isset($_SESSION['kaiin']['login']) == false) {
				print 'ログインされていません。';
				print '<a href="' . getDomainName() . '/ec_php/kaiin_login/kaiin_login.php">ログイン画面へ</a>';
				exit();
			} else {
				print '<a href="' . getDomainName() . '/ec_php/kaiin/kaiin_edit_mypage.php">';
				print $_SESSION['kaiin']['kaiin_name'];
				print '</a>さんログイン中';
			}
		?>
	</div>
	<div class="logout">
		<a href="<?php print getDomainName() . '/ec_php/kaiin_login/kaiin_logout.php'; ?>">
			<i class="fas fa-sign-out-alt fa-2x awe-grey"></i>
		</a>
	</div>
</div>

<div class="bread-zone"><?php
		$breads = make_bread($_SERVER["PHP_SELF"]);
		foreach ($breads as $i => $link) {
			if ($i != 0) {
				print ' > ';
			}
			print '<a href="' . $link[0] . '">' . $link[1] . '</a>';
		}
	?>
</div>