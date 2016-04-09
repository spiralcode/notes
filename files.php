<?php
include 'connect.php';
include 'session_check.php';
include 'ease.php';
class oblink
{
            function oblink($id,$filename,$file_name,$folder,$time)
    {
        $this->id=$id;
        $this->filename=$filename;
        $this->file_name=$file_name;
        $this->folder=$folder;
        $this->time=$time;
    }
};
$ob=array();
$counter=0;
$query=  mysqli_query($link, "select * from image where userid = $userid ORDER BY  time DESC ")or die(mysqli_error($link));
while($data=  mysqli_fetch_array($query))
{
    $id=$data['id'];
    $filename=$data['filename'];
    $file_name=$data['file_name'];
    $folder=$data['group_id'];
    $time= $data['time'];
    $ob[$counter]=new oblink($id, $filename,$file_name,$folder,$time);
$counter++;
}
echo json_encode($ob);
?>
