<?php
include 'connect.php';
$userid = mysqli_real_escape_string($_POST['userid'],$link)||"123";
$pass = mysqli_real_escape_string($_POST['pass'],$link)||"123";

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
	
	};


$resultArray = array();



$q = mysqli_query($link,"select * from follow_profiles where userid = $userid and password = $pass" ) or die(mysqli_error($link));
if(mysqli_num_rows($link,$q)==0)
{
echo "0";	
}
	while($data=mysqli_fetch_array($q))
	{
		$a = new user();
		$a.setTitle($data['title']);
		$a.setId($data['id']);
	}
	
	array_push($resultArray,$a);
	echo json_encode($resultArray);



?>
