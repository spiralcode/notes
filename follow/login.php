<?php
include 'connect.php';

$userid = $_POST['userid'];
$pass = $_POST['pass'];

class user{
	public $title;
	public $id;
	public function setTitle($title)
	{
		$this->title=$title;
		
	}
 public function setId($id)
	{
		$this->id=$id;
		
	}
	
	}


$resultArray = array();

$query = "select * from follow_profiles where userid = '$userid' and password = '$pass'";

$the = mysqli_query($link,$query);
$count = 0;
	while($data=mysqli_fetch_array($the))
	{
		$count++;
		$a = new user();
		$a->setTitle($data['title']);
		$a->setId($data['id']);
		array_push($resultArray,$a);

	}
	if($count!=0)
	{
	echo json_encode($resultArray);
}
	else
	{echo "0";}


?>
