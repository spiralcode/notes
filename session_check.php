<?php
session_start();
if(!isset($_SESSION['userid']))
{
header('location: index.php');
}
else 
{
	$userid=$_SESSION['userid'];
}
?>