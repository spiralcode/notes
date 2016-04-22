<?php
include 'connect.php';
include 'session_check.php';
include 'ease.php';
if($_SERVER['HTTP_HOST']!='localhost')
{
$target_dir="/var/lib/openshift/55a2abe1500446b24a00023d/app-root/data/";	
}   
else
{
$target_dir="media/";
}
$pid=  get('id');
$query=mysqli_query($link,"select * from image where id = $pid and userid = $userid")or die(mysqli_error($link));
	while($data=mysqli_fetch_array($query))
        {
            $filename=$data['filename'];
                        $realeFileName=$data['file_name'];
        }
$file = $target_dir.$filename;

if (file_exists($file)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.$realeFileName.'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    readfile($file);
    exit;
}
?>