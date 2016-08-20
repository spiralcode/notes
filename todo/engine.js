var core = {};
core={
pushItem:function(){
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
button.innerHTML="Save";
saveEdit.setAttribute('type','button');
saveEdit.appendChild(button);
tick.appendChild(checkBox);
tick.appendChild(saveEdit);
item.appendChild(tick);
item.appendChild(contentBox);
document.getElementById('ring').insertBefore(item,document.getElementById('ring').childNodes[0]);
}
};