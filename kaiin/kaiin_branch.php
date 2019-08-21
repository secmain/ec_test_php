<?php

if (isset($_POST['add']) == true) {
	header('Location:kaiin_add.php');
}

if (isset($_POST['disp']) == true) {
	if (isset($_POST['kaiin_code']) == false) {
		header('Location:kaiin_ng.php');
	} else {
		$kaiin_code = $_POST['kaiin_code'];
		header('Location:kaiin_disp.php?kaiin_code=' . $kaiin_code);
	}
}

if (isset($_POST['edit']) == true) {
	if (isset($_POST['kaiin_code']) == false) {
		header('Location:kaiin_ng.php');
	} else {
		$kaiin_code = $_POST['kaiin_code'];
		header('Location:kaiin_edit.php?kaiin_code=' . $kaiin_code);
	}
}

if (isset($_POST['delete']) == true) {
	if (isset($_POST['kaiin_code']) == false) {
		header('Location:kaiin_ng.php');
	} else {
		$kaiin_code = $_POST['kaiin_code'];
		header('Location:kaiin_delete.php?kaiin_code=' . $kaiin_code);
	}
}

?>