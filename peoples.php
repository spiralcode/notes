<?php
	include 'session_check.php';
	include 'connect.php';
	$query=mysqli_query($link,"select * from peoples where userid = $userid order by name asc") or die(mysqli_error($link));
	?>
<html>
	<head>

				<script src="notey.js"></script>
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
.bigoptions
{
  position:absolute;
  width:100%;
  text-align:center;
  top:40px;
}
.bigoptions span
{
  font-family:Arial,serif;
  font-size:20px;
  color: #A384BD;
  margin:2%;
 min-width:60px;
 min-height:20px;
}
a
{
  text-decoration:none;
    color: #A384BD;
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
td
{
		font-family:Arial,Serif;
		color:#50A9ED;
		font-size:20px;
}
td:hover
{
text-shadow:1px 1px 1px #093658;
cursor:pointer;
}
.result
{
	width:90%;
	font-size:18px;
	margin-left:5%;
	margin-top:2px;
	font-family:arial,serif;
	color:white;
	border-radius:2px;
		border:1px solid #fff;
}
.result:hover
{
	border:1px solid #C98078;
}
.result button
{
	position:absolute;
	right:5px;
	min-width:5px;
	min-height:5px;
	color:green;
	cursor:pointer;
}
.peoplelist 
{
position:relative;

}
.peoplelist td
{
width: 20px;
height:20px;
text-align:center;
color: #BBCAB4;
border:1px solid #fff;
text-shadow: 0px 0px 1px #093658;
background: rgba(5, 39, 22, 0.74);
font-size: 15px;
}
.peoplelist td:hover
{
	border:1px solid #C98078;
}
 .heading
{
	font-size:30px; 
font-family: "Segoe UI Light",arial,serif;		color: rgba(5, 39, 22, 0.57);
}
.grp
{

display:table;
margin:2%;
background: rgba(223, 223, 223, 0.75);}

.grp .entity
{
    display: table-cell;
float: left;
width: 100px;
height: 100px;
margin: 2px;
vertical-align: middle;
text-align: center;
color: #FFFFFF;
border: 1px solid #fff;
text-shadow: 0px 0px 1px rgba(255, 255, 255, 0.42);
background: rgba(71, 141, 200, 1);
font-size: 15px;
font-family: "Segoe UI Light",arial,serif;cursor: pointer;
padding: 5px;
}
.grp .entity:hover
{
    box-shadow: 0px 0px 5px #000;
}
</style>
<script>
function $id(ob)
{
	return document.getElementById(ob);
}
  </script>
		</head>
<body>
	<script>
		</script>
	<div style="height:100%" >
		<?php
			$relationList=array();
			$grpsList=array();
			$query1 = mysqli_query($conn,"select relation from peoples where userid  = $userid")or die(mysqli_error($conn));
			while($data=mysqli_fetch_array($query1))
			{
				array_push($relationList,$data['relation']);
			}
			foreach(array_unique($relationList) as $item)
			{

							$query2 = mysqli_query($conn,"select grps from relations where term = '$item'" )or die(mysqli_error($conn));
							while($data=mysqli_fetch_array($query2))
							{
								array_push($grpsList,$data['grps']);
							}
			}

							foreach(array_unique($grpsList) as $item)
							{
                            
                                                            if($item=='fam')
								{
									echo '<div class = "grp" id = "family"><div class="heading">Family</div>
									<script>notey.get(\'fetchPeoples.php?relation='.$item.'\',function(data){
									var decData=JSON.parse(data.responseText);
									var counter=0;
									while(decData[counter]!=null)
									{
									var item = document.createElement(\'div\');
									document.getElementById(\'family\').appendChild(item);
									item.setAttribute(\'class\',\'entity\');
								item.setAttribute(\'data-link\',\'person_info.php?pid=\'+decData[counter].id);
																										item.setAttribute(\'onclick\',\'goTopage(this)\');
									item.innerHTML=decData[counter].name;
									counter++;
									}
									});</script>
									</div>';
								}
								elseif($item=='frnd')
								{
                                                                    echo '<div class = "grp" id = "friend"><div class="heading">Friends</div><script>notey.get(\'fetchPeoples.php?relation='.$item.'\',function(data){
									var decData=JSON.parse(data.responseText);
									var counter=0;
									while(decData[counter]!=null)
									{
									var item = document.createElement(\'div\');
									document.getElementById(\'friend\').appendChild(item);
									item.innerHTML=decData[counter].name;
                                                                        item.addEventListener(\'mousemove\',function(e){helloWindows(e);},true);
								    item.setAttribute(\'class\',\'entity\');
								item.setAttribute(\'data-link\',\'person_info.php?pid=\'+decData[counter].id);
								item.setAttribute(\'onclick\',\'goTopage(this)\');
									counter++;
									}
									});</script>
									</div>';
								}

								elseif($item=='unsorted')
								{
									echo '<div class = "grp" id = "unsorted"><div class="heading">Miscellaneous</div><script>notey.get(\'fetchPeoples.php?relation='.$item.'\',function(data){
									var decData=JSON.parse(data.responseText);
									var counter=0;
									while(decData[counter]!=null)
									{
									var item = document.createElement(\'div\');
									document.getElementById(\'unsorted\').appendChild(item);
									item.innerHTML=decData[counter].name;
								    item.setAttribute(\'class\',\'entity\');
								item.setAttribute(\'data-link\',\'person_info.php?pid=\'+decData[counter].id);
								item.setAttribute(\'onclick\',\'goTopage(this)\');
									counter++;
									}
									});</script>
									</div>';
								}
                                                        }
							

							
			?>
		</div>
                <script>
                    function helloWindows(e)
{
                    }
                    </script>
</body>
</html>