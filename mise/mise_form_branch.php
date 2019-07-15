<?php
session_start();
session_regenerate_id(true);
if (isset($_SESSION['member_login']) && $_SESSION['member_login'] == 1) {
	header('Location:mise_form.html');
} else {

}
?>