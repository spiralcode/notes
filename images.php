<?php
include 'connect.php';
include 'session_check.php';
include 'ease.php';

$group = get('group');
$query = mysqli_query($link, "select * from image where userid = $userid  AND group_id = $group ")or die(mysqli_error($link));

class image
{
public $id=0;
public $noteid=0;
public $group=0;

function image($id,$noteid,$group)
{
    $this->id=$id;
    $this->noteid=$noteid;
        $this->group=$group;

}
};

$imgs=array();
$counter=0;
    while($row=mysqli_fetch_array($query))
    {
                $id=$row['id'];
        $noteid=$row['noteid'];
        $group=$row['group_id'];
        $imgs[$counter++]=new image($id,$noteid,$group);
    }
 
    echo json_encode($imgs);
    ?>