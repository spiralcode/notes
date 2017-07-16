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



/*
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



*/


$host = "127.10.171.2:3306";
$userr = "adminz8hImgI";
$passw = 'rUP7aW8my2r6';
$db = 'note';

// Create connection
$conn = new mysqli($host, $usser, $passw, $db);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT * from follow_profiles";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"];
    }
} else {
    echo "0 results";
}
$conn->close();















?>
