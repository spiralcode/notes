<?php
session_start();
include 'connect.php';
date_default_timezone_set('Asia/Calcutta');
$userid=$_SESSION['userid'];

$eachnote=array();
$imgs=array();
$index=0;

if(isset($_GET['date']))
{
	$in_date=$_GET['date'];
	$indianDate = date("y-m-d", strtotime($in_date));
	
	$query=mysqli_query($link,"select * from events where DATE(ftime) = '$indianDate'" )or die(mysqli_error($link));
}
else
{
$query=mysqli_query($link,"select * from events where DATE(ftime) = CURRENT_DATE()" )or die(mysqli_error($link));
}
if(mysqli_num_rows($query)==0)
{
	$status=0;
	$eachnote[0]=array("status"=>"0");
}
else 
{	
}
//Note Feeding stuffs begin here....


while($data=mysqli_fetch_array($query))
{
	$status=1;
	
$imindex=0;
$nid=$data['id'];
$loadimage='';
$query2=mysqli_query($link, "select id from image where noteid = $nid and userid = $userid")or die(mysqli_error($link));
{
while($row=mysqli_fetch_array($query2))
{
$fileid=$row['id'];
$imgs[$imindex++]=$fileid;
}
}
$content=$data['content'];
$time=$data['time'];
$geo=$data['setglocation'];
$ftime=$data['ftime'];
$ilist=$loadimage;
$eachnote[$index++]=array("status"=>"$status","content"=>"$content","time"=>"$time","geo"=>"$geo","ilist"=>array($imgs),"ftime"=>"$ftime");
$imindex=0;
$imgs='';
	/*echo "<tr><td><img src = \"https://maps.googleapis.com/maps/api/staticmap?center=".$data['setglocation']."&zoom=15&size=100x100&maptype=roadmap&markers=color:blue%7Clabel:S%7C40.702147,-74.015794&markers=color:green%7Clabel:G%7C40.711614,-74.012318&markers=color:red%7Clabel:C%7C40.718217,-73.998284\"</td><td><div class=\"resulttext\"><p>".$data['content']."</p><div class=\"time\">".gmdate('d/m/y , h:i:s A',$data['time']+19800)."</div></div></td>
	<td class=\"thumbspace\">$loadimage</td></tr>";*/
}
$json=json_encode($eachnote);
echo($json);
?>
