<?php
include '../connect.php';
//session_start();
$qq = mysqli_query($link,"select * from draw_view_count ") or die(mysqli_error($link));
$ip = "";
$act=0;
while($r = mysqli_fetch_array($qq))
{
    $loop = $r['count'];
    $did = $r['id'];
for($a = 0;$a<$loop;$a++)
{
    echo "Activity : ".$act."\n";
mysqli_query($link,"insert into view_count values ($did,'$ip',now())") or die (mysqli_error($link));
}
}
?>