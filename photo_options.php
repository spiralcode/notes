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
              font-size: 15px;
              background: #fff;
              margin-top: 10%;
          }
          body{
              background: #fff;
          }
          #infoSpace
          {
              color:#2F51B6;
              font-size: 13;
              text-align: center;
          }
          .imagePlace
          {
              position: absolute;
              left: 0px;
              
          }
          button
          {
              background: #fff;
          }
          #tagList
          {
              position: absolute;
              bottom: 2%;
              margin: 2% ;
          }
</style>
    </head>
    <body>
        <script>
            function deleteImage()
            {
                var ob = document.getElementById('infoSpace');
                ob.innerHTML='<div align="center">Are you sure about this ? <button onclick="goDelete()">Yes</button><button onclick="noDelete()">No</button></div>';
            }
            function goDelete()
            {
                $.post('delete_image.php',
                {id:'<?php echo $id; ?>'},function(data,success){
        if(data===1)                
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
                ob.style.texAlign="center";
    }
            </script>
<div class="options" align="center"><span style="cursor:pointer;" onclick="deletesImage('<?php echo $id ?>');">Delete </span> | 
    <span style="cursor:pointer;" onclick="tagPerson('<?php echo $id; ?>');">Tag people in this image</span> | 
        <a onclick="msg('<p>Downloading starts any moment, please wait.</p>');" href ="downloadImage.php?id=<?php echo $id; ?>" target="_blank">Download</a> | 
        <span onclick="changeFolder('<?php echo $id; ?>');" style="cursor:pointer;">Move to another folder.</span></div>
    <div id="infoSpace"></div>
    </body>
