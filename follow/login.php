<?php
include 'connect.php';
$userid = mysqli_real_escape_string($_POST['userid'],$link);
$pass = mysqli_real_escape_string($_POST['pass'],$link);

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


$resultArray = new array();



$q = mysqli_query($link,"select * from follow_profiles where userid = $userid and password = $pass" ) or die(mysqli_error($link));
if(mysqli_num_rows($link,$q)==0)
{
echo "0";	
}
else
{
	while($data=mysqli_fetch_array($q))
	{
		user a = new user();
		a.setTitle($data['title']);
		a.setId($data['id']);
	}
	
	array_push($resultArray,$a);
	echo json_encode($resultArray);
}



?>
