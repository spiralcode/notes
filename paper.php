<?php
include 'session_check.php';
require_once 'Mobile_Detect.php';
$detect = new Mobile_Detect;
if ( $detect->isMobile() &&isset($_GET['web'])!=true) {
 header('location: way/home.php');
return;
}
?>
<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <link id="favicon" rel="shortcut icon" href="favicon.png" type="image/png" />
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Notes Go</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/skeleton.css">
        <link rel="stylesheet" href="css/loader.css">
        <link rel="stylesheet" href="css/animate.css">
        <script src="js/vendor/modernizr-2.8.3.min.js"></script>
        <script src="notey.js"></script>
        <script src="jss/general.js"></script>
        <script src="jss/fly.js"></script>
        <script src="jss/moment.js"></script>
        <script src="jss/image.js"></script>
        <script src="ajax_1_10_2.js"></script>
        <script src="lib/jquery-1.10.2.js"></script>
        <script src="lib/jquery-ui.js"></script>
<!--Location Codes-->
<link type="text/css" rel="stylesheet" href="style/locationpicker.css" />
  <script src="lib/jquery.locationpicker.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
<link rel="stylesheet" href="style/jquery-ui.css">
<link rel="stylesheet" href="raid.css"/>
      <!--  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>-->
        <script>/*window.jQuery || document.write('<script src="js/vendor/jquery-1.11.3.min.js"><\/script>')*/</script>
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>
                <link rel="stylesheet" href="css/general.css">
                        <link rel="stylesheet" href="css/equip.css">
<style>
      [contentEditable=true]:empty:not(:focus):before {
content: attr(data-text);
}
  </style>
    </head>
    <body>
<script>
window.onbeforeunload = unloadPage;
</script>

       <!-- <div class="notificationContainer"></div>-->

        <div class="topribbon">Notes<div title="Logout & Account Informations" id="userOps"  onclick="builtMenu(this)" class="userInfo"><?php echo  $_SESSION['uname']; ?> <span style="color:rgb(180, 208, 208);
">&#x2193;</span></div></div>
        <script>
          gen.id('userOps').setAttribute( 'data-list','["Settings (BETA)","showSettings();","Informations","showInfo();", "Logout","window.location=\'logout.php\';"]');
          </script>
        <div id="titleBar_full" class="titleBar"><span id="titleBar_title"></span><span id="titleBar_options"></span></div>
      <div class="sideRack">
          
          <div class="searchNotes">
           <input id="keyWord" placeholder="Search for..." type="text" maxlength="100">
          <button id="searchButton" onclick="keyWordSearch();">Search Notes</button>
          <script>
            gen.id('keyWord').addEventListener('keyup',function(e){
           // if(gen.id('keyWord').value.length>2)
            // keyWordSearch();
             if(e.keyCode==13)
             keyWordSearch();
            });
            </script>
          </div>
          <div class="options">
            <ul id="mainOptions">
                    <li onclick="navigate(this);" data-task="addNote" data-label="htmls/addNote.php" data-title="Write Note">Add Note</li>
                  <li onclick="navigate(this);" data-task="searchNote" data-label="search.php?date=<?php date_default_timezone_set('Asia/Calcutta');
 echo date("d-m-Y"); ?>" data-title="Read Notes">Read Notes</li>
                     <li onclick="navigate(this);" data-task="files" data-label="fetch_albums.php" data-title="Files">Files</li>
                     <li onclick="navigate(this);" date-task="peoples"  data-label="ppl.html" data-title="Peoples">People</li>
                     <li onclick="navigate(this);" data-task="links"  data-label="links.php?limit=20,0" data-title="Links">Links</li>
                     <li onclick="navigate(this);" data-task="places"  data-label="fetchPlaces.php" data-title="Places">Places</li>
                    <li onclick="window.open('draw','_blank');" data-task="draw" title="Freedom Of Expression"  data-label="draw.php" data-title="Freeedom of Expression">F.O.E</li>

           </div>
            <div class="louis" id="louis">
           <div id="louis_load" class="spinner" style="" >
             </div>
              <span id="louis_talk"></span>
              </div>
<div class="companyPanel">About | Help | Contact<br> 
  &copy; of  Nobody 2015-2016
</div>
      </div>
      
        <div id="contentPlace" class="contentPlace" align="center" >

<div id="iQ"><table><tr id="iQlist"></tr></table>
</div>
</div>
<script>
  //AutoLoad Function

/*
Globals
*/
var searchFocus="";
var state = null;
var timer=(new Date).getTime();
var task = "";
    function navigate(ob)
    {
      state = ob;
      louis('Loading...',true);
    highlightSelection(ob);
notey.get(ob.dataset.label,function(data){
      louis(' ',false);
           gen.id('titleBar_title').innerHTML=ob.dataset.title;
   if(ob.dataset.task=='addNote')
   {
     searchFocus="addNote";
      gen.id('titleBar_options').innerHTML="";
     task=ob.dataset.task;
     gen.id('searchButton').innerHTML="search notes";
        gen.id('contentPlace').innerHTML=data.responseText;
       if(window.File && window.FileList && window.FileReader)
	{
	init();
	}
       gen.id('noteDate').innerHTML=moment().format('Do  MMMM YYYY , HH:mm');
       gen.id('typeSpace').addEventListener('keydown',function(e){
           if(e.ctrlKey&&e.keyCode==83)
           {
               e.preventDefault();
               transferNote();
           }
       });
    $( "#cal" ).datepicker({ changeMonth: true,
      changeYear: true,onSelect:function(data){
      timeTasks(moment(data,"MM/DD/YYYY").unix());
      }});    
      $('#fetchTheCoords').locationPicker();
   }
   else if(ob.dataset.task=='searchNote')
   {
          searchFocus="addNote";
     fileBuffer=[];
     locBuffer=[];
      gen.id('titleBar_options').innerHTML="<input  onchange=\"notesByDate(moment(this.value,'YYYY-MM-D').unix());\"  type=\"date\" value=\""+moment.unix(new Date/1000).format('YYYY-MM-DD')+"\"/>";
          task=ob.dataset.task;
     gen.id('searchButton').innerHTML="Search Notes";
       gen.id('contentPlace').innerHTML="";
var decoded = JSON.parse(data.responseText);
var start = 0;
while(decoded[start]!=null)
{
resultDisplay(decoded[start]);
start++;
}
   }
   else if(ob.dataset.task=='links')
   {
     searchFocus="links";
     fileBuffer=[];
     locBuffer=[];
gen.id('titleBar_options').innerHTML="";
task=ob.dataset.task;
gen.id('searchButton').innerHTML="search links";
 gen.id('contentPlace').innerHTML="";
 var decoded = JSON.parse(data.responseText);
 var start=0;
  if(decoded[start]==null)
 {
      var noLink = document.createElement('div');
      noLink.setAttribute('class','noFiles');
      noLink.innerHTML="No links are found, this might also happen if we've failed to crawl the link detected from your note. ";
      gen.id('contentPlace').appendChild(noLink);
 }
 while(decoded[start]!=null)
 {
   var link = document.createElement('div');
   
   var linkOpt = document.createElement('div');
   var titlePlace  = document.createElement('div');
   link.setAttribute('class','linkBox');
   link.setAttribute('id','link-'+decoded[start].id);
   linkOpt.setAttribute('class','linkOpt');
   titlePlace.setAttribute('class','titlePlace');
   titlePlace.innerHTML=decoded[start].title;
 var opt = document.createElement('span');
  opt.setAttribute('onclick','builtMenu(this)');
 opt.setAttribute('data-list','["delete","deleteLink('+decoded[start].id+');"]');
 opt.innerHTML="Option";
   linkOpt.appendChild(opt);
   link.appendChild(linkOpt);
   link.appendChild(titlePlace);
   var cast = 'window.open(\''+decoded[start].url+'\',\'_blank\')';
       titlePlace.setAttribute('onclick',cast);
      link.setAttribute('title',decoded[start].title);
   gen.id('contentPlace').appendChild(link);
   start++;
 }
   }
   else if(ob.dataset.task=='files')
   {
     fileBuffer=[];
     locBuffer=[];
  searchFocus="files";
  gen.id('titleBar_options').innerHTML="<span style=\"cursor:pointer;\" onclick=\"notey.notify('createImageFolder.php',{iframe:false,title:'Create Folder',width:400,height:0});\"> + create new folder</span>";
  task=ob.dataset.task;
gen.id('searchButton').innerHTML="Search files";
 gen.id('contentPlace').innerHTML="";
 var decoded = JSON.parse(data.responseText);
 folderDisplay(decoded);
   }
      else if(ob.dataset.task=='places')
      {
     fileBuffer=[];
     locBuffer=[];
      gen.id('contentPlace').innerHTML="";
              gen.id('titleBar_options').innerHTML="";
      var decoded = JSON.parse(data.responseText);
     var start = 0;
      while(decoded[start]!=null)
      {
       showPlaces(decoded[start]);
       start++;
      }
      if(decoded.length==0)
      {
      var noLink = document.createElement('div');
      noLink.setAttribute('class','noFiles');
      noLink.innerHTML="No places are found embedded with any note of yours. ";
      gen.id('contentPlace').appendChild(noLink);
      }
      }
   else
   {
          searchFocus="addNote";
     fileBuffer=[];
     locBuffer=[];
        gen.id('titleBar_options').innerHTML="";
        gen.id('contentPlace').innerHTML='Development On-Course...<a href="book.php" target="_new">Try the old one </a>';
   }
});
gen.id('titleBar_title').innerHTML="Loading...";
    }
    function showPlaces(coords)
    {
      var div_surround  = document.createElement('div');
      var div = document.createElement('div');
      var options =document.createElement('div');
      var placeName = document.createElement('div');
      var placeName_address = document.createElement('div');
            placeName_address.setAttribute('class','address');
      div_surround.setAttribute('class','dvSurround');
      options.setAttribute('class','options');
      placeName.setAttribute('class','placeInfoName');
 placeName_address.innerHTML="Loading...";
      notey.get('https://maps.googleapis.com/maps/api/geocode/json?latlng='+coords+'&key=AIzaSyA_HkUvZ2ncHBbYKvONx5jASKJ3T8djuTE',function(data){
              var dec = JSON.parse(data.response);
              placeName_address.innerHTML=dec.results[0].formatted_address;
              div.setAttribute('title','Spot '+dec.results[0].formatted_address+' on Map');
              div.addEventListener('click',function(e){
window.open('https://www.google.com/maps/place/'+dec.results[0].formatted_address+'','_blank');
              });
      });
            placeName.appendChild(placeName_address);
      var option = document.createElement('span');
      option.setAttribute('data-list','["list notes from here","searchByLoc(this)"]');
      option.setAttribute('onclick','builtMenu(this)');
      option.innerHTML="Options";
      options.appendChild(option);
      div_surround.appendChild(options);
      div.setAttribute('class','placeP');
     var staticImage='https://maps.googleapis.com/maps/api/staticmap?center='+coords+'&zoom=16&size=400x160&maptype=roadmap&markers=color:blue%7Clabel:S%7C40.702147,-74.015794&markers=color:green%7Clabel:G%7C40.711614,-74.012318&markers=color:red%7Clabel:C%7C40.718217,-73.998284';
     div.style.background='url('+staticImage+')';
     div.style.backgroundRepeat="no-repeat";
     div.style.backgroundSize="contain";
     div_surround.appendChild(div);
     div_surround.appendChild(placeName);
      gen.id('contentPlace').appendChild(div_surround);
    }
    function resultDisplay(ob)
    {
      if(ob.status!=0){
    var note = document.createElement('div');
    var noteInfo = document.createElement('div');
    var contentSlot = document.createElement('div');
    var fileSlot = document.createElement('div');
    var dateDiff = document.createElement('div');
    var options = document.createElement('div');
    var option = document.createElement('span');
    var locationSlot = document.createElement('div');
option.setAttribute('class','option');
locationSlot.setAttribute('class','locationSlot');
var staticImage='https://maps.googleapis.com/maps/api/staticmap?center='+ob.geo+'&zoom=15&size=300x300&maptype=roadmap&markers=color:blue%7Clabel:S%7C40.702147,-74.015794&markers=color:green%7Clabel:G%7C40.711614,-74.012318&markers=color:red%7Clabel:C%7C40.718217,-73.998284';
var locationInfo = document.createElement('div');
var locationStamp = document.createElement('div');
locationInfo.setAttribute('class','loctionInfo');
locationInfo.innerHTML=ob.geo;
locationStamp.innerHTML='<img src = '+staticImage+'/>';
locationSlot.appendChild(locationInfo);
locationSlot.appendChild(locationStamp);
option.setAttribute('data-noteId',ob.noteid);
option.setAttribute('data-list','["delete","deleteNote('+ob.noteid+');","find people","findPeople('+ob.noteid+')"]');
option.addEventListener('click',function(e){builtMenu(this)});
option.innerHTML="Options";
options.appendChild(option);
options.setAttribute('class','options');
    note.setAttribute('class','note');
    note.setAttribute('id','note-'+ob.noteid);
    noteInfo.setAttribute('class','noteInfo');
    contentSlot.setAttribute('class','contentSlot');
    fileSlot.setAttribute('class','fileSlot');
    dateDiff.setAttribute('class','dateDiff');
 var un_conv = moment(ob.ftime,"YYYY-MM-DD HH:mm:ss").format('x');
 var millisec=moment(moment()).diff(moment(un_conv,'x'));
 dateDiff.innerHTML=howFar(millisec);
    noteInfo.innerHTML=moment(ob.ftime,'YYYY-MM-DD HH:mm:ss').format('Do  MMMM YYYY , HH:mm');  
    contentSlot.innerHTML=ob.content;
    var beg = 0;
    while(ob.ilist[0][beg]!=null)
    {
notey.get('fileInfo.php?id='+ob.ilist[0][beg],function(data){
var decoded = JSON.parse(data.responseText);
var div = document.createElement('div');
div.setAttribute('class','file');
div.innerHTML=decoded[0].realFileName;
div.setAttribute('title',decoded[0].realFileName);
div.style.background='url('+JSON.parse(icons).defaultfile+')';
div.style.backgroundSize='5em 5em';
div.style.backgroundRepeat='no-repeat';
div.setAttribute('data-id',decoded[0].id);
div.addEventListener('click',function(e){
  fileInfo(this);
});
fileSlot.appendChild(div);
      });

      beg++;
    }
    noteInfo.appendChild(options);

      note.appendChild(noteInfo);
      note.appendChild(dateDiff);
      note.appendChild(contentSlot);
     if(beg!=0){ 
      note.appendChild(fileSlot);
     }
//       if(ob.geo!='0,0')
       // note.appendChild(locationSlot);
  gen.id('contentPlace').appendChild(note);
      }
      else
      {
            var report = document.createElement('div');
              report.setAttribute('class','noNote');
              report.innerHTML="No Notes to show !";
                gen.id('contentPlace').appendChild(report);
      }
    }
    function folderDisplay(decoded)
    {
        gen.id('titleBar_options').innerHTML="<span style=\"cursor:pointer;\" onclick=\"notey.notify('createImageFolder.php',{iframe:false,title:'Create Folder',width:400,height:0});\"> + create new folder</span>";
       gen.id('contentPlace').innerHTML="";
 var start=0;
 if(decoded[start]==null)
 {
      var noLink = document.createElement('div');
      noLink.setAttribute('class','noFiles');
      noLink.innerHTML="No folders found !";
      gen.id('contentPlace').appendChild(noLink);
 }
 while(decoded[start]!=null)
 {
   var link = document.createElement('div');
   var linkOpt = document.createElement('div');
   var titlePlace  = document.createElement('div');
   var fileIcon = document.createElement('div');
   var fileCount = document.createElement('div');
  // fileIcon.style.background='url('+decoded[start].iconDefault+')';
   fileIcon.style.backgroundSize='2em  2em';
   fileIcon.style.backgroundRepeat='no-repeat';
   link.setAttribute('class','folder');
   linkOpt.setAttribute('class','fileOpt');
   fileIcon.setAttribute('class','fileIcon');
   titlePlace.setAttribute('class','filePlace');
      fileCount.setAttribute('class','fileCount');
   fileCount.innerHTML=decoded[start].count+' files';
   if(decoded[start].name.length<20)
   titlePlace.innerHTML=decoded[start].name;
   else
  titlePlace.innerHTML=decoded[start].name.substring(0,10)+'...'+(decoded[start].name.substring(decoded[start].name.length-5));
  link.setAttribute('data-id',decoded[start].id);
    link.addEventListener('click',function(e){fetchFile(this)});
   linkOpt.innerHTML="";
   link.appendChild(linkOpt);
   link.appendChild(titlePlace);
   link.appendChild(fileIcon);
   link.appendChild(fileCount);
   link.setAttribute('tabindex','-1');
   gen.id('contentPlace').appendChild(link);
   start++;
   }
    }
    function fileDisplay(decoded)
    { 
  gen.id('contentPlace').innerHTML="";
  gen.id('titleBar_options').innerHTML="<span style=\"cursor:pointer;\" onclick=\"fileSelect();\"> [ ] select files</span>";
 var start=0;
 if(decoded[start]==null)
 {
      var noLink = document.createElement('div');
      noLink.setAttribute('class','noFiles');
      noLink.innerHTML="No files found !";
      gen.id('contentPlace').appendChild(noLink);
 }
 while(decoded[start]!=null)
 {
   var link = document.createElement('div');
   var linkOpt = document.createElement('div');
   var titlePlace  = document.createElement('div');
   var fileIcon = document.createElement('div');
   fileIcon.style.background='url('+decoded[start].iconDefault+')';
   fileIcon.style.backgroundSize='2em  2em';
   fileIcon.style.backgroundRepeat='no-repeat';
   link.setAttribute('class','fileBox');
   linkOpt.setAttribute('class','fileOpt');
   fileIcon.setAttribute('class','fileIcon');
   titlePlace.setAttribute('class','filePlace');
   if(decoded[start].file_name.length<20)
   titlePlace.innerHTML=decoded[start].file_name;
   else
  titlePlace.innerHTML=decoded[start].file_name.substring(0,10)+'...'+(decoded[start].file_name.substring(decoded[start].file_name.length-5));
  link.setAttribute('data-id',decoded[start].id);
  link.addEventListener('click',function(e){fileInfo(this)});
   linkOpt.innerHTML="";
   link.appendChild(linkOpt);
   link.appendChild(titlePlace);
   link.appendChild(fileIcon);
   link.setAttribute('tabindex','-1');
   gen.id('contentPlace').appendChild(link);
   start++;
   }
    }
    function selectFiles()
    {
      var start = 0;
      while(gen.id('contentPlace').getElementsByTagName('div')[start]!=null){
//      console.log(gen.id('contentPlace').getElementsByTagName('div')[start].dataset.id);
      start++;
    }}
    function listFile(fileCopy,fileName,bufferId)
    {
     /*Each fnctn call adds child elemnts to the div (fileList) in html file addNote.html*/
        var file = document.createElement('div');
        var fileInfo = document.createElement('div');
        var opts = document.createElement('div');
        var progress_wrap = document.createElement('div');
        var progress = document.createElement('progress');
        progress.setAttribute('max','100');
        progress.setAttribute('value','0');
        progress.setAttribute('id','buffer-'+bufferId);
         progress.style.width="8em";
                  progress.style.display="none";

        opts.setAttribute('class','opts');
        progress_wrap.setAttribute('class','progressWrap');
        fileInfo.setAttribute('class','info');
        if(fileName.length>25)
        var fileNamePad = fileName.substring(0,10)+'...'+fileName.substring(fileName.length-10,fileName.length);
        else
        fileNamePad=fileName;
        console.log(fileNamePad);
        opts.innerHTML='<span onclick="removeFile('+bufferId+');" title="Remove file from list"><img src = "'+png_close+'"/></span>';
       fileInfo.innerHTML=fileNamePad;
       //file.appendChild(progress);
       progress_wrap.appendChild(progress);
       file.appendChild(opts);
       file.appendChild(fileInfo);
              file.appendChild(progress_wrap);

        file.setAttribute('class','file');
        file.setAttribute('id','uploadFileId-'+bufferId);
        file.setAttribute('name',fileName);
        gen.id('fileList').appendChild(file);
        var code = gen.formatOf(fileName);
        if(fileCopy==null){
      file.style.background='url('+JSON.parse(icons).defaultfile+')';
            file.style.backgroundSize='8em 8em';
           file.style.backgroundRepeat='none';
        }
        else
        {
            file.style.background='url('+fileCopy+')';
            file.style.backgroundSize='8em 8em';
            file.style.backgroundRepeat='none';
        }
    }
    function removeFile(id)
    {
      var index=0;
while(fileBuffer[index]!=null)
{
   if(fileBuffer[index].id==id){
   fileBuffer.splice(index,1);
      gen.id('uploadFileId-'+id).remove();
   }
    index++;
}
    }
    function startUpload()
    {
        for(var i = 0;i<fileBuffer.length;i++)
        {
            uploadfile(fileBuffer[i]);
        }
    }
    var noteId = 0;
    var alterDate=0;
    var locBuffer = new Array();
    var geolocation='0,0';
    var setgLocation='0,0';
   function transferNote()
   {
     if(fileBuffer.length>0||gen.id('typeSpace').innerHTML.length>0)
     {
        gen.id('saveButton').setAttribute('disabled','disabled');
                gen.id('saveButton').setAttribute('onclick','function(){}');

       noteId=(new Date).getTime();
       if(fileBuffer.length>0)
       {
       gen.id('saveButton').innerHTML="Uploading Files...";
       var go=0;
       while(gen.id("fileList").getElementsByTagName('progress')[go]!=null)
       {
         gen.id("fileList").getElementsByTagName('progress')[go].style.display='block';
         go++;
       }
       startUpload();
       }    
       var dec = window.setInterval(function(){
       if(fileBuffer.length>1)
      showNotification(fileBuffer.length+" files being uploaded...");
      else if(fileBuffer.length==1)
      showNotification(fileBuffer.length+" file being uploaded...");
         if(fileBuffer.length<=0)
         {
      gen.id('saveButton').innerHTML="Saving Note...";
      var contents=gen.id('typeSpace').innerHTML;
     setgLocation=locBuffer[0];
      if(setgLocation=='0,0'&&geolocation!='0,0')
      setgLocation=geolocation;
 notey.post('feed.php',{contents:contents,timeid:noteId,alterDate:alterDate,geolocation:geolocation,setglocation:setgLocation},function(data)
{
  var dec = JSON.parse(data.response);
  if(dec.status==1&&dec.parity==gen.id('typeSpace').innerHTML.substr(0,5))
{
          gen.id('saveButton').innerHTML="Save Note";
          gen.id("fileList").innerHTML='';
          showNotification("Note Saved");
          gen.id('saveButton').removeAttribute('disabled');
          gen.id('saveButton').setAttribute('onclick','transferNote()');
          gen.id('typeSpace').innerHTML="";
}
else {
              showNotification("<span style=\"color:red;\">Error happened, try re-saving.</span>",15000);
          gen.id('saveButton').removeAttribute('disabled');
}
});
          window.clearInterval(dec);
         }
       },100);
     }
     else
     {
          showNotification("Note seems to be empty, type in something...");
     }
   }
   var toggleFlag=0;
   var staticVar = 0;
   function showNotification(content,counter)
   {
      gen.id('notificationSpace').innerHTML='';
      var ob = document.createElement('div');
      ob.setAttribute('id','notification-'+staticVar);
       ob.setAttribute('class','fadeInRight');
      var space=gen.id('notificationSpace');
      ob.innerHTML=content;
      space.appendChild(ob);

$('#notification-'+staticVar).delay(counter).fadeOut(2000);

           staticVar++;

   }
function keyWordSearch()
{
if(searchFocus=="addNote"||searchFocus=="")
{
notey.get('gcow.php?q='+gen.id('keyWord').value,function(data){
gen.id('contentPlace').innerHTML="";
gen.id('titleBar_title').innerHTML="Search";
gen.id('titleBar_options').innerHTML="showing results for <b>"+gen.id('keyWord').value+'</b>';
if(gen.id('keyWord').value=='')
gen.id('titleBar_options').innerHTML="give me something to search...";
var decoded = JSON.parse(data.responseText);
var start = 0;
while(decoded[start]!=null)
{
resultDisplay(decoded[start]);
start++;
}
		$('#geo').locationPicker();
  });
}
else if(searchFocus=="files")
{
gen.id('titleBar_options').innerHTML="showing results for <b>"+gen.id('keyWord').value+'</b>';
if(gen.id('keyWord').value=='')
gen.id('titleBar_options').innerHTML="give me something to search...";
   notey.get('gcow-files.php?q='+gen.id('keyWord').value,function(data){
   fileDisplay(JSON.parse(data.responseText));
   });
}
}
function fileInfo(file)
{
file.focus();
notey.get('fileInfo.php?id='+file.dataset.id,function(data){
var DCde = JSON.parse(data.responseText);
notey.notify('helloFile.php?id='+file.dataset.id,{iframe:true,width:600,height:0});
});

}
function fetchFile(ob)
{
  console.log(ob.dataset.id);
  notey.get('files.php?folder='+ob.dataset.id,function(data){
    var dv = JSON.parse(data.response);    
    fileDisplay(dv);
  });
}
var prev;
function highlightSelection(ob)
{
  ob.style.background="rgb(241, 238, 245)";
  if(prev==null)
  {
    prev=ob;
  }
  else if(ob!=prev)
  {
    prev.style.background="rgb(49, 54, 69)";
    prev=ob;
  }
}
 function louis(tell,toggle)
 {
   gen.id('louis_talk').innerHTML=tell;
   if(toggle)
   gen.id('louis_load').style.display='block';
   else
  gen.id('louis_load').style.display='none';
 }
 function showCalender()
 {
   gen.id('calender').style.display="block";
   var calenderDim = gen.id('calender').getBoundingClientRect();
  gen.id('calender').style.left=(window.innerWidth/2)-(calenderDim.width/2)+'px';
    gen.id('calender').style.top=(window.innerHeight/2)-(calenderDim.height/2)+'px';
 }
 function timeTasks(time)
 {
if(task=="addNote")
{
  if(moment.unix((new Date).getTime()/1000).format('MM-DD-YYYY')==moment.unix(time).format('MM-DD-YYYY'))
{
gen.id('noteDate').innerHTML=moment.unix((new Date).getTime()/1000).format('Do  MMMM YYYY , HH:mm');
alterDate=moment.unix((new Date).getTime()/1000).format('YYYY-MM-DD HH:mm:ss');
return;
}
  gen.id('noteDate').innerHTML=moment.unix(time).format('Do  MMMM YYYY , HH:mm');
  alterDate=moment.unix(time).format('YYYY-MM-DD HH:mm:ss');
}
else if(task=='searchNote')
{
 searchFocus = "addNote";
notesByDate(time);
}
 }
 function howFar(mS)
 {
   var hman = Math.round(mS/1000);
   if(hman<60)
   return "Just now";
   else if(hman<3599)
   return Math.floor(hman/60)+' minutes ago';
   else if(hman<86400)
   return Math.floor((hman/3600))+' hour ago';
   else if(hman>86400){
     if(hman/86400<1000)
   return Math.floor(hman/86400)+' day ago';
   else{
     var years = Math.floor((hman/86400)/365);
     var months = Math.floor(((hman/86400)%365)/31);
     if(months!=0)
     {
       var tem = years+' years and '+months + 'months';
     }
     else
     {
              var tem = years+' years';
     }
      return tem+' ('+Math.floor(hman/86400)+' day ago)';
   }
   }
 }
  function isSaved()
{
    if(fileBuffer.length==0||gen.id('typeSpace').value.length==0){
    return true;
    }
    else
    {
    return false;
    }
}
 function notesByDate(time,ob)
 {
//gen.id('titleBar_options').innerHTML="<input   onchange=\"notesByDate(moment('"+this.value+"','YYYY-MM-DD').unix());\"    type=\"date\" value=\""+moment.unix(time).format('YYYY-MM-DD')+"\"/>";
notey.get('search.php?date='+moment.unix(time).format("DD-MM-YYYY"),function(data){
gen.id('searchButton').innerHTML="Search Notes";
gen.id('contentPlace').innerHTML="";
var decoded = JSON.parse(data.responseText);
var start = 0;
while(decoded[start]!=null)
{
resultDisplay(decoded[start]);
start++;
}
 });
 }
 var c_index=0;
 function collectLocation(loc)
 {
   locBuffer[c_index]=loc;
   listLocation(loc,c_index);
 }
 var bufferIndex=0;
 function listLocation(loc,bufferId)
 {
   gen.id('mapRoll').innerHTML="";
    var file = document.createElement('div');
        var fileInfo = document.createElement('div');
        var opts = document.createElement('div');
        opts.setAttribute('class','opts');
        fileInfo.setAttribute('class','info');
        fileNamePad="location";
        opts.innerHTML='<span onclick="removeLoc('+bufferId+');" title="Remove location from list"><img src = "'+png_close+'"/></span>';
       fileInfo.innerHTML=fileNamePad;
     //  file.appendChild(opts);
     //  file.appendChild(fileInfo);
        file.setAttribute('class','place');
        file.setAttribute('id','locationId-'+bufferId);
        
        //gen.id('mapRoll').appendChild(file);
    //  gen.id('mapRoll').insertBefore(file, gen.id('mapRoll').children[bufferIndex]);
     gen.id('mapRoll').appendChild(file)
  var staticImage='https://maps.googleapis.com/maps/api/staticmap?center='+loc+'&zoom=15&size=300x300&maptype=roadmap&markers=color:blue%7Clabel:S%7C40.702147,-74.015794&markers=color:green%7Clabel:G%7C40.711614,-74.012318&markers=color:red%7Clabel:C%7C40.718217,-73.998284';
        file.style.background="url("+staticImage+")";
 }
function trackMe()
{
  if (navigator.geolocation) 
{
    navigator.geolocation.getCurrentPosition(showPosition);
}
 else
{
notey.notify("",{content:"Unable to find your location.  <ul><li></li></ul>",iframe:false,width:500});
}
function showPosition(position)
{
   var detected_lat=position.coords.latitude;
   var detected_lng=position.coords.longitude;
   geolocation=detected_lat+','+detected_lng;
   collectLocation(detected_lat+','+detected_lng);
}
}
function builtMenu(ob)
{
  var clientDim = ob.getBoundingClientRect();
  var div = document.createElement('div');
  var ul = document.createElement('ul');
  div.setAttribute('class','menu');
  div.setAttribute('id',ob.noteid+'DropMenu');
  div.setAttribute('tabindex',0);
  ul.setAttribute('shape','none');
var arra = JSON.parse(ob.dataset.list);
var start = 0;
while(arra[start]!=null)
{
  var ele = document.createElement('li');
 ele.innerHTML=arra[start++];
 ele.setAttribute('onclick',arra[start++]);
ul.appendChild(ele);
}
  div.appendChild(ul);
  div.style.position = 'absolute';
  div.style.marginBottom="0px";
  div.style.zIndex = 54;
  div.style.top = (clientDim.bottom+5)+'px';
  div.style.left = (clientDim.left)+'px';
   console.log(parseInt(div.style.width));
  div.addEventListener('blur',function(e){div.remove();});
  document.getElementsByTagName('body')[0].appendChild(div);
  gen.id(ob.noteid+'DropMenu').focus();
}
function findPeople(noteId)
{
    notey.notify('search_people.php?noteid='+noteId,{iframe:true,title:"Fetch people"});
}
function showInfo()
{
      notey.notify('info.php',{iframe:true,title:"Informations"});
}
function showSettings()
{
      notey.notify('settings.php',{iframe:true,title:"Settings"});
}
function deleteNote(noteId)
{
var text = "<div align=\"center\">Are you sure, about this deletion ?</div>";
notey.notify('',{iframe:false,text:text,width:300,height:0,confirm:true},function(status)
 {
   if(status==true)
    notey.post('deletenote.php',{id: noteId},function(data){if(data.responseText==='1'){
 $('#note-'+noteId).delay(500).fadeOut(1000);
        }
        else
        {
          var txt = "Some error occured, while deletion. Try again.";
          notey.notify('',{iframe:false,text:txt,width:200,confirm:false},function(){});
        }
});
            });
}
function deleteLink(linkId)
{
var text = "<div align=\"center\">Are you sure, about this deletion ?</div>";
notey.notify('',{iframe:false,text:text,width:300,height:0,confirm:true},function(status)
 {
   if(status==true)
    notey.post('deletelink.php',{id: linkId},function(data){if(data.responseText==='1'){
 $('#link-'+linkId).delay(500).fadeOut(1000);
        }
        else
        {
          var txt = "Some error occured, while deletion. Try again.";
          notey.notify('',{iframe:false,text:txt,width:200,confirm:false},function(){});
        }
});
            });
}
    </script>
    <script>
  gen.id('mainOptions').getElementsByTagName('li')[0].click();
  </script>
  <!--
    Script for unique page treatment
    -->
         <div draggable="true" id="calender" tabindex = "1"><div id="close_calender" align="right" class="options">Close</div>
         <script>
           gen.id('calender').addEventListener('blur',function(e){
              gen.id('calender').style.display="none";
           });
           gen.id('close_calender').addEventListener('click',function(e){gen.id('calender').style.display="none";});
           </script>
          <div id="cal"></div>
              </div>
              <script>
                $('#calender').draggable();
                </script>
                <script>
                  function showLocationSlot()
                  {
                                        if(document.getElementById('locationList').style.display=="block")
                    document.getElementById('locationList').style.display="none";
                    else
                                        document.getElementById('locationList').style.display="block";
                  }
                  function callOut()
                  {
                    notey.post('callOut.php',{
                      note : gen.id('typeSpace').value},function(data){
                        console.log(data.response);});
                  }
                  function chooseFolders()
                  {
                    notey.get('fetch_albums.php',function(data){
                      var dc = JSON.parse(data.response);
                    });
                  }
                  function creatAlbum()
            {
            var stuff = document.getElementById('albname').value;
            //Advanced validation has to added here
            if(stuff.length>2)
            {
            notey.post('albumManager.php?create',{albname:stuff},function(data){
                console.log(data.responseText);
                if(data.responseText==1)
                {
                    document.getElementById('reportArea').innerHTML="Album <b>"+stuff+"</b> is created.";
                   // window.location.href=window.location.href;
                     var link = document.createElement('div');
   var linkOpt = document.createElement('div');
   var titlePlace  = document.createElement('div');
   var fileIcon = document.createElement('div');
   var fileCount = document.createElement('div');
  // fileIcon.style.background='url('+decoded[start].iconDefault+')';
   fileIcon.style.backgroundSize='2em  2em';
   fileIcon.style.backgroundRepeat='no-repeat';
   link.setAttribute('class','folder');
   linkOpt.setAttribute('class','fileOpt');
   fileIcon.setAttribute('class','fileIcon');
   titlePlace.setAttribute('class','filePlace');
      fileCount.setAttribute('class','fileCount');
   fileCount.innerHTML=0+' files';
   if(stuff.length<20)
   titlePlace.innerHTML=stuff;
   else
  titlePlace.innerHTML=stuff.substring(0,10)+'...'+(stuff.substring(stuff.length-5));
  link.setAttribute('data-id',999999);
    link.addEventListener('click',function(e){fetchFile(this)});
   linkOpt.innerHTML="";
   link.appendChild(linkOpt);
   link.appendChild(titlePlace);
   link.appendChild(fileIcon);
   link.appendChild(fileCount);
   link.setAttribute('tabindex','-1');
   gen.id('contentPlace').appendChild(link);
               gen.eleRemove('uq');
            }
            else {
                document.getElementById('reportArea').innerHTML="Folder name <b>"+stuff+"</b> already exists or seems invalid.";
            }});
            }else{
                document.getElementById('reportArea').innerHTML="Give us a valid album name of your choice";
            }}
            var fileSelectToggle = 0;
            function fileSelect()
            {
              fileSelectToggle++;
              if(fileSelectToggle%2!=0)
              {
              var start = 0;
              while(gen.id('contentPlace').getElementsByClassName('fileBox')[start]!=null){
              var checkBox = document.createElement('input');
              checkBox.setAttribute('type','checkbox');
              checkBox.setAttribute('id','select-'+gen.id('contentPlace').getElementsByClassName('fileBox')[start].dataset.id);
                var overLay = document.createElement('div');
                  overLay.setAttribute('data-id',gen.id('contentPlace').getElementsByClassName('fileBox')[start].dataset.id);
                overLay.appendChild(checkBox);
                 gen.id('contentPlace').getElementsByClassName('fileBox')[start].removeEventListener('click',fileInfo);
                overLay.addEventListener('click',function(){
                  gen.id('select-'+this.dataset.id).click();
                });
                overLay.setAttribute('class','fileSelectMode');
              gen.id('contentPlace').getElementsByClassName('fileBox')[start++].appendChild(overLay);
              //console.log(gen.id('contentPlace').getElementsByClassName('fileBox')[start++]);
              }
            }
            else {
while(gen.id('contentPlace').getElementsByClassName('fileBox')[start]!=null){
  start++;
                }
          }
            }
                  </script>                                  
                <script src = "iconCode.js">
                  </script>
    </body>
    <!--V3.10.01-->
</html>