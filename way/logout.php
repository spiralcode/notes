<?php
session_start();
session_destroy();
setcookie ("email", "", time() - 3600,"/"); 
setcookie ("pass", "", time() - 3600,"/"); 
header('location: index.php?logout');
?>