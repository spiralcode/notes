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
          <link rel="icon" href="favicon.png">
  <style>
  #vC
  {
    text-decoration:underline;
    cursor:pointer;
  }
  </style>
  <?php
  $docId=$_GET['id'];
  $q = mysqli_query($link,"select * from draw where id= $docId ")or die(mysqli_error($link));
  if(mysqli_num_rows($q)==0)
  {
    header('location: pageNotFound.php');
  }

  while($data=mysqli_fetch_array($q))
  {
    $title=$data['title'];
    $id=$data['id'];
$date = $data['date'];
   $aux = mysqli_query($link,"select id from view_count where id = $id");
   $vC = mysqli_num_rows($aux);
   if(mysqli_num_rows($aux)<=0)
   {
     $vC = 0;
   }
   if($vC<9)
   {
     $vC = "0".$vC;
   }
    $content=$data['content'];
    $writerId=$data['userid'];
echo "<title>".$title."</title>";
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
    var t = window.confirm("Are you sure about deleting this document ? \n This document will not be recoverable. ");
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
      echo "<div id=\"pageTitle\">".$title."</div>";
      echo '<div id = "pageOptions">';
if(isset($_SESSION['userid']))
{
      if($writerId==$_SESSION['userid'])
      {
                        echo "<span onclick=\"viewStat();\" id =\"vC\">$vC views</span>";
       echo '<div class="fb-like" data-href="https://note-runfree.rhcloud.com/draw/page.php?id='.$id.'" data-layout="button_count" data-action="like" data-size="small" data-show-faces="false" data-share="true"></div>'; 
      echo " | <a href=\"edit.php?id=$id\">Edit</a> | <a onclick = \"deleteConfirm()\"><u style=\"cursor:pointer;\">Delete</u></a> | <a href = \"index.php\">Show all documents</a> | <a href=\"add.php\">Add document</a> | <span><a href= \"https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=https://note-runfree.rhcloud.com/draw/page.php?id=$id\">Get QR code</a></span></div>";
      }
      else
      {
                        echo "<span onclick=\"viewStat();\"  id =\"vC\">$vC views</span>";
       echo '<div class="fb-like" data-href="https://note-runfree.rhcloud.com/draw/page.php?id='.$id.'" data-layout="button_count" data-action="like" data-size="small" data-show-faces="false" data-share="true"></div>'; 
      echo "  |  <a href = \"index.php\">Show all documents</a> | <a href=\"add.php\">Add document</a> | <span><a href= \"https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=https://note-runfree.rhcloud.com/draw/page.php?id=$id\">Get QR code</a></span></div>";
      }
}
      else
      {
    echo "<span onclick=\"viewStat();\"  id =\"vC\">$vC views</span>";
  echo '<div class="fb-like" data-href="https://note-runfree.rhcloud.com/draw/page.php?id='.$id.'" data-layout="button_count" data-action="like" data-size="small" data-show-faces="false" data-share="true"></div><span> | <a href="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=https://note-runfree.rhcloud.com/draw/page.php?id='.$id.'">Get QR code</a></span>';
      }
echo "</div>";
    echo "<div id=\"content\">$content<div>";
?>
</div>
<script>
function viewStat()
{
  window.location="viewStatus.php?id=<?php echo $id; ?>&year=2017&title=<?php echo $title; ?>";
}
var tim = window.setInterval(function(){
  notey.get('countViewNew.php?id=<?php echo $id; ?>',function(data){});
window.clearInterval(tim);
},<?php
$alg = round(str_word_count(strip_tags($content))/300);
if($alg<=0)
{
$alg=10000;
}
else
{
  $alg*=10000;
}
echo $alg;
?>);
</script>
</div>
<div class="infospace"><span>Document created on </span><span><?php echo $date?></span> |  <a href="../index.php" title="Make a document">Make a document in FOE</a></div>

  </body>
  </html>
