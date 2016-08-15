<?php 
	$host = "127.0.0.1";
	$port = 8086;
	$message = "Hello Server";
	echo "Message to :".$message;
	
$socket = socket_create(AF_INET,SOCK_STREAM,0) or die("Couldnt create Socket");
$result = socket_connect($socket,$host,$port) or die("Unble to cnnect");
socket_write($socket,$message,strlen($message)) or die("9 errr");
$result = socket_read($socket,1024) or die("Loz");
echo "Reply from Server : ".$result;
socket_close($socket);
	?>