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


    </head>
    <body>
        
        <script>
            
//Notes Mobile
var time = new Date;
var timer=time.getTime();
            function $id(id)
            {
                return document.getElementById(id);
            }
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
function showPosition(position)
{
   var detected_lat=position.coords.latitude;
   var detected_lng=position.coords.longitude;
   detected_loc=detected_lat+','+detected_lng;
   var staticImage='https://maps.googleapis.com/maps/api/staticmap?center='+detected_loc+'&zoom=16&size=200x200&maptype=roadmap&markers=color:blue%7Clabel:S%7C40.702147,-74.015794&markers=color:green%7Clabel:G%7C40.711614,-74.012318&markers=color:red%7Clabel:C%7C40.718217,-73.998284';
   document.getElementById('locImage').src=staticImage;
}
 
            </script>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <!-- Add your site or application content here -->
        <div class="topribbon"><h2>Notes <sup>v3</sup></h2></div>
        <div class="login" align="center" ><h5 style="opacity: .5; text-align: right;">Write Note</h5>
    <form><textarea placeholder="Type in Notes here..." class="u-full-width" id="note" row="50" cols="100"></textarea>
         <input multiple="multiple" id="fileselect" name="fileselect[]" style="display: none;" type="file"  accept="image/*;capture=camera" />   
        <input onclick="$id('fileselect').click();" class="button-primary"  id="cameraButton" type="button" value="Camera">
        <input id="savebutton" class="button-primary" onclick="savenote();"  type="button" value="Save Note">
        <input id="fetchingLocation" class="button-primary" onclick="trackMe();"  type="button" value="Attach location">

    </form>
<div id="iQ"><table><tr id="iQlist"></tr></table>
</div>
<img id = "locImage"/>
</div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.3.min.js"><\/script>')</script>
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>
        <div class="footer"><p><a href="../paper.php">Deskop</a> | <a href="book.php">Read Note</a> | <a href="logout.php">Logout</a></p></div>
       
        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
          <script src="fly_m.js"></script>

    </body>
</html>
