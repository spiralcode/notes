var index=0;
/*
File Buffer */
var fileS = function(id,file)
{
	this.id=id;
	this.file=file;
};
var fileBuffer = new Array();


function $id(id)
{
	return document.getElementById(id);
}
function FileDragHover(e)
{
	e.stopPropagation();
	e.preventDefault();
	}
function FileDragOut(e)
{
	e.stopPropagation();
	e.preventDefault();
	}
function fileSelectHandler(e)
{
FileDragOut(e);
var files = e.target.files || e.dataTransfer.files;
var o =0;
for(var i=0,f;f=files[i];i++)
	{
//	fileBuffer.push(new fileS(o,f));
//	console.log('insertion-'+o);
//		console.log('after insertion len-'+fileBuffer.length);
	if(gen.formatOf(f.name)=='jpeg'||gen.formatOf(f.name)=='jpg'||gen.formatOf(f.name)=='png')
	{
			ParseFile(f,o);
	}
	else
	{
	listFile(null,f.name,o);
	}
	f=null;
	o++;
	}

}
function ParseFile(file,id)
{
			var reader = new FileReader();
			reader.onload = function(e) {
			listFile(e.target.result,file.name,id);
			}
			reader.readAsDataURL(file);
}
function init()
{
	var fileSelect = $id("fileSelect"),fileList=$id('fileList');
	var filesFiles = $id('filesFiles');
	fileSelect.addEventListener("change",fileSelectHandler,false);
	var xhr = new XMLHttpRequest();
	if(xhr.upload) 
		{
		fileSelect.addEventListener("dragover",FileDragHover,false);
		fileSelect.addEventListener("dragleave",FileDragOut,false);
		fileSelect.addEventListener("drop",fileSelectHandler,false);
		}
	}

function uploadfile(file)
{
	var fd = new FormData();    
	fd.append( 'file', file.file );
	fd.append( 'nid', noteId );
	fd.append( 'filename', file.name );
	fd.append( 'id', file.id );
	fd.append('folder',gen.id('folderSpec').value);
	$.ajax({
	  url: 'filecatch.php',
	  data: fd,
	  processData: false,
	  contentType: false,
	  type: 'POST',
	  mimeType: 'multipart/form-data',
	   xhr: function() {
                var myXhr = $.ajaxSettings.xhr();
                if(myXhr.upload){
                    myXhr.upload.addEventListener('progress',function(e){		
    if(e.lengthComputable){
        var max = e.total;
        var current = e.loaded;
        var Percentage = (current * 100)/max;
		document.getElementById('buffer-'+file.id).value=Math.round(Percentage);
		if(Percentage >= 100)
        {
var index=0;
while(fileBuffer[index]!=null)
{
   if(fileBuffer[index].id==file.id){
   fileBuffer.splice(index,1);
   }
    index++;
}
document.getElementsByName(file.file.name)[0].innerHTML='<img src="'+JSON.parse(icons).tick+'">';
if(document.getElementsByName(file.file.name)[0]!=null)
{
document.getElementsByName(file.file.name)[0].innerHTML='<img src="'+JSON.parse(icons).tick+'">';
}
        }
    }  
						}, false);
                }
                return myXhr;
        },
	  success: function(data){
		//  console.log(data);
		   }
                        });
	
}
