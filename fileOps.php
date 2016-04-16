<?php
	include 'connect.php';
	$id= $_GET['id'];
	if(isset($_GET['rename']))
		{
			$rename = $_POST['newName'];
			$query = mysqli_query($conn,"update image set file_name =' $rename' where id = $id  ")or die(mysqli_error($conn));
		}
	?>