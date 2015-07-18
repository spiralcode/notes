<?php
session_start();
include 'connect.php';
$userid=1;
$_SESSION['userid']=1;

?>
<!doctype html>
<html>
<head><title>Paper : 1</title>
<script src="ajax_1_10_2.js"></script>
<script src="aftersave.js"></script>

<link rel="stylesheet" href="style.css">
<link type="text/css" rel="stylesheet" href="style/locationpicker.css" />
<script>
var start=1;
var time = new Date;
var timer=time.getTime();
var width=window.innerWidth;
var height=window.innerHeight;

function $id(id)
{
	return document.getElementById(id);
}
function $name(name)
{
	return document.getElementsByName(name)[0];
}
function output(msg)
{
	console.log(msg);
}
function imglist(data,name)
{

	if(start>5){
		msg("You can only attach 5 images per note");
		return;
	}
	data = '<img src = "'+data+'">';
	$id("slot"+start).setAttribute("name", name);
	$id("slot"+start++).innerHTML=data;
}
function savecheck(ob)
{
	if((ob.value).length>0)
	{
	unsaved=true;
	console.log(unsaved);
	}
	else
	{
		unsaved=false;
		Lorem
	}
}
function getPlaceImage(coords,address)
{
	var staticImage='https://maps.googleapis.com/maps/api/staticmap?center='+coords+'&zoom=15&size=150x150&maptype=roadmap&markers=color:blue%7Clabel:S%7C40.702147,-74.015794&markers=color:green%7Clabel:G%7C40.711614,-74.012318&markers=color:red%7Clabel:C%7C40.718217,-73.998284';
	$id('geoimage').innerHTML='<img src="'+staticImage+'"/>';
	$id('geoimage').setAttribute('title','Mapshot of '+coords);
	
	
}
</script>
</head>
<body>
<div class="topribbon">Notes 3<div><a href="book.php">Read</a></div>
</div> 
<div class="paper" id="paper">
<div id="filedrag" class="imgplace" title="Drag and Drop files to here"><center><span align="center" id="timedat" class="pholder">10 July 2015, 11:52 </span></center>
<span class="timedate">Drag Images here</span>
</div>
<textarea onkeyup="savecheck(this)" placeholder="Type things here..." id = "tarea"></textarea>
<table align="center"><tr><td>
<button title="Save the note. (ctrl+s)" onclick="savenote()">Save Note<br><span class="buttonsubtext">ctrl+s</span></button></td>
<td>
<button value="0" title="Click to embed a location" onclick="" id="geo">Embed a location<br><span class="buttonsubtext"></span></button>
</td>
</tr>
</table>
<script>
getloc();
function getloc()
{
if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
} else { 
	console.log("Location no supported");
}
}
function showPosition(position)
{
    console.log("Latitude: " + position.coords.latitude + "<br>Longitude: " + position.coords.longitude);

}
function timeup()
{
var cal = new Date();
var date=cal.getDate();
var mnth=cal.getMonth();
var year=cal.getUTCFullYear();
var hour=cal.getHours();
var min=cal.getMinutes();
if(min<10)
{
	min="0"+min;
}
if(hour<10)
{
	hour="0"+hour;

}
var formatted = date+" - "+mnth+" - "+year+" ,"+hour+":"+min;
return formatted;
}
$id("timedat").innerHTML=timeup();
function savenote()
{
	console.log($id('geo').value);
	var contents=$id("tarea").value;
	if(contents=='')
	{
	alert('Nothing to save !!!');
	return;
	}
	$.post('feed.php',{
		contents:contents,
		timeid:timer,
		geolocation:'41,90',
		setglocation:$id("geo").value
		},function(data,success){
		if(data==1)
		{
		newnote();
		}
		else
		{alert(data);
		}
			});
}
function newnote()
{
	alert('Saved');
	$id('tarea').value='';
	timer++;
	
	for(var ii=1;ii<=5;ii++)
	{
		$id("slot"+ii).innerHTML='';
		console.log(ii);
	}
	$id("timedat").innerHTML=timeup();
	
}
</script>
<table align="right" id="imlist"><tr>
<td id = "slot1"></td>
<td id = "slot2"></td>
<td id = "slot3"></td>
<td id = "slot4"></td>
<td id = "slot5"></td>

</tr></table>

<progress width="100%" id="progress" max="100" value="5"></progress>
<div align="center" id="geoimage"></div>
</div>
<form method="post" enctype="multipart/form-data" action="filecatch.php">
<input style="display: none;" type="file" id="fileselect" name="fileselect[]" multiple="multiple" />

<script type="text/javascript">
var obpaper = document.getElementById('paper');
var tarea  = document.getElementById('tarea');
obpaper.style.width=width-300+'px';
obpaper.style.height=height-200+'px';
//ob dimensions
var opdimen=obpaper.getBoundingClientRect();
tarea.style.width=opdimen.width+'px';
tarea.style.height=opdimen.height-300+'px';
obpaper.style.top=(height/2)-(opdimen.height/2)+'px';
obpaper.style.left=(width/2)-(opdimen.width/2)+'px';
//Event listening for keyboard shortcuts
tarea.addEventListener('keydown',function(e){
	if(e.ctrlKey&&e.keyCode==83)
	{
		e.preventDefault();
		savenote();
	}
},false);
</script>
<script src="fly.js"></script>
</form>
<script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
	<script src="lib/jquery.js"></script>
	<script src="lib/jquery.locationpicker.js"></script>
	<script>
		$('#geo').locationPicker();
	</script>
</body>
</html>