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
		notify('File-type not allowed !',"desp");

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
        			var reader = new FileReader();
                                reader.onload=function(e)
                                {
                                    var dataImage=e.target.result;
                                }
                                reader.readAsDataURL(file);
            $name(file.name).setAttribute('class','uploaded');
            var dataimage='data:image/png;base64,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';
           dataimage='data:image/png;base64,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'
                                $name(file.name).innerHTML='<img style="border:none; width:40px; height:40px;" src = "'+dataimage+'">';
	    $name(file.name).style.backgroundRepeat='no-repeat';
            	    $name(file.name).dataset.uploaded='1';

	  }

	});
		
	}
