<?php

require_once('../common/common.php');

$_SESSION = array();
clearCart();

header('Location: mise_cartlook.php');