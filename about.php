<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <style>
            .container
            
            {
                margin: 10%;
                width: 80%;
            }
            .briefing
            {
font-family: "Segoe UI Light",arial,serif;
                font-size: 15px;
                color:  #292c3c;
                color: #4F6F32;
            }
            .title
            {
                font-size: 21px;
                color:  #0c0d15;
font-family: "Segoe UI Light",arial,serif;
                                opacity: .5;
                                

            }
            a{
                text-decoration: none;
                
            }
            a:hover
            {
                text-decoration: underline;
            }
            .ddlogo
            {
      color: #508844;
font-family: "Segoe UI Light",arial,serif;
font-size: 40px;
text-align: center;

            
}
        </style>
    </head>
    <body>
        <div class="container">
            <div class="ddlogo">Notes Deep Dive</div>
        <div class="title" >About</div>
        <div class="briefing">This is an independent project coded by <a target="new" href="https://facebook.com/rajkrrishnan" title="me on Facebook"> me</a> . 
       The project is 
     hosted in  SSL enabled, <a target="new" href="https://openshift.com">Redhat Cloud Server</a>. </div><br>
                <div class="title">Client</div>
        <div class="briefing">Detected IP : <?php echo $_SERVER['REMOTE_ADDR'] ;?></div><br>
                        <div class="title">3rd party components</div>
        <div class="briefing">List of open-source resources used for enabling certain features, <ul><li><a href="http://momentjs.com/" targer="new">MomentJS</a></li><li><a href="https://developers.google.com/maps/?hl=en
" target="new">Google Maps API</a></li><li><a href="http://openweathermap.org/API" target="new">Openweather</a></li></div>
        </div>

    </body>
</html>
