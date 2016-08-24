var core = {};
core={
pushItem:function(template){

var timeToken = new Date().getTime('x');
var userId = global_userid || 0; 
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
contentBox.setAttribute('id',timeToken+userId);
button.setAttribute('id','button-'+timeToken+userId);
button.setAttribute('data-item',timeToken+userId);


contentBox.addEventListener('keydown',function(e){
    /*if(contentBox.innerText.length%4==0||contentBox.textContent.length%4==0)
{
    core.remoteTransferItem(this);
}*/
   // core.remoteTransferItem(this);
});
button.innerHTML="Save";
button.setAttribute('data-kind','save');
button.addEventListener('click',function(e){
    if(this.dataset.kind=='save')
    {
core.remoteTransferItem(document.getElementById(timeToken+userId));
    }
    else if(this.dataset.kind=='edit')
    {
     this.innerHTML="Save";   
     button.setAttribute('data-kind','save');
     document.getElementById(this.dataset.item).setAttribute('contentEditable','true');
    }
});
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
    button.addEventListener('click',function(e){
    if(this.dataset.kind=='save')
    {
core.remoteTransferItem(document.getElementById(template.id));
    }
    else if(this.dataset.kind=='edit')
    {
     this.setAttribute('data-kind','save');
     this.innerHTML='Save';
     document.getElementById(this.dataset.item).setAttribute('contentEditable','true');
    }
});
}
saveEdit.appendChild(button);
tick.appendChild(checkBox);
tick.appendChild(saveEdit);
item.appendChild(tick);
item.appendChild(contentBox);
document.getElementById('ring').insertBefore(item,document.getElementById('ring').childNodes[0]);
},remoteTransferItem(ob){
    console.log(ob.id,ob.innerHTML);
    $.post('reciever.php',{itemId:ob.id,content:ob.innerHTML},function(data){
console.log(data);
document.getElementById('button-'+data).setAttribute('data-kind','edit');
document.getElementById('button-'+data).innerHTML="Edit";

    });},filler:function(){$.get('smartFetch.php',function(data){
        var decode = JSON.parse(data);
        var star = 0;
        while(decode[star]!=null)
        {
            if(decode[star].content!='')
            core.pushItem(decode[star]);
            star++;
        }
        core.pushItem();
    });}
};