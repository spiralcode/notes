<?php
include 'connect.php';

$userid = $_POST['userid'];
$pass = $_POST['pass'];

class user{
	var $title;
	var $id;
	function setTitle($title)
	{
		$this->title=$title;
		
	}
 function setId($id)
	{
		$this->id=$id;
		
	}
	
	}


$resultArray = array();

$query = "select * from follow_profiles where userid = '$userid' and password = '$pass'";

$qq = mysqli_query($link,$query)or die(mysqli_error($link));
$count = 0;
	while($data=mysqli_fetch_array($qq))
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
