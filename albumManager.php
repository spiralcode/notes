<?php
include 'connect.php';
include 'session_check.php';
if(isset($_GET['create']))
{
    $albname=$_POST['albname'];
    $checkfor = ucfirst($albname);
    $query=mysqli_query($link,"select name from image_folders where name like '$checkfor' and userid = $userid") or die(mysqli_error($link));
    if(mysqli_num_rows($query)>0)
    {
        echo 0;
    }
    else {
         $query=mysqli_query($link,"insert into image_folders values ('$checkfor',$userid,0)") or die(mysqli_error($link));
    echo 1;
    }
}
if(isset($_GET['list']))
{
    class ob
    {
        public $id=0;
        public $name='';
       function ob($id,$name){
           $this->id=$id;
           $this->name=$name;
    }
    };
    $list= array();
    $query=mysqli_query($link,"select name,id from image_folders where userid = $userid") or die(mysqli_error($link));
    while($data=  mysqli_fetch_array($query))    
    array_push($list,  new ob($data['id'],$data['name']) );
    echo json_encode($list);

    
}
?>
