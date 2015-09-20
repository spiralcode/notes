<?php
include 'connect.php';
include 'session_check.php';
$query = mysqli_query($link, "select id,name from image_folders where userid = $userid")or die(mysqli_error($link));

class image
{
public $id=0;
public $name='';
public $count=0;
function image($id,$noteid,$count)
{
    $this->id=$id;
    $this->name=$noteid;
    $this->count=$count;

}
};
$albms=array();
$counter=1;
        $query1 = mysqli_query($link, "select id from image where group_id = 0 and userid=$userid")or die(mysqli_error($link));

        $albms[0]=new image(0,"Attachements",  mysqli_num_rows($query1));

    while($row=mysqli_fetch_array($query))
    {
        $id=$row['id'];
        $query1 = mysqli_query($link, "select id from image where group_id = $id and userid = $userid")or die(mysqli_error($link));
        $count = mysqli_num_rows($query1);
        $name=$row['name'];
        $albms[$counter++]=new image($id,$name,$count);
    }
    echo json_encode($albms);
    ?>