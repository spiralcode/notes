<?php
include "connect.php";
include "session_check.php";
$list = array();
$query = "select  setglocation from events where userid = $userid";
$run = mysqli_query($conn,$query) or die(mysqli_error($conn));
while($data=mysqli_fetch_array($run))
{
	if($data['setglocation']!='0,0');
	array_push($list, round($data['setglocation'],2));
}
array_unique($list);
echo json_encode($list);
?>