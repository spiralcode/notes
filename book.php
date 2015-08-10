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
<td><input type="text" len="50" placeholder="Search " id="keyinput"/></td>
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
function showResult(url)
{
	
	$id('frameplace').innerHTML='';
	$id('loading').style.display='block';
	
	var init=0;
	$.get(url,function(data,success)
			{
		$id('loading').style.display='none';
		
		var json=JSON.parse(data);
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
			while(typeof(json[init].content)!='undefined')
			{
		/*Moment code starts*/
				var hr = moment(json[init].ftime).format('hh');
				var min = moment(json[init].ftime).format('mm');
				var ap = moment(json[init].ftime).format('A');
				var date= moment(json[init].ftime).format('DD');
				
				var mnth= moment(json[init].ftime).format('M');
				var year= moment(json[init].ftime).format('YYYY');
				var frmtime=hr+':'+min+' '+ap+' | '+date+'/'+mnth+'/'+year;

				
				var then = moment(json[init].ftime).format('D/M/YYYY HH:mm:ss');				
				var now=moment().format('D/M/YYYY HH:mm:ss');
				var millisec=moment(now,"D/M/YYYY HH:mm:ss").diff(moment(then,"D/M/YYYY HH:mm:ss"));
				var di = moment.duration(millisec);
				var hoursago=(Math.floor(di.asHours()));
				var days=Math.round(hoursago/24);
				if(hoursago<24)
				{
				var timeago=hoursago+" hours before";
					if(hoursago<1&&hoursago>.5)
					{
						timeago="Now"
					}
				if(hoursago<1&&hoursago<.1)
				{
				timeago="Just now"
				}
				}
				else
				{
					if((hoursago>=24)&&(days==1))
					{
					var timeago=days+" day ago";			
					}
					else
					{
					var timeago=days+" days ago";				
					}
				}

				/*Code for Moment ends*/
				
		var ele = json[init].content;
		var noteid=json[init].noteid;
		var newob=document.createElement('div');
		$id('frameplace').appendChild(newob).setAttribute("id",ir);
		$id('frameplace').appendChild(newob).setAttribute("class","note");
		var imlist=' ';
		var imlistindex=0;
		var imgexist=false;
		while(typeof(json[init].ilist[0][imlistindex])!='undefined')
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
	if(confirm("Please be sure about your decision!\n * This note is not recoverable after deletion.\n* All images linked to the note will be deleted.\n"))
	{
		$.post('deletenote.php',
			{
				id: noteID
			},function(data,success)
			{
				if(data=='1')
				{
					//$id(ob.dataset.divid).style.display="none";
                                                        $('#'+ob.dataset.divid).delay(500).fadeOut(1000);

				}
				else
				{
					alert("We faced some errors on deletion !, please try again.");
				}
			});
	}
	else
	{
		return;
	}
}
</script>
</div>
<div id="flowOptions">
<table width="100%">
<tr><td onclick="infoPaper('info.php','Informations')">Informations</td></tr>
<tr><td onclick="infoPaper('settings.php','Settings')">Settings</td></tr>
<tr><td onclick="infoPaper('getpeople.php','People and Places',1)">Fetch People or Places</td></tr>

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