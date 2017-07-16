<?php
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

//$the = mysqli_query($link,$query)or die(mysqli_error($link));


//$query5=mysqli_query($link, $query)or die(mysqli_error($link));
$count = 0;

$result = $this->mysqli->query($query);

while($row=$result->fetch_array(MYSQLI_NUM))
{
$count++;
		$a = new ind();
		$a->setTitle($data['title']);
		$a->setId($data['id']);
		array_push($resultArray,$a);
}


/*	while($data=mysqli_fetch_array($query5))
	{
		$count++;
		$a = new ind();
		$a->setTitle($data['title']);
		$a->setId($data['id']);
		array_push($resultArray,$a);

	}*/
	if($count!=0)
	{
	echo json_encode($resultArray);
}
	else
	{echo "0";}


?>
