<!doctype html>
<head>  <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
          <link rel="stylesheet" href="notesGen.css">
              <script async src="../notey.js"></script>

<title>
F.O.E - Create a document.
</title>
<style>
input 
{
    font-size:1em;
}
</style>
</head>
<body>
<div class="topbar">
<table>
<tr><td><a href="index.php" title="home">FOE</a></td><td></td></tr>
</table>
</div>
<div style="margin:1em; text-align:center;">
<input id="title" type="text" placeholder="Title for document"/>
<input onclick="cD(this)" type="button" value="Create Document"/>
</div>
<script>
function cD(ob)
{
ob.value="Creating...";
notey.post("createDoc.php",{title:document.getElementById('title').value},function(data){
    var data = data.response;
alert("Document Created !\nNow you can edit the document contents. \n The document is auto-saved at regular intervals and is kept as draft, therefore your un-published contents are'nt lost even if you close or exit the editing page. Next time, you open the edit page, you can restore the draft. ");
document.location="edit.php?id="+data;
})
}
</script>
</body>
</html>