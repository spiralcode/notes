<?php
include 'ease.php';
include 'connect.php';
$pid=post('id');
$query=  mysqli_query($link,"delete from image where id = $pid")or die(mysqli_error($link));
echo 1;
?>
