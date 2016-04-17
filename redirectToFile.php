<?php
include 'connect.php';
include 'session_check.php';
include 'ease.php';
include 'elements.php';
if($_SERVER['HTTP_HOST']!='localhost')
{
$target_dir=$_ENV['OPENSHIFT_DATA_DIR']."/";
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
        }
$file = $target_dir.$filename;

set_time_limit(0);
$filePath = $file;
$strContext=stream_context_create(
    array(
        'http'=>array(
        'method'=>'GET',
        'header'=>"Accept-language: en\r\n"
        )
    )
);
$fpOrigin=fopen($filePath, 'rb', false, $strContext);
header('Content-Disposition: inline; filename="'.$filename.'"');
header('Pragma: no-cache');
//header('Content-type: '+mime_content_type($file));
header('Content-type: '.mimeType($filename));
header('Content-Length: '.filesize($filePath));
while(!feof($fpOrigin)){
  $buffer=fread($fpOrigin, 4096);
  echo $buffer;
  flush();
}
fclose($fpOrigin);



// header('Location: '.$file);


?>