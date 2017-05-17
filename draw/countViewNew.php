<?php
session_start();
include '../connect.php';
$did = $_GET['id'];
$ip = $_SERVER['REMOTE_ADDR'];
$q = mysqli_query($link,"select * from draw where id = $did") or die(mysqli_error($link));
if(isset($_SESSION['userid']))
{
$userid=$_SESSION['userid'];
while($d = mysqli_fetch_array($q))
{
    $authId=$d['userid'];
}
if($authId!=$userid)
$q = mysqli_query($conn,"insert into view_count values ($did,'$ip','now()'") or die(mysqli_error($link));
}
else
{
    $q = mysqli_query($conn,"insert into view_count values ($did,'$ip','now()'") or die(mysqli_error($link));

}

?>