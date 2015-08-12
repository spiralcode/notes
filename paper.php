<?php
include 'connect.php';
include 'session_check.php';

?>
<!doctype html>
<html>
<head><title>Notes : Add Note</title>
<script src="aftersave.js"></script>
<script src="notify.js"></script>

<script src="lib/moment.js"></script>
<script src="ajax_1_10_2.js"></script>
<script src="lib/jquery-1.10.2.js"></script>
  <script src="lib/jquery-ui.js"></script>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="style/jquery-ui.css">

<link rel="stylesheet" href="notify.css">
<link type="text/css" rel="stylesheet" href="style/locationpicker.css" />
<script>
var start=1;
var time = new Date;
var timer=time.getTime();
var width=window.innerWidth;
var height=window.innerHeight;
function showMenu(ob)
{
if($id('flowOptions').style.display=='none'||$id('flowOptions').style.display=='')
{
$id('flowOptions').style.display='block';
}
else
{
	$id('flowOptions').style.display='none';
}
var refer_dim=ob.getBoundingClientRect();
{
	$id('flowOptions').style.top=refer_dim.bottom+'px';
	$id('flowOptions').style.right=(window.innerWidth-refer_dim.right)+'px';	
}
}
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
function savecheck()
{
	if(($id('tarea').value).length>0)
	{
	unsaved=true;
	}
	else
	{
	unsaved=false;
	}
}
function alterdate(ob)
{
    notify(ob.value);
}
function getPlaceImage(coords,address)
{
	var staticImage='https://maps.googleapis.com/maps/api/staticmap?center='+coords+'&zoom=15&size=150x150&maptype=roadmap&markers=color:blue%7Clabel:S%7C40.702147,-74.015794&markers=color:green%7Clabel:G%7C40.711614,-74.012318&markers=color:red%7Clabel:C%7C40.718217,-73.998284';
	$id('geoimage').innerHTML='<img src="'+staticImage+'"/>';
	$id('geoimage').setAttribute('title','Mapshot of '+coords);
	
	
}
function goTopage(ob)
{
	window.location.href=ob.dataset.link;
}
function infoPaper(resource,title,frame)
{
if(frame!=1)
{
	$.get(resource,function(data,success)
			{
		$id('infoPaperContent').innerHTML=data;
		$id('topstriptitle').innerHTML=title;
			});
}
else
{
$id('infoPaperContent').innerHTML='<iframe id="infoPaperFrame"></iframe>';
$id('infoPaperFrame').src=resource;
$id('topstriptitle').innerHTML=title;

}
	$id('infoPaper').style.display='block';
	var infoPaper = $id('infoPaper').getBoundingClientRect();
	$id('infoPaper').style.left=(window.innerWidth/2)-(infoPaper.width/2)+'px';
	$id('infoPaper').style.bottom=(window.innerHeight/2)-(infoPaper.height/2)+'px';
	$id('infoPaperFrame').style.height=infoPaper.height-40+'px';
	$id('infoPaperFrame').style.width=infoPaper.width-10+'px';
}
</script>
</head>
<body>
	
<div id="loading" class="spinner"></div>

<div class="topribbon"><span class="logo">Notes <sup>v3</sup></span>
<table align="right" cellspacing="4"><tr><td onclick="goTopage(this)" data-link="book.php">Read Notes</td><td onclick="showMenu(this)" data-link="paper.php">Menu</td>	<td onclick="goTopage(this)" data-link="logout.php">Logout</td></tr></table>
</div> 
<div class="paper" id="paper">
<div id="filedrag" class="imgplace" title="Drag and Drop files to here"><center><span align="center" id="timedat" class="pholder">10 July 2015, 11:52 </span></center>
<span align="center" class="timedate">Drag and Drop images here to attach with this note.</span>
</div>
<textarea onkeyup="savecheck()" placeholder="Type things here..." id = "tarea"></textarea>
<table align="center"><tr><td>
<button title="Save the note. (ctrl+s)" onclick="savenote()">Save Note<br><span class="buttonsubtext">ctrl+s</span></button></td>
<td>
<button value="0" title="Click to embed a location" onclick="" id="geo">Embed a location<br><span class="buttonsubtext"></span></button>
</td>
<td>
    <input onchange="alterdate(this);" type="hidden" id="hiddenField" class="datepicker" />

<script>  
$( "#hiddenField" ).datepicker({
      showOn: "button",
        buttonText: "Alter Date",
        Title: "Change Date"
    });
    </script>
</td>
</tr>
</table>

<script>
getloc();
/*
 * Global Variables

 */
var detected_lat=0;
var detected_lng=0;
var counter = window.setInterval(function(){},1000);

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
    detected_lat=position.coords.latitude;
    detected_lng=position.coords.longitude;
    $id('geo').value=detected_lat+','+detected_lng;
}
function timeup()
{
var cal = new Date();
var date=cal.getDate();
var mnth=cal.getMonth();
var year=cal.getUTCFullYear();
var hour=cal.getHours();
var min=cal.getMinutes();
mnth++;
if(min<10)
{
	min="0"+min;
}
if(hour<10)
{
	hour="0"+hour;
}
if(mnth<10)
{
	mnth="0"+mnth;
}
var formatted = date+" - "+mnth+" - "+year+" ,"+hour+":"+min;
return formatted;
}
$id("timedat").innerHTML=timeup();
function savenote()
{
    var process_timer=0;
    var warned=0;
	var contents=$id("tarea").value;
	if(contents=='')
	{
        notify('Nothing to save !!!');
	return;
	}
	$id('loading').style.display='block';
        counter = window.setInterval(function(){
            process_timer++;
            if(process_timer%10==0)
                {
                                        warned++;

                    if(warned<4)
                        {
                    notify('This is taking more than usual, check your Internet connection.','desp','ext');
                        }
                }
                if(warned==4)
                    {
                        window.clearInterval(counter);
                        $id("tarea").value='';
                        $id("tarea").placeholder='Sorry ! saving of last note was aborted due to a connection failure. ';
                        $id('loading').style.display='none';
                        	savecheck();

                    }
        },1000);
	$.post('feed.php',{
		contents:contents,
		timeid:timer,
		geolocation:detected_lat+','+detected_lng,
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
function infoPaperHide()
{
	$id('infoPaper').style.display='none';
}
function newnote()
{
        window.clearInterval(counter);
	$id('loading').style.display='none';
        notify('Last note Saved :)','happy');
	$id('tarea').value='';
	savecheck();
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
<td id = "slot6"></td>
<td id = "slot7"></td>
<td id = "slot8"></td>
<td id = "slot9"></td>
<td id = "slot10"></td>
</tr></table>

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
//Loading placements
//loading obj. dimensions
var loading=$id('loading').getBoundingClientRect();
$id('loading').style.left=(window.innerWidth/2)-(loading.width/2)-10+'px';
$id('loading').style.bottom=(window.innerHeight/2)-(loading.height/2)+'px';

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
        
	<div id="flowOptions">
<table width="100%">
<tr><td onclick="infoPaper('info.php','Informations');">Informations</td></tr>
<tr><td onclick="infoPaper('settings.php','Settings');">Settings</td></tr>
<tr><td onclick="infoPaper('getpeople.php','People and Places',1);">Fetch People or Places</td></tr>

</table>
</div>
<div id="infoPaper"><div class="topstrip"><span id="topstriptitle"></span><div id="infoPaperClose" onclick="infoPaperHide();"><img style="width:20px; height:20px;" title="Close ! this thing" src="images/b_close.png"/></div></div><div id=infoPaperContent></div></div></div>
<script src="notify.js"></script>

<div class="sudden_notify" id = "sudden_notify">Saved</div>
</body>
</html>