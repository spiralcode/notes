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

        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <!-- Place favicon.ico in the root directory -->

        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/skeleton.css">
                <link rel="stylesheet" href="mobstyle.css">
        <script src="js/vendor/modernizr-2.8.3.min.js"></script>
        
                <script src="notey.js"></script>
                <script src="jss/general.js"></script>
                <script src = "../iconCode.js"></script>
                        <script src="../jss/image.js"></script>
<style>
    [contentEditable=true]:empty:not(:focus):before {
content: attr(data-text);
}
</style>
    </head>
    <body>
        
        <script>
//Notes Mobile
var time = new Date;
var timer=time.getTime();
            function savenote()
            {
                 timer++;
if($id('note').value=='')
    {alert('Nothing to save !');
        return;}
        $id('savebutton').value="Saving...";

 var contents=$id('note').value,detected_loc='0,0';
notey.post('../feed.php',{contents:contents,timeid:timer,alterDate:0,geolocation:detected_loc,setglocation:detected_loc},function(data){
 if(data.responseText==1)
     {
            $id('note').value='';
            $id('note').placeholder='Last note saved';
            $id('savebutton').value="Save Note";
            $id('iQlist').innerHTML='';
     }
});

            }
            function $name(name)
{
	return document.getElementsByName(name)[0];
}
function trackMe()
{
  if (navigator.geolocation) 
{
    navigator.geolocation.getCurrentPosition(showPosition);
}
 else
{
alert('Seems your browser needs an update to support this feature.');
}
}
var staticVar = 0;
function showPosition(position)
{
   var detected_lat=position.coords.latitude;
   var detected_lng=position.coords.longitude;
   detected_loc=detected_lat+','+detected_lng;
   var staticImage='https://maps.googleapis.com/maps/api/staticmap?center='+detected_loc+'&zoom=16&size=200x200&maptype=roadmap&markers=color:blue%7Clabel:S%7C40.702147,-74.015794&markers=color:green%7Clabel:G%7C40.711614,-74.012318&markers=color:red%7Clabel:C%7C40.718217,-73.998284';
   document.getElementById('locImage').src=staticImage;
}
window.onbeforeunload = function (e) {
    if(gen.id('typeSpace').innerHTML!='')
    {
  var message = "There's an un-saved note here !",
  e = e || window.event;
  // For IE and Firefox
  if (e) {
    e.returnValue = message;
  }

  // For Safari
  return message;
    }
};

 
            </script>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <!-- Add your site or application content here -->
        <div class="topribbon"><h2>notes <sup></sup></h2></div>
        <div class="notificationSpace" id="notificationSpace"></div>
        <div class="login" align="center" ><h5 style="opacity: .5; text-align: right;">write note</h5>
 <div contenteditable="true" data-text="Type here all what you can..."  class="typeSpace" id="typeSpace" row="50" cols="100"></div>        

    <div class="buttonGroup">
             <input multiple="multiple" id="fileSelect" name="fileSelect[]" style="display: none;" type="file"  accept="image/*;capture=camera" />   
        <select style="display:none;" id="folderSpec"><option value="0">Attachment</option></select>
                <div onclick="gen.id('fileSelect').click();" class="selectFiles"  id="cameraButton" type="button" value="Files"></div>
        <div id="fetchingLocation" class="locationPick" onclick="trackMe();" ></div>
               <div id="saveButton" class="saveNote" onclick="transferNote();" ></div>

</div>
<div id="iQ"><table><tr id="iQlist"></tr></table>
</div>
<div class="fileList" id="fileList"></div>
<img id = "locImage"/>
</div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.3.min.js"><\/script>')</script>
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>
        <div class="footer"><p><a href="../paper.php">Deskop</a> | <a href="../todo">To-do</a> | <a href="logout.php">Logout</a></p></div>
       <script>
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


 
           </script>
          <script src="fly_m.js"></script>
<script>
    init();
 var noteId = 0;
    var alterDate=0;
    var locBuffer = new Array();
    var geolocation='0,0';
    var setgLocation='0,0';
   function transferNote()
   {
     if(fileBuffer.length>0||gen.id('typeSpace').innerHTML.length>0)
     {
        showNotification("Saving...",15000);
        gen.id('saveButton').setAttribute('disabled','disabled');
                gen.id('saveButton').setAttribute('onclick','function(){}');

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
      showNotification(fileBuffer.length+" files being uploaded...");
      else if(fileBuffer.length==1)
      showNotification(fileBuffer.length+" file being uploaded...");
         if(fileBuffer.length<=0)
         {
      gen.id('saveButton').value="Saving Note...";
      var contents=gen.id('typeSpace').innerHTML;
     setgLocation=locBuffer[0];
      if(setgLocation=='0,0'&&geolocation!='0,0')
      setgLocation=geolocation;
 notey.post('../feed.php',{contents:contents,timeid:noteId,alterDate:alterDate,geolocation:geolocation,setglocation:setgLocation},function(data)
{
    var dec = JSON.parse(data.response);
    console.log(dec.parity,gen.id('typeSpace').innerHTML.substr(0,5),dec.parity==gen.id('typeSpace').innerHTML.substr(0,5))
if(dec.status==1&&dec.parity==gen.id('typeSpace').innerHTML.substr(0,5))
{
          gen.id('saveButton').value="Save Note";
          gen.id("fileList").innerHTML='';
          showNotification("Note Saved");
          gen.id('saveButton').removeAttribute('disabled');
           gen.id('saveButton').setAttribute('onclick','transferNote()');
          gen.id('typeSpace').innerHTML="";
}
else {
              showNotification("<span style=\"color:red;\">Error happened, try re-saving.</span>",15000);
              
          gen.id('saveButton').removeAttribute('disabled');
                    gen.id('saveButton').value="Save Note";

}
});
          window.clearInterval(dec);
         }
       },100);
     }
     else
     {
          showNotification("Nothing is actually there to save !",10000);
     }
   }
      function startUpload()
    {
        for(var i = 0;i<fileBuffer.length;i++)
        {
            uploadfile(fileBuffer[i]);
        }
    }
   
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
    </script>
    </body>
</html>
