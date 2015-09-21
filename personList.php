<?php
include 'connect.php';
include 'session_check.php';
$query=  mysqli_query($link, "select * from peoples where userid = $userid order by name ASC ")or  die(mysqli_error($link));
class person
{
  public $id=0;
  public $name='';
 function person($id,$name)
{
     $this->id=$id;
     $this->name=$name;
}
};
$persons=array();
$init=0;
while($data=  mysqli_fetch_array($query))
{
    $persons[$init++]=new person($data['id'],ucfirst($data['name']));
}
echo json_encode($persons);