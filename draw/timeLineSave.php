<?php
include '../connect.php';
include '../session_check.php';
$date = $_POST['dateF'];
$only = $_POST['only'];
$epoch = strtotime($date)+86400; 
$content = mysqli_real_escape_string($link,$_POST['content']);
$q = mysqli_query($link,"insert into timeLine values(0,$userid,'$content','$date',$epoch,$only)")or die(mysqli_error($link));
echo 1;
?>