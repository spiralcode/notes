<?php
if(isset($_COOKIE['e'])){
header('location: login.php?cook');}
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

            function $id(id)
            {
                return document.getElementById(id);
            }
            function login()
            {
                $id('loginbutton').innerHTML="Logging in...";
                var email=$id('email').value, pass = $id('pass').value;
                if($id('cook').checked)
                var    cook=1;
                else 
                 cook = 0;
                notey.post('login.php',{email:email,pass:pass,cook:cook},function(data){
                    var info = data.responseText;
                    if(info==0){$id('report').innerHTML="Password or email is wrong, try again. ";
        $id('loginbutton').innerHTML="Log In";            
        }
                    else
                      window.location.href="home.php";
                });
            }
            </script>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <!-- Add your site or application content here -->
        <div class="topribbon"><h2>Notes <sup>v3</sup></h2></div>
        <div class="login" align="center" ><h5 style="opacity: .5; text-align: right;">Login</h5>
        <form>
            <ul style="list-style: none;">
           <li><span id="report">&nbsp;</span></li>
            <li><input placeholder="E-mail" autocomplete="off" type="text" id="email"/></li>
            <li><input placeholder="Password" type="password" id="pass"/></li>
            <li><input type="checkbox" id="cook">&nbsp;<span onclick="$id('cook').click();" for ="gender">remember me</span></li>
            <li><button id="loginbutton" class="button-primary" type="button" onclick="login();" >Log In</button></li>
        </ul></form></div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.3.min.js"><\/script>')</script>
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>

        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <div class="footer"><p><a href="../index.php?web">Desktop</a></p></div>
    </body>
</html>
