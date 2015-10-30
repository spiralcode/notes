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
 else {
$short_website=$website;    
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
color: #FFFFFF;font-family:Arial,Serif;
}
a:hover
{
  text-decoration:underline;
}
#heading
{
color: #366637;
font-size: 25px;
font-family: Arial,Serif;
text-align: center;
text-shadow: 0px 0px 1px slateblue;
margin: 1%;
}
.info
{

}
.info td
{
font-family: Arial,serif;
font-size: 14px;
color: #637A00;
}
.info td:nth-child(even)
{
    
}
.navigate_raw
{
	font-size:14px;
	color:#637A00;
	text-align:right;
        margin: 1%;
}
.divNavigate
{
height: 50px;
line-height: 50px;
font-size: 15px;
background: rgb(54, 66, 102);
text-align: right;
box-shadow: 1px 1px 1px rgb(47, 35, 35);
border-radius: 3px;
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
	<div class="divNavigate"><span class="navigate_raw"><a href="peoples.php">Back to peoples</a> | <a href="edit_person.php?pid=<?php echo $pid; ?>">Edit <b><?php echo  ucfirst( $name); ?></b> 's data</a> | <a href="delete_person_warn.php?pid=<?php echo $pid; ?>&name=<?php echo  ucfirst( $name); ?>"> Delete <b><?php echo  ucfirst( $name); ?></b></a></span></div>
		<div id="heading"><?php echo ucfirst($name); ?></div>
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