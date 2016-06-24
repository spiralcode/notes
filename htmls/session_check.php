<?php
session_start();
if(!isset($_SESSION['userid']))
{
header('location: index.php?logreq');
}
else 
{
	$userid=$_SESSION['userid'];
    $name=$_SESSION['uname'];

}
?>