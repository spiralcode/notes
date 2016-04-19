<?php
	include 'connect.php';
	$id= $_GET['id'];
	$q = mysqli_query($conn,"select visibility from image where id = $id ")or die(mysqli_error($conn));
	while($r=mysqli_fetch_array($q))
	{
		$cV = $r['visibility'];
	}
	if($cV=='p')
	$tG = 'me';
	else
	$tG = 'p';
			$query = mysqli_query($conn,"update image set visibility ='$tG' where id = $id  ")or die(mysqli_error($conn));
			echo $tG;
	?>