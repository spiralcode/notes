<?php
include 'session_check.php';
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
                                <link rel="stylesheet" href="css/general.css">
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
<link rel="stylesheet" href="style/jquery-ui.css">
<link rel="stylesheet" href="raid.css"/>

      <!--  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>-->
        <script>/*window.jQuery || document.write('<script src="js/vendor/jquery-1.11.3.min.js"><\/script>')*/</script>
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>
    </head>
    <body>
<script>

</script>
        <div class="topribbon">Notes<div onclick="userAccOptions()" class="userInfo"><?php echo  $_SESSION['uname']; ?></div></div>
        <div id="titleBar_full" class="titleBar"><span id="titleBar_title"></span><span id="titleBar_options"></span></div>
      <div class="sideRack">
          
          <div class="searchNotes">
           <input id="keyWord" placeholder="Search for..." type="text" maxlength="100">
          <button id="searchButton" onclick="keyWordSearch();">Search Notes</button>
          <script>
            gen.id('keyWord').addEventListener('keyup',function(e){
            if(gen.id('keyWord').value.length>2)
             keyWordSearch();
             if(e.keyCode==13)
             keyWordSearch();
            });
            </script>
          </div>
          <div class="options">
            <ul id="mainOptions">
                    <li onclick="navigate(this);" data-task="addNote" data-label="htmls/addNote.html" data-title="Write Note">Add Note</li>
                  <li onclick="navigate(this);" data-task="searchNote" data-label="search.php?date=<?php date_default_timezone_set('Asia/Calcutta');
 echo date("d-m-Y"); ?>" data-title="Read Notes">Read Notes</li>
                     <li onclick="navigate(this);" data-task="files" data-label="files.php" data-title="Files">Files</li>
                     <li onclick="navigate(this);" date-task="peoples"  data-label="ppl.html" data-title="Peoples">People</li>
                     <li onclick="navigate(this);" data-task="links"  data-label="links.php?limit=20,0" data-title="Links">Links</li>
           </div>
            <div class="louis" id="louis">
           <div id="louis_load" class="spinner" style="" >
             </div>
              <span id="louis_talk"></span>
              </div>

      </div>
      
        <div id="contentPlace" class="contentPlace" align="center" >

<div id="iQ"><table><tr id="iQlist"></tr></table>
</div>
</div>

<script>
/*
Globals
*/
var searchFocus="";
var timer=(new Date).getTime();
var task = "";
    function navigate(ob)
    {
      louis('Loading...',true);
    highlightSelection(ob);
notey.get(ob.dataset.label,function(data){
      louis(' ',false);
           gen.id('titleBar_title').innerHTML=ob.dataset.title;
   if(ob.dataset.task=='addNote')
   {
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
    $( "#cal" ).datepicker({onSelect:function(data){
      timeTasks(moment(data,"MM/DD/YYYY").unix());
      }});
   }
   else if(ob.dataset.task=='searchNote')
   {
     fileBuffer=[];
      gen.id('titleBar_options').innerHTML="<input type=\"text\" value=\""+moment.unix(new Date/1000).format('DD - MM - YYYY')+"\"/>";
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
          fileBuffer=[];
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
   linkOpt.setAttribute('class','linkOpt');
   titlePlace.setAttribute('class','titlePlace');
   titlePlace.innerHTML=decoded[start].title;
   linkOpt.innerHTML="Delete";
   link.appendChild(linkOpt);
   link.appendChild(titlePlace);
   var cast = 'window.open(\''+decoded[start].url+'\',\'_blank\')';
      link.setAttribute('onclick',cast);
      link.setAttribute('title',decoded[start].title);
   gen.id('contentPlace').appendChild(link);
   start++;
 }
   }
   else if(ob.dataset.task=='files')
   {
          fileBuffer=[];
  searchFocus="files";
  gen.id('titleBar_options').innerHTML="<input type=\"button\" onclick=\"selectFiles()\" value = \"Select files\"/><input type=\"button\" value = \"Delete Files\"/> ";
  task=ob.dataset.task;
          
gen.id('searchButton').innerHTML="Search files";

 gen.id('contentPlace').innerHTML="";
 var decoded = JSON.parse(data.responseText);
 fileDisplay(decoded)
   }
   else
   {
          fileBuffer=[];
        gen.id('titleBar_options').innerHTML="";
        gen.id('contentPlace').innerHTML='Development On-Course...<a href="book.php" target="_new">Try the old one </a>';
   }
});
gen.id('titleBar_title').innerHTML="Loading...";
    }
    function resultDisplay(ob)
    {
      if(ob.status!=0){
    var note = document.createElement('div');
    var noteInfo = document.createElement('div');
    var contentSlot = document.createElement('div');
    var fileSlot = document.createElement('div');
    var dateDiff = document.createElement('div');
  note.setAttribute('class','note');
    noteInfo.setAttribute('class','noteInfo');
    contentSlot.setAttribute('class','contentSlot');
    fileSlot.setAttribute('class','fileSlot');
    dateDiff.setAttribute('class','dateDiff');
 // noteInfo.innerHTML=moment.unix(ob.time).format('Do  MMMM YYYY , HH:mm');  
    //dateDiff.innerHTML="Delegation";
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
    noteInfo.appendChild(dateDiff);
      note.appendChild(noteInfo);
      note.appendChild(contentSlot);
     if(beg!=0){
       
      note.appendChild(fileSlot);
     }
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
    function fileDisplay(decoded)
    { 
  gen.id('contentPlace').innerHTML="";
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
  titlePlace.setAttribute('data-id',decoded[start].id);
    titlePlace.addEventListener('click',function(e){fileInfo(this)});
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
      console.log(gen.id('contentPlace').getElementsByTagName('div')[start].dataset.id);
      start++;
    }}
    function listFile(fileCopy,fileName,bufferId)
    {
     /*each fnctn call adds child elemnts to the div (fileList) in html file addNote.html*/
        var file = document.createElement('div');
        var fileInfo = document.createElement('div');
        var opts = document.createElement('div');
        var progress = document.createElement('progress');
        progress.setAttribute('max','100');
        progress.setAttribute('value','0');
        progress.setAttribute('id','buffer-'+bufferId);
        opts.setAttribute('class','opts');
        fileInfo.setAttribute('class','info');
        if(fileName.length>20)
        var fileNamePad = fileName.substring(0,5)+'...'+fileName.substring(fileName.length-5,5);
        else
        fileNamePad=fileName;
        opts.innerHTML='<span onclick="removeFile('+bufferId+');" title="Remove file from list"><img src = "'+png_close+'"/></span>';
       fileInfo.innerHTML=fileNamePad;
       file.appendChild(opts);
       file.appendChild(fileInfo);
       file.appendChild(progress);
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
      console.log('removal - '+id);
      var index=0;
while(fileBuffer[index]!=null)
{
   if(fileBuffer[index].id==id){
   fileBuffer.splice(index,1);
		console.log('after deletion len-'+fileBuffer.length);
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
   function transferNote()
   {
     if(fileBuffer.length>0||gen.id('typeSpace').value.length>0)
     {
        gen.id('saveButton').setAttribute('disabled','disabled');
       noteId=(new Date).getTime();
       if(fileBuffer.length>0)
       {
       gen.id('saveButton').value="Uploading Files...";
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
      showNotification(fileBuffer.length+" files to upload");
      else
      showNotification(fileBuffer.length+" file to upload");
         if(fileBuffer.length<=0)
         {
      gen.id('saveButton').value="Saving Note...";
      var contents=gen.id('typeSpace').value;
      var geolocation='0,0';
      var setgLocation='0,0';
 notey.post('feed.php',{contents:contents,timeid:noteId,alterDate:alterDate,geolocation:geolocation,setglocation:setgLocation},function(data)
{
          gen.id('saveButton').value="Save Note";
          gen.id("fileList").innerHTML='';
          showNotification("Note Saved");
          gen.id('saveButton').removeAttribute('disabled');
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
   function showNotification(content)
   {
      gen.id('notificationSpace').innerHTML='';
            gen.id('typeSpace').value='';
      var ob = document.createElement('div');
      ob.setAttribute('id','notification');
       ob.setAttribute('class','fadeInRight');
      var space=gen.id('notificationSpace');
      ob.innerHTML=content;
      space.appendChild(ob);
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
  });
}
else if(searchFocus=="files")
{
gen.id('titleBar_options').innerHTML="showing results for <b>"+gen.id('keyWord').value+'</b>';
if(gen.id('keyWord').value=='')
gen.id('titleBar_options').innerHTML="give me something to search...";
   notey.get('gcow-files.php?q='+gen.id('keyWord').value,function(data){
       console.log(data.responseText);
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
function userAccOptions()
{
  var content='<div align="center"><a  href="logout.php">Log-Out</a></div>';
    notey.notify('',{text:content,iframe:false,width:200,height:0});
 //   gen.dropDown("");
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
 function notesByDate(time)
 {
gen.id('titleBar_options').innerHTML="<input onclick=\"this.datepicker();\"  type=\"text\" value=\""+moment.unix(time).format('DD - MM - YYYY')+"\"/>";
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
    </script>
    <script>
  gen.id('mainOptions').getElementsByTagName('li')[0].click();
  </script>
  <!--
    Script for unique page treatment
    -->
         <div draggable="true" id="calender"><div id="close_calender" align="right" class="options">Close</div>
         <script>
           gen.id('close_calender').addEventListener('click',function(e){gen.id('calender').style.display="none";});
           </script>
          <div id="cal"></div>
              </div>
              <script>
                $('#calender').draggable();
                </script>
                <script src = "iconCode.js">
                  </script>
    </body>
    <!--V3.10.01-->
</html>