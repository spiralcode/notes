<?php
include 'session_check.php';
include 'connect.php';
error_reporting(E_ERROR | E_PARSE);

$id = $_GET['id'];
$query2=mysqli_query($link, "select * from image where id = $id")or die(mysqli_error($link));
{
	$imindex=0;
while($row=mysqli_fetch_array($query2))
{
$fileid=$row['id'];
$realFileName = $row['file_name'];
$root = $row['filename'];
}
}
if($_SERVER['HTTP_HOST']!='localhost')
{
$target_dir="/var/lib/openshift/55a2abe1500446b24a00023d/app-root/data/";	
}   
else
{
$target_dir="media/";	
}
$size=filesize($target_dir.$root);
$img[0]=array("id"=>"$fileid","realFileName"=>"$realFileName","root"=>"$root","size" => "$size");
echo json_encode($img);
?>

