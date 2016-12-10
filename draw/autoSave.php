<?php
session_start();
include "../connect.php";
$userid = $_SESSION['userid'];
$docId = $_POST['docId'];
$content = mysqli_real_escape_string($link,$_POST['content']);
$q = mysqli_query($link,"select docId from draw_draft where docId = $docId") or die(mysqli_error($link));
if(mysqli_num_rows($q)==0)
{
    $qq = mysqli_query($link,"insert into draw_draft values($docId,'$content',NOW())") or die(mysqli_error($link));
    echo 1;
}
else
{
        $qq = mysqli_query($link,"update draw_draft set content = '$content', date = now() where docId = $docId") or die(mysqli_error($link));
        echo 1;
}
?>