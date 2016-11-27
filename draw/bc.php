<!doctype html>
<?php
include '../session_check.php';
?>
<head>
  <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
          <link rel="stylesheet" href="notesGen.css">
            <script src="../notey.js"></script>
             <script src="../jss/moment.js"></script>       
             <script>
              function putThing()
          {
              var tillYear = document.getElementById('tillYear').value,fromYear= document.getElementById('fromYear').value;
              var content = document.getElementById('content').value;
  
          if(fromYear!=''&&content!='')
          {
            if(tillYear=='')
            {
                tillYear=0;
            }
          notey.post('saveBC.php',{tY:tillYear,content:content,fY:fromYear},function(data){
              if(data.response==1)
              {
                  alert('Saved');
              }
              else
              {
                  alert('Encountered an error on-course');
              }
          });
          }
          else
          {
              alert('\n\n\nAtleast,year and content is required  !\n\n\n');
          }
          }
             </script>   
</head>
<body>
<div id = "inputSection">
<table align="center">
<tr>
<td><input placeholder="From" type="number" id = "fromYear"/></td>
<td><input placeholder="Till (optional)" value="" type="number" id = "tillYear"/></td>
</tr>
<tr><td colspan=2><textarea placeholder="Content" id ="content"></textarea></td></tr>
<tr><td colspan=2><button onclick="putThing()">Feed</button></td></tr>
</table>
</div>
<script>
</script>
<div id = "resultSpace">
<div><a href="timeGraph.php">View</a></div>

</div>
<script>
</script>
</body>
</html>