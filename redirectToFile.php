<?php
    session_start();
include 'connect.php';
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
//$query=mysqli_query($link,"select * from image where id = $pid and userid = $userid")or die(mysqli_error($link));
$query=mysqli_query($link,"select * from image where id = $pid ")or die(mysqli_error($link));
	while($data=mysqli_fetch_array($query))
        {
            $visibility = $data['visibility'];
            $filename=$data['filename'];
            $user = $data['userid'];
        }
$file = $target_dir.$filename;
if($visibility=='p')
{
    if(!isset($_SESSION['userid']))
    $viewCount =  mysqli_query($conn,"update image set p_view = p_view+1 where id = $pid") or die(mysqli_error($conn));
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
}
else if(isset($_SESSION['userid']))
{

    if($user==$_SESSION['userid']){
    $viewCount =  mysqli_query($conn,"update image set me_view = me_view+1 where id = $pid") or die(mysqli_error($conn));
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
}
}
else
{
    
}


// header('Location: '.$file);


?>