<?php
	function cmdPcss($cmd,$socket)
	{
		$cmd=trim($cmd);
		if($cmd=="delete")
		{
			echo "Deletion activites initiated\n";
			socket_write($socket,'Deleted\n');
		}
		elseif($cmd=="rename")
		{
			echo "Rename activites initiated\n";
			socket_write($socket,'Renamed\n');
		}
		else
		{
			echo "Unclassified activity\n";
			socket_write($socket,'Unclassifed\n');
		}
		
	}
	?>