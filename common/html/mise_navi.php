<?php require_once '../common/common.php'; ?>
<div class="nav-container">

	<div class="login-info">
		<?php
			if (isset($_SESSION['member_login']) == false) {
				print 'ようこそゲスト様';
				print '<br>';
			} else {
				print 'ようこそ';
				print $_SESSION['member_name'];
				print '様';
				print '<a href="member_logout.php">ログアウト</a><br>';
				print '<br>';
			}
		?>
	</div>
	<div class="logout">
		<?php
			if (isset($_SESSION['member_login'])) {
				print '<a href="' . getDomainName() . '/ec_php/mise/member_logout.php' . '">';
		 		print '<i class="fas fa-sign-out-alt fa-2x awe-grey"></i>';
			} else {
				print '<a href="' . getDomainName() . '/ec_php/mise/member_login.php' . '">';
				print 'メンバーログイン<i class="fas fa-sign-out-alt fa-2x awe-grey"></i>';
				print '</a>';
			}
		?>
	</div>
</div>

<div class="bread-zone">
	<?php
		$breads = make_bread($_SERVER["PHP_SELF"]);
		foreach ($breads as $i => $link) {
			if ($i != 0) {
				print ' > ';
			}
			print '<a href="' . $link[0] . '">' . $link[1] . '</a>';
		}
	?>
</div>