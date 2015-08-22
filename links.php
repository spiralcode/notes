<?php
include 'connect.php';
include 'session_check.php';
include 'ease.php';
error_reporting(0);


$limit=  explode(",", get('limit'));
$count=$limit[0];
$offset=$limit[1];
class oblink
{
    public $id = 0;
    public $url='';
    function oblink($id,$url)
    {
        $this->id=$id;
        $this->url=$url;
    }
};
$ob[]=new oblink();
$counter=0;
$query=  mysqli_query($link, "select * from url where userid = $userid limit $count offset $offset")or die(mysqli_error($link));
while($data=  mysqli_fetch_array($query))
{
    $id=$data['id'];
    $url=$data['url'];
    $ob[$counter]=new oblink($id, $url);
$counter++;
}
echo json_encode($ob);
?>
