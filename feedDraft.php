<?php
include 'session_check.php';
include 'connect.php';
date_default_timezone_set('Asia/Calcutta');
$contents=$_POST['contents'];
$contents=mysqli_real_escape_string($conn, $contents);
$time=time();
$datum = new DateTime();
if($_POST['alterDate']==0)
$startTime = $datum->format('Y-m-d H:i:s');
else
$startTime = $_POST['alterDate'];

$q1 = mysqli_query($link, "insert into drafts values ($userid,'$contents','$id','$startTime')")or die(mysqli_error($link));
echo 1;
