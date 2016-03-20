<?php
include 'session_check.php';
?>
<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
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
    </head>
    <body>
<script>

</script>
        <div class="topribbon">Notes<div onclick="userAccOptions()" class="userInfo"><?php echo  $_SESSION['uname']; ?></div></div>
        <div id="titleBar" class="titleBar"></div>
      <div class="sideRack">
          
          <div class="searchNotes">
           <input id="keyWord" placeholder="Search for..." style="width:100%" type="text">
          <button onclick="keyWordSearch();">Search Notes</button>
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
                  <li onclick="navigate(this);" data-task="searchNote" data-label="search.php" data-title="Read Notes">Read Notes</li>
                     <li onclick="navigate(this);" data-task="photo" data-label="pho.html" data-title="All your Files...">Files</li>
                     <li onclick="navigate(this);"  data-label="ppl.html" data-title="Some of them..">People</li>
                     <li onclick="navigate(this);" data-task="links"  data-label="links.php?limit=9,0" data-title="Links">Links</li>
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
var timer=(new Date).getTime();
    function navigate(ob)
    {
      louis('Loading...',true);
    highlightSelection(ob);
notey.get(ob.dataset.label,function(data){
      louis(' ',false);
   if(ob.dataset.task=='addNote')
   {
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
  $(function() {
    $( "#cal" ).datepicker();
  });
   }
   else if(ob.dataset.task=='searchNote')
   {
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
 gen.id('contentPlace').innerHTML="";
 var decoded = JSON.parse(data.responseText);
 var start=0;
 while(decoded[start]!=null)
 {
   var link = document.createElement('div');
   var linkOpt = document.createElement('div');
   var titlePlace  = document.createElement('div');
   link.setAttribute('class','linkBox');
   linkOpt.setAttribute('class','linkOpt');
   titlePlace.setAttribute('class','titlePlace');
   titlePlace.innerHTML=decoded[start].title;
   titlePlace.setAttribute('title','Delete');
   linkOpt.innerHTML="Delete";
   link.appendChild(linkOpt);
   link.appendChild(titlePlace);
   
   var cast = 'window.open(\''+decoded[start].url+'\',\'_blank\')';
      link.setAttribute('onclick',cast);
      link.setAttribute('title',decoded[start].title);
   //link.innerHTML=decoded[start].title;
   gen.id('contentPlace').appendChild(link);
   start++;
 }
   }
   else
   {
        gen.id('contentPlace').innerHTML='Development On-Course...<a href="book.php" target="_new">Try the old one </a>';
   }


});
if(ob.dataset.title!=null)
gen.id('titleBar').innerHTML=ob.dataset.title;
else
gen.id('titleBar').innerHTML=' ';
    }
    
    function resultDisplay(ob)
    {
      if(ob.status!=0){
    var note = document.createElement('div');
    var noteInfo = document.createElement('div');
    var contentSlot = document.createElement('div');
    var fileSlot = document.createElement('div');
  note.setAttribute('class','note');
    noteInfo.setAttribute('class','noteInfo');
    contentSlot.setAttribute('class','contentSlot');
    fileSlot.setAttribute('class','fileSlot');
    fileSlot.innerHTML="Files are being loaded...";
  noteInfo.innerHTML=moment.unix(ob.time).format('Do  MMMM YYYY , HH:mm');  
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
    
    
    function listFile(fileCopy,fileName)
    {
     /*each fnctn call adds child elemnts to the div (fileList) in html file addNote.html*/
        var file = document.createElement('div');
        file.setAttribute('class','file');
        file.setAttribute('name',fileName);
        gen.id('fileList').appendChild(file);
        var code = gen.formatOf(fileName);
        if(fileCopy==null){
      file.style.background='url('+JSON.parse(icons).defaultfile+')';
            file.style.backgroundSize='5em 5em';
        }
        else
        {
              file.style.background='url('+fileCopy+')';
            file.style.backgroundSize='5em 5em';
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
   function transferNote()
   {
            gen.id('saveButton').setAttribute('disabled','disabled');
      var alterDate=(new Date).getTime();
      noteId=alterDate;
       if(fileBuffer.length>0)
       {
       gen.id('saveButton').value="Uploading Files...";
       startUpload();
       }
      gen.id('saveButton').value="Saving Note...";
      var contents=gen.id('typeSpace').value;
      alterDate=0;
      var geolocation='0,0';
      var setgLocation='0,0';
 notey.post('feed.php',{contents:contents,timeid:noteId,alterDate:alterDate,geolocation:geolocation,	setglocation:setgLocation},function(data)
{
          gen.id('saveButton').value="Save Note";
          gen.id("fileList").innerHTML='';
          showNotification("Note Saved");
          gen.id('saveButton').removeAttribute('disabled');
});
   }
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
  notey.get('gcow.php?q='+gen.id('keyWord').value,function(data){
gen.id('contentPlace').innerHTML="";
gen.id('titleBar').innerHTML="Showing results for <b>"+gen.id('keyWord').value+'</b>';
var decoded = JSON.parse(data.responseText);
var start = 0;
while(decoded[start]!=null)
{
resultDisplay(decoded[start]);
start++;
}
  });
}
function fileInfo(file)
{
notey.get('fileInfo.php?id='+file.dataset.id,function(data){
var DCde = JSON.parse(data.responseText);

  var content = '<div style="text-align:center;"><div>'+DCde[0].realFileName+'</div><div>'+Math.round(parseInt(DCde[0].size)/1000000)+' MB</div><div><a target="_new" href = "downloadImage.php?id='+DCde[0].id+'">Download the File</a> | <a target="_new" href = "redirectToFile.php?id='+DCde[0].id+'">Open the file</a></div></div>';
        notey.notify('',{text:content,iframe:false,width:500,height:0});
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
  else
  {
    prev.style.background="rgb(49, 54, 69)";
    prev=ob;
  }
}
function userAccOptions()
{
  var content='<div align="center"><a  href="logout.php">Log-Out</a></div>';
    notey.notify('',{text:content,iframe:false,width:200,height:0});
}
 function louis(tell,toggle)
 {
   gen.id('louis_talk').innerHTML=tell;
   if(toggle)
   gen.id('louis_load').style.display='block';
   else
  gen.id('louis_load').style.display='none';
 }
    </script>
    <script>
  gen.id('mainOptions').getElementsByTagName('li')[0].click();
  </script>
  <!--
    Script for unique page treatment
    -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.3.min.js"><\/script>')</script>
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>

    </body>
</html>