<?php
include '../connect.php';
include '../session_check.php';
$content=mysqli_real_escape_string($link,$_POST['content']);
$tY = $_POST['tY'];
$fY=$_POST['fY'];
if(isset($_GET['edit']))
{
$id=$_POST['id'];
$q = mysqli_query($link,"update draw set content = '$content',title = '$title', category = '$cat' where id = $id")or die(mysqli_error($link));
echo 1;
}
else
{

$q = mysqli_query($link,"insert into timeLineBC values (0,$userid,$fY,$tY,'$content')")or die(mysqli_error($link));
echo 1;
}
?>