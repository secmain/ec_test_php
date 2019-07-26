<?php require_once '../common/common.php'; ?>
<div class="nav-container">

	<div class="login-info">
		<?php
			if (isset($_SESSION['member']) == false) {
				print 'ようこそゲスト様';
				print '<br>';
			} else {
				print 'ようこそ';
				print sprintf('<a href="../mise/mise_edit_mypage.php?code=%s">%s</a>', $_SESSION['member']['member_code'], $_SESSION['member']['member_name']);
				print '様';
				print '<br>';
			}
		?>
	</div>
	<div class="logout">
		<?php
			if (isset($_SESSION['member'])) {
				print '<a href="' . getDomainName() . '/ec_php/mise/member_logout.php' . '">';
		 		print 'ログアウト<i class="fas fa-sign-out-alt fa-2x awe-grey"></i>';
		 		print '</a>';
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