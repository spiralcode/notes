<?php
require_once 'Mobile_Detect.php';
$detect = new Mobile_Detect;
if ( $detect->isMobile() &&isset($_GET['web'])!=true) {
 header('location: way');
 break;
}
if(isset($_COOKIE['e'])){
header('location: login.php?cook');}
    ?>
<!doctype html>
<html >
<head>
<title>Notes </title>
<meta name = "description" content="Write notes, attach any files, locations and keep it for free and forever."/>
<meta name = "description" content="Write notes, attach any files, locations and keep it for free and forever."/>
<meta id = "ogType" property="og:type"          content="Web Application" />
	<meta id = "ogTitle" property="og:title"         content="Notes" />
	<meta id = "ogDescription" property="og:description"   content="Create Notes, attach files and access it anywhere." />
<link id="favicon" rel="shortcut icon" href="favicon.png" type="image/png" />

  <link rel="stylesheet" href="style.css">
      <script src="notey.js"></script>
        <link rel="stylesheet" href="raid.css">
<link rel="stylesheet" href="raid.css"/>

<style>
body
{
background:#fff;
}
.aboutspace
{
position:absolute;
width:90%;
margin-left:5%;
top:20%;
color:#508844;
font-family:"Segoe UI Light",arial,serif;
font-size:60px;
text-align:center;
}
.attract
{
position:absolute;
width:90%;
margin-left:5%;
top:50%;
color:#B6B02F;
font-family:"Segoe UI Light",arial,serif;
font-size:20px;
text-align:center;
cursor:pointer;
}
.virtual
{
color:#2FB660;
font-family:"Segoe UI Light",arial,serif;
text-align:center;
}
.spinner {
position:absolute;
z-index:101;
  width: 40px;
  height: 40px;
  margin: 100px auto;
margin-left:5%;
top:20%;
  background-color: #2F51B6;

  border-radius: 100%;  
  -webkit-animation: sk-scaleout 1.0s infinite ease-in-out;
  animation: sk-scaleout 1.0s infinite ease-in-out;
}

@-webkit-keyframes sk-scaleout {
  0% { -webkit-transform: scale(0) }
  100% {
    -webkit-transform: scale(1.0);
    opacity: 0;
  }
}

@keyframes sk-scaleout {
  0% { 
    -webkit-transform: scale(0);
    transform: scale(0);
  } 100% {
    -webkit-transform: scale(1.0);
    transform: scale(1.0);
    opacity: 0;
  }
}
#smartslide
{
position:absolute;
width:700px;
height:250px;
border: 1px solid #A0A59C;
bottom:10px;
}
#smartslide .loginarea
{
width:100%;
}
input
{
border:none;
border-bottom:1px solid #000;
font-size:20px;
}
button
{
border:none;

}
button:hover
{
cursor:pointer;
}
#errorshow
{
font-family:arial,serif;
color:red;
font-size:12px;
}
.about
{
    color: #4B4865;
    font-size: 13px;
    cursor: pointer;
}
</style>
<script src="ajax_1_10_2.js"></script>
<script>
function $id(ob)
{
	return document.getElementById(ob);
}
function datagateway(type)
{
	var email=$id('email').value;
	var pass=$id('password').value;
	var semail=$id('semail').value;
	var spass=$id('spassword').value;
	var sname=$id('sname').value;
                  var logged = $id('loggedin').checked;
	if(type.dataset.kind=='login')
	{
            if(logged===true){var cookie='1';}else{var cookie = '0'};
            $id('spinner').style.display="block";
            $id('loginbutton').innerHTML="Logging in...";
		notey.post('login.php',{
			email: email ,
			pass: pass ,
                        cook: cookie
			},function(data){
         var dC = JSON.parse(data.responseText);
				if(dC.status==1)
				{
          $id('attract').innerHTML="Hi, <b>"+dC.name+"</b> we're loading your account...";
					window.location.href='paper.php';
				}
				else
				{
				$id('errorshow').innerHTML='E-mail or Password doesn\'t seems to be correct, try again or make an account.';	
                                            $id('loginbutton').innerHTML="Login";
                                            $id('spinner').style.display="none";

				}});
		}
	if(type.dataset.kind=='Create an Account'&&semail!='')
	{
		type.disabled="disabled";
		notey.post('create_acc.php',{
			email: semail ,
			password: spass ,
			name: sname
			},function(data){
				if(data.responseText==1)
				{
notey.notify('welcome.php',{title:'Welcome !',iframe:false});				
$id('email').value=semail;
				$id("password").value=spass;	
				}
				else
				{
				type.removeAttribute("disabled");
				}
				
				});}}
</script>
</head>
<body>
<script>
            </script>
<div id="spinner" class="spinner"></div>
<div class="aboutspace">
Notes<sup>v3</sup>
</div>
<div id="attract" class="attract" onclick="notey.notify('declare.php',{title:'Welcome !',iframe:false});"}>Weird !, What made you here?</div>
<div id="smartslide">
<table border="0" width=100% height="100%">
<tr><td align="center" class="virtual">Login</td><td class="virtual" align="center">Sign Up</td></tr>
<tr><td align="center" colspan="2"><span id="errorshow">&nbsp;<?php if(isset($_GET['logreq'])){echo "The service you requested requires you to login.";} ?></span></td></tr>
<tr><td align="center">
<div id="loginarea"class="loginarea"><table><tr><td>
<input type="text" id="email" placeholder="E-mail"/></td></tr>
<tr><td><input type="password" id="password" placeholder="Password"/></td></tr><form name="dummy">
<tr><td align="center"><input type="checkbox" value="yes" id="loggedin" style="color:#494949; font-size: 13px"/><label onclick="$id('loggedin').click();" for =" loggedin"  style="color:#494949; font-size:14px;" >Remember me</label></td></form></tr><tr><td></td></tr>
<tr><td align="center">
<button data-kind="login" onclick="datagateway(this);" id="loginbutton">Login</button></td></tr></table></div>
</td><td align="center"><div class="loginarea"><table>
<tr><td><input type="text" id="sname" placeholder="Name"/></td></tr>
<tr><td><input type="text" id="semail" placeholder="E-mail"/></td></tr>
<script>
  $id('semail').addEventListener('blur',function(e){
    notey.post('emailExistence.php',{email : $id('semail').value},function(data){
      if(data.responseText==1)
      {
        $id('errorshow').innerHTML="Email seems already existing";
         $id('semail').border="1px dotted red";
      }
    });
  });
  </script>
<tr><td><input type="password" id="spassword" placeholder="Password"/></td></tr>
<tr><td><input type="password" id="cpassword" placeholder="Confirm password"/></td></tr>
<tr><td align="center"><button data-kind="Create an Account" onclick="datagateway(this)">Create an Account</button></td></tr></table></div></td></tr></table>
</div>
</div>

<script>
var loading=document.getElementById('spinner').getBoundingClientRect();
var smartslide=document.getElementById('smartslide').getBoundingClientRect();
document.getElementById('spinner').style.left=(window.innerWidth/2)-(loading.width/2)+'px';
document.getElementById('smartslide').style.left=(window.innerWidth/2)-(smartslide.width/2)+'px';
</script>
<p class="about" align="right"><span id="about" onclick="notey.notify('about.php',{title:'',iframe:true});">About</span></p>
</body>
<script>
    document.getElementById('loginarea').addEventListener('keyup',function(e){
        if (e.keyCode===13){
            datagateway(document.getElementById('loginbutton'));
        }
    });
    </script>
<?php
if(isset($_GET['deepdive']))
{
    echo "<script>document.getElementById('about').click();</script>";
}
?>
<!--V3.10-->
</html>