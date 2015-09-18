<!DOCTYPE html>
<html>
    <head>
        <title>Photos</title>
        
        <script src="ajax_1_10_2.js"></script>
          <link rel="stylesheet" href="style.css">

      <style>
            .image_title 
            {
                                position: relative;

               background: #dadada;
               width:100%;
            }
            .image_entity
            {
                position: relative;
                float: left;
                cursor: pointer;
                margin: 1%;
                box-shadow: 0px 0px 10px #485565;
                
            }
                        .image_entity:hover
                        {
                                       box-shadow: 0px 0px 10px #48654A;
     
                        }

            body
            {
                background: #fff;
            }
            
            </style>
    </head>
    <body onload ="fetchImages();">
        <div id="img_container" class="image_title">
  <script>
            function fetchImages()
            {
                $.get('images.php',function(data,success)
            {
                
               var ob=JSON.parse(data);
               var counter=0;
               while(typeof(ob[counter].id)!==null)
                   {
              var state='<a target="_new" href="image.php?id='+ob[counter].id+'"><img  class="image_entity" src = "image.php?thumb&size=100x100&id='+ob[counter].id+'"/></a>';
              var obj = document.createElement('span');
              obj.innerHTML=state;
              obj.setAttribute('class','image_entity');
                            obj.setAttribute('id','image_entity');

              document.getElementById('img_container').appendChild(obj);
              counter++;
                   }
            }
            );
            }
            </script></div>
    </body>
</html>
