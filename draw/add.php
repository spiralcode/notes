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
<div style="text-align:center;"><img style="width:4em; height:4em; margin:.5em;" src="data:image/png;base64,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"/></div>

<div style="margin:1em; text-align:center;">
<input id="title" type="text" placeholder="Title for document"/>
<input onclick="cD(this)" type="button" value="Create Document"/>
</div>
<script>
function cD(ob)
{
    if(document.getElementById('title').value=="")
    {
        alert("Can't proceed without a Title ");
        return;
    }
ob.value="Creating...";
notey.post("createDoc.php",{title:document.getElementById('title').value},function(data){
    var data = data.response;
alert("Document Created !\n\nNow you can edit the document contents. \n\n The document is auto-saved at regular intervals and is kept as draft, therefore your un-published contents are'nt lost even if you close or exit the editing page. Next time, you open the edit page, you can restore the draft. ");
ob.value="Preparing document...";
document.location="edit.php?id="+data;
})
}
</script>
</body>
</html>