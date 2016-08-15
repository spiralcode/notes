<?php
$subject = "9497336650 is my number";
preg_match_all("/[^0-9]/i",$subject,$list);
foreach($list[0] as $ele)
{
    echo $ele."<br>";
}
?>