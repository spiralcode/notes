<?php
include 'connect.php';
session_start();
if(isset($_GET['cook']))
{
 $email=$_COOKIE['email'];
$pass=$_COOKIE['pass'];   
$cookie='true';
}
else
{
$email=$_POST['email'];
$pass=$_POST['pass'];
$cookie=$_POST['cook'];
}
$query=mysqli_query($link, "select * from userbase where email = '$email' and password = '$pass'")or die(mysqli_error($link));
if(mysqli_num_rows($query)==0)
{
echo "0";
}
else
{
while($row=mysqli_fetch_array($query))
{
            if($cookie=='true')
            {
                setcookie("email",$email,time() + (86400 * 30), "/");
                setcookie("pass",$pass,time() + (86400 * 30), "/");

            }
		$_SESSION['userid']=$row['id'];
		echo "1";
	}
}
?>