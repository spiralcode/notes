<html>
    <head>
        <style>
            .formArea
            {
                text-align: center;
                font-size: 13px;
                font-family: "Segoe UI Light",Arial,serif;
            }
           #reportArea
           {
               text-align: center;
               color: #002810;
               font-family: "Segoe UI Light",arial,serif;
               font-size: 16px;
                   margin:1%;
           }
           .formArea input
           {
               text-align: left;
               font-size: 18px;
               font-family: "Segoe UI Light",arial,serif;
               
               
           }
           .formArea button
           {
                              font-size: 18px;
                              font-family: "Segoe UI Light",arial,serif;

           }
            </style>
    </head>
    
    <body>
        <script src ="notey.js"></script><script>
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
            }
            else {
                document.getElementById('reportArea').innerHTML="Folder named <b>"+stuff+"</b> already exists or seems invalid.";
            }});
            }else{
                document.getElementById('reportArea').innerHTML="Give us a valid album name of your choice";
            }}
        </script>
        <div class="formArea"><input placeholder="type-in a album name" type="text" id="albname"/><button onclick="creatAlbum();">Create album</button></div>
        <div id="reportArea"></div>
    </body>
        </html>