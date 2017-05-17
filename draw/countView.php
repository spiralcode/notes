<?php
session_start();
include '../connect.php';
$q = mysqli_query($link,"select * from draw_view_count ") or die(mysqli_error($link));
$ip = "";
while($r=mysqli_fetch_array($q))
{
    $loop = $r['count'];
    $did = $r['id'];
for($a = 0;$a<$loop;$a++)
{
$q = mysqli_query($link,"insert into view_count values ($did,'$ip',now()");
}
}
?>