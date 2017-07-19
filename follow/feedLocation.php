<?php
error_reporting(-1);

include 'connect.php';

$host = "127.10.171.2:3306";
$userr = "adminz8hImgI";
$passw = 'rUP7aW8my2r6';
$db = 'note';

//Date Creation
date_default_timezone_set('Asia/Calcutta');
$datum = new DateTime();
$feedDate = $datum->format('d-m-Y H:i:s');



// Create connection
$conn = new mysqli($host, $userr, $passw, $db);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 





$id = $_POST['id'];
$coords = mysqli_real_escape_string($conn,$_POST['coords']);
$speed = mysqli_real_escape_string($conn,$_POST['speed']);
$accuracy = mysqli_real_escape_string($conn,$_POST['accuracy']);
//$speed=$speed;
$accuracy=round($accuracy);


$sql = "update follow_coords set coords = '$coords', speed = $speed, accuracy = $accuracy,time='$feedDate' where id = $id  ";

echo $speed;

$result = $conn->query($sql);
if($result)
{
echo "Success";
}


$conn->close();















?>
