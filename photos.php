<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Photos</title>
        
        <script src="ajax_1_10_2.js"></script>
      <style>
            .image_title 
            {
                

            }
            .image_entity
            {
                position: relative;
                float: right;
                border: 1px #f00 dotted;
                cursor: pointer;
            }
            </style>
    </head>
    <body onload ="fetchImages();">
        <div class="image_title">
  <script>
            function fetchImages()
            {
                $.get('images.php',function(data,success)
            {
                
               var ob=JSON.parse(data);
               var counter=0;
               while(typeof(ob[counter].id)!==null)
                   {
              var state='<a target="_new" href="image.php?id='+ob[counter].id+'"><img  class="image_entity" src = "image.php?thumb&size=110x110&id='+ob[counter].id+'"/></a>';
              console.log(state);
              document.write(state);  
              counter++;
                   }
            }
            );
            }
            </script></div>
    </body>
</html>
