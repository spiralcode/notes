<?php
error_reporting(-1);

include 'connect.php';


class ind{
var $lat="";
var $lng="";
var $speed=0;
var $accuracy = 0;
var $timed ="";
	public function setLat($lat)
	{
		$this->lat=$lat;
		
	}
 public function setLng($lng)
	{
		$this->lng=$lng;
		
	}
		public function setSpeed($speed)
	{
		$this->speed=$speed;
		
	}
 public function setAccuracy($acc)
	{
		$this->accuracy=$acc;
		
	}
public function setTimedAt($end)
{
$this->timed=$end;
}	};

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

$id = mysqli_real_escape_string($conn,$_GET['id']);


$sql = "SELECT coords,speed,accuracy,time as timedat from follow_coords where id = 1";

$result = $conn->query($sql);
$count=0;

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
$count++;
$a = new ind();
$cp =explode(",",$row['coords']);
$a->setLat($cp[0]);
$a->setLng($cp[1]);
$a->setSpeed($row['speed']);
$a->setAccuracy($row['accuracy']);
$a->setTimedAt($row['timedat']);
array_push($resultArray,$a);
}
echo json_encode($resultArray);
} else {
    echo "0";
}
$conn->close();















?>
