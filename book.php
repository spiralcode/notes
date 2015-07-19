<!doctype html>
<html>
<head>
<link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="style/jquery-ui.css">
<script src="lib/moment.js"></script>
<script src="ajax_1_10_2.js"></script>
<script src="lib/jquery-1.10.2.js"></script>
  <script src="lib/jquery-ui.js"></script>
<title>Read your Notes</title>
<style type="text/css">
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
function goTopage(ob)
{
	console.log(ob.dataset.link);
	window.location.href=ob.dataset.link;
}
function showMenu(ob)
{
	console.log($id('flowOptions').style.display);
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
function infoPaper(resource)
{
	console.log(resource);
	$.get(resource,function(data,success)
			{
		$id('infoPaperContent').innerHTML=data;
			});
	$id('infoPaper').style.display='block';
	var infoPaper = $id('infoPaper').getBoundingClientRect();
	$id('infoPaper').style.left=(window.innerWidth/2)-(infoPaper.width/2)+'px';
	$id('infoPaper').style.bottom=(window.innerHeight/2)-(infoPaper.height/2)+'px';
}
function infoPaperHide()
{
	$id('infoPaper').style.display='none';
}
</script>

</head>
<body>

<div id="optionbar" class="optionbar">
<span class="logo">Notes <sup>v3</sup></span>
<table class="option" align="right" cellspacing="4"><tr><td onclick="goTopage(this)" data-link="paper.php">Add a note</td><td onclick="showMenu(this)" data-link="paper.php">Menu</td></tr></table>
<div align="center" id="searchoptions">
<table  border="0"><tr>
<td><input type="text" len="50" placeholder="Search " id="keyinput"/></td>
<td><input type="text" id="datepicker" onChange="datesearch(this)"></td>
<!--  <td id="yest" onclick="nav(this)" data-value=""><img src="images/arrow-left.png"></td>
<td id="tomm" onclick="nav(this)" data-value=""><img src="images/arrow-right.png"></td>
-->

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
				var hr = moment(json[init].ftime).format('h');
				var min = moment(json[init].ftime).format('m');
				var ap = moment(json[init].ftime).format('A');
				var date= moment(json[init].ftime).format('D');
				
				var mnth= moment(json[init].ftime).format('M');
				var year= moment(json[init].ftime).format('YYYY');
				if(date<10){date="0"+date;}
				if(mnth<10){mnth="0"+mnth;}	
				if(hr<10){hr="0"+hr;}
				if(min<10){min="0"+min;}
				var frmtime=hr+':'+min+' '+ap+' | '+date+'/'+mnth+'/'+year;


				/*Code for Moment ends*/
				
		var ele = json[init].content;
		
		var newob=document.createElement('div');
		$id('frameplace').appendChild(newob).setAttribute("id",ir);
		$id('frameplace').appendChild(newob).setAttribute("class","note");
		var imlist=' ';
		var imlistindex=0;
		var imgexist=false;
		while(typeof(json[init].ilist[0][imlistindex])!='undefined')
		{
			imlist+='<div class="imgspace"><a href="image.php?id='+json[init].ilist[0][imlistindex]+'" target="_blank"><img src="image.php?id='+json[init].ilist[0][imlistindex]+'&thumb&size=50x50"/></div>';
			imlistindex++;
		}
		$id(ir).innerHTML='<div class="timeslot">'+frmtime+'</div><div class="contentslot">'+ele+'</div>'+imlist;
		ir++;
		init++;
			}
		}
			});
}
</script>
</div>
<div id="flowOptions">
<table width="100%">
<tr><td onclick="infoPaper('info.php')">Informations</td></tr>
<tr><td onclick="infoPaper('settings.php')">Settings</td></tr>

</table>
</div>
<div id="infoPaper"><div id="infoPaperClose" onclick="infoPaperHide()">Close</div><div id=infoPaperContent></div></div>
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