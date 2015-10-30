<?php
	include 'session_check.php';
	include 'connect.php';
	include 'ease.php';

$email = post('email');
$dob = post('dob');
$rel = post('rel');
$name=post('name');
$url = post('url');
$geoloc = post('geoloc');
$phone = post('phone');
$pid = post('pid');
$gender = post('gender');
$query = mysqli_query($link,"update peoples set 
	relation = '$rel', 
	email = '$email',
	 website = '$url', 
	 homelocation = '$geoloc', 
	 phone = '$phone' ,
	 dob = '$dob',
	 gender =  '$gender ', name = '$name' 
	   where id = $pid ") or die(mysqli_error($conn));
	  echo "1";
	?>