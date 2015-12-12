<?php
include 'session_check.php';
?>
<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Notes Go : Read Notes</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/skeleton.css">
         <link rel="stylesheet" href="mobstyle.css">
        <link rel="stylesheet" href="../raid.css"/>
 <link rel="stylesheet" href="../style/jquery-ui.css">
     <link rel="stylesheet" href="../raid.css"/>
<link rel="stylesheet" href="../style/jquery-ui.css">

<script src="js/vendor/modernizr-2.8.3.min.js"></script>
<script src="../lib/jquery-1.10.2.js"></script>
<script src="../lib/jquery-ui.js"></script>
<script src="../notey.js"></script>
<script src="../raid.js"></script>
<script src="../lib/moment.js"></script>

<style>
    input[type="text"]
    {
        height: auto;
        margin-bottom: 0%;
    }
    </style>
    </head>
    <body>
        <script>
//Notes Mobile
var ir=0;
    function $id(id)
            {
                return document.getElementById(id);
            }
            </script>
        <div class="topribbon"><h5>Notes <sup>v3</sup></h5></div>
        <div class="toolsBar" ><input type="text" id="keyinput" placeholder="Search for...">
      <input style="height:auto; margin: 0%;" value="Search" type="button" class="button-primary"  onclick="showResult('../gcow.php?q='+$id('keyinput').value);"/>
<!--<input onchange="datesearch(this);" id="datepicker" type="text" placeholder="01/01/2015">-->
        </div>
<script>
        $id('keyinput').addEventListener('keyup',function(e){if(e.keyCode==13){showResult('../gcow.php?q='+$id('keyinput').value);}});

    </script>
    <div class="spinner" id="spinner"></div>
        <div id="frameplace" class="login" align="center" ><h5 style="opacity: .5; text-align: right;">No Notes this day</h5>
</div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.3.min.js"><\/script>')</script>
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>
        <div class="footer"><p><a href="../book.php">Desktop</a> | <a href="home.php">Write Note</a> | <a href="logout.php">Logout</a></p></div>
 <script>
          /*  $(function() {
    $( "#datepicker" ).datepicker(
    		{
    	dateFormat: "dd-mm-yy"		
});
  });*/
    var thing = moment();
datesearch(thing.format('DD-M-YYYY'),true);
var currentDate = thing.format('DD-M-YYYY');

//Code for swipe
 var x = 0,xx=0;
            var y =0,yy=0;
            var t = 0,tt=0;
        document.getElementById('frameplace').addEventListener('touchstart',function(e)
    {
e.preventDefault();
        var ob = e.changedTouches[0];
        x = ob.pageX;
        y = ob.pageY;
        t = new Date().getTime();
    });
     document.getElementById('frameplace').addEventListener('touchend',function(e)
    {
e.preventDefault();

        tt = new Date().getTime();
        var ob = e.changedTouches[0];
        xx = ob.pageX;
        yy = ob.pageY;
        if(Math.abs(tt-t)<200)
            {
                var abs_x = Math.abs(xx-x);
                 var abs_y = Math.abs(yy-y);

        if(abs_x>abs_y)
            {
                //x movement is greater
                if(xx>x)
                    {
       

                    

                 //right Swipe
                 

                    return 0;
                    }
                    else
                        {


                    //left swipe
                            return 1;
                        }
            }
            else
                {
                    //y movement is greater
                    if(yy>y)
                        {
                            //console.log("Down Swipe");
                            return 2;
                        }
                        else
                            {
                                //console.log("Up Swipe");
                                return 3;
                            }
                }
            }
    });
            </script>
    </body>
</html>
