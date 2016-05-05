<?php
include "connect.php";
include "session_check.php";
$list = array();
$query = "select  setglocation from events where userid = $userid";
$run = mysqli_query($conn,$query) or die(mysqli_error($conn));
$ind = 0;
while($data=mysqli_fetch_array($run))
{
	if( $data['setglocation']!='0,0'&& $data['setglocation']!='0')
	$list[$ind++]=$data['setglocation'];
	//array_push($list, $data['setglocation']);
}
$list=array_unique($list);
echo json_encode($list);
?>