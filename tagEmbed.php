<?php
include 'connect.php';
include 'session_check.php';
$pid = $_GET['iid'];
class person
{
    public $id = 0;
    public $name = ' ';
    public function person($id,$name)
    {
        $this->id=$id;
        $this->name=$name;
}
}
$pL = array();
if(isset($_GET['retrieve']))
{
    $query1=  mysqli_query($link, "select people from image where id = $pid and userid = $userid") or die(mysqli_error($link));
while($data=  mysqli_fetch_array($query1))
{
    $list= $data['people'];
}
$inter = json_decode($list);
foreach ($inter as $id)
{
    if($id!=0)
    {
    $query=  mysqli_query($link, "select name from peoples where id = $id and userid = $userid") or die(mysqli_error($link));
  while($row=  mysqli_fetch_array($query))
  {
      $name=$row['name'];
      $ob = new person($id,  ucfirst($name));  
      array_push($pL,$ob);
  }
    }
}
echo json_encode($pL);

}
 else {
$list=$_POST['list'];
$json = json_encode(array_unique(explode(",", $list)));
$query=  mysqli_query($link, "update image set people = '$json' where id = $pid and userid = $userid ") or die(mysqli_error($link));
echo "Done";
 }
?>
