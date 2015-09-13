<?php
include 'session_check.php';
include('connect.php');
$nid=$_POST['nid'];
if($_SERVER['HTTP_HOST']!='localhost')
{
$target_dir="/var/lib/openshift/55a2abe1500446b24a00023d/app-root/data/";	
}   
else
{
$target_dir="media/";	
}

$rand=md5(rand(1, 50000));
$name = $_FILES["file"]["name"];
$ext = end((explode(".", $_FILES["file"]["name"]))); 
$target_file = $target_dir . $rand.md5(basename($_FILES["file"]["name"])).".".$ext;
$justname=$rand.md5(basename($_FILES["file"]["name"])).".".$ext;
move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);
$query=mysqli_query($link, "insert into image values (0,$userid,$nid,'$justname',CURRENT_TIMESTAMP())")or die(mysqli_error($link));
echo "1";