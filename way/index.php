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
            function $id(id)
            {
                return document.getElementById(id);
            }
            function login()
            {
                var email=$id('email').value, pass = $id('pass').value;
                notey.post('login.php',{email:email,pass:pass,cook:0},function(data){
                    var info = data.responseText;
                    if(info==0){$id('report').innerHTML="Password or email is wrong, try again. ";}
                    else
                      window.location.href="home.php";
                });
            }
            </script>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <!-- Add your site or application content here -->
        <h1>Notes <sup>v3</sup></h1>
        <div class="login" align="center"><h3>Login</h3>
        <form><table><tr>
                    <td><span id="report">&nbsp;</span></td></tr><tr>
                    <td align="center">
            <input placeholder="E-mail" type="text" id="email"/></td></tr><tr>
                    <td align="center"> <input placeholder="Password" type="password" id="pass"/></td></tr>
            <tr><td align="center"><button class="button-primary" type="button" onclick="login();" align="center">Log In</button></td></tr>
            </table>
        </form></div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.3.min.js"><\/script>')</script>
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>

        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
    </body>
</html>
