<?php
include 'session_check.php';
include 'connect.php';
date_default_timezone_set('Asia/Calcutta');

function getUrls($string) {
 $regex = '/https?\:\/\/[^\" ]+/i';
 preg_match_all($regex, $string, $matches);
 return ($matches[0]);
}

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
flush();
$urls=  getUrls($content);
foreach ($urls as $url)
{
    $q4=mysqli_query($link, "select url from url where url like '$url'")or die(mysqli_error($link));
   if(mysqli_num_rows($q4)==0)
   {
       $url=mysqli_real_escape_string($conn, $url);
          mysqli_query($link, "insert into url values (0,'$url',$userid)")or die(mysqli_error($link));

   }
}
