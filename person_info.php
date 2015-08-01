<?php
	include 'session_check.php';
	include 'connect.php';
	include 'ease.php';
	$pid=get('pid');
	$query=mysqli_query($link,"select * from peoples where id = $pid ") or die(mysqli_error($link));
	while($data=mysqli_fetch_array($query))
	{
		$name=$data['name'];
		$relation = $data['relation'];
		$email=$data['email'];
		$website=$data['website'];
		$dob=$data['dob'];
		$phone=$data['phone'];
		$geoloc=$data['homelocation'];
	}
if(strlen($website)>40)
{
	$short_website=substr($website,0,40)."...";
}
	?>
<html>
	<head>
		<script src="ajax_1_10_2.js"></script>
		<script>
			function goTopage(ob,target)
{
	window.location.href=ob.dataset.link;
}
</script>
<style>
.spinner {
 display:none;
z-index:101;
  width: 40px;
  height: 40px;
  margin: 100px auto;
  background-color: #0f0;

  border-radius: 100%;  
  -webkit-animation: sk-scaleout 1.0s infinite ease-in-out;
  animation: sk-scaleout 1.0s infinite ease-in-out;
}

@-webkit-keyframes sk-scaleout {
  0% { -webkit-transform: scale(0) }
  100% {
    -webkit-transform: scale(3.0);
    opacity: 0;
  }
}

@keyframes sk-scaleout {
  0% { 
    -webkit-transform: scale(0);
    transform: scale(0);
  } 100% {
    -webkit-transform: scale(3.0);
    transform: scale(1.0);
    opacity: 0;
  }
}

a
{
 text-decoration:none;
 color: #A384BD;
font-family:Arial,Serif;
}
a:hover
{
  text-decoration:underline;
}
#heading
{
	color:#ED9450;
	font-size:25px;
	font-family:Arial,Serif;
	text-align:center;
}
.info
{
	font-family:Arial,serif;
	font-size:12px;
	color:#637A00;
}
.info td
{
	font-family:Arial,serif;
	font-size:14px;
	color:#637A00;
}
.navigate_raw
{
	font-size:14px;
	color:#637A00;
	text-align:right;
}

</style>
<script>
function $id(ob)
{
	return document.getElementById(ob);
}

  </script>
		</head>
<body>
	<span class="navigate_raw"><a href="peoples.php">Back to peoples</a> | <a href="edit_person.php?pid=<?php echo $pid; ?>"> Add or Edit <b><?php echo  ucfirst( $name); ?></b> 's data</a></span>
		<br>
		<div id="heading"><?php echo ucfirst($name); ?></div><br><br>		<br>
		<div align="center" class="info">
		<table border="0" cellspacing="10">
			<tr><td>Birth on </td><td><?php riskdata($dob); ?></td></tr>
			<tr><td>Phone</td><td><?php riskdata($phone); ?></td></tr>
			<tr><td>E-Mail</td><td><?php riskdata($email); ?></td></tr>
			<tr><td>Website</td><td><?php 
				if($website!='')
				{
					echo '<a target="_new" href= " '.$website.'">'.$short_website.'</a>';
				}
				else
				{
					echo "<i>not available</i>";
				}
				 ?>
				
				</td></tr>
			</table>
		</div>
</body>
</html>