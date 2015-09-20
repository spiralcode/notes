<?php
include 'connect.php';
include 'session_check.php';
$query = mysqli_query($link, "select id,name from image_folders where userid = $userid")or die(mysqli_error($link));

class image
{
public $id=0;
public $name='';
function image($id,$noteid)
{
    $this->id=$id;
    $this->name=$noteid;
}
};
$albms=array();
$counter=1;
        $albms[0]=new image(0,"Attachements");

    while($row=mysqli_fetch_array($query))
    {
                $id=$row['id'];
        $name=$row['name'];
        $albms[$counter++]=new image($id,$name);
    }
    echo json_encode($albms);
    ?>