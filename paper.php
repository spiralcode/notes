<?php//Confinclude 'connect.php';include 'session_check.php';?><!doctype html><html><head><title>Notes : Add Note</title><script src="aftersave.js"></script><script src="notify.js"></script> <script src="raid.js"></script><script src="notey.js"></script><script src="lib/moment.js"></script><script src="ajax_1_10_2.js"></script><script src="lib/jquery-1.10.2.js"></script>  <script src="lib/jquery-ui.js"></script>  <link rel="stylesheet" href="style.css">  <link rel="stylesheet" href="style/jquery-ui.css"><link rel="stylesheet" href="raid.css"/><link rel="stylesheet" href="notify.css"><link type="text/css" rel="stylesheet" href="style/locationpicker.css" /><script>var start=1;var alteredDate=0;var detected_lat=0;var detected_lng=0;var time = new Date;var timer=time.getTime();var width=window.innerWidth;var height=window.innerHeight;getloc(); function getloc(){if (navigator.geolocation) {    navigator.geolocation.getCurrentPosition(showPosition);} else{console.log("Location no supported");}}function showPosition(position){    detected_lat=position.coords.latitude;    detected_lng=position.coords.longitude;    $id('geo').value=detected_lat+','+detected_lng;}function showMenu(ob){if($id('flowOptions').style.display=='none'||$id('flowOptions').style.display==''){$id('flowOptions').style.display='block';}else{	$id('flowOptions').style.display='none';}var refer_dim=ob.getBoundingClientRect();{	$id('flowOptions').style.top=refer_dim.bottom+'px';	$id('flowOptions').style.right=(window.innerWidth-refer_dim.right)+'px';	}}function $id(id){	return document.getElementById(id);}function $name(name){	return document.getElementsByName(name)[0];}function output(msg){	console.log(msg);}function savecheck(){	if(($id('tarea').innerHTML).length>0)	{               unsaved=true;}            else{                      unsaved=false;            }}function getPlaceImage(coords,address){	var staticImage='https://maps.googleapis.com/maps/api/staticmap?center='+coords+'&zoom=15&size=300x300&maptype=roadmap&markers=color:blue%7Clabel:S%7C40.702147,-74.015794&markers=color:green%7Clabel:G%7C40.711614,-74.012318&markers=color:red%7Clabel:C%7C40.718217,-73.998284';	$id('tarea').style.backgroundImage='url('+staticImage+')';                  $id('tarea').style.backgroundPosition='bottom right';                  $id('tarea').style.backgroundRepeat='no-repeat';                  $id('tarea').style.backgroundSize='contain';                  document.cookie="userLocation="+coords+"; expires=Thu, 18 Dec 2013 12:00:00 UTC";	}function goTopage(ob){	window.location.href=ob.dataset.link;}function infoPaper(resource,title,frame){if(frame!=1){	$.get(resource,function(data,success)			{		$id('infoPaperContent').innerHTML=data;		$id('topstriptitle').innerHTML=title;			});}else{$id('infoPaperContent').innerHTML='<iframe id="infoPaperFrame"></iframe>';$id('infoPaperFrame').src=resource;$id('topstriptitle').innerHTML=title;}	$id('infoPaper').style.display='block';	var infoPaper = $id('infoPaper').getBoundingClientRect();	$id('infoPaper').style.left=(window.innerWidth/2)-(infoPaper.width/2)+'px';	$id('infoPaper').style.bottom=(window.innerHeight/2)-(infoPaper.height/2)+'px';	$id('infoPaperFrame').style.height=infoPaper.height-40+'px';	$id('infoPaperFrame').style.width=infoPaper.width-10+'px';}</script><style>    [contentEditable=true]:empty:not(:focus):before{        content:attr(data-text)    }    button    {        background: linear-gradient(#BBCAB4,#91B195);        border-radius: 1px;        display: table-cell;        color: #fff;        box-shadow: 1px 1px 2px #92AA88;        text-shadow: 1px 1px 5px #000;    }    button:hover    {    }    </style></head><body><div id="loading" class="spinner"></div><div class="topribbon"><span class="logo">Notes <sup>v3</sup></span><table align="right" cellspacing="4"><tr><td onclick="goTopage(this)" data-link="book.php">Read Notes</td><td onclick="showMenu(this)" data-link="paper.php">Menu</td>	<td onclick="goTopage(this)" data-link="logout.php">Logout</td></tr></table></div> <div class="paper" id="paper"><div id="filedrag" class="imgplace" ><center><span align="center" id="timedat" class="pholder">10 July 2015, 11:52 </span></center></div> <div data-text ="Type in something or drag and drop images here..."  id ="tarea" onkeyup ="savecheck();" contenteditable="true" placeholder="Typethings here" style="background:white; overflow-y: scroll; border-top: 1px double  yellowgreen;"></div><table align="center"><tr><td><button title="Save the note. (ctrl+s)" onclick="savenote()">Save Note<br><span class="buttonsubtext">ctrl+s</span></button></td><td><button value="0" title="Click to embed a location" onclick="" id="geo">Attach Location</button></td><td>    <input onchange="timeup(this);" type="hidden" id="hiddenField" class="datepicker" /><script>   $( "#hiddenField" ).datepicker({      showOn: "button",        buttonText: "Alter Date",        Title: "Change Date"    });    </script></td><td><button onclick="$('#fileselect').click();">Attach Images</button></td>	<input type="file" id="fileselect" name="fileselect[]" multiple="multiple"  style="visibility:hidden;"/></tr></table><script>/* * Global Variables */var alterDate=0;var counter = window.setInterval(function(){},1000);function timeup(alt){if(alt==null)return moment().format('Do  MMM. YYYY , HH:mm');else{    var val = moment(alt.value,'MM/DD/YYYY');    if(moment().format('DD-MM-YYYY')==val.format('DD-MM-YYYY'))        {      $id("timedat").innerHTML=moment().format('Do  MMM. YYYY , HH:mm');          alterDate=moment().format('YYYY-MM-DD H:mm:ss');        }        else            {    $id("timedat").innerHTML=val.format('Do  MMM. YYYY , HH:mm');    alterDate=val.format('YYYY-MM-DD H:mm:ss');    var ul=val.format(' Do  MMMM  YYYY');              notify("Date is changed to <strong>"+ul+'</strong>','happy','ext');            }}}$id("timedat").innerHTML=timeup();function savenote(){    var process_timer=15;    var warned=0;	var contents=$id("tarea").innerHTML;	if(contents=='')	{        notify('Nothing to save !');	return;	}	$id('loading').style.display='block';notey.post('feed.php',{contents:contents,timeid:timer,alterDate:alterDate,geolocation:detected_lat+','+detected_lng,		setglocation:$id("geo").value},function(data){//    if(data.status==404)//        {//      window.clearInterval(counter);//     process_timer=15;//      var image_Data='data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/PjxzdmcgaGVpZ2h0PSIzMnB4IiB2ZXJzaW9uPSIxLjEiIHZpZXdCb3g9IjAgMCAzMiAzMiIgd2lkdGg9IjMycHgiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6c2tldGNoPSJodHRwOi8vd3d3LmJvaGVtaWFuY29kaW5nLmNvbS9za2V0Y2gvbnMiIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIj48dGl0bGUvPjxkZXNjLz48ZGVmcy8+PGcgZmlsbD0ibm9uZSIgZmlsbC1ydWxlPSJldmVub2RkIiBpZD0iUGFnZS0xIiBzdHJva2U9Im5vbmUiIHN0cm9rZS13aWR0aD0iMSI+PGcgZmlsbD0iIzkyOTI5MiIgaWQ9Imljb24tMjAtc2FkLWZhY2UtZXllYnJvd3MiPjxwYXRoIGQ9Ik0xNi41LDI5IEMyMy40MDM1NTk3LDI5IDI5LDIzLjQwMzU1OTcgMjksMTYuNSBDMjksOS41OTY0NDAyOSAyMy40MDM1NTk3LDQgMTYuNSw0IEM5LjU5NjQ0MDI5LDQgNCw5LjU5NjQ0MDI5IDQsMTYuNSBDNCwyMy40MDM1NTk3IDkuNTk2NDQwMjksMjkgMTYuNSwyOSBMMTYuNSwyOSBaIE0xNi41LDI4IEMyMi44NTEyNzQ5LDI4IDI4LDIyLjg1MTI3NDkgMjgsMTYuNSBDMjgsMTAuMTQ4NzI1MSAyMi44NTEyNzQ5LDUgMTYuNSw1IEMxMC4xNDg3MjUxLDUgNSwxMC4xNDg3MjUxIDUsMTYuNSBDNSwyMi44NTEyNzQ5IDEwLjE0ODcyNTEsMjggMTYuNSwyOCBMMTYuNSwyOCBaIE0xNi40ODEzMjMyLDIxIEMxMywyMSAxMSwyMyAxMSwyMyBMMTEsMjIgQzExLDIyIDEzLDIwIDE2LjQ4MTMyMzIsMjAgQzE5Ljk2MjY0NjUsMjAgMjIsMjIgMjIsMjIgTDIyLDIzIEMyMiwyMyAxOS45NjI2NDY1LDIxIDE2LjQ4MTMyMzIsMjEgTDE2LjQ4MTMyMzIsMjEgWiBNMjAuNjIxNTIxMyw5Ljk2NzA5NTQxIEwyMC4wNjIzMjg0LDEwLjc5NjEzMyBMMjMuMzc4NDc4NywxMy4wMzI5MDQ2IEwyMy45Mzc2NzE2LDEyLjIwMzg2NyBMMjAuNjIxNTIxMyw5Ljk2NzA5NTQxIEwyMC42MjE1MjEzLDkuOTY3MDk1NDEgWiBNOS4wNjIzMjg0LDEyLjIwMzg2NyBMOS42MjE1MjEzMSwxMy4wMzI5MDQ2IEwxMi45Mzc2NzE2LDEwLjc5NjEzMyBMMTIuMzc4NDc4Nyw5Ljk2NzA5NTQxIEw5LjA2MjMyODQsMTIuMjAzODY3IEw5LjA2MjMyODQsMTIuMjAzODY3IFogTTEyLDE1IEMxMi41NTIyODQ4LDE1IDEzLDE0LjU1MjI4NDggMTMsMTQgQzEzLDEzLjQ0NzcxNTIgMTIuNTUyMjg0OCwxMyAxMiwxMyBDMTEuNDQ3NzE1MiwxMyAxMSwxMy40NDc3MTUyIDExLDE0IEMxMSwxNC41NTIyODQ4IDExLjQ0NzcxNTIsMTUgMTIsMTUgTDEyLDE1IFogTTIxLDE1IEMyMS41NTIyODQ4LDE1IDIyLDE0LjU1MjI4NDggMjIsMTQgQzIyLDEzLjQ0NzcxNTIgMjEuNTUyMjg0OCwxMyAyMSwxMyBDMjAuNDQ3NzE1MiwxMyAyMCwxMy40NDc3MTUyIDIwLDE0IEMyMCwxNC41NTIyODQ4IDIwLjQ0NzcxNTIsMTUgMjEsMTUgTDIxLDE1IFoiIGlkPSJzYWQtZmFjZS1leWVicm93cyIvPjwvZz48L2c+PC9zdmc+';//      var text='<div align="center"><img style="width:100px; height:100px;" src = '+image_Data+'></div><div style="font-family:"Segoe UI",arial,serif;" align="center" style="font-family:Arial,serif; font-size:18px; color:red;">Can\'t connect to the server !</div><p style="font-size:12px; color:blue;" align="center" style="font-family:"Segoe UI",arial,serif;">Seems as if, you are not connected to Internet.</p><div style="font-size:arial,serif; font-size:12px; text-align:center;" id="retry"></div>';//      notey.notify('',{iframe:false,text:text,width:500,height:250});//      	$id('loading').style.display='none';//         counter = window.setInterval(function(){//         if(process_timer==0)//         {//         $id('retry').innerHTML='Saving...';//         process_timer=15;//         savenote();//            }//        $id('retry').innerHTML="We'll retry saving in "+--process_timer+' seconds';//        },1000);//        }        if(data.status==200 && data.responseText==1)            {                window.clearInterval(counter);                if($id('uq'))                notey.eleRemove('uq');                newnote();            }            if(data.status==503)        {window.clearInterval(counter);      process_timer=15;      var image_Data='data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/PjxzdmcgaGVpZ2h0PSIzMnB4IiB2ZXJzaW9uPSIxLjEiIHZpZXdCb3g9IjAgMCAzMiAzMiIgd2lkdGg9IjMycHgiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6c2tldGNoPSJodHRwOi8vd3d3LmJvaGVtaWFuY29kaW5nLmNvbS9za2V0Y2gvbnMiIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIj48dGl0bGUvPjxkZXNjLz48ZGVmcy8+PGcgZmlsbD0ibm9uZSIgZmlsbC1ydWxlPSJldmVub2RkIiBpZD0iUGFnZS0xIiBzdHJva2U9Im5vbmUiIHN0cm9rZS13aWR0aD0iMSI+PGcgZmlsbD0iIzkyOTI5MiIgaWQ9Imljb24tMjAtc2FkLWZhY2UtZXllYnJvd3MiPjxwYXRoIGQ9Ik0xNi41LDI5IEMyMy40MDM1NTk3LDI5IDI5LDIzLjQwMzU1OTcgMjksMTYuNSBDMjksOS41OTY0NDAyOSAyMy40MDM1NTk3LDQgMTYuNSw0IEM5LjU5NjQ0MDI5LDQgNCw5LjU5NjQ0MDI5IDQsMTYuNSBDNCwyMy40MDM1NTk3IDkuNTk2NDQwMjksMjkgMTYuNSwyOSBMMTYuNSwyOSBaIE0xNi41LDI4IEMyMi44NTEyNzQ5LDI4IDI4LDIyLjg1MTI3NDkgMjgsMTYuNSBDMjgsMTAuMTQ4NzI1MSAyMi44NTEyNzQ5LDUgMTYuNSw1IEMxMC4xNDg3MjUxLDUgNSwxMC4xNDg3MjUxIDUsMTYuNSBDNSwyMi44NTEyNzQ5IDEwLjE0ODcyNTEsMjggMTYuNSwyOCBMMTYuNSwyOCBaIE0xNi40ODEzMjMyLDIxIEMxMywyMSAxMSwyMyAxMSwyMyBMMTEsMjIgQzExLDIyIDEzLDIwIDE2LjQ4MTMyMzIsMjAgQzE5Ljk2MjY0NjUsMjAgMjIsMjIgMjIsMjIgTDIyLDIzIEMyMiwyMyAxOS45NjI2NDY1LDIxIDE2LjQ4MTMyMzIsMjEgTDE2LjQ4MTMyMzIsMjEgWiBNMjAuNjIxNTIxMyw5Ljk2NzA5NTQxIEwyMC4wNjIzMjg0LDEwLjc5NjEzMyBMMjMuMzc4NDc4NywxMy4wMzI5MDQ2IEwyMy45Mzc2NzE2LDEyLjIwMzg2NyBMMjAuNjIxNTIxMyw5Ljk2NzA5NTQxIEwyMC42MjE1MjEzLDkuOTY3MDk1NDEgWiBNOS4wNjIzMjg0LDEyLjIwMzg2NyBMOS42MjE1MjEzMSwxMy4wMzI5MDQ2IEwxMi45Mzc2NzE2LDEwLjc5NjEzMyBMMTIuMzc4NDc4Nyw5Ljk2NzA5NTQxIEw5LjA2MjMyODQsMTIuMjAzODY3IEw5LjA2MjMyODQsMTIuMjAzODY3IFogTTEyLDE1IEMxMi41NTIyODQ4LDE1IDEzLDE0LjU1MjI4NDggMTMsMTQgQzEzLDEzLjQ0NzcxNTIgMTIuNTUyMjg0OCwxMyAxMiwxMyBDMTEuNDQ3NzE1MiwxMyAxMSwxMy40NDc3MTUyIDExLDE0IEMxMSwxNC41NTIyODQ4IDExLjQ0NzcxNTIsMTUgMTIsMTUgTDEyLDE1IFogTTIxLDE1IEMyMS41NTIyODQ4LDE1IDIyLDE0LjU1MjI4NDggMjIsMTQgQzIyLDEzLjQ0NzcxNTIgMjEuNTUyMjg0OCwxMyAyMSwxMyBDMjAuNDQ3NzE1MiwxMyAyMCwxMy40NDc3MTUyIDIwLDE0IEMyMCwxNC41NTIyODQ4IDIwLjQ0NzcxNTIsMTUgMjEsMTUgTDIxLDE1IFoiIGlkPSJzYWQtZmFjZS1leWVicm93cyIvPjwvZz48L2c+PC9zdmc+';      var text='<div align="center"><img style="width:100px; height:100px;" src = '+image_Data+'></div><div style="font-family:"Segoe UI",arial,serif;" align="center" style="font-family:Arial,serif; font-size:18px; color:red; text-align:justify;">Server went down to take a coin !</div><p style="font-size:12px; color:blue;" align="center" style="font-family:"Segoe UI",arial,serif;">We are fixing something up here. Your note will be saved in few moments.</p><div style="font-size:arial,serif; font-size:12px; text-align:center;" id="retry"></div>';      notey.notify('',{iframe:false,text:text,width:500,height:250});      	$id('loading').style.display='none';         counter = window.setInterval(function(){         if(process_timer==0)         {         $id('retry').innerHTML='Saving...';         savenote();            }        $id('retry').innerHTML="We'll retry saving in "+--process_timer+' seconds';        },1000);        }    });}function infoPaperHide(){	$id('infoPaper').style.display='none';}function newnote(){        window.clearInterval(counter);	$id('loading').style.display='none';        notify('Last note Saved :)','happy');	$id('tarea').innerHTML='';	savecheck();	timer++;        var i = 1;        while(typeof($id('slot+i'))!='undefined')            {                		$id("slot"+i++).remove();            }	$id("timedat").innerHTML=timeup();	}</script><table align="right" id="imlist"><tr  style="width:80px; height: 80px"  id="imgrow">        <script>            function imglist(data,name){//Recieves the data file and embed //        var td = document.createElement('td');        $id('imgrow').appendChild(td);        td.setAttribute('id','slot'+start++);        td.setAttribute('class','uploadslot');        td.style.backgroundImage='url('+data+')';        td.setAttribute('name',name);        td.setAttribute('data-uploaded','0');}            </script></tr></table><div align="center" id="geoimage"></div></div><form method="post" enctype="multipart/form-data" action="filecatch.php"><input style="display: none;" type="file" id="fileselect" name="fileselect[]" multiple="multiple" /><script type="text/javascript">var obpaper = document.getElementById('paper');var tarea  = document.getElementById('tarea');obpaper.style.width=width-300+'px';obpaper.style.height=height-200+'px';//ob dimensionsvar opdimen=obpaper.getBoundingClientRect();tarea.style.width=opdimen.width+'px';tarea.style.height=opdimen.height-300+'px';obpaper.style.top=(height/2)-(opdimen.height/2)+'px';obpaper.style.left=(width/2)-(opdimen.width/2)+'px';//Loading placements//loading obj. dimensionsvar loading=$id('loading').getBoundingClientRect();$id('loading').style.left=(window.innerWidth/2)-(loading.width/2)-10+'px';$id('loading').style.bottom=(window.innerHeight/2)-(loading.height/2)+'px';//Event listening for keyboard shortcutstarea.addEventListener('keydown',function(e){	if(e.ctrlKey&&e.keyCode==83)	{		e.preventDefault();		savenote();	}},false);</script><script src="fly.js"></script></form><script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>	<script src="lib/jquery.js"></script>	<script src="lib/jquery.locationpicker.js"></script>	<script>		$('#geo').locationPicker();	</script>        <div id="flowOptions" ><table width="100%">    <tr><td onclick="showMsg('albums.php',{title:'Photos',iframe:true}); showMenu(this);">Photos</td></tr>    <tr><td onclick="showMsg('mylinks.php',{title:'Links',iframe:true}); showMenu(this);">Links</td></tr><tr><td onclick="infoPaper('getpeople.php','Peoples',1)">Peoples</td></tr><tr><td onclick="infoPaper('info.php','Informations')">Informations</td></tr><tr><td onclick="showMsg('settings.php',{title:'Settings',iframe:true}); showMenu(this);">Settings</td></tr></table></div><div id="infoPaper"><div class="topstrip"><span id="topstriptitle"></span><div id="infoPaperClose" onclick="infoPaperHide();"><img style="width:20px; height:20px;" title="Close ! this thing" src="images/b_close.png"/></div></div><div id=infoPaperContent></div></div></div><script src="notify.js"></script></body></html>