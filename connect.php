<?php    
if($_SERVER['HTTP_HOST']!='localhost')
{
   //Dont alter its remote credentials
$host = "127.10.171.2:3306";
$user = "adminz8hImgI";
$pass = 'rUP7aW8my2r6';
$db = 'note';
}   
else
{
//For localhost
$host = "localhost";
$user = "root";
$pass = 'dbase001';
$db = 'notes';	
}
$conn = new mysqli($host,$user,$pass);
$link=$conn;
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
} 
$db=mysqli_select_db($conn,$db);
?>
