<?php
include '../connect.php';
$result= array();
$query = mysqli_query($conn,"select * from todo where userid = 0") or die(mysqli_error($conn));
while($data=mysqli_fetch_array($query))
{
    array_push($result,$data);
}
echo json_encode($result);
?>