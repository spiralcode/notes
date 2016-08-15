<?php
include 'session_check.php';
include('connect.php');
$id=$_GET['id'];
$query=mysqli_query($link, "select filename from image where id=$id and userid = $userid")or die(mysqli_error($link));
while($data=mysqli_fetch_array($query))
{
	$fname=$data['filename'];
	if($_SERVER['HTTP_HOST']!='localhost')
{
$target_dir="/var/lib/openshift/55a2abe1500446b24a00023d/app-root/data/";	
}   
else
{
$target_dir="media/";	
}
	if(isset($_GET['thumb']))
	{
		$ext=explode(".",basename($fname));
		$extension=$ext[1];
		$size=$_GET['size'];	
		$filename = $target_dir.$fname;
		$percent = 0.5;
		list($width, $height) = getimagesize($filename);
		$sizes=explode("x", $size);
		$newwidth=$sizes[0];
		$newheight=$sizes[1];
		$thumb = imagecreatetruecolor($newwidth, $newheight);
		if($extension=='JPG'||$extension=='jpeg'||$extension=='jpg'){
                                    $source = imagecreatefromjpeg($filename);
		header('Content-Type: image/jpeg');		
		}
		if($extension=='png'||$extension=='png'){
		$source = imagecreatefrompng($filename);	
		header('Content-Type: image/png');
		}
		imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
		imagejpeg($thumb);
	}
        elseif(isset ($_GET['resize']))
        {
                                    $ext=explode(".",basename($fname));
		$extension=$ext[1];
                                    $factor=$_GET['factor'];
		$filename = $target_dir.$fname;
		list($width, $height) = getimagesize($filename);
		/*$newwidth = $width * $percent;
		$newheight = $height * $percent;
		*/
		$newwidth=($width/100)*$factor;
		$newheight=($height/100)*$factor;
		$thumb = imagecreatetruecolor($newwidth, $newheight);
		if($extension=='JPG'||$extension=='jpeg'||$extension=='jpg'){
		$source = imagecreatefromjpeg($filename);
		header('Content-Type: image/jpeg');		
		}
		if($extension=='png'||$extension=='png'){
		$source = imagecreatefrompng($filename);			
		header('Content-Type: image/png');
		}
		imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
		imagejpeg($thumb);
        }
	else 
	{
	$ext=explode(".",basename($fname));
		$extension=$ext[1];
		$filename = $target_dir.$fname;

		list($width, $height) = getimagesize($filename);
				
		// Load
		$thumb = imagecreatetruecolor($width, $height);
		
		if($extension=='JPG'||$extension=='jpeg'||$extension=='jpg'){
			$source = imagecreatefromjpeg($filename);
			header('Content-Type: image/jpeg');
				
		}
		
		if($extension=='png'){
			$source = imagecreatefrompng($filename);
			header('Content-Type: image/png');
		}
		
		// Resize
		imagecopyresized($thumb, $source, 0, 0, 0, 0, $width, $height, $width, $height);
		
		// Output
		imagejpeg($thumb);
	}
}
