<?php
include '../connect.php';
include '../session_check.php';
$id=$_POST['id'];
$q = mysqli_query($link,"delete from draw where id = $id")or die(mysqli_error($link));
echo 1;
?>