<?php
include 'connect.php';
require_once 'Mobile_Detect.php';
$rem_ip = $_SERVER['REMOTE_ADDR'];
$q = mysqli_query($link,"insert into root_log values (NOW(),'$rem_ip')");
$detect = new Mobile_Detect;
if ( $detect->isMobile() &&isset($_GET['web'])!=true) {
 header('location: way');
 break;
}
if(isset($_COOKIE['e'])){
header('location: login.php?cook');}
    ?>
<!doctype html>
<html lang="en" xml:lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="grand.css"/>
        <script src="ajax_1_10_2.js"></script>
        <script src="lib/jquery-ui.js"></script>
          <script src="notey.js"></script>
<link rel="stylesheet" href="style/jquery-ui.css">
<title>Notes</title>
<meta name = "description" content="Write notes, attach any files, locations and keep it for free and forever."/>
<meta name = "description" content="Write notes, attach any files, locations and keep it for free and forever."/>
<meta id = "ogType" property="og:type"          content="Web Application" />
	<meta id = "ogTitle" property="og:title"         content="Notes" />
	<meta id = "ogDescription" property="og:description"   content="Create Notes, attach files and access it anywhere." />
<link id="favicon" rel="shortcut icon" href="favicon.png" type="image/png" />
</head>
<body onresize="align();">
<script>
function revealCAC()
{
  //document.getElementById('createAc').style.display='block';
   $('#createAcc').delay(0).fadeIn(550);
    $('html, body').animate({scrollTop:$(document).height()}, 'medium');

}
var tryC=0;
function loginActivity(ob)
{
ob.innerHTML="Logging in...";
ob.disabled="disabled";
notey.post('login.php',{email:document.getElementById('loginEmail').value,pass:document.getElementById('loginPassword').value,cook:document.getElementById('cooked').value},function(data){
  if(data.response!=0)
  {
    $id('login').setAttribute('disabled','disabled');
   window.location="paper.php";
  }
  else
  {
    tryC++;
    if(tryC<3){
document.getElementById('notificationPlace').innerHTML="Password / Email is wrong, try again or <u onclick=\"revealCAC()\">create an account</u> if you lack one.";
    }
else{
document.getElementById('notificationPlace').innerHTML="Still can't get it right ?, why couldn't you make a new account then ?";
}
ob.innerHTML="Log In";
ob.removeAttribute('disabled');
  }
});
}
function createActivity(ob)
{
ob.innerHTML="validating...";
//ob.disabled="disabled";
//ob.setAttribute('onclick','');
    var noc = 0;

var x = $id('newEmail').value;
 var atpos = x.indexOf("@");
var dotpos = x.lastIndexOf(".");
 if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) {
 $id('newEmail_error').innerHTML="E-mail format is wrong";
           $id('createAccountButton').innerHTML="Create";

    }
    else
    {
       $id('newEmail_error').innerHTML="";
    noc++;
  notey.post('emailExistence.php',{email:$id('newEmail').value},function(data){
        if(data.response==1){
          $id('newEmail_error').innerHTML="Email is already taken, provide another one.";
          $id('createAccountButton').setAttribute('disabled','disabled');
        }
        else
        {
          noc++;
        }
if($id('newName').value.length<4||$id('newName').value.length>20){
  $id('newName_error').innerHTML="Name must between 4 and 20 letters";
}
  else
 {   $id('newName_error').innerHTML="";
 noc++;
 }
 
    if($id('newPassword').value.length<6||$id('newPassword').value.length>40)
  {    $id('newPassword_error').innerHTML="Password must be between 6 and 40 letters";
  }
else
{ $id('newPassword_error').innerHTML=""; 
noc++;
}
    if($id('newPassword').value!=$id('newConfirmPassword').value)
  {  
      $id('newConfirmPassword_error').innerHTML="Password doesn't matchup";
  }
else
{
   $id('newConfirmPassword_error').innerHTML=""; 
         noc++;


   }
   console.log(noc);
var email = $id('newEmail').value,name=$id('newName').value,pass=$id('newPassword').value;
   if(noc==5)
   {
$id('createAccountButton').innerHTML="Creating...";
notey.post('create_acc.php',{email:email,name:name,password:pass},function(data){
if(data.response=='1')
{
  $id('createAccountButton').innerHTML="Creation succeeded";
$id('loginEmail').value=$id('newEmail').value;
$id('loginPassword').value=$id('newPassword').value;
$id('createAcc').innerHTML='<div class="headSuccess" align = "center">Done !</div><div class="headDes">Thank you, login and make many million notes.</div>';
}

});
   }
   else
   {
 $id('createAccountButton').innerHTML="Create";
 $id('createAccountButton').removeAttribute("disabled","disabled");
   }
        
      });
    }
}
function $id(id)
{
  return document.getElementById(id);
}
</script>

<div class="title"><span>Notes</span></div>
<div class="about"><span>&copy; of Nobody, Kundiland, India</span></div>
<div class="midContainer" id = "midContainer">
<div class="login" id="login">
<div class="loginTitle">
<span class="head">Login</span></div>
<div id="notificationPlace">
<?php
if(isset($_GET['logreq']))
echo "The request you made, requires you to login.";
?>
</div>

<div><input placeholder="Email" title="Email" id="loginEmail" type="text"></div>
<div class="inputError" id="loginEmail_error"></div>
<div><input title="Password" placeholder="Password" id="loginPassword" type="password"></div>
<div  class="inputError" id="loginPassword_error"></div>
<div><input type="checkbox" id="cooked"/><label onclick="document.getElementById('cooked').click();">remember me</label></div>
<div  onclick="loginActivity(this);" id="loginButton" tabindex=1>Login</div>
<div class="cAc" style="text-align:center;" onclick="revealCAC()"><span class="span" title="Click to create an account">Create an account</span></div>
<div class="createAc" id="createAcc" type="bttn" >
<div><input placeholder="Your name" title="Your name" id="newName" type="text"></div>
<div class="inputError" id="newName_error"></div>
<div><input placeholder="Email" title="Email" id="newEmail" type="text"></div>
<div class="inputError" id="newEmail_error"></div>
<div><input title="Password" placeholder="Password" id="newPassword" type="password"></div>
<div class="inputError" id="newPassword_error"></div>
<div><input title="Confirm password" placeholder="Confirm password" id="newConfirmPassword" type="password"></div>
<div class="inputError" id="newConfirmPassword_error"></div>
<div id="createAccountButton" tabindex="1" onclick="createActivity(this);">Create</div>
</div>
</div>
<script>
align();
function align(){
var logDim = document.getElementById('midContainer').getBoundingClientRect();
document.getElementById('midContainer').style.left=(window.innerWidth/2)-logDim.width/2+'px';
document.getElementById('midContainer').style.top=(window.innerHeight/2)-logDim.height/2+'px';
}
</script>
</body>