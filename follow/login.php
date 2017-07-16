<?php
error_reporting(-1);

include 'connect.php';

$userid = $_POST['userid'];
$pass = $_POST['pass'];

class ind{
	var $title="";
	var $id="";
	public function setTitle($title)
	{
		$this->title=$title;
		
	}
 public function setId($id)
	{
		$this->id=$id;
		
	}
	
	};

$resultArray = array();




$query = "select * from follow_profiles where userid = '$userid' and password = '$pass'";
$host = "127.10.171.2:3306";
$userr = "adminz8hImgI";
$passw = 'rUP7aW8my2r6';
$db = 'note';
$conn = new mysqli($host,$userr,$passw);

$the = mysqli_query($conn,$query)or die(mysqli_error($conn));

$count = 0;
	while($data=mysqli_fetch_array($the))
	{
		$count++;
		$a = new ind();
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
