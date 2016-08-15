<?php
	include 'session_check.php';
	include 'connect.php';
	include 'ease.php';
	$linkid=post('id');
	$query=mysqli_query($link,"delete from url where id = $linkid")or die(mysqli_error($link));
	echo 1;
	?>