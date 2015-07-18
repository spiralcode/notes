var index=0;
function $id(id)
{
	return document.getElementById(id);
}
function FileDragHover(e)
{
	e.stopPropagation();
	e.preventDefault();
	//e.target.style.border="1px solid #f00";
	$id("filedrag").style.border="2px dotted #f00";
	$id("filedrag").style.borderBottom="none";

	}
function FileDragOut(e)
{
	e.stopPropagation();
	e.preventDefault();
	//e.target.style.border="1px solid #f00";
	$id("filedrag").style.border="1px dotted #7192A8";
	$id("filedrag").style.borderBottom="none";
	}
function FileSelectHandler(e)
{
	FileDragOut(e);
var files = e.target.files || e.dataTransfer.files;

for(var i=0,f;f=files[i];i++)
	{
	ParseFile(f);
	files[i]='';
	}
}
function ParseFile(file)
{
	if(file.type=='image/jpeg'||file.type=='image/png')
		{
	
		console.log(file.name);
		console.log(file.type);
		console.log(file.size);
		if (file.type.indexOf("image") == 0) {
			var reader = new FileReader();
			reader.onload = function(e) {
				imglist(e.target.result,file.name);
				uploadfile(file);
			}
			reader.readAsDataURL(file);
		}
		
		}
	else
		{
		msg('Filetype not allowed');
		console.log(file.type);

		}
}
function init()
{
	var fileselect = $id("fileselect"),filedrag=$id('filedrag');
	fileselect.addEventListener("change",FileSelectHandler,false);
	var xhr = new XMLHttpRequest();
	if(xhr.upload)
		{
		filedrag.addEventListener("dragover",FileDragHover,false);
		filedrag.addEventListener("dragleave",FileDragOut,false);
		filedrag.addEventListener("drop",FileSelectHandler,false);

		}
	}
if(window.File && window.FileList && window.FileReader)
	{
	init();
	}
function msg(data)
{
	alert(data);
	}
function uploadfile(file)
{
	var fd = new FormData();    
	fd.append( 'file', file );
	fd.append( 'nid', timer );


	$.ajax({
	  url: 'filecatch.php',
	  data: fd,
	  processData: false,
	  contentType: false,
	  type: 'POST',
	  mimeType: 'multipart/form-data',
	  success: function(data){
	    $name(file.name).style.opacity='.5';
	    $name(file.name).style.border='1px solid #0f0';
	  }

	});
		
	}
