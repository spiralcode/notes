<!doctype html>
<?php
include '../session_check.php';
?>
<head>
<title>Notes Draw BC</title>
  <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
          <link rel="stylesheet" href="notesGen.css">
            <script src="../notey.js"></script>
             <script src="../jss/moment.js"></script>

          <script>

    var slotSize=0;

function startPosition(index)
{
var di =((index/slotSize));
var slot = Math.round(di)%10;
return slot*slotSize;
}
function buildResult()
{
    document.getElementById('ground').innerHTML="";
    var url = "timeLineFetchBC.php";
notey.get(url,function(data)
{
    var dec = JSON.parse(data.response);
    var i = 0;
    while(dec[i]!=null)
    {
        //console.log(dec[i].content);
        pushToTable(dec[i].id,dec[i].fY,dec[i].tY,dec[i].content);
        i++;
    }
    });
}

function pushToTable(id,fy,ty,content)
{
var tim = document.createElement('div');
tim.setAttribute('class','timeItem');
//tim.style.background=colorPick();
var con = document.createElement('div');
con.setAttribute('class','cont');
con.innerHTML=content;
var yearSlot = document.createElement('div');
if(ty!=0)
yearSlot.innerHTML = fy+' - '+ty
else
yearSlot.innerHTML = fy;
var close = document.createElement('div');
close.setAttribute('class','delete');
close.innerHTML="X";
close.setAttribute('id',id);
close.setAttribute('onclick','deleteEntry(this.id)');
yearSlot.setAttribute('class','yS');

tim.appendChild(yearSlot);
tim.appendChild(con);
tim.appendChild(close);
document.getElementById('ground').appendChild(tim);
}
function deleteEntry(ob)
{
    if(confirm('\n\nAre you sure about deletion ?\n\n'))
    {
        notey.post('removeBC.php',{id:ob},function(data){
            if(data.response=='1')
            {
                alert('\n\nDeleted\n\n');
                buildResult('all');
            }
            else
            {
                alert('Error occured on-course, unable to delete');
            }
        });
    }
}
function colorPick()
{
    var cc = "";
    var oi = Math.floor((Math.random() * 4) + 1);
    switch(oi) {
    case 1:
     cc = "red";
     break;
    case 2:
     cc = "green";
        break;
            case 3:
     cc = "violet";
        break;
    case 4:
     cc = "blue";
        break;
    default:
     cc = "blue";
}
return cc;

}
          </script>
          
</head>
<body>
<div><a href="bc.php">Add</a></div>
<div id = "ground">
</div>
<script>
buildResult();
</script>
</body>
</html>