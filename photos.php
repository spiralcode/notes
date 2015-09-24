<?php
include 'ease.php';
$group=get('group')
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Photos</title>
        
        <script src="ajax_1_10_2.js"></script>
          <link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="raid.css"/>
        <script src="raid.js"></script>
          <script src="lib/jquery-ui.js"></script>


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
                                       box-shadow: 1px 0px 5px #48654A;
     
                        }

            body
            {
                background: #fff;
            }
            #overlayOptions
            {
               position: fixed;
                display: none;
                z-index: 9999;
                text-align:right;
                vertical-align:baseline;
                background-image: url(images/optionbar.png);
                color:#fff;
                cursor: pointer;
            }
              #overlayOptions:hover
            {

            }
            .options
            {
font-family:"Segoe UI Light",arial,serif;
font-size: 20px;
color:#2F51B6;
height: 50px;
text-decoration: none;
            }
                        .options:hover
                        {
                        }
            
            a
            {
                text-decoration: none;
            }
            .empty
            {
font-family:"Segoe UI Light",arial,serif;
color: #1B3450;
font-size: 13px;
            }
            #infoSpace
            {
font-family:"Segoe UI Light",arial,serif;
font-size: 18px;
color:#093658;
text-shadow: 1px 1px 5px #000;
background: #fff;
            }
            </style>
            <script>
                var imageID=0;
                function tagPerson(id)
            {
                $.get('personList.php',function (data,success)
            {
                var json = JSON.parse(data);
                var counter = 0; var attachString='';
                while(typeof(json[counter])!='undefined')
                    {
                        attachString+='<option value = '+json[counter].id+'>'+json[counter].name+'</option>';
                        counter++;
                    }
                    if(counter!=0)
                        {
                                    var ob = document.getElementById('infoSpace');              
                ob.innerHTML='<div align="center"><p>This picture has whom ?</p><select id = "peoples"></select><div>';
                $id('peoples').innerHTML=attachString;
                }
                else
                    {                    var ob = document.getElementById('infoSpace');              
                                        ob.innerHTML='<div align="center"><p>Your people\'s list is empty, you need atleast one to try this facility</p><div>';

            }}
            );
            }
            function deletesImage(id)
            {
                var ob = document.getElementById('infoSpace');              
                ob.innerHTML='<div align="center"><p>Are you sure about this ?</p><button onclick="goDelete('+id+')">Yes</button><button onclick="noDelete()">No</button></div>';
    }
            function goDelete(id)
            {
                $.post('delete_image.php',
                {id:id},function(data,success){
        if(data==1)
            {
                closething('uq');
  $( "#"+id ).effect( "clip", "slow",function() {$id(id).style.display="none";} );
                  overlayOptionsOut();
            }
        else{
            alert('We are facing some issues, prohibiting us from deleting this one !, try again later.');
        }
    });
    }
    function noDelete()
    {
        
        var ob = document.getElementById('infoSpace');
                ob.innerHTML='';
                overlayOptionsOut();
    }            
            function $id(id)
            {
                return document.getElementById(id);
            }
            function msg(msg)
            {
                var ob = document.getElementById('infoSpace');              
                ob.innerHTML=msg;
            }
     
            </script>
       
    </head>
    <body onload ="fetchImages();">
        <div class="options" align="center" style="font-family:"Segoe UI Light", Arial;"><a href="albums.php"><< Back to Albums</a></div>
        <div id="img_container" class="image_title">
            <div id="overlayOptions" onmousout="overlayOptionsOut()">Options</div>
  <script>
      function $id(id)
      {
          return document.getElementById(id);
      }
      function overlayOptions(ob)
      {
        var referDimension = ob.getBoundingClientRect(); 
        $id('overlayOptions').style.width=referDimension.width+"px";
        //$id('overlayOptions').style.height=(referDimension.height*30)/100+"px";
        $id('overlayOptions').style.left=referDimension.left+"px";
                $id('overlayOptions').style.top=referDimension.top+"px";
                $id('overlayOptions').style.display='block';
                $id('overlayOptions').setAttribute('onclick','imageOptions('+ob.id+')');
                
      }
      function overlayOptionsOut()
      {
                         $id('overlayOptions').style.display='none';
 
      }
      function imageOptions(imageId)
      {
    showMsg('photo_options.php?id='+imageId,{iframe:false,title:"Photo Options (Alpha)",expand:"auto"});  
    $id('uq_content').style.backgroundImage="url(image.php?resize&factor=20&id="+imageId+")";
        $id('uq_content').style.backgroundSize="fit";
                $id('uq_content').style.backgroundRepeat="no-repeat";
                                $id('uq_content').style.backgroundPosition="center center";




      }
    
            function fetchImages()
            {
                
            $id('spinner').style.display="block";
                $.get('images.php?group=<?php echo $group; ?>',function(data,success)
            {
                var ennam,counter;
                counter=ennam=0;
               var ob=JSON.parse(data);
               while(typeof(ob[counter])!='undefined')
                   {
              var state='<a target="_new" href="image.php?id='+ob[counter].id+'"><img  class="image_entity" src = "image.php?thumb&size=200x200&id='+ob[counter].id+'"/></a>';
              var obj = document.createElement('span');
              obj.innerHTML=state;
              obj.setAttribute('class','image_entity');
              obj.setAttribute('id',ob[counter].id);
              obj.setAttribute('onmouseover','overlayOptions(this);');
              document.getElementById('img_container').appendChild(obj);
              counter++;
              ennam++;
            $id('spinner').style.display="none";

                   }
                   if(ennam===0)
            {
            $id('img_container').innerHTML="<div align=\"center\"><strong>This album seems to be empty !</strong><p> You can attach images  via <a href=\"paper.php\" target=\"_top\">\'Add Note\' </a>option. All images uploaded will be in \'Attachements\' album.</div>";
            $id('img_container').setAttribute('class','empty');
                        $id('spinner').style.display="none";

            }
            }
            );
            
            }

            </script></div>
                <div align="center" class="spinner" id="spinner"></div>

    </body>
</html>
