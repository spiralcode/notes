<?php
include('ease.php');
include('connect.php');
$id = get('id');
$query=mysqli_query($link,"select * from image where id = $id") or die(mysqli_error($link));
while($data=  mysqli_fetch_array($query))
{
    $imgloc=$data['filename'];
}
echo "<img src = \"$imgloc\"/>";
?>
