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

</head>
<body>
<script>
function revealCAC()
{
  //document.getElementById('createAc').style.display='block';
   $('#createAc').delay(0).fadeIn(200);
    $('html, body').animate({scrollTop:$(document).height()}, 'slow');

}
var tryC=0;
function loginActivity(ob)
{
ob.innerHTML="Logging in...";
ob.disabled="disabled";
notey.post('login.php',{email:document.getElementById('loginEmail').value,pass:document.getElementById('loginPassword').value,cook:document.getElementById('cooked').value},function(data){
  if(data.response!=0)
  {
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

  notey.post('emailExistence.php',{email:$id('newEmail').value},function(data){
        if(data.response==1){
          $id('newEmail_error').innerHTML="Email is already taken, provide another one.";
        }

          console.log('Submitting...');
if($id('newName').value.length<4||$id('newName').value.length>20){
  $id('newName_error').innerHTML="Name must between 4 and 20 letters";
}
  else
 {   $id('newName_error').innerHTML="";
 }
 var x = $id('newEmail').value;
 var atpos = x.indexOf("@");
var dotpos = x.lastIndexOf(".");
 if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) {
 $id('newEmail_error').innerHTML="E-mail format is wrong";
    }
    else
    {
       $id('newEmail_error').innerHTML="";
    
    }
    if($id('newPassword').value.length<6||$id('newPassword').value.length>40)
  {    $id('newPassword_error').innerHTML="Password must be between 6 and 40 letters";
  }
else
{ $id('newPassword_error').innerHTML=""; }
    if($id('newPassword').value!=$id('newConfirmPassword').value)
  {  
      $id('newConfirmPassword_error').innerHTML="Password doesn't matchup";
  }
else
{
   $id('newConfirmPassword_error').innerHTML=""; 
   }
          notey.post('create_acc.php',{},function(data){
});
        
      });
notey.post('create_acc.php',{},function(data){
});
}
function $id(id)
{
  return document.getElementById(id);
}
function dataValidity()
{
  console.log('Submitting...');
if($id('newName').value.length<4||$id('newName').value.length>20){
  $id('newName_error').innerHTML="Name must between 4 and 20 letters";
}
  else
 {   $id('newName_error').innerHTML="";
 }
 var x = $id('newEmail').value;
 var atpos = x.indexOf("@");
var dotpos = x.lastIndexOf(".");
 if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) {
 $id('newEmail_error').innerHTML="E-mail format is wrong";
    }
    else
    {
       $id('newEmail_error').innerHTML="";
    
    }
    if($id('newPassword').value.length<6||$id('newPassword').value.length>40)
  {    $id('newPassword_error').innerHTML="Password must be between 6 and 40 letters";
  }
else
{ $id('newPassword_error').innerHTML=""; }
    if($id('newPassword').value!=$id('newConfirmPassword').value)
  {  
      $id('newConfirmPassword_error').innerHTML="Password doesn't matchup";
  }
else
{
   $id('newConfirmPassword_error').innerHTML=""; 
   }
}
</script>

<div class="title">Notes</div>

<div class="midContainer" id = "midContainer">
<div class="login" id="login">

<span class="head">Login</span>
<div id="notificationPlace"></div>

<div><input placeholder="Email" title="Email" id="loginEmail" type="text"></div>
<div class="inputError" id="loginEmail_error"></div>
<div><input title="Password" placeholder="Password" id="loginPassword" type="password"></div>
<div  class="inputError" id="loginPassword_error"></div>
<div><input type="checkbox" id="cooked"/><label onclick="document.getElementById('cooked').click();">remember me</lable>
<div  onclick="loginActivity(this);" id="loginButton" tabindex=1>Login</div>
<div class="cAc" style="text-align:center;" onclick="revealCAC()">Create An account</div>
<div class="createAc" id="createAc" >
<div><input placeholder="Your name" title="Your name" id="newName" type="text"></div>
<div class="inputError" id="newName_error"></div>
<div><input placeholder="Email" title="Email" id="newEmail" type="text"></div>
<div class="inputError" id="newEmail_error"></div>
<div><input title="Password" placeholder="Password" id="newPassword" type="password"></div>
<div class="inputError" id="newPassword_error"></div>
<div><input title="Confirm password" placeholder="Confirm password" id="newConfirmPassword" type="password"></div>
<div class="inputError" id="newConfirmPassword_error"></div>
<div id="loginButton" tabindex="1" onclick="createActivity(this);">Create</div>
</div>
</div>
<script>
var logDim = document.getElementById('midContainer').getBoundingClientRect();
document.getElementById('midContainer').style.left=(window.innerWidth/2)-logDim.width/2+'px';
document.getElementById('midContainer').style.top=(window.innerHeight/2)-logDim.height/2+'px';

</script>
</body>