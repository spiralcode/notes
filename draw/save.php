<?php
include '../connect.php';
include '../session_check.php';
$title=mysqli_real_escape_string($link,$_POST['title']);
$content=mysqli_real_escape_string($link,$_POST['content']);
$cat = mysqli_real_escape_string($link,$_POST['cat']);
if(isset($_GET['edit']))
{
$id=$_POST['id'];
$q = mysqli_query($link,"update draw set content = '$content',title = '$title', category = '$cat' where id = $id")or die(mysqli_error($link));
echo 1;
}
else
{

$q = mysqli_query($link,"insert into draw values (0,$userid,'$title','$content',NOW(),'$cat')")or die(mysqli_error($link));
echo 1;
}
?>