<?php
include '../connect.php';
include '../session_check.php';
$id=$_GET['id'];
$query = mysqli_query($conn,"select status from todo where id = $id") or die(mysqli_error($conn));
while($row = mysqli_fetch_array($query))
{
    $state = $row[0];
}
if($state==0)
$query = mysqli_query($conn,"update todo set status = 1 where userid = $userid and id = $id") or die(mysqli_error($conn));
else
$query = mysqli_query($conn,"update todo set status = 0 where userid = $userid and id = $id") or die(mysqli_error($conn));
echo 1;
?>