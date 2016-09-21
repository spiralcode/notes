<?php
include 'ease.php';
include 'connect.php';
//Fetch all variables
$email=post('email');
$name=post('name');
$pass=post('password');
if(isset($email,$name,$pass))
{
	mysqli_query($link, "insert into userbase values(0,'$name','$email','$pass',NOW(),0,0)")or die(mysqli_error($link));
	echo 1;
}
else
{
	echo "0";
}
?>