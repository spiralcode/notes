<?php
	include 'connect.php';
	$email=$_POST['email'];
	$q = "select email from userbase where email like '$email' ";
	$result = mysqli_query($conn,$q);
	if(mysqli_num_rows($result)>0)
		echo 1;
		else
		echo 0;
	?>