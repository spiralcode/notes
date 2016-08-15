<?php
include 'session_check.php';
include 'connect.php';

//counter variables
$wordcount=0;
$chars=0;
$data0=mysqli_query($link, "select * from userbase where id = $userid")or die(mysqli_error($link));
while($row=mysqli_fetch_array($data0))
{
	$time=$row['time'];
}
$data=mysqli_query($link, "select * from events where userid = $userid")or die(mysqli_error($link));
$note_counts=mysqli_num_rows($data);
while($row1=mysqli_fetch_array($data))
{
	$wordcount+=str_word_count($row1['content']);
	$chars+=strlen($row1['content']);
}
$data1=mysqli_query($link, "select * from image where userid = $userid")or die(mysqli_error($link));
$image_counts=mysqli_num_rows($data1);

$data2=mysqli_query($link, "select * from peoples where userid = $userid")or die(mysqli_error($link));
$totalpeoples = mysqli_num_rows($data2);
//User Informations
$data3 = mysqli_query($link,"select * from userbase where id = $userid") or die(mysqli_error($link));
while($row=mysqli_fetch_array($data3))
{
	$email = $row['email'];
	$accountOpen = $row['time'];
	$name=$row['name'];
}
?>
<!doctype html>
<head>
<style>
	.title
{
font-size: 1.5em;
text-align: left;
font-family: Arial,Serif;
background: darkseagreen;
color: white;
margin:1em;

}
.demographics
{
color:#617A43;
font-family:Arial,Serif;
text-align:center;
}

.demographics p
{
color:#6F9F38;
text-align:center;
}
.demographics .goodtable
{
text-align: center;
background: white;
width: 100%;
}
.demographics .goodtable td
{
width:5em;
font-size:1em;
padding:.8em;

}
.demographics .goodtable td:nth-child(even)
{
color: dimgrey;
text-align: right;
}
.demographics .goodtable tr:nth-child(even)
{
background: rgba(0, 0, 255, 0.09);
}
</style>
</head><body>
<div class="title">Demographics</div>
<div class="demographics">
<div class="goodtable"><center><table cellspadding="10" >
<tr><th>Item</th><th>Count</th></tr>
<tr><td>Notes</td><td><?php echo sprintf('%04d',$note_counts); ?></td></tr>
<tr><td>Files</td><td><?php echo sprintf('%04d',$image_counts);?></td></tr>
<tr><td>Contacts</td><td><?php echo sprintf('%04d',$totalpeoples);?></td></tr>
<tr><td>Words</td><td><?php echo sprintf('%04d',$wordcount);?></td></tr>
<tr><td>Characters</td><td><?php echo sprintf('%04d',$chars);?></td></tr>
</table></center>
</div>
<div class="title">Account Informations</div>
<div class="goodtable"><center><table>
	<tr><td>Name </td><td><?php echo $name; ?></td></tr>
	<tr><td>E-mail</td><td><?php echo $email; ?></td></tr>
		<tr><td>Created on </td><td><?php echo $time; ?></td></tr>

</body>
</html>