<?php
	if(!$ip_address = gethostbyname("localhost"))
	{
		$ip_address="127.0.0.1";
	}
	$sock = socket_create(AF_INET,SOCK_STREAM,0);
	if(!$sock)
	{
		$errorcode = socket_last_error();
		$errormsg = socket_strerror($errorcode);
		die('Unable to create socket : [$errorcode] $errormsg');
	}
	echo "Socket created\n";
	if(!socket_connect($sock,$ip_address,5002))
	{
		$errorcode = socket_last_error();
		$errormsg =socket_strerror($errorcode);
		die("Unable to connect [$errorcode]:$errormsg");
	}
	echo "Connection established\n";
	$message = "Hey";
	if(!socket_send($sock,$message,strlen($message),0))
	{
		$errorcode = socket_last_error();
		$errormsg =socket_strerror($errorcode);
		die("Cant transfer data [$errorcode]:$errormsg");
	}
	echo "Data transferd \n";
	if(!socket_recv($sock,$buf,2045,MSG_WAITALL))
	{
		$errorcode = socket_last_error();
		$errormsg =socket_strerror($errorcode);
		die("Cant recieve data [$errorcode]:$errormsg");

	}
	echo $buf;	
	socket_close($sock);
	?>