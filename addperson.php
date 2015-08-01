<?php
include 'session_check.php';
include 'connect.php';
include 'ease.php';
$name= post('name');
$query=mysqli_query($link,"insert into peoples values (0,'$name',$userid,'','','','','','','')")or die(mysqli_query($link));
echo 1;

?>