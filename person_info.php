<?php
	include 'session_check.php';
	include 'connect.php';
	include 'ease.php';
	$pid=get('pid');
        $imagery = mysqli_query($link,"select id from image where people like '%$pid%' and userid= $userid ") or die(mysqli_error($link));
        while($row=  mysqli_fetch_array($imagery))
        {
           $Imagelinkid= $row['id'];
           $Imagelink='<img src = "image.php?thumb&size=200x200&id='.$Imagelinkid.'">';

}
if(mysqli_num_rows($imagery)==0)
{
    $Imagelink='<img src="data:image/png;base64,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" width="200px" height="200px"/>';
}
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
font-family:Arial,Serif;
text-decoration: none;
}
a:hover
{
  text-decoration:underline;
}
#heading
{
color: #366637;
font-size: 50px;
text-shadow: 0px 0px 1px rgb(206, 198, 213);
margin: 1%;
color: rgba(5, 39, 22, 0.57);
font-family: "Segoe UI Light",arial,serif;
}
.info
{
min-width: 300px;
background: rgb(237, 237, 237);height: 200px;
border-radius: 1px;
box-shadow: 0px 0px 5px rgb(54, 66, 102);
margin-left: 30%;
}
.info td
{
font-family: Arial,serif;
font-size: 15px;
color: #092002;
text-shadow: 0px 0px 1px snow;
font-family: "Segoe UI Light",arial,serif;
}
.info td:nth-child(even)
{
font-size: 14px;
color: rgb(121, 111, 39);
font-weight: bold;
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
background: rgba(94, 100, 116, 0.78);text-align: right;
border-radius: 2px;
color: #FFFFFF;
}
.personImage
{
    max-width: 200px;;
    max-height:200px;
    box-shadow: 1px 0px 5px rgb(54, 66, 102);

}
.infoContainer
{
    position: relative;
    width: 90%;
    margin-left:10%;
}
.infoContainer div
{
    position: relative;
    float: left;
    margin: 10px;
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
	<div class="divNavigate"><span class="navigate_raw"><a href="peoples.php">Back to peoples</a>  | <a href="delete_person_warn.php?pid=<?php echo $pid; ?>&name=<?php echo  ucfirst( $name); ?>"> Delete <b><?php echo  ucfirst( $name); ?></b></a></span></div>
		<div id="heading"><?php echo ucfirst($name); ?></div>
             <div class="infoContainer">   <div class="personImage">
                    <?php echo $Imagelink; ?>
                     </div>
		<div align="center" class="info">
		<table height="100%" width="100%" border="0" cellspacing="10">
                    <tr><td colspan="2" align="right"><a href="edit_person.php?pid=<?php echo $pid; ?>">Edit Info.</a></td></tr>
			<tr><td>Birth on </td><td><?php riskdata($dob); ?></td></tr>
			<tr><td>Phone</td><td><?php riskdata($phone); ?></td></tr>
			<tr><td>E-Mail</td><td><?php riskdata($email); ?></td></tr>
			<tr><td>Website</td><td><?php 
				if($website!=NULL
                                        )
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
		</div></div>
</body>
</html>