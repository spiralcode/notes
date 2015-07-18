<?php
include 'connect.php';
session_start();
date_default_timezone_set('Asia/Calcutta');
$userid=$_SESSION['userid'];
$content=$_POST['contents'];
$content=mysqli_real_escape_string($conn, $content);
$geo=$_POST['geolocation'];
$sgeo=$_POST['setglocation'];
$nid=$_POST['timeid'];
$time=time();
$datum = new DateTime();
$startTime = $datum->format('Y-m-d H:i:s');

$q1 = mysqli_query($link, "insert into events values ($nid,$userid,$time,'$content','$sgeo','$geo','$startTime')")or die(mysqli_error($link));
echo 1;