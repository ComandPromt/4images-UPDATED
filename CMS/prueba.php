<?php
print substr($_SERVER["REQUEST_URI"],0,strripos($_SERVER["REQUEST_URI"],"/")+1);
?>