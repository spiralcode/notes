<?php
include '../connect.php';
session_start();

$did = $_GET['id'];
$q = mysqli_query($link,"select * from draw where id = $did") or die(mysqli_error($link));
if(isset($_SESSION['userid']))
{
    $userid=$_SESSION['userid'];
while($d = mysqli_fetch_array($q))
{
    $authId=$d['userid'];
}
if($userid != $authId)
{
    if(mysqli_num_rows(mysqli_query($link,"select * from draw_view_count where id = $did"))==0)
    {
$s=mysqli_query("insert into data_view_count values ($did,1)") or die(mysqli_error($link));
    }
    else
    {
    $ins = mysqli_query("update draw_view_count set count = count + 1") or die(mysqli_error($link));
    }
}
}
else
{
     if(mysqli_num_rows(mysqli_query($link,"select * from draw_view_count where id = $did"))==0)
    {
$s=mysqli_query($link,"insert into draw_view_count values ($did,1)") or die(mysqli_error($link));
    }
    else
    {
    $ins = mysqli_query($link,"update draw_view_count set count = count + 1") or die(mysqli_error($link));
    }

}