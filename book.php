<?php 
include 'session_check.php';
?>
<!doctype html>
<html>
<head>
<script src="lib/moment.js"></script>
<script src="ajax_1_10_2.js"></script>
<script src="lib/jquery-1.10.2.js"></script>
  <script src="lib/jquery-ui.js"></script>
  <script src="notey.js"></script>

     <script src="raid.js"></script>
<link rel="stylesheet" href="raid.css"/>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="style/jquery-ui.css">
  
<title>Read your Notes</title>
<style type="text/css">
input
{
font-size:18px;
}
</style>
<script>
var ir=0;

function $id(id)
{
	return document.getElementById(id);
}

function datesearch(ob,init)
{
	
	if(init){
	showResult('search.php?date='+ob);}
	else{
	showResult('search.php?date='+ob.value);}	
}
function nav(nav)
{
	var datenew=new Date(nav.dataset.value);
	var year=datenew.getUTCFullYear(),month=datenew.getMonth(),date=datenew.getDate();
	if(month<10){month="0"+month;}
	if(date<10){date="0"+date;}
	var finput = year+"-"+month+"-"+date;
	$id('datepicker').value=finput;
	//$id("frame").src='search.php?date='+nav.dataset.value;
	showResult('search.php?date='+nav.dataset.value);
	$id("yest").dataset.value=passby(nav.dataset.value,(-1));
	$id("tomm").dataset.value=passby(nav.dataset.value,(1));
	
}
function unix2local(unix)
{
	var date = new Date(unix);
	// hours part from the timestamp
	var date1 = date.getDate();
	if(date1<10){date1="0"+date1;}
	// minutes part from the timestamp
	var month = date.getMonth();
	if(month<10){month="0"+month;}
	
	// seconds part from the timestamp
	var year = date.getFullYear();
	
	return month+"-"+date1+"-"+year;
		
}
function passby(date,days)
{
var date = new Date(date);
var newdate = new Date(date);
newdate.setDate(newdate.getDate() + days);
var nd = new Date(newdate);
if(nd.getMonth()<10)
{
	var mnth='0'+nd.getMonth();
}
else
{
	var mnth=nd.getMonth();
	
}
if(nd.getDate()<10)
{
	var dt='0'+nd.getMonth();
}
else
{
	var mnth=nd.getMonth();
	
}
var frmt=nd.getUTCFullYear()+'-'+mnth+'-'+nd.getDate();
return frmt;
}
function goTopage(ob,target)
{
	window.location.href=ob.dataset.link;
}
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
function infoPaperHide()
{
	//$id('infoPaper').style.display='none';
                $('#infoPaper').delay(0).fadeOut(200);

}
function repos(ob)
{
	console.log(document.getElementById('menuroot').scrollTop);
	$id('flowoptions')
}
function noteOptions(ob)
{
    //Generate Div
var div = document.createElement('div');
document.getElementsByTagName('body')[0].appenChild(div);
div.setAttribute('class','noteOpt');
div.innerHTML="Some Options";
var referObjectDimen = ob.getBoundingClientRect();
div.style.top=referObjectDimen.bottom;

}
</script></head>
<body onscroll="repos(this);">
<div id="optionbar" class="optionbar">
<span class="logo">Notes <sup>v3</sup></span>
<table class="option" align="right" cellspacing="4"><tr>
	<td onclick="goTopage(this)" data-link="paper.php">Add a note</td>
<td onclick="showMenu(this)" data-link="paper.php" id="menuroot">Menu</td>
	<td onclick="goTopage(this)" data-link="logout.php">Logout</td>
</tr></table>
<div align="center" id="searchoptions">
<table  border="0"><tr>
<td><input type="text" len="50" onkeyup="autosearch();" placeholder="Search " id="keyinput"/></td>
<td><input type="text" id="datepicker" onChange="datesearch(this)"></td>
</tr></table></div>
</div>
<div id="loading" class="spinner"></div>

<div id="frameplace" class="frameplace">

<script>
$id('datepicker').value=moment().format('DD-MM-YYYY');
$id('keyinput').addEventListener('keyup',function(e)
		{
	if(e.keyCode==13)
	{
		showResult('gcow.php?q='+$id('keyinput').value);
	}
		},false);
function autosearch()
{
    if(($id('keyinput').value).length%1===0&&($id('keyinput').value).length!=1)
        {
   showResult('gcow.php?q='+$id('keyinput').value);
        }
}
function showResult(url)
{
	$id('loading').style.display='block';
	var init=0;
	notey.get(url,function(data)
			{$id('frameplace').innerHTML='';
        $id('loading').style.display='none';
		var json=JSON.parse(data.responseText);
		if(json[0].status==0)
		{	
            var ele='No results found !';
		var newob=document.createElement('div');
		$id('frameplace').appendChild(newob).setAttribute("id","error");
		$id('frameplace').appendChild(newob).setAttribute("class","nonote");		
		$id('error').innerHTML=ele;
		}
		else
		{
			while(typeof(json[init])!=='undefined')
			{
		/*Moment code starts*/
                var momentObject = moment(json[init].ftime);
				var hr = momentObject.format('hh');
				var min = momentObject.format('mm');
				var ap = momentObject.format('A');
				var date= momentObject.format('DD');
				var mnth= momentObject.format('MMMM');
				var year= momentObject.format('YYYY');
				var frmtime=hr+':'+min+' '+ap+' | '+date+' '+mnth+' '+year;

				
				var then = momentObject.format('D/M/YYYY HH:mm:ss');				
				var now=moment().format('D/M/YYYY HH:mm:ss');
				var millisec=moment(now,"D/M/YYYY HH:mm:ss").diff(moment(then,"D/M/YYYY HH:mm:ss"));
				var di = moment.duration(millisec);
                                                                       var minutes=di.asMinutes();
				var hoursago=(Math.floor(di.asHours()));
				var days=Math.round(hoursago/24);
                                timeago="";
                                if(minutes<15)
                                    {
                                        timeago="Now";
                                    }
                                    if(minutes>15&&minutes<60)
                                        {
                                            timeago="Some time before";
                                        }
                                        if(minutes>60&&minutes<120)
                                            {
                                                timeago= "1 hour before";
                                            }
                                            if(minutes>120&&minutes<(24*60))
                                            {
                                                timeago=Math.floor(minutes/60)+" hours before";
                                            }
                                            if(minutes>(24*60)&&minutes<(24*120))
                                            {
                                                timeago="A day before";
                                            }
                                            if(minutes>(24*120))
                                                {
                                                    timeago=Math.floor(((minutes/60)/24))+" days before";
                                                }
				
		var ele = json[init].content;
		var noteid=json[init].noteid;
		var newob=document.createElement('div');
		$id('frameplace').appendChild(newob).setAttribute("id",ir);
		$id('frameplace').appendChild(newob).setAttribute("class","note");
		var imlist=' ';
		var imlistindex=0;
		var imgexist=false;
		while(typeof(json[init].ilist[0][imlistindex])!=='undefined')
		{
	imlist+='<div class="imgspace"><a href="image.php?id='+json[init].ilist[0][imlistindex]+'" target="_blank"><img src="image.php?id='+json[init].ilist[0][imlistindex]+'&thumb&size=50x50"/></a></div>';
			imlistindex++;
		}
		$id(ir).innerHTML='<div title="Delete this note" data-noteid="'+noteid+'" data-divid='+ir+' class="noteoptions" onclick="deletenote(this)"><img style="width:20px; height:20px;" src = "images/Trash-empty-icon.png"/></div><div class="timeslot">'+frmtime+'</div><div class="contentslot">'+ele+'</div>'+imlist+'<div class="daysago">'+timeago+'</div>';
		ir++;
		init++;
			}
		}
			});
}
function deletenote(ob)
{
	var noteID=ob.dataset.noteid;
      var image_Data='data:image/png;base64,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';
        var text='<div align="center"><img src = '+image_Data+'></div><div style="font-size:18px; color:red; text-align:center; font-family:\'Segoe UI\',arial,serif;" align="center">Are you sure ?</div><div style="font-size:14px; color:blue; font-family:\'Segoe UI\',Arial; text-align:justify;"><ul><li>Once deleted the note is not recoverable</li><li>All images linked with this note will be deleted</li><li>We don\'t put a limit on the number of notes which you can save.</li></div>';
        notey.notify('',{iframe:false,text:text,width:600,height:0,confirm:true},function(status)
        {
            if(status)
                {
           notey.post('deletenote.php',{id: noteID},function(data)
			{if(data.responseText==='1'){
                       $('#'+ob.dataset.divid).delay(500).fadeOut(1000);}
				else
				{
var image_Data='data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/PjxzdmcgaGVpZ2h0PSIzMnB4IiB2ZXJzaW9uPSIxLjEiIHZpZXdCb3g9IjAgMCAzMiAzMiIgd2lkdGg9IjMycHgiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6c2tldGNoPSJodHRwOi8vd3d3LmJvaGVtaWFuY29kaW5nLmNvbS9za2V0Y2gvbnMiIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIj48dGl0bGUvPjxkZXNjLz48ZGVmcy8+PGcgZmlsbD0ibm9uZSIgZmlsbC1ydWxlPSJldmVub2RkIiBpZD0iUGFnZS0xIiBzdHJva2U9Im5vbmUiIHN0cm9rZS13aWR0aD0iMSI+PGcgZmlsbD0iIzkyOTI5MiIgaWQ9Imljb24tMjAtc2FkLWZhY2UtZXllYnJvd3MiPjxwYXRoIGQ9Ik0xNi41LDI5IEMyMy40MDM1NTk3LDI5IDI5LDIzLjQwMzU1OTcgMjksMTYuNSBDMjksOS41OTY0NDAyOSAyMy40MDM1NTk3LDQgMTYuNSw0IEM5LjU5NjQ0MDI5LDQgNCw5LjU5NjQ0MDI5IDQsMTYuNSBDNCwyMy40MDM1NTk3IDkuNTk2NDQwMjksMjkgMTYuNSwyOSBMMTYuNSwyOSBaIE0xNi41LDI4IEMyMi44NTEyNzQ5LDI4IDI4LDIyLjg1MTI3NDkgMjgsMTYuNSBDMjgsMTAuMTQ4NzI1MSAyMi44NTEyNzQ5LDUgMTYuNSw1IEMxMC4xNDg3MjUxLDUgNSwxMC4xNDg3MjUxIDUsMTYuNSBDNSwyMi44NTEyNzQ5IDEwLjE0ODcyNTEsMjggMTYuNSwyOCBMMTYuNSwyOCBaIE0xNi40ODEzMjMyLDIxIEMxMywyMSAxMSwyMyAxMSwyMyBMMTEsMjIgQzExLDIyIDEzLDIwIDE2LjQ4MTMyMzIsMjAgQzE5Ljk2MjY0NjUsMjAgMjIsMjIgMjIsMjIgTDIyLDIzIEMyMiwyMyAxOS45NjI2NDY1LDIxIDE2LjQ4MTMyMzIsMjEgTDE2LjQ4MTMyMzIsMjEgWiBNMjAuNjIxNTIxMyw5Ljk2NzA5NTQxIEwyMC4wNjIzMjg0LDEwLjc5NjEzMyBMMjMuMzc4NDc4NywxMy4wMzI5MDQ2IEwyMy45Mzc2NzE2LDEyLjIwMzg2NyBMMjAuNjIxNTIxMyw5Ljk2NzA5NTQxIEwyMC42MjE1MjEzLDkuOTY3MDk1NDEgWiBNOS4wNjIzMjg0LDEyLjIwMzg2NyBMOS42MjE1MjEzMSwxMy4wMzI5MDQ2IEwxMi45Mzc2NzE2LDEwLjc5NjEzMyBMMTIuMzc4NDc4Nyw5Ljk2NzA5NTQxIEw5LjA2MjMyODQsMTIuMjAzODY3IEw5LjA2MjMyODQsMTIuMjAzODY3IFogTTEyLDE1IEMxMi41NTIyODQ4LDE1IDEzLDE0LjU1MjI4NDggMTMsMTQgQzEzLDEzLjQ0NzcxNTIgMTIuNTUyMjg0OCwxMyAxMiwxMyBDMTEuNDQ3NzE1MiwxMyAxMSwxMy40NDc3MTUyIDExLDE0IEMxMSwxNC41NTIyODQ4IDExLjQ0NzcxNTIsMTUgMTIsMTUgTDEyLDE1IFogTTIxLDE1IEMyMS41NTIyODQ4LDE1IDIyLDE0LjU1MjI4NDggMjIsMTQgQzIyLDEzLjQ0NzcxNTIgMjEuNTUyMjg0OCwxMyAyMSwxMyBDMjAuNDQ3NzE1MiwxMyAyMCwxMy40NDc3MTUyIDIwLDE0IEMyMCwxNC41NTIyODQ4IDIwLjQ0NzcxNTIsMTUgMjEsMTUgTDIxLDE1IFoiIGlkPSJzYWQtZmFjZS1leWVicm93cyIvPjwvZz48L2c+PC9zdmc+';
var headline="Something happened, so wrong !";
var explain="Unable to delete that one, some un-expected error occured on course.";
var text='<div align="center"><img style="width:100px; height:100px;" src = '+image_Data+'></div><div style="font-family:"Segoe UI",arial,serif;" align="center" style="font-family:Arial,serif; font-size:18px; color:red; text-align:justify;">'+headline+'</div><p style="font-size:12px; color:blue;" align="center" style="font-family:"Segoe UI",arial,serif;">'+explain+'</p><div style="font-size:arial,serif; font-size:12px; text-align:center;" id="retry"></div>';
notey.notify('',{text:text,iframe:false,width:500,height:0});}
			});
                }
                    
        });
}
</script>
</div>
<div id="flowOptions" >
<table width="100%">
    <tr><td onclick="showMsg('albums.php',{title:'Albums',iframe:true}); showMenu(this);">Photos</td></tr>
    <tr><td onclick="showMsg('mylinks.php',{title:'Links',iframe:true}); showMenu(this);">Links</td></tr>
<tr><td onclick="infoPaper('getpeople.php','Peoples',1)">Peoples</td></tr>

<tr><td onclick="infoPaper('info.php','Informations')">Informations</td></tr>
<tr><td onclick="showMsg('settings.php',{title:'Settings',iframe:true}); showMenu(this);">Settings</td></tr>

</table>
</div>

<div id="infoPaper"><div class="topstrip"><span id="topstriptitle"></span><div id="infoPaperClose" onclick="infoPaperHide()"><img style="width:20px; height:20px;" title="Close ! this thing" src="images/b_close.png"/></div></div><div id=infoPaperContent></div></div>
<script>
$(function() {
    $( "#datepicker" ).datepicker(
    		{
    	dateFormat: "dd-mm-yy"		
    		}
    	    );
    
  });
datesearch($id('datepicker').value,true);

var searchoptions_dim = $id('searchoptions').getBoundingClientRect();
$id('searchoptions').style.left=(window.innerWidth/2)-(searchoptions_dim.width/2)+'px';

var loading = $id('loading').getBoundingClientRect();
$id('loading').style.left=(window.innerWidth/2)-(loading.width/2)+'px';
$id('loading').style.bottom=(window.innerHeight/2)-(loading.height/2)+'px';


</script>
</body>
</html>