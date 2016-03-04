<?php
	include 'session_check.php';
	include 'connect.php';
	include 'ease.php';
	$pid=get('pid');
	$locationList = array();
	$query=mysqli_query($link,"select * from peoples where id = $pid and userid=$userid ") or die(mysqli_error($link));
	while($data=mysqli_fetch_array($query))
	{
		$name=$data['name'];
		$relation = $data['relation'];
		$email=$data['email'];
		$website=$data['website'];
		$dob=$data['dob'];
		$phone=$data['phone'];
		$geoloc=$data['homelocation'];
                                    $nicks = $data['nicknames'];
                                    $gender = $data['gender'];
	}
 $nicksArray = json_decode($nicks);
$query=mysqli_query($link,"select * from events where content like '%$name%'  ") or die(mysqli_error($link));
$noteCount= mysqli_num_rows($query);
          while($data=  mysqli_fetch_array($query))
          {
              if($data['setglocation']!=0)
			  {
				  array_push($locationList,$data['setglocation']);
			  }
		/*	  else if($data['geolocation']!="0,0")
			  {
				 array_push($locationList,$data['geolocation']);
			  }*/
			  
          }
          $subCount = 0;
          if(sizeof($nicksArray)>0)
          foreach($nicksArray as $OneName)
          {
  $query=mysqli_query($link,"select * from events where content like '%$OneName%'  ") or die(mysqli_error($link));
//$noteCount= mysqli_num_rows($query);
          while($data=  mysqli_fetch_array($query))
          {
              $subCount++;
          }
          }
 array_unique($locationList,SORT_STRING);
if(strlen($website)>40)
{
	$short_website=substr($website,0,40)."...";
}
 else {
$short_website=$website;    
}
$outArray = array("name"=>  ucfirst($name),"relation"=>$relation,"dob"=>$dob,"gender"=>$gender,"noteCount"=>$noteCount+$subCount,"locationCount"=> sizeof($locationList), "locations"=>$locationList);
echo json_encode($outArray);
	?>