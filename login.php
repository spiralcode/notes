<?php
include 'connect.php';
session_start();
$email=$_POST['email'];
$pass=$_POST['pass'];

$query=mysqli_query($link, "select * from userbase where email = '$email' and password = '$pass'")or die(mysqli_error($link));
if(mysqli_num_rows($query)==0)
{
	echo "0";
}
else
{
	while($row=mysqli_fetch_array($query))
	{
		$_SESSION['userid']=$row['id'];
		echo "1";
	}
}
?>