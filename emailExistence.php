<?php
	include 'connect.php';
	$email=$_POST['email'];
	echo $email;
	$q = "select email from where userbase where email = '$email' ";
	$result = mysqli_query($conn,$q);
	if(mysqli_num_rows($result)>0)
		echo 1;
		else
		echo 0;
		
	?>