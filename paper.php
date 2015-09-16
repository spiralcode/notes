<?php
include 'connect.php';
include 'session_check.php';

?>
<!doctype html>
<html>
<head><title>Notes : Add Note</title>
<script src="aftersave.js"></script>
<script src="notify.js"></script>
 <script src="raid.js"></script>


<script src="lib/moment.js"></script>
<script src="ajax_1_10_2.js"></script>
<script src="lib/jquery-1.10.2.js"></script>
  <script src="lib/jquery-ui.js"></script>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="style/jquery-ui.css">
<link rel="stylesheet" href="raid.css"/>

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

function savecheck()
{
	if(($id('tarea').innerHTML).length>0)
	{
            var count=0,filecount=0;
while(typeof($id('slot'+count)!='undefined'))
{
    if($id('slot'+count++).dataset.upload==1)
        {
            filecount++;
        }
}
if(filecount==0){
            unsaved=true;}
            else{
                      unsaved=false;
            }
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
	var staticImage='https://maps.googleapis.com/maps/api/staticmap?center='+coords+'&zoom=15&size=300x300&maptype=roadmap&markers=color:blue%7Clabel:S%7C40.702147,-74.015794&markers=color:green%7Clabel:G%7C40.711614,-74.012318&markers=color:red%7Clabel:C%7C40.718217,-73.998284';
	$id('tarea').style.backgroundImage='url('+staticImage+')';
                  $id('tarea').style.backgroundPosition='bottom right';
                  $id('tarea').style.backgroundRepeat='no-repeat';
                  $id('tarea').style.backgroundSize='contain';

	
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
<style>
    [contentEditable=true]:empty:not(:focus):before{
        content:attr(data-text)
    }
    
    </style>
</head>
<body>

<div id="loading" class="spinner"></div>

<div class="topribbon"><span class="logo">Notes <sup>v3</sup></span>
<table align="right" cellspacing="4"><tr><td onclick="goTopage(this)" data-link="book.php">Read Notes</td><td onclick="showMenu(this)" data-link="paper.php">Menu</td>	<td onclick="goTopage(this)" data-link="logout.php">Logout</td></tr></table>
</div> 
<div class="paper" id="paper">
<div id="filedrag" class="imgplace" ><center><span align="center" id="timedat" class="pholder">10 July 2015, 11:52 </span></center>
</div>
    
 <div data-text ="Type in something or drag and drop images here..."  id ="tarea" onkeyup ="savecheck();" contenteditable="true" placeholder="Typethings here" style="background:white; overflow-y: scroll; border-top: 1px double  yellowgreen;"></div>
<table align="center"><tr><td>
<button title="Save the note. (ctrl+s)" onclick="savenote()">Save Note<br><span class="buttonsubtext">ctrl+s</span></button></td>
<td>
<button value="0" title="Click to embed a location" onclick="" id="geo">Embed a location<br><span class="buttonsubtext"></span></button>
</td>
<td>
    <input onchange="timeup(this);" type="hidden" id="hiddenField" class="datepicker" />

<script>
     function showMsg(url)
            {
                var windowHeight=window.innerHeight , windowWidth = window.innerWidth;
                var divHeight=windowHeight-200, divWidth=windowWidth-300;
                var ele=document.createElement("div");
                document.getElementsByTagName('body')[0].appendChild(ele);
                ele.setAttribute('id',"uq");
                 ele.setAttribute('class',"raid");
                $.get(url,function(data,success){
                    ele.innerHTML=data;
    });
                ele.style.width=divWidth+'px';
                ele.style.height=divHeight+'px';
                var divPos = ele.getBoundingClientRect();
                ele.style.left=(windowWidth/2)-(divPos.width/2)+'px';
                ele.style.top=(windowHeight/2)-(divPos.height/2)+'px';
                var closeDiv =document.createElement('div');
                ele.appendChild(closeDiv);
                closeDiv.setAttribute('class','close');
                closeDiv.setAttribute('onclick','closething(\'uq\')');

            }
$( "#hiddenField" ).datepicker({
      showOn: "button",
        buttonText: "Alter Date",
        Title: "Change Date"
    });
    </script>
</td>
<td><button onclick="$('#fileselect').click();">Attach Images</button></td>
	<input type="file" id="fileselect" name="fileselect[]" multiple="multiple"  style="visibility:hidden;"/>

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
    //console.log("Latitude: " + position.coords.latitude + "<br>Longitude: " + position.coords.longitude);
    detected_lat=position.coords.latitude;
    detected_lng=position.coords.longitude;
    $id('geo').value=detected_lat+','+detected_lng;
}
function timeup(alt)
{
if(alt==null)
return moment().format('DD  MMM. YYYY , HH:mm');
else
{
    var val = moment(alt.value,'MM/DD/YYYY');
    $id("timedat").innerHTML=val.format('DD  MMM. YYYY , HH:mm');
}
}
$id("timedat").innerHTML=timeup();
function savenote()
{
    var process_timer=0;
    var warned=0;
	var contents=$id("tarea").innerHTML;
	if(contents=='')
	{
        notify('Nothing to save !');
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
                    notify('Is there some trouble with your Internet ? Because it\'s taking some time extra !, we are trying all ways to get this done :D ','desp','ext');
                        }
                }
                if(warned==4)
                    {
                        window.clearInterval(counter);
                        $id("tarea").innerHTML='';
                        $id("tarea").placeholder='Sorry ! saving of last note was aborted due to a connection failure. ';
                        $id('loading').style.display='none';
                        	savecheck();

                    }
        },1000);
	$.post('feed.php',{
		contents:contents,
		timeid:timer,
                                    datetime:0,
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
	$id('tarea').innerHTML='';
	savecheck();
	timer++;

        var i = 1;
        while(typeof($id('slot+i'))!='undefined')
            {
                		$id("slot"+i++).remove();

            }
	$id("timedat").innerHTML=timeup();
	
}
</script>
<table align="right" id="imlist"><tr  style="width:80px; height: 80px"  id="imgrow">
        <script>
            function imglist(data,name)
{
//Recieves the data file and embed 
//
        var td = document.createElement('td');
        $id('imgrow').appendChild(td);
        td.setAttribute('id','slot'+start++);
        td.setAttribute('class','uploadslot');
        td.style.backgroundImage='url('+data+')';
        td.setAttribute('name',name);
        td.setAttribute('data-uploaded','0');
}
            </script>
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
    <tr><td onclick="infoPaper('photos.php','Images',1);">Images</td></tr>
    <tr><td onclick="infoPaper('mylinks.php','Links',1)">Links</td></tr>
<tr><td onclick="infoPaper('getpeople.php','People and Places',1);">Peoples</td></tr>
<tr><td onclick="infoPaper('info.php','Informations');">Informations</td></tr>
<tr><td onclick="infoPaper('settings.php','Settings');">Settings</td></tr>

</table>
</div>

<div id="infoPaper"><div class="topstrip"><span id="topstriptitle"></span><div id="infoPaperClose" onclick="infoPaperHide();"><img style="width:20px; height:20px;" title="Close ! this thing" src="images/b_close.png"/></div></div><div id=infoPaperContent></div></div></div>
<script src="notify.js"></script>

<div class="sudden_notify" id = "sudden_notify">Saved</div>

</body>
</html>