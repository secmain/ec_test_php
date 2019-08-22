<?php
	session_start();
	session_regenerate_id(true);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>会員削除完了</title>
	<form action="kaiin_delete_done.php" method="post">
				<!-- (A) -->
				<input type="hidden" name="code" value="<?php print $kaiin_code; ?>">
				<input type="hidden" name="name" value="<?php print $kaiin_name; ?>">
				<input type="button" class="btn" onclick="history.back()" value="戻る">
				<input type="submit" class="btn" value="OK">
			</form>
</head>
<body>
	
	<?php
		require_once('../common/html/kaiin_header.php');
		require_once('../common/html/kaiin_navi.php');
		require_once('../common/common.php');
		require_once('../class/Kaiin_db.php');
	?>

	<div class="main" class="clear-fix">
		<div class="main-container">
			<h3 class="main-title">会員削除完了</h3>
			<?php
				try {

					$kaiin_code = $_POST['code'];
					// ここでサニタイジング
					// $kaiin_code = htmlspecialchars($kaiin_code);

					$kaiin_db = new Kaiin_db();

					$kaiin_db->delete_kaiin($kaiin_code);
					
					unset($kaiin_db);

					print checkGamenDispField('会員コード：' . $kaiin_code . 'を削除しました');

				} catch (Exception $e) {
					print 'system error!!';
					exit();
				}
			?>
			<form action="kaiin_list.php" method="get">
				<input type="submit" class="btn" value="会員一覧へ">
			</form>
		</div>
		<?php require_once '../common/html/kaiin_side.php'; ?>
	</div>
	<?php require_once '../common/html/footer.php'; ?>
</body>
</html>