<!doctype html>
<html>
<head>
  <link rel="stylesheet" href="style/jquery-ui.css">
<script src="lib/moment.js"></script>
<script src="lib/jquery-1.10.2.js"></script>
  <script src="lib/jquery-ui.js"></script>
<title>Read your Notes</title>
<style type="text/css">
body
{
background:black;
background-image:url(images/intro_image.jpg);
background-attachment:fixed;
background-repeat:no-repeat;
background-size:cover;
}
.optionbar
{
position:fixed;
top:0px;
left:0px;
width:10px;
height:80px;
background-image:url(images/tile6.png);
z-index:100;
}
.frameplace
{
position:absolute;
top:80px;
width:70%;
margin-left:15%;
}
#searchoptions
{
position:absolute;
bottom:0px;
}
input
{
font-size:20px;
}
#optionbar img
{
font-family:arial,serif;
width:50px;
height:50px;
}
#optionbar td:hover
{
background:#9C9DA5;
cursor:pointer;
}
.nonote
{
position:relative;
	width:98%;
	//background:#4F6034;
	color:#fff;
	font-family:Arial,serif;
	border-radius:2px;
	background:#A8BBFF;
	text-align:center;
}
.note
{
position:relative;
	width:98%;
	min-height:150px;
	color:#fff;
	font-family:Arial,serif;
	border-radius:2px;
	background-image:url(images/tile.png);
	box-shadow:1px 1px 5px #6D7463;
	overflow:auto;
	margin-top:1%;
	
}
.note .timeslot
{
position:relative;
top:0px;
right:1px;
text-align:right;
color:#7190D0;
font-size:13px;

}
.note .contentslot
{
position:relative;
margin:1%;
width:98%;

}
.note .imgspace
{
position:relative;
float:left;
bottom:1px;
margin:5px;
}

.note .imgspace img
{
width:60px;
height:60px;
  border-radius: 5px 20px 5px;

}

input
{
border:none;
border-radius:2px;
outline:none;
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

</script>

</head>
<body>
<div id="optionbar" class="optionbar">
<div align="center" id="searchoptions">
<table  border="0"><tr>
<td><input type="text" len="50" placeholder="Search " id="keyinput"/></td>
<td><input type="text" id="datepicker" onChange="datesearch(this)"></td>
<!--  <td id="yest" onclick="nav(this)" dThankata-value=""><img src="images/arrow-left.png"></td>
<td id="tomm" onclick="nav(this)" data-value=""><img src="images/arrow-right.png"></td>
-->

</tr></table></div>
</div>
<div id="frameplace" class="frameplace"><script>

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
	var init=0;
	$.get(url,function(data,success)
			{
		console.log(data);
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
			imlist+='<div class="imgspace"><a href="image.php?id='+json[init].ilist[0][imlistindex]+'" target="_blank"><img src="image.php?id='+json[init].ilist[0][imlistindex]+'"/></div>';
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

<script>
$(function() {
    $( "#datepicker" ).datepicker(
    		{
    	dateFormat: "dd-mm-yy"		
    		}
    	    );
    
  });
datesearch($id('datepicker').value,true);

$id('optionbar').style.width=window.innerWidth+'px';
$id('searchoptions').style.width=window.innerWidth+'px';


</script>
</body>
</html>