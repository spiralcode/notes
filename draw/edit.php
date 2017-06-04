<!DOCTYPE html>
<?php
include '../session_check.php';
include '../connect.php';
$id=$_GET['id'];
$q = mysqli_query($link,"select * from draw where id= $id ")or die(mysqli_error($link));
  while($data=mysqli_fetch_array($q))
  {
 $title=$data['title'];
  $id=$data['id'];
   $content=$data['content'];
   $cat = $data['category'];
  }
  $presence=0;
  $restoreData='';
    $qq = mysqli_query($link,"select * from draw_draft where docId= $id ")or die(mysqli_error($link));
  while($data=mysqli_fetch_array($qq))
  {
    $presence = 1;
    $restoreData = $data['content'];
  }
  if(isset($_GET['draft']))
  {
    $content=$restoreData;
  }
?>
<html>
<head>
<title>Notes Draw</title>
<link rel="icon" href="favicon.png"/>
  <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Include Font Awesome. -->
  <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

  <!-- Include Editor style. -->
  <link href="css/froala_editor.min.css" rel="stylesheet" type="text/css" />
  <link href="css/froala_style.min.css" rel="stylesheet" type="text/css" />
  <!-- Include Code Mirror style -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/codemirror.min.css">

  <!-- Include Editor Plugins style. -->
  <link rel="stylesheet" href="css/plugins/char_counter.css">
  <link rel="stylesheet" href="css/plugins/code_view.css">
  <link rel="stylesheet" href="css/plugins/colors.css">
  <link rel="stylesheet" href="css/plugins/emoticons.css">
  <link rel="stylesheet" href="css/plugins/file.css">
  <link rel="stylesheet" href="css/plugins/fullscreen.css">
  <link rel="stylesheet" href="css/plugins/image.css">
  <link rel="stylesheet" href="css/plugins/image_manager.css">
  <link rel="stylesheet" href="css/plugins/line_breaker.css">
  <link rel="stylesheet" href="css/plugins/quick_insert.css">
  <link rel="stylesheet" href="css/plugins/table.css">
  <link rel="stylesheet" href="css/plugins/video.css">
  <link rel="stylesheet" href="notesGen.css">
  
  <script src="../notey.js"></script>
  <script src="../jss/moment.js"></script>
  <script>
  function restoreDraft(ob)
{
  console.log(document.getElementById('restoreIt').innerHTML);
  //document.getElementById('edit').value=document.getElementById('restoreIt').innerHTML;

}
  function saveDoc()
  {
    var id = <?php echo $id; ?>;
    var title = document.getElementById('titleDoc').value, content = document.getElementById('edit').value,cat = document.getElementById('cat').value;
    if(title!=''&&content!='')
    {
         document.getElementById('saveDoc').innerHTML="Saving...";
    document.getElementById('saveDoc').setAttribute('disabled','disabled');
    notey.post('save.php?edit',{id:id,title:title,content:content,cat:cat},function(data){if(data.response=='1')
    {
      alert('Saved');
      window.location='page.php?id='+id;
    }
    else
    {
      alert('Error Occured on Saving');
    }
    });
  }
  else
  {
    alert('Can\'t save !\n\nContent or Subject is empty');
  }
  }
  </script>
  <div id = "cac" style="display:none;"><?php echo $content; ?></div>
<script>
var cont = document.getElementById('cac').innerHTML;
function autoSave()
{
  if(cont!=document.getElementById('edit').value)
  {
    var docId = <?php echo $id ?>;
    var current = document.getElementById('edit').value;
    document.getElementById('saveStatus').innerHTML="Saving Draft...";
    
    notey.post('autoSave.php',{docId:docId,content:current},function(data){
      if(data.response==1)
      {
            document.getElementById('saveStatus').innerHTML="Draft saved at "+moment().format('hh:mm:ss');
                cont=document.getElementById('edit').value;


      }

    });
  }
}

  </script>
</head>

<body>
<div class="topbar">F.O.E</div>
<div style="font-size: 1.5em;text-align:left; background:rgba(172, 213, 174, 0.41);" id= "docOptions">

<input placeholder="Title" type="text" id = "titleDoc" value="<?php echo $title; ?>">
<select id = "cat">
<?php 
$q = mysqli_query($link,"select * from draw_category");
while($re = mysqli_fetch_array($q))
{
  if($re['category']==$cat)
  echo '<option selected id = "'.$re['id'].'">'.$re['category'].'</option>';
  else
  echo '<option id = "'.$re['id'].'">'.$re['category'].'</option>';
}
?>
</select>
<button id="saveDoc" onclick="saveDoc()">Publish</button></div>
<?php
if($presence==1&&isset($_GET['draft'])==false)
echo '<div style="cursor:pointer; color : blue; padding:1.5em; text-decoration:underline;" align = "center" ><a href = "?draft&id='.$id.' ">Draft Exists, Click to restore contents</a></div>';
if(isset($_GET['draft']))
{
  echo '<div style="cursor:pointer; color : blue; padding:1em; " align = "center" >Draft Edit</div>';
}
?>
<div align="center" id = "saveStatus">&nbsp;</div>
  <form>
    <textarea id="edit" name="content"><?php echo $content;?></textarea>
  </form>

  <!-- Include jQuery. -->
  <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

  <!-- Include JS files. -->
  <script type="text/javascript" src="js/froala_editor.min.js"></script>

  <!-- Include Code Mirror. -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/codemirror.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/mode/xml/xml.min.js"></script>

  <!-- Include Plugins. -->
  <script type="text/javascript" src="js/plugins/align.min.js"></script>
  <script type="text/javascript" src="js/plugins/char_counter.min.js"></script>
  <script type="text/javascript" src="js/plugins/code_beautifier.min.js"></script>
  <script type="text/javascript" src="js/plugins/code_view.min.js"></script>
  <script type="text/javascript" src="js/plugins/colors.min.js"></script>
  <script type="text/javascript" src="js/plugins/emoticons.min.js"></script>
  <script type="text/javascript" src="js/plugins/entities.min.js"></script>
  <script type="text/javascript" src="js/plugins/file.min.js"></script>
  <script type="text/javascript" src="js/plugins/font_family.min.js"></script>
  <script type="text/javascript" src="js/plugins/font_size.min.js"></script>
  <script type="text/javascript" src="js/plugins/fullscreen.min.js"></script>
  <script type="text/javascript" src="js/plugins/image.min.js"></script>
  <script type="text/javascript" src="js/plugins/image_manager.min.js"></script>
  <script type="text/javascript" src="js/plugins/inline_style.min.js"></script>
  <script type="text/javascript" src="js/plugins/line_breaker.min.js"></script>
  <script type="text/javascript" src="js/plugins/link.min.js"></script>
  <script type="text/javascript" src="js/plugins/lists.min.js"></script>
  <script type="text/javascript" src="js/plugins/paragraph_format.min.js"></script>
  <script type="text/javascript" src="js/plugins/paragraph_style.min.js"></script>
  <script type="text/javascript" src="js/plugins/quick_insert.min.js"></script>
  <script type="text/javascript" src="js/plugins/quote.min.js"></script>
  <script type="text/javascript" src="js/plugins/table.min.js"></script>
  <script type="text/javascript" src="js/plugins/save.min.js"></script>
  <script type="text/javascript" src="js/plugins/url.min.js"></script>
  <script type="text/javascript" src="js/plugins/video.min.js"></script>

  <!-- Include Language file if we want to use it. -->
  <script type="text/javascript" src="js/languages/ro.js"></script>

  <!-- Initialize the editor. -->
  <script>
      $(function() {
          $('#edit').froalaEditor({height: 400})
      });

      //autoSave 
      window.setInterval(function(){autoSave();},3000);
      
  </script>
  <style>
  a[href="https://froala.com/wysiwyg-editor"]
{
visibility: hidden;
}
  </style>

</body>
</html>
