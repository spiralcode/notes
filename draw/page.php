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
  </script>
  </head>
  <body>
  <?php
  $docId=$_GET['id'];
  $q = mysqli_query($link,"select * from draw where id= $docId ")or die(mysqli_error($link));
  while($data=mysqli_fetch_array($q))
  {
      $title=$data['title'];
      $id=$data['id'];
    $content=$data['content'];
echo "<title>".ucfirst(strtolower($title))."</title>";
echo '<meta property="og:url"                content="https://note-runfree.rhcloud.com/draw/page.php?id='.$id.'" />
<meta property="og:type"               content="article" />
<meta property="og:title"              content="'.ucfirst(strtolower($title)).'" />
<meta property="og:description"        content="'.substr(strip_tags($content),0,30).'..." />
<meta property="og:image"              content="https://note-runfree.rhcloud.com/draw/favicon.png" />
<meta property="url"                content="https://note-runfree.rhcloud.com/draw/page.php?id='.$id.'" />
<meta property="type"               content="article" />
<meta property="title"              content="'.ucfirst(strtolower($title)).'" />
<meta property="description"        content="'.substr(strip_tags($content),0,30).'..." />
<meta property="image"              content="https://note-runfree.rhcloud.com/draw/favicon.png" />
';
  }
?>

  <div id="docShow">
  <script>
var id = '<?php echo $_GET['id']; ?>';
function deleteConfirm()
{
    var t = window.confirm("Are you sure about deleting this document ?");
  if(t)
    {
        notey.post('delete.php',{id:id},function(data){
if(data.response==1)
{
alert('Deleted');
window.location="index.php";
}
else
{
    alert('Error occured on deletion');
}
        });
    }
}

</script>

  <?php
      echo "<div id=\"pageTitle\">".ucfirst(strtolower($title))."</div>";
      echo "<div id = \"pageOptions\"><a href=\"edit.php?id=$id\">Edit</a> | <a onclick = \"deleteConfirm()\">Delete</a> | <a href = \"index.php\">Show all documents</a> | <a href=\"add.php\">Add document</a></div>";
    echo "<div id=\"content\">$content<div>";

?>
</div>

  </body>
  </html>