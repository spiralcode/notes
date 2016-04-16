<script src="notey.js"></script>
<script>

	notey.get('fileInfo.php?id=<?php echo $_GET['id']; ?>',function(data){
	var dec = JSON.parse(data.responseText);
document.getElementById('realFileName').value=dec[0].realFileName;
document.getElementById('icn').src='iconTransfer.php?title='+formatOf(dec[0].realFileName);
document.getElementById('format').innerHTML=formatOf(dec[0].realFileName);
if(dec[0].size/1000000>1)
document.getElementById('size').innerHTML=Math.ceil(dec[0].size/1000000)+' MB';
else if(dec[0].size/1000>1)
document.getElementById('size').innerHTML=Math.ceil(dec[0].size/1000)+' KB';
else
document.getElementById('size').innerHTML=dec[0].size+' B';
document.getElementById('dwnload_link').href='downloadImage.php?id=<?php echo $_GET['id'] ?>';

notey.get('iconTransfer.php?title='+formatOf(dec[0].realFileName),function(datam){
	document.getElementById('icn').src=datam.responseText;
    
});

		});
		
		
		
		
		function formatOf(fileName)
	{
  var collect=  fileName.split(".");
  var at = collect.length-1;
    if(collect[at]=='html')
    return 'text/html';
    else if(collect[at]=='css')
    return 'text/css';
        else if(collect[at]=='js')
    return 'application/javascript';
            else if(collect[at]=='json')
    return 'application/json';
	  else if(collect[at]=='mp3')
    return 'mp3';
        else if(collect[at]=='pdf')
    return 'pdf';
            else if(collect[at]=='jpeg')
    return 'jpeg';
               else if(collect[at]=='jpg')
    return 'jpeg';
                   else if(collect[at]=='png')
    return 'png';
	    else
    return collect[at];
	}
	</script>
	<style>
        a
        {
            text-decoration:none;
        }
		input[type="text"]
        {

                        font-family:Arial,Serif;
        }
        label
        {
            font-family:Arial,Serif;
color: rgb(67, 80, 85);
            opacity:.8;
        }
        		input[type="button"]
        {
background: cornflowerblue;
border:none;
color:white;
cursor:pointer;
padding: 5px;
        }
        .info
        {
            font-family:Arial;
padding:1em;
opacity: .8;
color: rgb(67, 80, 85);
        }
        .info span
        {
            opacity:1;
            font-weight: bold;
            color: forestgreen;
        }
        .skelt .iconSide
        {
            border-right:1px solid black;
        }
        .options
        {
            padding:1em;
        }
        .options span
        {
            color:black;
            font-family:Arial;
        }
		</style>
	<body id = "full">
        <table cellpadding="1" class="skelt"><tr><td rowspan="1" class="iconSide">
		<img id = "icn">
        <td>
		<label for ="realFileName">File Name</label> <input type="text" id= "realFileName"> <input type="button" value="Change"><br>
        <table>
            <tr><td><div class="info"> Size :  <span  id="size"></span> Format : <span id="format"></span></div></td></tr>
             <tr><td><div class="options"><span  id="dwnload"><a target="_blank" id="dwnload_link">Download</a></span> </div></td></tr></table></td></tr>
            </table></td></tr>
                       
            </table>
        </body>