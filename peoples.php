<?php
	include 'session_check.php';
	include 'connect.php';
	$query=mysqli_query($link,"select * from peoples where userid = $userid order by name asc") or die(mysqli_error($link));
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
.bigoptions
{
  position:absolute;
  width:100%;
  text-align:center;
  top:40px;
}
.bigoptions span
{
  font-family:Arial,serif;
  font-size:20px;
  color: #A384BD;
  margin:2%;
 min-width:60px;
 min-height:20px;
}
a
{
  text-decoration:none;
    color: #A384BD;
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
td
{
		font-family:Arial,Serif;
		color:#50A9ED;
		font-size:20px;
}
td:hover
{
text-shadow:1px 1px 1px #093658;
cursor:pointer;
}
.result
{
	width:90%;
	font-size:18px;
	background-image:url(images/tile6.png);
	margin-left:5%;
	margin-top:2px;
	font-family:arial,serif;
	color:white;
	border-radius:2px;

		border:1px solid #fff;
}
.result:hover
{
	border:1px solid #C98078;
}
.result button
{
	position:absolute;
	right:5px;
	min-width:5px;
	min-height:5px;
	color:green;
	cursor:pointer;
}
.peoplelist 
{
position:relative;

}
.peoplelist td
{
width: 20px;
height:20px;
background:#4B63E7;
color:white;
text-align:center;
border:1px solid #fff;
}
.peoplelist td:hover
{
	border:1px solid #C98078;
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
	<script>
		</script>
		<div id="heading">Peoples</div>
	<div style="height:100%">
		<table id="peoplelist" cellspacing="2px" cellpadding="10" width="100%" height="50%" class="peoplelist">
			<?php
			$counter=0;
			echo "<tr>";
			while($row=mysqli_fetch_array($query))
			{
				$pid = $row['id'];
	
				echo "<td data-link=\"person_info.php?pid=".$pid."\" onclick = \"goTopage(this)\">".ucfirst($row['name'])."</td>";

				$counter++;
									if($counter%3==0)
				{
					echo "</tr><tr>";
				}
			}
				?>
				</tr>
			</table>
		</div>
</body>
</html>