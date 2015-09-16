<?php
include 'session_check.php';
include 'connect.php';
include 'crawl/simple_html_dom.php';
date_default_timezone_set('Asia/Calcutta');

function getUrls($string) {
 $regex = '/https?\:\/\/[^\" ]+/i';
 preg_match_all($regex, $string, $matches);
 return ($matches[0]);
}

$content=$_POST['contents'];
$content=mysqli_real_escape_string($conn, $content);
$geo=$_POST['geolocation'];
$sgeo=$_POST['setglocation'];
$nid=$_POST['timeid'];
$time=time();
$datum = new DateTime();
if($_POST['alterDate']==0)
$startTime = $datum->format('Y-m-d H:i:s');
else
$startTime = $_POST['alterDate'];

$q1 = mysqli_query($link, "insert into events values ($nid,$userid,$time,'$content','$sgeo','$geo','$startTime')")or die(mysqli_error($link));
echo s1;
  echo str_repeat(' ',1024*64);
flush();
$urls=  getUrls(strip_tags($content));
foreach ($urls as $url)
{
    $html = file_get_html($url);
foreach($html->find('title') as $element) 
{
    $title=$element->plaintext;
    $title=mysqli_real_escape_string($conn, $title);

}
$desc_fb='';
foreach($html->find('meta') as $element) 
{
    $stuff=$element->name;
    if($stuff=='og:description')
    {
        $desc_fb=$element->content;
        $desc_fb=mysqli_real_escape_string($conn, $desc_fb);
        break;
    }
}
foreach($html->find('meta') as $element) 
{
    $stuff=$element->name;
    if($stuff=='description')
    {
        $desc_fb=$element->content;
        $desc_fb=mysqli_real_escape_string($conn, $desc_fb);
        break;
    }
}


    $q4=mysqli_query($link, "select url from url where url like '$url'")or die(mysqli_error($link));
   if(mysqli_num_rows($q4)==0)
   {
       $url=mysqli_real_escape_string($conn, $url);
       $time=time();
       mysqli_query($link, "insert into url values (0,'$url',$userid,'$title','$desc_fb',$time)")or die(mysqli_error($link));

   }
}
