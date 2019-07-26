<?php
	session_start();
	session_regenerate_id(true);
/*
	// Csrf対策
	if ($_POST['csrf_token'] != $_SESSION['csrf_token']) {
		print '不正な操作が行われました。';
		exit();
	}
	unset($_SESSION['csrf_token']);
*/
?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>商品レビュー</title>
	<?php require_once('../common/html/mise_style.php'); ?>
	<link rel="stylesheet" href="../css/pro_disp.css">
</head>
<body>
	<?php
		require_once('../common/common.php');
		require_once('../common/html/mise_header.php');
		require_once('../common/html/mise_navi.php');
	?>
	<div class="main">
		<div class="main-container">

			<h3 class="main-title">商品レビュー画面</h3>
			<?php
				require_once('../class/Mise_db.php');

				$is_login = isMemberLogin();
				
				if (!$is_login) {
					print 'レビューを行うにはログインする必要があります。';
					exit();
				}

				try {	

					// XSSの脆弱性のため
					// $post = sanitize($_POST);
					$post = $_POST;
					$pro_code = $post['pro_code'];
					$comment = $post['comment'];
					$member = $_SESSION['member'];
					$member_code = $member['member_code'];

					$mise_db = new Mise_db();

					$mise_db->insert_table(Mise_db::REVIEW_TABLE, [
						'pro_code' => $pro_code,
						'user_id' => $member_code,
						'comment' => $comment,
					]);

					header('Location:mise_product.php?pro_code=' . $pro_code);

				} catch (Exception $e) {
					print $e;
					print 'ただいま障害によりご迷惑をおかけしています。';
					exit();
				}

			?>
			</div>
		<?php require_once('../common/html/mise_side.php'); ?>
	</div>
	<?php require_once('../common/html/footer.php'); ?>
</body>
</html>