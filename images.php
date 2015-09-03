<?php
include 'connect.php';
include 'session_check.php';
$query = mysqli_query($link, "select id,noteid from image where userid = $userid")or die(mysqli_error($link));

class image
{
public $id=0;
public $noteid=0;
function image($id,$noteid)
{
    $this->id=$id;
    $this->noteid=$noteid;
}
};
$imgs=array();
$counter=0;
    $row_count=0;
    while($row=mysqli_fetch_array($query))
    {
                $id=$row['id'];
        $noteid=$row['noteid'];
        $imgs[$counter++]=new image($id,$noteid);
    }
    echo json_encode($imgs);
    ?>