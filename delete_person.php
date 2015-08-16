<?php
include 'ease.php';
include 'connect.php';
$pid=post('pid');
$query=  mysqli_query($link, "delete from peoples where id = $pid")or die(mysqli_error($link));
echo 1;
?>
