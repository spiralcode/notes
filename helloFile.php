<!doctype html>
<head>
    <meta id = "ogURL" property="og:url"           content="" />
	<meta id = "ogType" property="og:type"          content="website" />
	<meta id = "ogTitle" property="og:title"         content="Notes Stream" />
	<meta id = "ogDescription" property="og:description"   content="" />
	<meta id = "ogImage" property="og:image"         content="favicon.png" />
  <link rel="stylesheet" href = "css/loader.css"/>
<style>
        a
        {
            text-decoration:none;
        }
        a:link {
            text-decoration:none;
}

/* visited link */
a:visited {
            text-decoration:none;
}

/* mouse over link */
a:hover {
            text-decoration:none;
}

/* selected link */
a:active {
            text-decoration:none;
}
		input[type="text"]
        {

                        font-family:Arial,Serif;
                        padding:.5px;
font-size: 1.1em;
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

            background: aliceblue;
            border-radius:3px;
            font-family:Arial;
color: rgb(67, 80, 85);
font-size: .9em;
margin-bottom:1em;
        }
        .options span
        {
            font-family:Arial;
            cursor:pointer;
color : rgb(46, 48, 241);
background: rgba(174, 174, 174, 0.81);
	color: white;
	cursor: pointer;
	border-radius: 2px;
	margin: .1em;
	padding: .3em;
            
        }
        #notification
        {
            text-align:center;
            color:black;
            font-family:Arial;
            font-size:.8em;
        }
        #urlSlot
        {
            display:none;
        }
		</style>
<script src="notey.js"></script>

	</head>
	<body id = "full">
        <script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '593526644156691',
      xfbml      : true,
      version    : 'v2.6'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
   
</script>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.6&appId=593526644156691";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

        <div class="spinner" id = "spinner"></div>
        <div id = "dataContent">
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
             <tr><td><div class="options"><span  id="dwnload"><a target="_blank" id="dwnload_link">Download</a></span><span  id="dwnload"><a target="_blank" id="open_link">Open File</a></span><span  id="dwnload"><a target="" href = "confirmDelete.php?id=<?php echo $_GET['id']; ?>">Delete File</a></span> Visibility : <span onclick="toggleVisibility(<?php echo $_GET['id']; ?>)" id="visibility"></span>
             </div></td></tr>
             <?php
                 if($_SERVER['HTTP_HOST']!='localhost')
{
$genLink='https://'.$_SERVER['SERVER_NAME'].'/redirectToFile.php?id='.$_GET['id'];	
}   
else
{
 $genLink='http://'.$_SERVER['SERVER_NAME'].'/codeBox/note/redirectToFile.php?id='.$_GET['id'];	   
}
                 ?>
             <tr id = "urlSlot"><td><label for publicLink>Public URL (Streaming)  </label><input onclick = "this.select();" id ="publicLink" type="text" value="<?php echo  $genLink; ?>"/>
             <div class="fb-share-button" data-href="<?php echo  $genLink; ?>" data-layout="button_count" data-mobile-iframe="true"></div>
             </td></tr>
             </table></td></tr>

          </table></td></tr>
                       
            </table>
            </div>
        </body>
        	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
        <script>
            function copyLink()
            {
                document.getElementById('publicLink').select();
            }
            </script>
            <script>
                document.getElementById('spinner').style.display="block";
                document.getElementById('dataContent').style.display="none";
notey.get('fileInfo.php?id=<?php echo $_GET['id']; ?>',function(data){
 var dec = JSON.parse(data.responseText);
document.getElementById('realFileName').value=xtractFileName(dec[0].realFileName);
document.getElementById('ogDescription').content=xtractFileName(dec[0].realFileName);
document.getElementById('ogTitle').content='Notes Stream : '+xtractFileName(dec[0].realFileName);
document.getElementById('icn').src=formatOf(dec[0].iconDefault);
var visibility =formatOf(dec[0].visibility);
if(visibility=='p'){
document.getElementById('visibility').innerHTML="Turn Private";
document.getElementById('visibility').title="Only you can access this file, after logging in";
document.getElementById('urlSlot').style.display="block"
}
else{
document.getElementById('visibility').innerHTML="Turn Public";
document.getElementById('visibility').title="The file becomes public and you could share the URL to others for viewing.";
      document.getElementById('urlSlot').style.display="none"
}
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
document.getElementById('open_link').href='stream.php?id=<?php echo $_GET['id'] ?>';
document.getElementById('spinner').style.display="none";
document.getElementById('dataContent').style.display="block";

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
             document.getElementById('ogDescription').content=document.getElementById('realFileName').value+document.getElementById('realFileName').dataset.ext;
            });
            }
            else
            {
            document.getElementById('notification').innerHTML='Enter a new name...';
            }
        }
        function toggleVisibility(id)
        {  
            
            notey.get('toggleFileVisibility.php?id='+id,function(data){

if(data.responseText=='p')
{
    document.getElementById('visibility').innerHTML="Turn Private";
    document.getElementById('visibility').title="Only you can access this file after logging in";
    document.getElementById('urlSlot').style.display="block"
}
else
{
    document.getElementById('visibility').innerHTML="Turn Public";
        document.getElementById('visibility').title="The file becomes public and you could share the URL to others for viewing.";
      document.getElementById('urlSlot').style.display="none"
}
            });

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