<?php
error_reporting(-1);

include 'connect.php';


class ind{
	var $lat="";
	var $lng="";
var $speed=0;
var $accuracy = 0;

	public function setLat($title)
	{
		$this->lat=$title;
		
	}
 public function setLong($id)
	{
		$this->long=$id;
		
	}
		public function setSpeed($title)
	{
		$this->speed=$title;
		
	}
 public function setAccuracy($id)
	{
		$this->accuracy=$id;
		
	}
	};

$resultArray = array();


$host = "127.10.171.2:3306";
$userr = "adminz8hImgI";
$passw = 'rUP7aW8my2r6';
$db = 'note';

// Create connection
$conn = new mysqli($host, $userr, $passw, $db);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$id = mysqli_real_escape_string($conn,
$_POST['id']);



$sql = "SELECT * from follow_profiles where id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
		
		$count++;
		$a = new ind();

$cp =explode(",",string);
$a.setLat($cp[0]);
$a.setLng($cp[1]);



		$a->setSpeed($row['speed']);
		$a->setAccuracy($row['accuracy']);
		array_push($resultArray,$a);
		    }
    echo json_encode($resultArray);
} else {
    echo "0";
}
$conn->close();















?>