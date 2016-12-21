<?php
//include '../session_check.php';
include '../connect.php';
session_start();

?>
<html>
<head>
  <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
          <link rel="stylesheet" href="notesGen.css">
  <?php
  $docId=$_GET['id'];
  $q = mysqli_query($link,"select * from draw where id= $docId ")or die(mysqli_error($link));
  if(mysqli_num_rows($link,$q)==0)
  {
    header('location: pageNotFound.php');
  }

  while($data=mysqli_fetch_array($q))
  {
      $title=$data['title'];
      $id=$data['id'];
    $content=$data['content'];
    $writerId=$data['userid'];
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
  </head>
  <body>
    <script async src="../notey.js"></script>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.8&appId=593526644156691";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
  <?php
      echo "<div id=\"pageTitle\">".ucfirst(strtolower($title))."</div>";
      echo '<div id = "pageOptions">';
if(isset($_SESSION['userid']))
{
      if($writerId==$_SESSION['userid'])
      {
       echo '<div class="fb-like" data-href="https://note-runfree.rhcloud.com/draw/page.php?id='.$id.'" data-layout="button_count" data-action="like" data-size="small" data-show-faces="false" data-share="true"></div>'; 
      echo " | <a href=\"edit.php?id=$id\">Edit</a> | <a onclick = \"deleteConfirm()\">Delete</a> | <a href = \"index.php\">Show all documents</a> | <a href=\"add.php\">Add document</a></div>";
      }
      else
      {
echo '<div class="fb-like" data-href="https://note-runfree.rhcloud.com/draw/page.php?id='.$id.'" data-layout="button_count" data-action="like" data-size="small" data-show-faces="false" data-share="true"></div>';
      }
}
      else
      {
        echo '<div class="fb-like" data-href="https://note-runfree.rhcloud.com/draw/page.php?id='.$id.'" data-layout="button_count" data-action="like" data-size="small" data-show-faces="false" data-share="true"></div>';
      }
echo "</div>'";
    echo "<div id=\"content\">$content<div>";
?>
</div>

  </body>
  </html>