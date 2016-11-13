<?php
include '../connect.php';
include '../session_check.php';
$title=$_POST['title'];
$content=$_POST['content'];
if(isset($_GET['edit']))
{
$id=$_POST['id'];
$q = mysqli_query($link,"update draw set content = '$content',title = '$title' where id = $id")or die(mysqli_error($link));
echo 1;
}
else
{

$q = mysqli_query($link,"insert into draw values (0,$userid,'$title','$content',NOW())")or die(mysqli_error($link));
echo 1;
}
?>