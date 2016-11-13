<?php
include '../session_check.php';
include '../connect.php';

?>
<html>
<head>
  <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
          <link rel="stylesheet" href="notesGen.css">
  <script src="../notey.js"></script>
  <script>
  function openDoc(ob)
  {
      window.open('page.php?id='+ob.dataset.id,'_blank');
  }
  </script>
  </head>
  <body>
  <div id="pageOptions"><a href="add.php">Add Doc </a></div>
  <div id=resultSlot>
  <?php
  $q = mysqli_query($link,"select * from draw where userid= $userid ")or die(mysqli_error($link));
  while($data=mysqli_fetch_array($q))
  {
      $title=$data['title'];
      $id=$data['id'];
      echo "<div onclick=\"openDoc(this)\" data-id=\"$id\" id=\"result\">$title</div>";
  }
?>
</div>
  </body>
  </html>