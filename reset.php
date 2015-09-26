<style>
    body
    {
        font-family:"Segoe UI Light",Arial;
        font-size:30px;
    }
    </style>
<?php
include 'connect.php';
include 'session_check.php';
if(isset($_POST['notes']))
{
    $query = "delete from events where userid = $userid ";
     mysqli_query($link,$query) or die(mysqli_error($link));

}
if(isset($_POST['images']))
{

      if($_SERVER['HTTP_HOST']!='localhost')
{
$target_dir="/var/lib/openshift/55a2abe1500446b24a00023d/app-root/data/";	
}   
else
{
$target_dir="media/";	
}
	$query=mysqli_query($link,"select * from image where userid = $userid")or die(mysqli_error($link));
	while($data=mysqli_fetch_array($query))
        {
            $filename=$data['filename'];
            unlink($target_dir.$filename);
        }
$query=  mysqli_query($link,"delete from image where userid = $userid")or die(mysqli_error($link));
}
if(isset($_POST['peoples']))
{
    $query = "delete from peoples where userid = $userid ";
    mysqli_query($link,$query) or die(mysqli_error($link));
}
echo "<div align=\"center\"><img src = \"images/shell.png\"/><br>We kill them all, master !!!</div>";
?>
