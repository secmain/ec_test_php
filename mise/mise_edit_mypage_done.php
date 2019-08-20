<?php
	session_start();
	session_regenerate_id(true);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>会員修正完了</title>
	<?php require_once('../common/html/mise_style.php'); ?>
	<link rel="stylesheet" href="../css/common.css">
</head>
<body>
	<?php
		require_once('../common/html/mise_header.php');
		require_once('../common/html/mise_navi.php');
		require_once('../class/Mise_db.php');
	?>

	<div class="main">
		<div class="main-container">
			<h3 class="main-title">myページ編集完了</h3>

			<?php
				try {
					$data = [];
					$member = sanitize($_SESSION['member_info']);
					// file_nameもエスケープが必要
					// $data['mem_file_name'] = htmlspecialchars($_SESSION['my_file_name']);
					/*
					$data['mem_file_name'] = $member['my_file_name'];
					$data['mem_file_path'] = $member['mem_file_path'];
					*/
					
					$mise_db = new Mise_db();

					$mise_db->update_member($_SESSION['member']['member_code'], [
						'name' => $member['name'],
						'email' => $member['email'],
						'postal1' => $member['postal1'],
						'postal2' => $member['postal2'],
						'address' => $member['address'],
						'tel' => $member['tel'],
						'mem_file_name' => $member['my_file_name'],
						'mem_file_path' => $member['my_file_path'],
					]);

					unset($mise_db);

					// セッションの会員名も更新
					$member['member'] = $member_info;
					print '更新完了しました <br>';
					print '<a href="../mise/mise_list.php" class="btn">商品一覧画面へ</a>';

				} catch (Exception $e) {
					print 'system error!!<br>';
					print $e;
					exit();
				}
			?>
		</div>
		<?php require_once('../common/html/kaiin_side.php'); ?>
	</div>
	<?php require_once('../common/html/footer.php'); ?>
</body>
</html>