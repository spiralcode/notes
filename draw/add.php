<!DOCTYPE html>
<?php
include '../session_check.php';
include '../connect.php';
?>
<html>
<head>
<title>Notes Draw</title>

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
  <script>
  function saveDoc()
  {
    var title = document.getElementById('titleDoc').value, content = document.getElementById('edit').value, cat = document.getElementById('cat').value;
       if(title!=''&&content!='')
    {
    document.getElementById('saveDoc').innerHTML="Saving...";
    document.getElementById('saveDoc').setAttribute('disabled','disabled');
    notey.post('save.php',{title:title,content:content,cat:cat},function(data){if(data.response=='1')
    {
      alert('Saved');
      window.location="index.php";
    }
    else
    {
      alert('Error Occured on saving...');
    }
    });
  }
  else
  {
        alert('Can\'t save ! \n\nContent or Subject is empty.');
  }
  }
  </script>
</head>

<body><div style="text-align:left" id= "docOptions">
<input placeholder="Title" type="text" id = "titleDoc"><select id = "cat">
<?php 
$q = mysqli_query($link,"select * from draw_category");
while($re = mysqli_fetch_array($q))
{
  echo '<option id = "'.$re['id'].'">'.$re['category'].'</option>';
}
?>
</select>
<button id="saveDoc" onclick="saveDoc()">Save</div>
  <form>
    <textarea id="edit" name="content"></textarea>
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
          $('#edit').froalaEditor()
      });
  </script>
    <style>
  a[href="https://froala.com/wysiwyg-editor"]
{
visibility: hidden;
}
  </style>
</body>
</html>
