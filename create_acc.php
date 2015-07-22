<?php
include 'ease.php';
include 'connect.php';
//Fetch all variables
$email=post('email');
$name=post('email');
$pass=post('password');
if(isset($email,$name,$pass))
{
	mysqli_query($link, "insert into userbase values(0,'$name','$email','$pass',current_date())")or die(mysqli_error($link));
	echo 1;
}
else
{
	echo "0";
}
?>