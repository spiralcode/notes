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
bodsy
{
    -webkit-animation:spin 8s linear  ;
    -moz-animation:spin 8s linear ;
    animation:spin 8s linear;
}
@-moz-keyframes spin { 100% { -moz-transform: rotate(360deg); } }
@-webkit-keyframes spin { 100% { -webkit-transform: rotate(360deg); } }
@keyframes spin { 100% { -webkit-transform: rotate(360deg); transform:rotate(360deg); } 
}
.note_settings_icon
{
    -webkit-animation:spin 8s linear infinite ;
    -moz-animation:spin 8s linear infinite;
    animation:spin 8s linear infinite;
}
@-moz-keyframes spin { 100% { -moz-transform: rotate(360deg); } }
@-webkit-keyframes spin { 100% { -webkit-transform: rotate(360deg); } }
@keyframes spin { 100% { -webkit-transform: rotate(360deg); transform:rotate(360deg); } 
}
.autoFillList
{
    position:fixed;
    background: #fff;
    color: #093658;
    font-size: 20px;
    cursor: pointer;
    box-shadow: 0px 0px 1px #000;
        display:table;

}
.autoFillList div
{
background: rgba(174, 205, 179, 0.3);width: 100%;
        cursor: pointer;
        width: 100%;
        position: relative;
}
.personInfo
{
position: relative;
left: 1%;
top: 5px;
width: 80%;
height: 80%;
border-radius: 5px;
text-align: left;

}
.personInfo #personName
{
    font-size: 50px;
    color: darkblue;
}
.personInfo #relation
{
    font-size: 20px;
    text-align: center;
    margin: 5%;

}

.personInfo #counts
{
    text-align: center;
    font-size: 20px;
        margin: 5%;

}
.personInfo #placeBox
{
    text-align: center;
    font-size: 20px;
        margin: 5%;
           border-spacing: 10px;


}
.personInfo #placeBox .placeBox_image
{
    text-align: center;
    font-size: 20px;
    margin: 1%;
        float: left;
        border-radius: 2px;
                   display: table-cell;
                   width: 200px;
                   height: 200px;


       
}
.personInfo #placeBox .placename
{
  position: relative;
  bottom: 0px;
  width: 90%;
  text-align: center;
  left: 5%;
  font-size: 12px;
  font-family: Arial,serif;
  color:slateblue;
}
</style>
<script>
var ir=0;
 var count = 0;

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

function noteOptions(ob)
{
var div = document.createElement('div');
document.getElementsByTagName('body')[0].appenChild(div);
div.setAttribute('class','noteOpt');
div.innerHTML="Some Options";
var referObjectDimen = ob.getBoundingClientRect();
div.style.top=referObjectDimen.bottom;
}
</script></head>
<body>
<div id="optionbar" class="optionbar">
<span class="logo">Notes <sup>v3</sup></span>
<table class="option" align="right" cellspacing="4"><tr>
<td onclick="goTopage(this);" data-link="paper.php">Add a note</td>
<td onclick="showMenu(this);" data-link="paper.php" id="menuroot">Menu</td>
<td onclick="goTopage(this);" data-link="logout.php">Logout</td>
</tr></table>
<div align="center" id="searchoptions">
<table  border="0"><tr>
<td><input type="text" tabindex="2" len="50" onkeyup="autosearch();" placeholder="Search " id="keyinput"/></td>
<td><input type="text" id="datepicker" onChange="datesearch(this)"></td>
</tr></table></div>
</div>
<div class="notifcationArea">Hi, <span class="uname"><?php echo $_SESSION['uname']; ?></span></div>
<div id="loading" class="spinner"></div>
<div id="frameplace" class="frameplace">
<script>
    var r = 0;
$id('datepicker').value=moment().format('DD-MM-YYYY');
$id('keyinput').addEventListener('keyup',function(e)
		{
	if(e.keyCode===13)
	{
		showResult('gcow.php?q='+$id('keyinput').value);
	}
		},false);
function autosearch()
{
       if($id('keyinput').value[0]==='-'&&$id('keyinput').value.length>1)
       {
         notey.get('fetchPeoples.php?q='+$id('keyinput').value.substring(1),function(data){autoFillList(data.responseText);});
       }
    if(($id('keyinput').value).length%1===0&&($id('keyinput').value).length!=1)
        {
            showResult('gcow.php?q='+$id('keyinput').value);
        }
}
function autoFillList(data)
{
  if(document.getElementById('autoFillList'))
      {
          document.getElementById('autoFillList').remove();
      }
        var list = document.createElement('div');
    $id('optionbar').appendChild(list);
    list.setAttribute('class','autoFillList');
        list.setAttribute('id','autoFillList');

    var refer_Dimension=document.getElementById('keyinput').getBoundingClientRect();
list.focus();
        list.style.left=refer_Dimension.left+'px';
    list.style.top=(refer_Dimension.bottom+1)+'px';
        list.style.width=refer_Dimension.width+'px';
    var dec_data=JSON.parse(data);
    var i = 0;
    if(dec_data[i]!=null){    
        list.innerHTML=' ';
        while(dec_data[i]!=null)
        {
            list.innerHTML+='<div data-pid = '+dec_data[i].id+' onclick="personPage(this);">'+dec_data[i].name+'</div>';
            i++;
        }}
}
function personPage(ob)
{
 var PlaceList=new Array();
        $id('autoFillList').remove();
 var pid = ob.dataset.pid;
$id('frameplace').innerHTML='';
var ob = document.createElement('div');
$id('frameplace').appendChild(ob);
ob.setAttribute('class','personInfo');
ob.setAttribute('id','personInfo');
var pname = document.createElement('div');
$id('personInfo').appendChild(pname);
pname.setAttribute('id','personName');

var counts = document.createElement('div');
$id('personInfo').appendChild(counts);
counts.setAttribute('id','counts');

var relation = document.createElement('div');
$id('personInfo').appendChild(relation);
relation.setAttribute('id','relation');

var placeBox = document.createElement('div');
$id('personInfo').appendChild(placeBox);
placeBox.setAttribute('id','placeBox');


notey.get('fetchPerson.php?pid='+pid,function(data)
{
  var decData = JSON.parse(data.responseText);
   var name=decData.name;
      var relation=decData.relation;
      var noteCount=decData.noteCount;
            var gender=decData.gender;
            if(gender==0){var grammer='him';}else{var grammer='her';}
   $id('personName').innerHTML=name;
   if(relation!='')
            $id('counts').innerHTML='Your '+relation+', you mentioned '+noteCount+' times about '+grammer+' in your Notes';
        else
$id('counts').innerHTML='You mentioned '+noteCount+' times about '+grammer+' in your Notes';
if(decData.locationCount!=0)
$id('relation').innerHTML=decData.locationCount+" places been together.";
while(decData.locations[r]!=null)
 {
      notey.get('https://maps.googleapis.com/maps/api/geocode/json?latlng='+decData.locations[r]+'&key=AIzaSyA_HkUvZ2ncHBbYKvONx5jASKJ3T8djuTE',function(data)
    {
 var location = JSON.parse(data.responseText).results[0].geometry.location.lat+','+JSON.parse(data.responseText).results[0].geometry.location.lng;
        var staticImage='https://maps.googleapis.com/maps/api/staticmap?center='+location+'&zoom=15&size=180x180&maptype=roadmap&markers=color:blue%7Clabel:S%7C40.702147,-74.015794&markers=color:green%7Clabel:G%7C40.711614,-74.012318&markers=color:red%7Clabel:C%7C40.718217,-73.998284';
$id('placeBox').innerHTML+='<div class="placeBox_image"><img src = "'+staticImage+'"/><div id="place'+r+'" class="placename">'+JSON.parse(data.responseText).results[0].address_components[0].long_name+'</div></div>';
    });
    r++;
    }});}
function showResult(url)
{
$id('frameplace').innerHTML='';	
        $id('loading').style.display='block';
	var init=0;
	notey.get(url,function(data)
	{
        $id('loading').style.display='none';
        		var newob=document.createElement('div');
		$id('frameplace').appendChild(newob).setAttribute("id","error");
		$id('frameplace').appendChild(newob).setAttribute("class","nonote");
		var json=JSON.parse(data.responseText);
		if(json[0].status==0)
		{	
            var ele="Nothing found !";
            $id('error').innerHTML=ele;
		}
		else
		{     
               $id('frameplace').innerHTML='';
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
var image = 'data:image/png;base64,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';
$id(ir).innerHTML='<div title="Note Options" class="noteoptions" onclick="showOptions('+ir+')"><img class="note_settings_icon" style="width:20px; height:20px;" src = "'+image+'"/></div><div class="timeslot">'+frmtime+'</div><div class="contentslot">'+ele+'</div>'+imlist+'<div class="daysago">'+timeago+'</div>';
if(newob.getBoundingClientRect().height>200)
{
//Code for managing big over-sized notes
    }
var optEle=document.createElement('div');
$id('frameplace').appendChild(optEle);
var text = '<span onclick="deletenote(this);" data-noteid="'+noteid+'" data-divid="'+ir+'">Delete Note</span><span onclick="findPeople('+noteid+');">Extract people names</span>';
optEle.setAttribute('class','noteOptionSlider');
optEle.setAttribute('id',ir+'_opt');

optEle.innerHTML=text;ir++;
init++;}}
});}
function showOptions(id)
{
if($id(id+'_opt').style.display==='block')
{
//$id(id+'_opt').style.display='none';
  $( "#"+id+'_opt' ).effect( "blind", "slow",function() {$id(id+'_opt').style.display="none";} );
}
else{
  $( "#"+id+'_opt' ).effect( "bounce", "slow",function() {$id(id+'_opt').style.display="block";} );
            }
}
function findPeople(noteId)
{
    notey.notify('search_people.php?noteid='+noteId,{iframe:true,title:"Fetch people"});
}
function deletenote(ob)
{
	var noteID=ob.dataset.noteid;
      var image_Data='data:image/png;base64,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';
        var text='<div align="center"><img  style="wdith:40px; height:40px;" src = '+image_Data+'></div><div style="font-size:18px; color:red; text-align:center; font-family:\'Segoe UI\',arial,serif;" align="center">Are you sure ?</div><div style="font-size:14px; color:blue; font-family:\'Segoe UI\',Arial; text-align:justify;"><ul><li>Once deleted the note is not recoverable</li><li>All images linked with this note will be deleted</li><li>Unlimited number of notes can be saved.</li></div>';
        notey.notify('',{iframe:false,text:text,width:600,height:0,confirm:true},function(status)
        {
            if(status)
                {
           notey.post('deletenote.php',{id: noteID},function(data)
{if(data.responseText==='1'){
       $('#'+ob.dataset.divid).delay(500).fadeOut(1000);
   $('#'+ob.dataset.divid+'_opt').delay(500).fadeOut(1000);
        }
				else
				{
var image_Data='data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/PjxzdmcgaGVpZ2h0PSIzMnB4IiB2ZXJzaW9uPSIxLjEiIHZpZXdCb3g9IjAgMCAzMiAzMiIgd2lkdGg9IjMycHgiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6c2tldGNoPSJodHRwOi8vd3d3LmJvaGVtaWFuY29kaW5nLmNvbS9za2V0Y2gvbnMiIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIj48dGl0bGUvPjxkZXNjLz48ZGVmcy8+PGcgZmlsbD0ibm9uZSIgZmlsbC1ydWxlPSJldmVub2RkIiBpZD0iUGFnZS0xIiBzdHJva2U9Im5vbmUiIHN0cm9rZS13aWR0aD0iMSI+PGcgZmlsbD0iIzkyOTI5MiIgaWQ9Imljb24tMjAtc2FkLWZhY2UtZXllYnJvd3MiPjxwYXRoIGQ9Ik0xNi41LDI5IEMyMy40MDM1NTk3LDI5IDI5LDIzLjQwMzU1OTcgMjksMTYuNSBDMjksOS41OTY0NDAyOSAyMy40MDM1NTk3LDQgMTYuNSw0IEM5LjU5NjQ0MDI5LDQgNCw5LjU5NjQ0MDI5IDQsMTYuNSBDNCwyMy40MDM1NTk3IDkuNTk2NDQwMjksMjkgMTYuNSwyOSBMMTYuNSwyOSBaIE0xNi41LDI4IEMyMi44NTEyNzQ5LDI4IDI4LDIyLjg1MTI3NDkgMjgsMTYuNSBDMjgsMTAuMTQ4NzI1MSAyMi44NTEyNzQ5LDUgMTYuNSw1IEMxMC4xNDg3MjUxLDUgNSwxMC4xNDg3MjUxIDUsMTYuNSBDNSwyMi44NTEyNzQ5IDEwLjE0ODcyNTEsMjggMTYuNSwyOCBMMTYuNSwyOCBaIE0xNi40ODEzMjMyLDIxIEMxMywyMSAxMSwyMyAxMSwyMyBMMTEsMjIgQzExLDIyIDEzLDIwIDE2LjQ4MTMyMzIsMjAgQzE5Ljk2MjY0NjUsMjAgMjIsMjIgMjIsMjIgTDIyLDIzIEMyMiwyMyAxOS45NjI2NDY1LDIxIDE2LjQ4MTMyMzIsMjEgTDE2LjQ4MTMyMzIsMjEgWiBNMjAuNjIxNTIxMyw5Ljk2NzA5NTQxIEwyMC4wNjIzMjg0LDEwLjc5NjEzMyBMMjMuMzc4NDc4NywxMy4wMzI5MDQ2IEwyMy45Mzc2NzE2LDEyLjIwMzg2NyBMMjAuNjIxNTIxMyw5Ljk2NzA5NTQxIEwyMC42MjE1MjEzLDkuOTY3MDk1NDEgWiBNOS4wNjIzMjg0LDEyLjIwMzg2NyBMOS42MjE1MjEzMSwxMy4wMzI5MDQ2IEwxMi45Mzc2NzE2LDEwLjc5NjEzMyBMMTIuMzc4NDc4Nyw5Ljk2NzA5NTQxIEw5LjA2MjMyODQsMTIuMjAzODY3IEw5LjA2MjMyODQsMTIuMjAzODY3IFogTTEyLDE1IEMxMi41NTIyODQ4LDE1IDEzLDE0LjU1MjI4NDggMTMsMTQgQzEzLDEzLjQ0NzcxNTIgMTIuNTUyMjg0OCwxMyAxMiwxMyBDMTEuNDQ3NzE1MiwxMyAxMSwxMy40NDc3MTUyIDExLDE0IEMxMSwxNC41NTIyODQ4IDExLjQ0NzcxNTIsMTUgMTIsMTUgTDEyLDE1IFogTTIxLDE1IEMyMS41NTIyODQ4LDE1IDIyLDE0LjU1MjI4NDggMjIsMTQgQzIyLDEzLjQ0NzcxNTIgMjEuNTUyMjg0OCwxMyAyMSwxMyBDMjAuNDQ3NzE1MiwxMyAyMCwxMy40NDc3MTUyIDIwLDE0IEMyMCwxNC41NTIyODQ4IDIwLjQ0NzcxNTIsMTUgMjEsMTUgTDIxLDE1IFoiIGlkPSJzYWQtZmFjZS1leWVicm93cyIvPjwvZz48L2c+PC9zdmc+';
var headline="Something happened, so wrong !";
var explain="Unable to delete that one, some un-expected error occured on course.";
var text='<div align="center"><img style="width:100px; height:100px;" src = '+image_Data+'></div><div style="font-family:"Segoe UI",arial,serif;" align="center" style="font-family:Arial,serif; font-size:18px; color:red; text-align:justify;">'+headline+'</div><p style="font-size:12px; color:blue;" align="center" style="font-family:"Segoe UI",arial,serif;">'+explain+'</p><div style="font-size:arial,serif; font-size:12px; text-align:center;" id="retry"></div>';
notey.notify('',{text:text,iframe:false,width:500,height:0});}
			});}});
}
</script>
</div>
<div id="flowOptions" >
<table width="100%">
<tr><td onclick="showMsg('albums.php',{title:'Albums',iframe:true}); showMenu(this);">Photos</td></tr>
<tr><td onclick="showMsg('mylinks.php',{title:'Links',iframe:true}); showMenu(this);">Links</td></tr>
<tr><td onclick="showMsg('peoples.php',{title:'Peoples',iframe: true}); showMenu(this);">Peoples</td></tr>
<tr><td onclick="showMsg('info.php',{title:'Informations',iframe: false}); showMenu(this);">Informations</td></tr>
<tr><td onclick="showMsg('settings.php',{title:'Settings',iframe:true}); showMenu(this);">Settings</td></tr>
</table>
</div>
<div id="infoPaper"><div class="topstrip"><span id="topstriptitle"></span><div id="infoPaperClose" onclick="infoPaperHide();"><img style="width:20px; height:20px;" title="Close ! this thing" src="images/b_close.png"/></div></div><div id=infoPaperContent></div></div>
<script>
$(function() {
    $( "#datepicker" ).datepicker(
    		{
    	dateFormat: "dd-mm-yy"		
});
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