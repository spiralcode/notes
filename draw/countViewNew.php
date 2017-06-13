<?php
session_start();
include '../connect.php';
$did = $_GET['id'];

$ip = getRealIpAddr();
$q = mysqli_query($link,"select * from draw where id = $did") or die(mysqli_error($link));
if(isset($_SESSION['userid']))
{
$userid=$_SESSION['userid'];
while($d = mysqli_fetch_array($q))
{
    $authId=$d['userid'];
}
if($authId!=$userid)
$q = mysqli_query($conn,"insert into view_count values ($did,'$ip',now())") or die(mysqli_error($link));
}
else
{
    $q = mysqli_query($conn,"insert into view_count values ($did,'$ip',now())") or die(mysqli_error($link));

}
function getRealIpAddr()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
?>