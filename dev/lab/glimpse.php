<?php
header('content-type: text/event-stream');
$username="Raj";
$time= time();
$fact = rand(1,25 );
if($time%$fact==0)
{
    echo "data: How you doing, ".$username." \n\n";
}
 else {
    echo "data: Good Morning \n\n";
}
?>
