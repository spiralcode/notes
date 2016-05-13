<?php
include 'connect.php';
include 'session_check.php';

class feeds
{
    var $notes =  Array();
   public function setvalues($a)
{
$this->notes=$a;	
}
};
//check for notes of today and tomorrow added days at a before date
$notesStock = [];
date_default_timezone_set('Asia/Calcutta');
$today = date('y-m-d');
//$reTime = 
$tommo = date('y-m-d',  strtotime('+1 day'));
$run = mysqli_query($conn, "select * from events where userid = $userid and ((DATE(ftime) = '$today'  ) or DATE(ftime)='$tommo')")or die(mysqli_error($conn));
while($data=mysqli_fetch_array($run))
{
if(gmdate('d',  strtotime($data['ftime']))==gmdate('d',  strtotime('today')))
{
if(gmdate('d',  strtotime($data['ftime']))>gmdate('d',  $data['time']))
{
        array_push($notesStock,  $data['content'],$data['ftime']);
}
}
else
    array_push($notesStock,  $data['content'],$data['ftime']);
}
$feed = new feeds();
$feed->notes=$notesStock;
echo json_encode($feed);
?>
