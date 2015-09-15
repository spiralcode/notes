var index=0;
function $id(id)
{
	return document.getElementById(id);
}
function FileDragHover(e)
{
	e.stopPropagation();
	e.preventDefault();
	$id("tarea").style.border="1px dotted #f00";
        	$id("tarea").style.background="rgb(232, 230, 192)";

	$id("tarea").style.borderBottom="none";

	}
function FileDragOut(e)
{

	e.stopPropagation();
	e.preventDefault();
	$id("tarea").style.border="1px dotted #7192A8";
	$id("tarea").style.borderBottom="none";
                	$id("tarea").style.background="#fff";

	
	}
function FileSelectHandler(e)
{
	FileDragOut(e);
var files = e.target.files || e.dataTransfer.files;

for(var i=0,f;f=files[i];i++)
	{
	ParseFile(f);
	f=null;
	}
}
function ParseFile(file)
{
	if(file.type=='image/jpeg'||file.type=='image/png')
		{
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
		notify('Filetype not allowed !',"desp");

		}
}
function init()
{
	var fileselect = $id("fileselect"),tarea=$id('tarea');
	fileselect.addEventListener("change",FileSelectHandler,false);
	var xhr = new XMLHttpRequest();
	if(xhr.upload)
		{
		tarea.addEventListener("dragover",FileDragHover,false);
		tarea.addEventListener("dragleave",FileDragOut,false);
		tarea.addEventListener("drop",FileSelectHandler,false);

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
	$id('loading').style.display='block';
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
		$id('loading').style.display='none';
	    $name(file.name).style.backgroundImage="url('images/s_okay.png')";
	    $name(file.name).style.border='1px solid #0f0';
	    $name(file.name).style.backgroundPosition='top right';

	    $name(file.name).style.backgroundRepeat='no-repeat';



	  }

	});
		
	}
