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
echo $query;

$qq = mysqli_query($link,$query) or die(mysqli_error($link));
if(mysqli_num_rows($qq)==0)
{
echo "0";	
}
else
{
	while($data=mysqli_fetch_array($qq))
	{
		$a = new user();
		$a->setTitle($data['title']);
		$a->setId($data['id']);
		array_push($resultArray,$a);

	}
	
	echo json_encode($resultArray);

}

?>
