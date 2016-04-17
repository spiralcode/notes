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
            border-right:1px solid rgb(67, 80, 85);
            opacity:.8;
        }
        .options
        {
            padding:1em;
            background: aliceblue;
            border-radius:3px;
        }
        .options span
        {
            color:black;
            font-family:Arial;
        }
        #notification
        {
            text-align:center;
            color:black;
            font-family:Arial;
            font-size:.8em;
        }
		</style>
<script src="notey.js"></script>
<script>

	notey.get('fileInfo.php?id=<?php echo $_GET['id']; ?>',function(data){
    var dec = JSON.parse(data.responseText);
document.getElementById('realFileName').value=xtractFileName(dec[0].realFileName);
document.getElementById('icn').src=formatOf(dec[0].iconDefault);
document.getElementById('realFileName').setAttribute('data-id',<?php echo $_GET['id']; ?>);
document.getElementById('realFileName').setAttribute('data-ext','.'+formatOf(dec[0].realFileName));
document.getElementById('format').innerHTML=formatOf(dec[0].realFileName);
if(dec[0].size/1000000>1)
document.getElementById('size').innerHTML=Math.ceil(dec[0].size/1000000)+' MB';
else if(dec[0].size/1000>1)
document.getElementById('size').innerHTML=Math.ceil(dec[0].size/1000)+' KB';
else
document.getElementById('size').innerHTML=dec[0].size+' B';
document.getElementById('dwnload_link').href='downloadImage.php?id=<?php echo $_GET['id'] ?>';
document.getElementById('open_link').href='redirectToFile.php?id=<?php echo $_GET['id'] ?>';



		});
		
		function changeName()
        {  
            
            if(document.getElementById('realFileName').value!=='')
            {
                
           document.getElementById('realFileName_btton').value='Changing...';
            notey.post('fileOps.php?id='+document.getElementById('realFileName').dataset.id+'&rename',{
               newName:document.getElementById('realFileName').value+document.getElementById('realFileName').dataset.ext
            },function(data){
             document.getElementById('notification').innerHTML='Altered';
             document.getElementById('realFileName_btton').value='Change';
            });
            }
            else
            {
                            document.getElementById('notification').innerHTML='Enter a new name...';
            }
        }
		
		
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
    function xtractFileName(fileName)
    {
          var collect=  fileName.split(".");
          return collect[0];
    }
	</script>
	
	<body id = "full">
        <table  cellspacing="5" cellpadding="5" class="skelt"><tr><td rowspan="1" class="iconSide">
		<img id = "icn">
        <td style="padding:1em">
            <div id = "notification"></div>
		<label for ="realFileName">File name</label> <input  type="text" id= "realFileName"> <input id="realFileName_btton" onclick = "changeName()" type="button" value="Change"><br>
        <script>
            document.getElementById('realFileName').addEventListener('keyup',function(e){
                if(e.keyCode==13)
                changeName();
            });
            </script>
        <table>
            <tr><td><div class="info"> Size :  <span  id="size"></span> Format : <span id="format"></span></div></td></tr>
             <tr><td><div class="options"><span  id="dwnload"><a target="_blank" id="dwnload_link">Download</a></span> | <span  id="dwnload"><a target="_blank" id="open_link">Open File</a></span> </div></td></tr></table></td></tr>
            </table></td></tr>
                       
            </table>
        </body>