<?php
include 'connect.php';
include 'session_check.php';
include 'ease.php';

$limit=  explode(",", get('limit'));
$count=$limit[0];
$offset=$limit[1];
class oblink
{
    public $id = 0;
    public $url='';
    public $title='';
    public $description='';
            function oblink($id,$url,$title,$desc)
    {
        $this->id=$id;
        $this->url=$url;
        $this->title=$title;
        $this->description=$desc;
    }
};
$ob=array();
$counter=0;
$query=  mysqli_query($link, "select * from url where userid = $userid ORDER BY  time DESC limit $count offset $offset ")or die(mysqli_error($link));
while($data=  mysqli_fetch_array($query))
{
    $id=$data['id'];
    $url=$data['url'];
    $title=$data['page_title'];
    $desc=$data['page_description'];

    $ob[$counter]=new oblink($id, $url,$title,$desc);
$counter++;
}
echo json_encode($ob);
?>
