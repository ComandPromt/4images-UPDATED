<?php
session_start();
$main_template = 0;

$nozip = 1;
define('ROOT_PATH', './');
include(ROOT_PATH.'global.php');
require(ROOT_PATH.'includes/sessions.php');

if (($user_info['user_level'] != GUEST && $user_info['user_level'] != USER_AWAITING)) {
    $site_sess->logout($user_info['user_id']);
}

  redirect($_SESSION['pagina']);

?>
