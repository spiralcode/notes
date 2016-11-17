<!doctype html>
<?php
include '../session_check.php';
?>
<head>
  <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
          <link rel="stylesheet" href="notesGen.css">
            <script src="../notey.js"></script>
             <script src="../jss/moment.js"></script>

          <script>
          function putThing()
          {
              var day = document.getElementById('day').value,month= document.getElementById('month').value;
              var year= document.getElementById('year').value;
              var content = document.getElementById('content').value;
              if(day<10&&day[0]!='0')
              {
                  day='0'+day;
              }          
          if(year!=''&&content!='')
          {
              if(month==0||day==0)
              {
var only = 1;
          var dateFormatted = year+'-'+01+'-'+01+' 00:00:00';

              }
              else
              {
                 var only = 0;
                            var dateFormatted = year+'-'+month+'-'+day+' 00:00:00';

              }
          notey.post('timeLineSave.php',{dateF:dateFormatted,content:content,only:only},function(data){
              if(data.response=='1')
              buildResult('all');
              alert('\n\nSaved\n\n');
              document.getElementById('day').value="";
              document.getElementById('month').value="";
              document.getElementById('year').value="";
              document.getElementById('content').value="";

          });
          }
          else
          {
              alert('\n\n\nAtleast, year and content is required  !\n\n\n');
          }
          }
          
function buildResult(opt)
{
    document.getElementById('coreTable').innerHTML="";
if(opt=='all')
{
    $url = "timeLineFetch.php";
}
notey.get($url,function(data)
{
    var dec = JSON.parse(data.response);
    var i = 0;
    while(dec[i]!=null)
    {
        //console.log(dec[i].content);
        pushToTable(dec[i].id,dec[i].date,dec[i].content,dec[i].only);
        i++;
    }
    });
}

function pushToTable(id,dt,content,only)
{
var table = document.getElementById('coreTable');
var tr = document.createElement('tr');
var  dte= document.createElement('td');
var  cntnt= document.createElement('td');
var  opt= document.createElement('td');
opt.setAttribute('class','optionsCell');
cntnt.setAttribute('class','contentCell');

if(only==1)
dte.innerHTML=moment(dt,'YYYY-MM-DD').format('YYYY');
else
dte.innerHTML=moment(dt,'YYYY-MM-DD').format('Do  MMMM YYYY');

cntnt.innerHTML=content;
opt.innerHTML='<button id = "'+id+'" onclick="deleteEntry(this)">Delete';
tr.appendChild(dte);
tr.appendChild(cntnt);
tr.appendChild(opt);
table.appendChild(tr);
}
function deleteEntry(ob)
{
    if(confirm('\n\nAre you sure about deletion ?\n\n'))
    {
        notey.post('deleteTimeLine.php',{id:ob.id},function(data){
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
          </script>
          
</head>
<body>
<div id = "inputSection">
<div>
<input type="number" id="day" placeholder="dd"> / 
<select id = "month">
<option value="00">Month nil</option>
<option value="01">January</option>
<option value="02">February</option>
<option value="03">March</option>
<option value="04">April</option>
<option value="05">May</option>
<option value="06">June</option>
<option value="07">July</option>
<option value="08">August</option>
<option value="09">September</option>
<option value="10">October</option>
<option value="11">November</option>
<option value="12">December</option>
</select>
/
<input type="number" id="year" placeholder="yyyy">
</div>
 <div style="margin-top:.5em;"><textarea id = "content" placeholder="Event" rows="4" cols="10"></textarea></div>

 <button onclick="putThing()">Feed</button>
<script>
</script>
<div id = "resultSpace">
<table id = "coreTable">
</table>
</div>
<script>
buildResult('all');
</script>
</body>
</html>