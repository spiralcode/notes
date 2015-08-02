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
?>
<style>
.justinfo
{
color:#617A43;
width:100%;
height:100%;
}
.justinfo p
{
color:#6F9F38;
text-align:center;
}
.justinfo .goodtable
{
text-align:center;


}
.justinfo td
{
width:100px;
border-right:1px solid #67389F;
}
</style>
<div class="justinfo">
<p>That's all we have, here...</p>
<div class="goodtable"><center><table cellspadding="10" >
<tr><th>Item</th><th>Count</th></tr>
<tr><td>Notes</td><td><?php echo $note_counts; ?></td></tr>
<tr><td>Images</td><td><?php echo $image_counts;?></td></tr>
<tr><td>Contacts</td><td><?php echo $totalpeoples?></td></tr>
<tr><td>Words</td><td><?php echo $wordcount;?></td></tr>
<tr><td>Characters</td><td><?php echo $chars;?></td></tr>


</table></center>
</div>