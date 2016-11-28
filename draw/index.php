<?php
session_start();
if(isset($_SESSION['userid']))
$userid = $_SESSION['userid'];
else
header('location: ../index.php?logreq&backto=draw');
include '../connect.php';

?>
<html>
<head>
<title>Notes Draw</title>
  <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
          <link rel="stylesheet" href="notesGen.css">
<link rel="shortcut icon" href="favicon.png">

  <script src="../notey.js"></script>
  <script>
  function openDoc(ob)
  {
      window.open('page.php?id='+ob.dataset.id,'_self');
  }
  function loadList(filter)
  {
    document.getElementById('resultSlot').innerHTML="";
    notey.get('documentFetch.php?filter='+filter,function(data){
      var dec = JSON.parse(data.response);
      var i=0;
      while(dec[i]!=null)
      {
        buildResult(dec[i]);
        i++;
      }
    });
  }
  function buildResult(ob)
  {
var result = document.createElement('div');
result.setAttribute('id','result');
result.setAttribute('data-id',ob.id);
result.setAttribute('onclick','openDoc(this)');
result.innerHTML=ob.title;
document.getElementById('resultSlot').appendChild(result);
  }
  function loadCategory(ob)
  {
    loadList(ob.value);
  }
  </script>
  </head>
  <body>
  <div id="pageOptions"> Category : <select id = "cat" onchange="loadList(this.value);">
  <option id = "0">All</option>
<?php 
$q = mysqli_query($link,"select * from draw_category");
while($re = mysqli_fetch_array($q))
{
  echo '<option id = "'.$re['id'].'">'.$re['category'].'</option>';
}
?>
</select> <br><br> <a href="add.php">Add Document </a> | <a href="timeLine.php">Add Year and Event </a> |  <a href = "bc.php"> Add BC event</a></div>
  <div id=resultSlot>
</div>
<style>
</style>
<script>
loadList('all');
</script>
  </body>
  </html>