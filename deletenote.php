<?php
	include 'session_check.php';
	include 'connect.php';
	include 'ease.php';
	$noteid=post('id');
	$query=mysqli_query($link,"delete from events where id = $noteid")or die(mysqli_error($link));
	$query=mysqli_query($link,"delete from image where noteid = $noteid")or die(mysqli_error($link));
	echo 1;
	?>