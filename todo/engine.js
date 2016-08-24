var timeToken=(new Date).getTime();
var core = {};
core={
pushItem:function(template){
var userId = global_userid; 
var item = document.createElement('div');
var tick = document.createElement('div');
var contentBox = document.createElement('div');
var checkBox = document.createElement('input');
var saveEdit = document.createElement('span');
var button = document.createElement('button');
var day = document.createElement('div');
item.setAttribute('class','item');
tick.setAttribute('class','tick');
saveEdit.setAttribute('class','saveEdit');
item.setAttribute('class','item');
contentBox.setAttribute('class','contentBox');
day.setAttribute('class','day');
checkBox.setAttribute('type','checkbox');
contentBox.setAttribute('contentEditable','true');
contentBox.innerHTML="";
contentBox.setAttribute('data-text','Type it here...');
contentBox.setAttribute('id',timeToken+''+userId);
button.setAttribute('id','button-'+timeToken+''+userId);
button.setAttribute('data-item',timeToken+''+userId);
checkBox.setAttribute('id','checkbox-'+timeToken+''+userId);
checkBox.setAttribute('data-item',timeToken+''+userId);
checkBox.setAttribute('disabled','disabled');
contentBox.addEventListener('keydown',function(e){
    /*if(contentBox.innerText.length%4==0||contentBox.textContent.length%4==0)
{
    core.remoteTransferItem(this);
}*/
   // core.remoteTransferItem(this);
});
button.innerHTML="Save";
button.setAttribute('data-kind','save');
if(!template)
{
button.addEventListener('click',function(e){
    if(this.dataset.kind=='save')
    {
this.setAttribute('data-kind','edit');
core.remoteTransferItem(document.getElementById(timeToken+''+userId));
    }
    else if(this.dataset.kind=='edit')
    {
     this.innerHTML="Save";   
     this.setAttribute('data-kind','save');
     document.getElementById(this.dataset.item).setAttribute('contentEditable','true');
    }
});

checkBox.addEventListener('click',function(e){
        core.ping('updateItem.php?id='+this.dataset.item);

});
}
saveEdit.setAttribute('type','button');
//On Pre-saved noted
if(template)
{
    contentBox.innerHTML=template.content;
    contentBox.setAttribute('contentEditable','false');
    button.setAttribute('data-kind','edit');
    button.innerHTML="Edit";
    contentBox.setAttribute('id',template.id);
    button.setAttribute('data-item',template.id);
    button.setAttribute('id','button-'+template.id);
    checkBox.setAttribute('id','check'-template.id);
    checkBox.removeAttribute('disabled');
checkBox.setAttribute('data-item',template.id);
    button.addEventListener('click',function(e){
    if(this.dataset.kind=='save')
    {
core.remoteTransferItem(document.getElementById(template.id));
     this.setAttribute('data-kind','save');

    }
    else if(this.dataset.kind=='edit')
    {
     this.innerHTML='Save';
     this.setAttribute('data-kind','save');
     document.getElementById(this.dataset.item).setAttribute('contentEditable','true');
    }
});
checkBox.addEventListener('click',function(e){
  //  alert(this.dataset.item);
    core.ping('updateItem.php?id='+this.dataset.item);
});
}
saveEdit.appendChild(button);
tick.appendChild(checkBox);
tick.appendChild(saveEdit);
item.appendChild(tick);
item.appendChild(contentBox);
document.getElementById('ring').insertBefore(item,document.getElementById('ring').childNodes[0]);
},remoteTransferItem(ob){
    $.post('reciever.php',{itemId:ob.id,content:ob.innerHTML},function(data){
        console.log('button-'+data);
document.getElementById('button-'+data).setAttribute('data-kind','edit');
document.getElementById('button-'+data).innerHTML="Edit";
document.getElementById(data).setAttribute('contentEditable','false');
document.getElementById('checkbox-'+data).removeAttribute('disabled');


    });},filler:function(){$.get('smartFetch.php',function(data){
        var decode = JSON.parse(data);
        var star = 0;
        while(decode[star]!=null)
        {
            if(decode[star].content!='')
            core.pushItem(decode[star]);
            star++;
        }
    });},ping:function(url){
        $.get(url,function(data){});
    }
};