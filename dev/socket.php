<?php
	echo "Initializing...";
$host = "127.0.0.1";
$port = 8086;
set_time_limit(0);
$socket = socket_create(AF_INET,SOCK_STREAM,0) or die("Couldnt create Socket");
echo "Socket Initialized at Host ".$host. "at port ".$port;
$result = socket_bind($socket,$host,$port) or die("Couldnt create Socket");
$result = socket_listen($socket,3) or die("Listen");
$spawn = socket_accept($socket) or die("erro");
$input = socket_read($spawn,1024) or die('9 error');
trim($input);
$output = strrev($input)."\n";
socket_write($spawn,$output,strlen($output)) or die("11 err");
/*
socket_close($spawn);
socket_close($socket);
*/

	?>