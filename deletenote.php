<?php
	include 'session_check.php';
	include 'connect.php';
	include 'ease.php';
	$noteid=post('id');
        if($_SERVER['HTTP_HOST']!='localhost')
{
$target_dir="/var/lib/openshift/55a2abe1500446b24a00023d/app-root/data/";	
}   
else
{
$target_dir="media/";	
}
        
	$query=mysqli_query($link,"delete from events where id = $noteid")or die(mysqli_error($link));
	$query=mysqli_query($link,"select * from image where noteid = $noteid")or die(mysqli_error($link));
	while($data=mysqli_fetch_array($query))
	{
		$filename=$data['filename'];
		unlink($target_dir.$filename);
	}
	$query=mysqli_query($link,"delete from image where noteid = $noteid")or die(mysqli_error($link));
	echo 1;
	?>