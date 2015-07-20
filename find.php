<?php
include 'session_check.php';
include 'connect.php';
date_default_timezone_set('Asia/Calcutta');
if(isset($_GET['date']))
{
	$in_date=$_GET['date'];
	$jsDateTS = strtotime(substr($in_date, 0,15));
	if ($jsDateTS !== false)
$in_date=date('Y-m-d',$jsDateTS);	
	$query=mysqli_query($link,"select * from events where DATE(ftime) = '$in_date'" )or die(mysqli_error($link));
}
else
{
$query=mysqli_query($link,"select * from events where DATE(ftime) = CURRENT_DATE()" )or die(mysqli_error($link));
	}
	?>
<!doctype html>
<html>
<head>
<link rel="stylesheet"  href="style.css">
<title>Get Contents</title>
</head>
<body>

<table cellspacing="10" class="results" border="0">
<?php 
if(mysqli_num_rows($query)==0)
{
	echo "<p align=\"center\">No notes to show in this date.</p>";
}
while($data=mysqli_fetch_array($query))
{
	$nid=$data['id'];
	$loadimage='';
	
	$query2=mysqli_query($link, "select id from image where noteid = $nid and userid = $userid")or die(mysqli_error($link));
	{
		while($row=mysqli_fetch_array($query2))
		{
			$fileid=$row['id'];
		
				$loadimage=$loadimage.'<a target="_new" href="image.php?id='.$fileid.'"><img src="image.php?id='.$fileid.'"/></a>';
		}
	}
	echo "<tr><td><img src = \"https://maps.googleapis.com/maps/api/staticmap?center=".$data['setglocation']."&zoom=15&size=100x100&maptype=roadmap&markers=color:blue%7Clabel:S%7C40.702147,-74.015794&markers=color:green%7Clabel:G%7C40.711614,-74.012318&markers=color:red%7Clabel:C%7C40.718217,-73.998284\"</td><td><div class=\"resulttext\"><p>".$data['content']."</p><div class=\"time\">".gmdate('d/m/y , h:i:s A',$data['time']+19800)."</div></div></td>
	<td class=\"thumbspace\">$loadimage</td></tr>";
}
?>
</table>
</body>
</html>