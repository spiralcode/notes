<?php
include 'connect.php';
?>
<html>
<head>
<title>FOE Library</title>
  <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta property="og:type"               content="article" />
<meta property="og:title"              content="FOE Library" />
<meta property="og:description"        content="Full documents in FOE" />
<meta property="og:image"              content="https://note-runfree.rhcloud.com/draw/favicon.png" />
<meta property="url"                content="showRoom.php'" />
<meta property="type"               content="article" />
<meta property="title"              content="FOE Library" />
<meta property="description"        content="'Full documents in FOE" />
<meta property="image"              content="https://note-runfree.rhcloud.com/draw/favicon.png" />
        </head>
<body>
<h2 align="center">Freedom of Expression </h2>
<h4>Full stack</h4>
<table>
<?php
 $q = mysqli_query($link,"select title,id from draw")or die(mysqli_error($link));
 $count=0;
  while($data=mysqli_fetch_array($q))
  {

    $title=$data['title'];
    $id = $data['id'];
    echo "<tr><td>".++$count."&nbsp;&nbsp;";
    echo '<a href = "https://note-runfree.rhcloud.com/draw/page.php?id='.$id.'" >'.$title.'</a>';
    echo "</td></tr>";
  }
?>
</table>
</body>
</html>
