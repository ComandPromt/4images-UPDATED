<?php
session_start();
$main_template = 0;

$nozip = 1;
define('ROOT_PATH', './');
include(ROOT_PATH.'global.php');
require(ROOT_PATH.'includes/sessions.php');

$error = 0;
if ($user_info['user_level'] != GUEST || empty($HTTP_POST_VARS['user_name']) || empty($HTTP_POST_VARS['user_password'])) {
  if (!preg_match("/index\.php/", $url) && !preg_match("/login\.php/", $url) && !preg_match("/register\.php/", $url) && !preg_match("/member\.php/", $url)) {
    redirect($url);
  }
  else {
  redirect($_SESSION['pagina']);

  }
}
else {
  $user_name = trim($HTTP_POST_VARS['user_name']);
  $user_password = trim($HTTP_POST_VARS['user_password']);
  $auto_login = (isset($HTTP_POST_VARS['auto_login']) && $HTTP_POST_VARS['auto_login'] == 1) ? 1 : 0;

  if ($site_sess->login($user_name, $user_password, $auto_login)) {
    if (!preg_match("/index\.php/", $url) && !preg_match("/login\.php/", $url) && !preg_match("/register\.php/", $url) && !preg_match("/member\.php/", $url)) {
      redirect($url);
    }
    else {

       redirect($_SESSION['pagina']);

    }
  }
  
}


  redirect($_SESSION['pagina']);

?>
