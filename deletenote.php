<?php
	include 'session_check.php';
	include 'connect.php';
	include 'ease.php';
	$noteid=post('id');
	$query=mysqli_query($link,"delete from events where id = $noteid")or die(mysqli_error($link));
	$query=mysqli_query($link,"select * from image where noteid = $noteid")or die(mysqli_error($link));
	while($data=mysqli_fetch_array($query))
	{
		$filename=$data['filename'];
		unlink('media/'.$filename);
	}
	$query=mysqli_query($link,"delete from image where noteid = $noteid")or die(mysqli_error($link));
	echo 1;
	?>