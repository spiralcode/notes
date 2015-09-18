var index=0;
function $id(id)
{
	return document.getElementById(id);
}
function FileDragHover(e)
{
	e.stopPropagation();
	e.preventDefault();
	$id("tarea").style.border="1px groove #48655B";
	$id("tarea").style.borderBottom="none";

	}
function FileDragOut(e)
{

	e.stopPropagation();
	e.preventDefault();
	$id("tarea").style.border="1px dotted #7192A8";
	$id("tarea").style.borderBottom="none";


	
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
                                                    $id('loading').style.display='block';
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
                 		notify('<strong>'+file.name+'</strong> doesn\'t seems to be an image (png/jpeg)',"desp",'ext');
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
          var dataimage='data:image/png;base64,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'
                                $name(file.name).innerHTML='<img style="border:none; width:20px; height:20px;" src = "'+dataimage+'">';
	    $name(file.name).style.backgroundRepeat='no-repeat';
            	    $name(file.name).dataset.uploaded='1';}});}
