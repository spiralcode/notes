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
	fileBuffer.push(new fileS(o++,f));
	if(gen.formatOf(f.name)=='jpeg'||gen.formatOf(f.name)=='jpg'||gen.formatOf(f.name)=='png')
	{
			ParseFile(f);
	}
	else
	{
					listFile(null,f.name);
	}
	f=null;
	}

}
function ParseFile(file)
{
			var reader = new FileReader();
			reader.onload = function(e) {
			listFile(e.target.result,file.name);
			}
			reader.readAsDataURL(file);
}
function init()
{
	var fileSelect = $id("fileSelect"),fileList=$id('fileList');
	fileSelect.addEventListener("change",fileSelectHandler,false);
	var xhr = new XMLHttpRequest();
	if(xhr.upload) 
		{
		fileList.addEventListener("dragover",FileDragHover,false);
		fileList.addEventListener("dragleave",FileDragOut,false);
		fileList.addEventListener("drop",fileSelectHandler,false);

		}
	}

function uploadfile(file)
{

	var fd = new FormData();    
	fd.append( 'file', file.file );
	fd.append( 'nid', noteId );
	fd.append( 'filename', file.name );
	fd.append( 'id', file.id );
	$.ajax({
		xhr: function () {
        var xhr = new window.XMLHttpRequest();
        //Download progress
        xhr.addEventListener("progress", function (evt) {
            if (evt.lengthComputable) {
                var percentComplete = evt.loaded / evt.total;
              //  console.log(Math.round(percentComplete * 100) + "%");
				gen.id('id'+file.name).value=Math.round(percentComplete * 100);
            }
			else
			{
				console.log('Unable to estimate');
			}
        }, false);
        return xhr;
    },
	  url: 'filecatch.php',
	  data: fd,
	  processData: false,
	  contentType: false,
	  type: 'POST',
	  mimeType: 'multipart/form-data',
	  success: function(data){
var dec = JSON.parse(data);
var index=0;
while(fileBuffer[index]!=null)
{
   if(fileBuffer[index].id==dec.id){
       fileBuffer.splice(index,1);
   }

    index++;
}
if(document.getElementsByName(dec.filename)[0]!=null)
{
document.getElementsByName(dec.filename)[0].innerHTML='<img src="'+JSON.parse(icons).tick+'">';
}
gen.id('louis_load').style.display='none';
	gen.id('louis_talk').innerHTML='';		
	  }
                        });
	
}

