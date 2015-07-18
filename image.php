<?php
session_start();
include('connect.php');
$id=$_GET['id'];
$userid=$_SESSION['userid'];
$query=mysqli_query($link, "select filename from image where id=$id and userid = $userid")or die(mysqli_error($link));
while($data=mysqli_fetch_array($query))
{
	$fname=$data['filename'];
	if(isset($_GET['thumb']))
	{
		$filename = 'media/'+$fname;
		$percent = 0.5;
		
		// Content type
		header('Content-Type: image/jpeg');
		
		// Get new dimensions
		list($width, $height) = getimagesize($filename);
		$new_width = $width * $percent;
		$new_height = $height * $percent;
		
		// Resample
		$image_p = imagecreatetruecolor($new_width, $new_height);
		$image = imagecreatefromjpeg($filename);
		imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
		
		// Output
		imagejpeg($image_p, null, 100);
	}
	else 
	{
	header('location: media/'.$fname);
	}
}
