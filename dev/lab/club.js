document.getElementById('divDiv').addEventListener('keyup',function(e)
{
    scanPeople(e);
},false);
function $id(id)
{
    return document.getElementById(id);
}

function textTrans(ob)
{
    console.log(ob);
    $id('textArea').innerHTML=ob.innerHTML;
}
function scanPeople(ob)
{
    var pplist=new Array("Archana","Arathy");
String=document.getElementById('divDiv').innerHTML;
var output=String;
for(var a=0;a<pplist.length;a++)
    {
       var regex = new RegExp(pplist[a],"ig");
output=output.replace(regex,'<span class="selectStyle">'+pplist[a]+'</span>') ;
    }
document.getElementById('divDiv').innerHTML=output;
document.getElementById('divDiv').innerHTML.length=output.length;
document.getElementById('textArea').value=output;


document.getElementById('divDiv').contentEditable='true';

}