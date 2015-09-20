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
                    width: 150px;
    height: 150px;
    display: table-cell;
    vertical-align:middle;
    text-align:center;
    color: #FFFFFF;
    text-decoration: none;
                background: #2F51B6;
                cursor: pointer;
                margin-right: 1%;
                float:left;
                line-height: 150px;

                
            }
            .image_entity .count
            {
            font-size: 15px;
vertical-align: text-top;
display: inline-block;
opacity: .5;
}
                
                
            }
                        .image_entity:hover
                        {
                                       box-shadow: 0px 0px 10px #48654A;
     
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
            </style>
            <script>
                var imageID=0;
            function deletesImage(id)
            {
                var ob = document.getElementById('infoSpace');              
                ob.innerHTML='<div align="center"><p>Are you sure about this ?</p><br><button onclick="goDelete('+id+')">Yes</button><button onclick="noDelete()">No</button></div>';
    }
            function goDelete(id)
            {
                $.post('delete_image.php',
                {id:id},function(data,success){
        if(data==1)
            {
                closething('uq');
                                //$('#'+id).delay(0).fadeOut(2000);
  $( "#"+id ).effect( "clip", "slow",function() {$id(id).style.display="none";} );
                  overlayOptionsOut();


               // $id(id).style.display="none";
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
    showMsg('album_options.php?id='+imageId,{iframe:false,title:"Album Options (Alpha)"});  
    }
            function fetchImages()
            {
                $.get('fetch_albums.php',function(data,success)
            {
                
               var ob=JSON.parse(data);
               var counter=0;
               while(typeof(ob[counter].id)!==null)
                   {
              var state=ob[counter].name;
              var obj = document.createElement('div');
              obj.innerHTML=state;
              obj.setAttribute('class','image_entity');
              obj.setAttribute('id',ob[counter].id);
              obj.setAttribute('onmouseover','overlayOptions(this);');
              var link= "goTopage('photos.php?group="+ob[counter].id+"')";
               obj.setAttribute('onclick',link);
              document.getElementById('img_container').appendChild(obj);
              var count = document.createElement('div');
              obj.appendChild(count);
              count.setAttribute('class','count');
              count.innerHTML=ob[counter].count;
              counter++;
                   }
            }
            );
            }
function goTopage(some)
{
    window.location=some;
}
            </script></div>
    </body>
</html>
