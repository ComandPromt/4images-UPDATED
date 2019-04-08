<?php
session_start();
setcookie("4images_userid","-1");
echo '<script>location.href="'.$_SESSION['pagina'].'";</script>';
?>
