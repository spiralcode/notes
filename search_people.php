<html>
<head>
<script src="ajax_1_10_2.js"></script>
<style>
.spinner {
display:none;
z-index:101;
 width: 40px;
 height: 40px;
 margin: 100px auto;
 background-color: #0f0;
 border-radius: 100%;  
 -webkit-animation: sk-scaleout 1.0s infinite ease-in-out;
 animation: sk-scaleout 1.0s infinite ease-in-out;
}
@-webkit-keyframes sk-scaleout {
  0% { -webkit-transform: scale(0) }
  100% {
    -webkit-transform: scale(3.0);
    opacity: 0;
  }
}

@keyframes sk-scaleout {
  0% { 
    -webkit-transform: scale(0);
    transform: scale(0);
  } 100% {
    -webkit-transform: scale(3.0);
    transform: scale(1.0);
    opacity: 0;
  }
}
.bigoptions
{
  position:absolute;
  text-align:center;
  top:40px;
  
}
.bigoptions span
{
  font-family:Arial,serif;
  font-size:20px;
  color: #A384BD;
  margin:2%;
 min-width:60px;
 min-height:20px;

}
a
{
  text-decoration:none;
    color: #A384BD;
}
a:hover
{
  text-decoration:underline;
}
#spinnertext
{
color: #115123;	font-size:14px;
	font-family:Arial,Serif;
	text-align:justify;
}

.result
{
width: 60%;
font-size: 15px;
font-family: arial,serif;
color: white;
border-radius: 2px;
background: rgba(51, 61, 29, 1);
border: 1px solid #fff;
height: 50px;
float: bottom;
line-height: 50px;
border-radius: 3px;
text-align: c;
display: row;
text-align: justify;
left: 15%;
position: relative;

                
}
.result span
{
    margin-left: 1%;
}
.result:hover
{
	border:1px solid #C98078;
}
.result .optionSpace
{
    position: absolute;
     right: 0px;
     top: 0px;
            z-index: 15;

}
.result button
{
	min-width:5px;
	min-height:5px;
	color:green;
	cursor:pointer;
        border:none;
        border-radius: 2px;
        line-height: 30px;
        float: left;
        margin: 1px;
}

</style>
<script>
function $id(ob)
{
	return document.getElementById(ob);
}
function addPerson(ob)
{
ob.setAttribute('disabled',"disabled");
	var name = (ob.dataset.refer);
        var name = $id(ob.dataset.rootid).getElementsByTagName('span')[0].innerHTML;
	$.post('addperson.php',{
		name: name
	},function(data,success)
	{
		if(data==1)
		$id(ob.dataset.rootid).style.background='#7FC978';	
		ob.setAttribute('disabled',"disabled");
		ob.innerHTML="Added";
	});

}
function mergeWithTop(ob)
{
    var rootId=ob.dataset.rootid;
    if($id(rootId-1)){
    $id((rootId-1)).getElementsByTagName('span')[0].innerHTML+=' '+$id((rootId)).getElementsByTagName('span')[0].innerHTML;
    $id(rootId).remove();
    }
}
  </script>
		</head>
<body>
		<div id="spinnertext"><p align="center">Looking for people names inside your Notes. The time this would take is proportional to the size of Note.</p></div>
	<div id="spinner" align="center" class="spinner"></div>
	<div id="content"></div>
	<div id ="list">
	<script>
		$id('spinner').style.display='block';
		$id('spinnertext').style.display='block';
		
		$.get('isthatword.php?noteid=<?php echo $_GET['noteid']; ?>',function(data,success)
			{
			var index = 0;
			var jsonobj = JSON.parse(data);
		$id('spinner').style.display='none';
		if(typeof(jsonobj[0])!=='undefined')
		$id('spinnertext').innerHTML='<p align="center">Below results might also include, word errors, place names or other words. </p>';
else
$id('spinnertext').innerHTML='<p align="center">Can\'t find any new names, check the <a href="peoples.php">peoples list</a> they might be already there.';
while(typeof(jsonobj[index])!=='undefined')
{
var ele = jsonobj[index];
var newob=document.createElement('div');
$id('list').appendChild(newob).setAttribute("id",index);
$id('list').appendChild(newob).setAttribute("class","result");
newob.innerHTML='<span>'+ele+'</span>';
document.getElementsByTagName('body')[0].appendChild(newob);
var optionSpace = document.createElement('div');
 $id(index).appendChild(optionSpace);
optionSpace.setAttribute('id','optionSpace_'+index);
optionSpace.setAttribute('class','optionSpace');

var addButton=document.createElement('button');
$id('optionSpace_'+index).appendChild(addButton);
addButton.setAttribute('onclick','addPerson(this);');
addButton.setAttribute('data-rootid',index);
addButton.setAttribute('data-refer',ele);
addButton.setAttribute('id','AddButton');
addButton.innerHTML="Add to peoples";
if(index>0){
var merge_Button = document.createElement('button');
$id('optionSpace_'+index).appendChild(merge_Button);
merge_Button.innerHTML="Merge with name on top";
merge_Button.setAttribute('onclick','mergeWithTop(this);');
merge_Button.setAttribute('data-rootid',index);
merge_Button.setAttribute('data-refer',ele);
}
index++;
}});
$id('spinner').style.display='block';
$id('spinnertext').style.display='block';
</script>
</ol>
</body>
</html>