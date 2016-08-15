<?php
session_start();
session_destroy();
setcookie ("p", "", time() - 3600,"/"); 
setcookie ("e", "", time() - 3600,"/"); 
header('location: index.php');
?>