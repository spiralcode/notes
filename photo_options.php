<?php
include 'ease.php';
$id=get('id');
?>
<html>
    <head>
        <link rel="stylesheet" href="style.css">
        <script src="ajax_1_10_2.js"></script>

      <style>
          .options
          {
              margin: 10px;
              font-size: 15px;
          }
          body{
              background: #fff;
          }
</style>
    </head>
    <body>
        <script>
            function deleteImage()
            {
                var ob = document.getElementById('infoSpace');
                ob.innerHTML='<div align="center">Are you sure about this ?<br><button onclick="goDelete()">Yes</button><button onclick="noDelete()">No</button></div>';
            }
            function goDelete()
            {
                $.post('delete_image.php',
                {id:'<?php echo $id; ?>'},function(data,success){
        if(data==1)                
        document.getElementsByTagName('body')[0].innerHTML="<center>That was clean, the Image was removed</center>";
        else{
            alert('We are facing some issues, prohibiting us from deleting this one !, try again later.');
        }
    });
    }
    function noDelete()
    {
        
        var ob = document.getElementById('infoSpace');
                ob.innerHTML='';
    }
            </script>
<div align="center"><img src ="image.php?thumb&size=200x200&id=<?php echo $id; ?>">        </div>
<div class="options" align="center"><span style="cursor:pointer;" onclick="deleteImage();">Delete </span> | Tag a person | Download</div>
<div id="infoSpace"></infoSpace>
    </body>
