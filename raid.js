function $id(id)
{
    return document.getElementById(id);
}

function closething(id)
{
    $id(id).remove();
}
function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) == 0) return c.substring(name.length,c.length);
    }
    return "";
}
  function showMsg(url,config)
            {
                var element=document.getElementById('uq');
                if(element)
                    {
                        element.remove();
                    }
                var windowHeight=window.innerHeight , windowWidth = window.innerWidth;
                var divHeight=windowHeight-200, divWidth=windowWidth-300;
      //Check whether another instance of the div exists

      var ele=document.createElement("div");

                document.getElementsByTagName('body')[0].appendChild(ele);
                
                ele.setAttribute('id',"uq");
                 ele.setAttribute('class',"raid");
                
                ele.style.width=divWidth+'px';
                ele.style.height=divHeight+'px';
                var divPos = ele.getBoundingClientRect();
                ele.style.left=(windowWidth/2)-(divPos.width/2)+'px';
                ele.style.top=(windowHeight/2)-(divPos.height/2)+'px';
                var closeDiv =document.createElement('div');
                ele.appendChild(closeDiv);
                closeDiv.setAttribute('class','close');
                closeDiv.setAttribute('onclick','closething(\'uq\')');
                var title = document.createElement('div');
                ele.appendChild(title); title.innerHTML="Title";
                 if(typeof(config.title)=='undefined'){title.innerHTML=' ';}else{title.innerHTML=config.title}
                title.setAttribute('class','title');
             
                var contentDiv = document.createElement('div');
                ele.appendChild(contentDiv);
                contentDiv.setAttribute('class','content');
                contentDiv.style.top='30px';
                contentDiv.style.height=ele.getBoundingClientRect().height-30+'px';
                if(typeof(config.iframe)!='undefined')
                    {
                if(config.iframe)
                    {
                        
                        var iframe=document.createElement('iframe');
                        contentDiv.appendChild(iframe);
                        iframe.setAttribute('class','iframe');
                        iframe.setAttribute('frameborder','0');
                        iframe.setAttribute('src',url);
                        iframe.style.height=contentDiv.getBoundingClientRect().height+"px";
                       iframe.style.width=contentDiv.getBoundingClientRect().width+"px";  
                    }
                    else
                        {
                            $.get(url,function(data,success){
                                contentDiv.innerHTML=data;
    });
                        }
            }
            else
                {
                                $.get(url,function(data,success){
                                contentDiv.innerHTML=data;});
                }
                
            }