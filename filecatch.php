<?php
include 'session_check.php';
include('connect.php');
$nid=$_POST['nid'];
$target_dir='media/';
if(file_exists($target_dir)==0)
{
	$oldmask = umask(0);
	mkdir($target_dir,0777);
	umask($oldmask);
}
$rand=md5(rand(1, 50000));
$name = $_FILES["file"]["name"];
$ext = end((explode(".", $_FILES["file"]["name"]))); # extra () to prevent notice
$target_file = $target_dir . $rand.md5(basename($_FILES["file"]["name"])).".".$ext;
$justname=$rand.md5(basename($_FILES["file"]["name"])).".".$ext;
move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);
$query=mysqli_query($link, "insert into image values (0,$userid,$nid,'$justname')")or die(mysqli_error($link));
echo "1";