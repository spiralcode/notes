<?php
	include 'session_check.php';
	include 'connect.php';
	include 'ease.php';
	$pid=get('pid');
	$query=mysqli_query($link,"select * from peoples where id = $pid ") or die(mysqli_error($link));
	while($data=mysqli_fetch_array($query))
	{
		$name=$data['name'];
		$relation = $data['relation'];
		$email=$data['email'];
		$website=$data['website'];
		$dob=$data['dob'];
		$phone=$data['phone'];
		$geoloc=$data['homelocation'];
		$gender = $data['gender'];
	}

	?>
<html>
	<head>
		<script src="ajax_1_10_2.js"></script>
		<script>
			function goTopage(ob,target)
{
	window.location.href=ob.dataset.link;
}
</script>
<style>
.spinner {
 display:none;
z-index:101;
  width: 40px;
  height: 40px;
  margin: 100px auto;
  background-color: #0f0;

  border-radius: 100%;  
  -webkit-animation: sk-scaleout 1.0s infinite ease-in-out;
  animation: sk-scaleout 1.0s infinite ease-in-out;
}

@-webkit-keyframes sk-scaleout {
  0% { -webkit-transform: scale(0) }
  100% {
    -webkit-transform: scale(3.0);
    opacity: 0;
  }
}

@keyframes sk-scaleout {
  0% { 
    -webkit-transform: scale(0);
    transform: scale(0);
  } 100% {
    -webkit-transform: scale(3.0);
    transform: scale(1.0);
    opacity: 0;
  }
}

a
{
  text-decoration:none;
    color: #A384BD;
		font-family:Arial,Serif;
}
a:hover
{
  text-decoration:underline;
}
#heading
{
	color:#ED9450;
	font-size:25px;
	font-family:Arial,Serif;
	text-align:center;
}
.info
{
	font-family:Arial,serif;
	font-size:14px;
	color:#637A00;
}
#formarea
{
	font-family:Arial,Serif;
	font-size:12px;
}
span
{
	font-family:Arial,Serif;
	font-size:12px;
}
.form tr td:nth-child(odd)
{
	text-align:right;
	font-size:13px;
}
.navigate_raw
{
	font-size:14px;
	color:#637A00;
	text-align:right;
}
</style>

<script>
function $id(ob)
{
	return document.getElementById(ob);
}
function formsub()
{
	var phone = val($id("phone")), email = val($id("email")), dob = val($id("datepicker")), url = val($id("url")), geoloc = val($id("geo")),rel = val($id("relation")),phone = val($id("phone"));
	var gender = ''; 
	if(document.getElementsByName("gender")[0].selected)
	{
		gender=0;
	}
	else
	gender=1;
	$.post("saveperson.php",{
		email:email,
		dob:dob,
		phone:phone,
		rel:rel,
		url:url,
		pid:'<?php echo $pid; ?>',
		geoloc:geoloc,
		gender:gender
	},function(data,success)
	{
if(data==1)
{
	travelto('person_info.php?pid=<?php echo $pid; ?>');
}
else
{
	alert('Unable to save, we faced some errors on the course !');
}
	});
}
function val(ob)
{
	return ob.value;
}
function travelto(target)
{
	window.location.href=target;
}
  </script>
		</head>
<body>
		<span class="navigate_raw"><a href="peoples.php">Back to peoples</a></span>
<div id="heading"><?php echo ucfirst($name); ?></div>
<div id = "formarea" align="center"><br><br>
<?php echo $gender;
	?>
<table class="form" cellspacing="10">
	<tr><td>How are you  related to <?php echo ucfirst($name); ?></td><td><select value="<?php echo $relation; ?>" id ="relation">
		<?php
			$q3=mysqli_query($link,"select * from relations")or die(mysqli_error($link));
			while($rows=mysqli_fetch_array($q3))
			{
				if($relation==$rows['term'])
				{
						echo "<option selected=\"selected\">".$rows['term']."</option>";		
				}
				else
				{
				echo "<option>".$rows['term']."</option>";
				}			
			}
			?>
		</select></td></tr>
	<tr><td>Gender</td><td><span>Male </span> <input <?php if($gender=='0'){echo 'checked';} ?> name ="gender" value = "0" type ="radio"><span>Fe-male </span> <input <?php if($gender=='1'){echo 'checked';} ?>  type = "radio" name ="gender" value = "1"></td></tr>
	<tr><td>Phone number</td><td><input type="text" id = "phone" value="<?php echo $phone; ?>"></td></tr>
	<tr><td>E-mail</td><td><input type="email" id = "email" value="<?php echo $email; ?>"></td></tr>
	<tr><td>Date of Birth</td><td><input type="email" id = "datepicker" value="<?php echo $dob; ?>"></td></tr>
	<tr><td>Address of a page/link associated with <?php echo ucfirst($name); ?></td><td><input value="<?php echo $website; ?>" type="url" id = "url"></td></tr>
	<tr><td>Home/ Resident location</td><td><input type="email" id = "geo" value="<?php echo $geoloc; ?>"></td></tr>
	<tr><td colspan="2" align="center"><button onclick="formsub()">Save</button></td></tr>
</div>
</body>
</html>