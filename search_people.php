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
	color:#ED9450;
	font-size:14px;
	font-family:Arial,Serif;
	text-align:justify;
}

.result
{
	width:60%;
	font-size:20px;
	margin:1%;
	font-family:arial,serif;
	color:white;
	border-radius:2px;
background: rgba(46, 139, 87, 0.71);
		border:1px solid #fff;
                height: 50px;
                float: bottom;
                line-height: 50px;
                
}
.result:hover
{
	border:1px solid #C98078;
}
.result button
{
	position:relative;
	min-width:5px;
	min-height:5px;
	color:green;
	cursor:pointer;
        right: 0px;
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
  </script>
		</head>
<body>
		<div id="spinnertext"><p>Scrowling for people names inside your Notes...</p><p>This might take some time to complete and depends upon the quanity of notes.</div>
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
		$id('spinnertext').innerHTML='<p>We guess below listed are names. The result might also include place names or word errors. Click the \'add\' button next to the person name to add them to the \'People\'s List\'.</p>';
else
$id('spinnertext').innerHTML='<p align="center">Can\'t find any new names, check the <a href="peoples.php">peoples list</a> they might be already there.';
while(typeof(jsonobj[index])!=='undefined')
{
		var ele = jsonobj[index];
		var newob=document.createElement('div');
		$id('list').appendChild(newob).setAttribute("id",index);
		$id('list').appendChild(newob).setAttribute("class","result");
                var addButton=document.createElement('button');
                document.getElementsByTagName('body')[0].appendChild(newob);
                newob.innerHTML='<span>'+ele+'</span>';
                newob.appendChild(addButton);
                addButton.setAttribute('onclick','addPerson(this);');
                addButton.setAttribute('data-rootid',index);
                addButton.setAttribute('data-refer',ele);
                addButton.innerHTML="Add";
		index++;
						}
			});
		$id('spinner').style.display='block';
		$id('spinnertext').style.display='block';
		
		</script>
</ol>

</body>
</html>