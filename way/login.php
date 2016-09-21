<?php
include 'connect.php';
session_start();
$exist=0;
$bis=0;
if(isset($_GET['cook']))
{
    //Detection of cookle existence
    //If cookie exist
$email= base64_decode($_COOKIE['p']);
$pass= base64_decode($_COOKIE['e']);   

}
else
{
    //Normal Login via post method
$email=$_POST['email'];
$pass=$_POST['pass'];
$cookie=$_POST['cook'];
if($cookie==1)
{
    $bis=1;
}
 else {
   $bis=0;
 }
}
//Query Part
$query=mysqli_query($link, "select * from userbase where email = '$email' and password = '$pass'")or die(mysqli_error($link));
if(mysqli_num_rows($query)==0)
{
echo "0";
}
else
{
    //Works if the count is 1 or greater
while($row=mysqli_fetch_array($query))
{
            $_SESSION['userid']=$row['id'];
            $_SESSION['uname']=$row['name'];
            $exist=1;
}}
if($exist==1)
{
      $userid=  $_SESSION['userid'];
            $query3=mysqli_query($link,"update userbase set login_count=login_count+1,last_login = NOW() where id =$userid") or die(mysqli_error($link));
            if(isset($_COOKIE['p']))
            {   $_SESSION['cook_log']=1;
                header('location: home.php');
            }
            else
            {
            if($bis==1)
{
    setcookie("p",base64_encode($email),time() + (86400 * 30), "/");
    setcookie("e",  base64_encode($pass),time() + (86400 * 30), "/");
}
$_SESSION['cook_log']=0;
            echo "1";
}
}
?>