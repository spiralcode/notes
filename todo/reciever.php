<?php
include '../connect.php';
$id = $_POST['itemId'];
$content = $_POST['content'];
echo $content;
$query = mysqli_query($conn,"select * from todo where id = $id")or die(mysqli_error($conn));
if(mysqli_num_rows($query)==0)
{
$content=mysqli_escape_string($content);
$query = mysqli_query($conn,"insert into todo values ($id,0,'$content',0,0,0)")or die(mysqli_error($conn));
}
else
{
$query = mysqli_query($conn,"update todo set content = '$content' where id = $id")or die(mysqli_error($conn));
}
?>