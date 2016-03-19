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
	$query=mysqli_query($link,"select * from events where DATE(ftime) = '$indianDate' and userid = $userid" )or die(mysqli_error($link));
}
else
{
$query=mysqli_query($link,"select * from events where DATE(ftime) = CURRENT_DATE() and userid = $userid" )or die(mysqli_error($link));
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
$eachnote[$index++]=array("status"=>"$status","noteid"=>"$nid","content"=>"$content","time"=>"$time","geo"=>"$geo","ilist"=>array($imgs),"ftime"=>"$ftime");
$imindex=0;
$imgs='';
}
$json=json_encode($eachnote);
echo($json);
?>
