<?php
include '../connect.php';
include '../session_check.php';
$id = $_POST['itemId'];
$content = mysqli_real_escape_string($conn,$_POST['content']);
$query = mysqli_query($conn,"select * from todo where id = $id")or die(mysqli_error($conn));
if(mysqli_num_rows($query)==0)
{
$query = mysqli_query($conn,"insert into todo values ($id,$userid,'$content',0,0,0)")or die(mysqli_error($conn));
}
else
{
$query = mysqli_query($conn,"update todo set content = '$content' where id = $id")or die(mysqli_error($conn));
}
echo $id;
?>