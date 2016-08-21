var core = {};
core={
pushItem:function(){
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
button.setAttribute('id','button-'+timeToken+'-'+userId);
contentBox.addEventListener('keydown',function(e){
    if(contentBox.innerText.length%4==0||contentBox.textContent.length%4==0)
{
    core.remoteTransferItem(this);
}
});
button.innerHTML="Save";
button.setAttribute('data-kind','save');
button.addEventListener('click',function(e){
    if(this.dataset.kind=='save')
    {
core.remoteTransferItem(document.getElementById(timeToken+userId));
    }
});
saveEdit.setAttribute('type','button');
saveEdit.appendChild(button);
tick.appendChild(checkBox);
tick.appendChild(saveEdit);
item.appendChild(tick);
item.appendChild(contentBox);
document.getElementById('ring').insertBefore(item,document.getElementById('ring').childNodes[0]);
},remoteTransferItem(ob){
    $.post('reciever.php',{itemId:ob.id,content:ob.innerHTML},function(data){

    });}
};