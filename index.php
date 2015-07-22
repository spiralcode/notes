<!doctype html>
<html>
<head>

<title>Notes </title>
<style>
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
font-size:30px;
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
background:#9DCB76;
border:none;
border:1px solid white;
}
button:hover
{
border:1px solid black;
cursor:pointer;
}
#errorshow
{
font-family:arial,serif;
color:red;
font-size:12px;
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
	if(type.dataset.kind=='login')
	{
		$.post('login.php',{
			email: email ,
			pass: pass
			},function(data,status){
				if(data==1)
				{
					window.location.href='paper.php';
				}
				if(data==0)
				{
				$id('errorshow').innerHTML='E-mail and Password doesn\'t seems to exist, try again or make an account.';	
				}
				
				});
		}
	if(type.dataset.kind=='signup')
	{
		$.post('create_acc.php',{
			email: semail ,
			password: spass ,
			name: sname
			},function(data,status){
				alert(data);
				
				});
		}
}
</script>
</head>
<body>

<div id="spinner" class="spinner"></div>
<div class="aboutspace">
Notes<sup>v3</sup>
</div>
<div class="attract">It just went to Gymm</div>
<div id="smartslide">
<table border="0" width=100% height="100%">
<tr><td align="center" class="virtual">Login</td><td class="virtual" align="center">Sign Up</td></tr>
<tr><td align="center" colspan="2"><span id="errorshow">&nbsp;</span></td></tr>
<tr><td align="center">
<div class="loginarea"><table><tr><td>
<input type="text" id="email" placeholder="E-mail"/></td></tr>
<tr><td><input type="password" id="password" placeholder="Password"/></td></tr>
<tr><td align="center">
<button data-kind="login" onclick="datagateway(this)">Login</button></td></tr></table></div>
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
</body>
</html>