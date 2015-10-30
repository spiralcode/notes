
<!doctype html>
<html>
<head><title>Make  a Draft</title>
 <script src="raid.js"></script>

<script src="ajax_1_10_2.js"></script>
<script src="notify.js"></script>

<script src="notey.js"></script>

  <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="raid.css">
<link rel="stylesheet" href="notify.css">

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
function saveDraft()
{
    var content =$id('writeArea').innerHTML;
    notey.post('feedDraft.php',{contents:content},function(data)
    {
        console.log(data.responseText);
        if(data.responseText==1)
            {
                notey.notify('',{iframe:false,text:"Saved",width:600});
            }
    });
}
function clearDraft()
{
    $id('writeArea').innerHTML = "";
}
  function fileList(data,name)
{
//Recieves the data file and embed 
//
        var td = document.createElement('div');
        $id('attachArea').appendChild(td);
        td.setAttribute('id','slot'+start++);
        td.setAttribute('class','uploadslot');
        //td.style.backgroundImage='url('+data+')';
        td.innerHTML=name;
        td.setAttribute('name',name);
        td.setAttribute('data-uploaded','0');
        td.setAttribute('class','item');
}
</script>

<style>
    [contentEditable=true]:empty:not(:focus):before{
        content:attr(data-text)
    }
    button
    {

    }
    button:hover
    {
    }
    #typeArea
    {
    }
    .draftWorkSpace
    {
        position: relative;
        height: 93vh;
       top: 5vh;
    }
    .topribbon
    {
        height: 5vh;
        font-size: 1em;
    }
    .topribbon tr td {
    height: 4vh;
    }
    .draftWorkSpace .writeArea
    {
        position: absolute;
        width: 49.5%;
        height: 100%;
        left: 0px;
background: rgba(0, 0, 0, 0.09);
box-shadow: 0px 0px 2px black;
overflow-y: scroll;

    }
        .draftWorkSpace .attachArea
    {
        position: absolute;
        width: 49.5%;
        height: 50%;
        background: #000000;
        right: 0px;
background: rgba(0, 0, 0, 0.09);
box-shadow: 0px 0px 2px black;


    }
            .draftWorkSpace .buttonArea
    {
        position: absolute;
        width: 49.5%;
        height: 50%;
        right: 0px;
top: 50%;


    }
            .draftWorkSpace .attachArea .item
    {
float: left;
min-width: 150px;
min-height: 150px;
font-size: 13px;
font-family: Arial,serif;
border: 1px solid #0782C1;
    }
                .draftWorkSpace .attachArea .uploaded
    {
position: relative;
float: left;
min-width: 150px;
min-height: 150px;
border: 1px solid #0782C1;
font-size: 13px;
font-family: Arial,serif;
border: 1px solid #0782C1;
line-height: 150px;
overflow-wrap:break-word;
    }
    </style>
</head>
<body>
<input type="file" id="fileselect" name="fileselect[]" multiple="multiple"  style="display: none;"/>
<div id="loading" class="spinner"></div>
<div class="topribbon" id="topribbon"><span class="logo">Notes <sup>draft</sup></span>
<table align="right" cellspacing="4"><tr><td onclick="goTopage(this)" data-link="book.php">Read Notes</td><td onclick="showMenu(this)" data-link="paper.php">Menu</td>	<td onclick="goTopage(this)" data-link="logout.php">Logout</td></tr></table>
</div> 
<div id="infoPaper"><div class="topstrip" id="topstrip"><span id="topstriptitle"></span><div id="infoPaperClose" onclick="infoPaperHide();"><img style="width:20px; height:20px;" title="Close ! this thing" src="images/b_close.png"/></div></div><div id=infoPaperContent></div></div></div>
<div id="flowOptions" >
<table width="100%">
<tr><td onclick="showMsg('albums.php',{title:'Albums',iframe:true}); showMenu(this);">Photos</td></tr>
<tr><td onclick="showMsg('mylinks.php',{title:'Links',iframe:true}); showMenu(this);">Links</td></tr>
<tr><td onclick="showMsg('peoples.php',{title:'Peoples',iframe: true}); showMenu(this);">Peoples</td></tr>
<tr><td onclick="showMsg('info.php',{title:'Informations',iframe: false}); showMenu(this);">Informations</td></tr>
<tr><td onclick="showMsg('settings.php',{title:'Settings',iframe:true}); showMenu(this);">Settings</td></tr>
</table>
</div>
<div class="draftWorkSpace">
<div id="writeArea" class="writeArea" contenteditable="true">
</div>
<div id="attachArea" class="attachArea"><div>File table, Files attached</div></div>
<div class="buttonArea">
    <button onclick="saveDraft();">Save</button>
    <button onclick="clearDraft();">New Draft</button>
        <button onclick="$id('fileselect').click();">Put Files</button>

</div>

</div>
<script src="uploadScript.js"></script>

</body>
</html>