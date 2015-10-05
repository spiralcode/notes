<?php

if(isset($_COOKIE['email']))
{
    header('location: login.php?cook');
}
    ?>
<!doctype html>
<html >
<head>
<title>Notes </title>
<link rel="icon" href = "favicon.png">
  <link rel="stylesheet" href="style.css">
   <script src="raid.js"></script>
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
	function infoPaper(resource,title,frame)
{
if(frame!=1)
{
$.get(resource,function(data,success)
		{
	$id('infoPaperContent').innerHTML=data;
	$id('topstriptitle').innerHTML=title;
		});
}
else
{	
$id('infoPaperContent').innerHTML='<iframe id="infoPaperFrame"></iframe>';
$id('infoPaperFrame').src=resource;
$id('topstriptitle').innerHTML=title;
}
	$id('infoPaper').style.display='block';
	var infoPaper = $id('infoPaper').getBoundingClientRect();
	$id('infoPaper').style.left=(window.innerWidth/2)-(infoPaper.width/2)+'px';
	$id('infoPaper').style.bottom=(window.innerHeight/2)-(infoPaper.height/2)+'px';
}
function infoPaperHide()
{
	$id('infoPaper').style.display='none';
}
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
		$.post('login.php',{
			email: email ,
			pass: pass ,
                                                      cook: cookie
			},function(data,status){
                            
				if(data==1)
				{
					window.location.href='paper.php';
				}
                                console.log(data);
				if(data==0)
				{
				$id('errorshow').innerHTML='E-mail and Password doesn\'t seems to exist, try again or make an account.';	
                                            $id('loginbutton').innerHTML="Login";

                                            $id('spinner').style.display="none";

				}});
		}
	if(type.dataset.kind=='signup'&&semail!='')
	{
		type.disabled="disabled";
		$.post('create_acc.php',{
			email: semail ,
			password: spass ,
			name: sname
			},function(data,status){
				if(data==1)
				{
				infoPaper('welcome.php','That\'s It');
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
<div class="attract">Rough Edges and Cliff's makes things complete</div>
<div id="smartslide">
<table border="0" width=100% height="100%">
<tr><td align="center" class="virtual">Login</td><td class="virtual" align="center">Sign Up</td></tr>
<tr><td align="center" colspan="2"><span id="errorshow">&nbsp;<?php if(isset($_GET['logreq'])){echo "The service you requested requires you to login.";} ?></span></td></tr>
<tr><td align="center">
<div class="loginarea"><table><tr><td>
<input type="text" id="email" placeholder="E-mail"/></td></tr>
<tr><td><input type="password" id="password" placeholder="Password"/></td></tr><form name="dummy">
<tr><td align="center"><input type="checkbox" value="yes" id="loggedin" style="color:#494949; font-size: 13px"/><label for =" loggedin"  style="color:#494949; font-size:14px;" >Remember me</label></td></form></tr><tr><td></td></tr>
<tr><td align="center">
<button data-kind="login" onclick="datagateway(this)" id="loginbutton">Login</button></td></tr></table></div>
</td><td align="center"><div class="loginarea"><table>
<tr><td><input type="text" id="sname" placeholder="Name"/></td></tr>
<tr><td><input type="text" id="semail" placeholder="E-mail"/></td></tr>
<tr><td><input type="password" id="spassword" placeholder="Password"/></td></tr>
<tr><td><input type="password" id="cpassword" placeholder="Confirm password"/></td></tr>

<tr><td align="center"><button data-kind="signup" onclick="datagateway(this)">Sign Up</button></td></tr></table></div></td></tr></table>
</div>
</div>

<script>
var loading=document.getElementById('spinner').getBoundingClientRect();
var smartslide=document.getElementById('smartslide').getBoundingClientRect();

document.getElementById('spinner').style.left=(window.innerWidth/2)-(loading.width/2)+'px';
document.getElementById('smartslide').style.left=(window.innerWidth/2)-(smartslide.width/2)+'px';
</script>
<div id="infoPaper"><div class="topstrip"><span id="topstriptitle"></span><div id="infoPaperClose" onclick="infoPaperHide()"><img style="width:20px; height:20px;" title="Close ! this thing" src="images/b_close.png"/></div></div><div id=infoPaperContent></div></div>
<p class="about" align="right"><span onclick="showMsg('index.php',{title:'About',iframe:true});">About</span></p>
</body>
</html>