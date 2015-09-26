<?php
include 'connect.php';
//include 'session_check.php';

?>
<!doctype html>
<html>
<head><title>RichText Document</title>
 <script src="3rdparty_ck/ckeditor.js"></script>
 <script src="raid.js"></script>

<script src="ajax_1_10_2.js"></script>

  <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="raid.css">

<script>
var start=1;
var alteredDate=0;
var detected_lat=0;
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
               unsaved=true;

}
            else{
                      unsaved=false;
            }

}
function getPlaceImage(coords,address)
{
	var staticImage='https://maps.googleapis.com/maps/api/staticmap?center='+coords+'&zoom=15&size=300x300&maptype=roadmap&markers=color:blue%7Clabel:S%7C40.702147,-74.015794&markers=color:green%7Clabel:G%7C40.711614,-74.012318&markers=color:red%7Clabel:C%7C40.718217,-73.998284';
	$id('tarea').style.backgroundImage='url('+staticImage+')';
                  $id('tarea').style.backgroundPosition='bottom right';
                  $id('tarea').style.backgroundRepeat='no-repeat';
                  $id('tarea').style.backgroundSize='contain';
                  document.cookie="userLocation="+coords+"; expires=Thu, 18 Dec 2013 12:00:00 UTC";

	
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
    button
    {
        background: linear-gradient(#BBCAB4,#91B195);
        border-radius: 1px;
        display: table-cell;
        color: #fff;
        box-shadow: 1px 1px 2px #92AA88;
        text-shadow: 1px 1px 5px #000;
    }
    button:hover
    {
    }
    #typeArea
    {
    }
    </style>
</head>
<body>

<div id="loading" class="spinner"></div>

<div class="topribbon" id="topribbon"><span class="logo">Notes <sup>loud</sup></span>
<table align="right" cellspacing="4"><tr><td onclick="goTopage(this)" data-link="book.php">Read Notes</td><td onclick="showMenu(this)" data-link="paper.php">Menu</td>	<td onclick="goTopage(this)" data-link="logout.php">Logout</td></tr></table>
</div> 
<div id="infoPaper"><div class="topstrip" id="topstrip"><span id="topstriptitle"></span><div id="infoPaperClose" onclick="infoPaperHide();"><img style="width:20px; height:20px;" title="Close ! this thing" src="images/b_close.png"/></div></div><div id=infoPaperContent></div></div></div>
<div id="flowOptions" >
<table width="100%">
<tr><td onclick="showMsg('albums.php',{title:'Photos',iframe:true}); showMenu(this);">Photos</td></tr>
<tr><td onclick="showMsg('mylinks.php',{title:'Links',iframe:true}); showMenu(this);">Links</td></tr>
<tr><td onclick="infoPaper('getpeople.php','Peoples',1)">Peoples</td></tr>
<tr><td onclick="infoPaper('info.php','Informations')">Informations</td></tr>
<tr><td onclick="showMsg('settings.php',{title:'Settings',iframe:true}); showMenu(this);">Settings</td></tr>

</table>
</div>

<textarea  id="typeArea" rows="50" style="top:150px;">Create Rich Text Documents</textarea>

<script>
    //Positioning Element

                CKEDITOR.replace( 'typeArea');
  

            </script>
</body>
</html>