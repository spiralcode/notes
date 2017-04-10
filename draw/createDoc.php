<?php
include '../connect.php';
include '../session_check.php';
$title=mysqli_real_escape_string($link,$_POST['title']);
$content="";
$cat=0;
$q = mysqli_query($link,"insert into draw values (0,$userid,'$title','$content',NOW(),'$cat')")or die(mysqli_error($link));
$qq = mysqli_query($link,"select id from draw where userid = $userid order by id desc limit 0,1 ")or die(mysqli_error($link));
while($re = mysqli_fetch_array($qq))
{
    $return = $re['id'];
}
echo $return;
?>