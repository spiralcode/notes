
 var gen=
{
	 id: function(id)
	{
		return document.getElementById(id);
	},
	formatOf: function(fileName)
	{
  var collect=  fileName.split(".");
  var at = collect.length-1;
    if(collect[at]=='html')
    return 'text/html';
    else if(collect[at]=='css')
    return 'text/css';
        else if(collect[at]=='js')
    return 'application/javascript';
            else if(collect[at]=='json')
    return 'application/json';
	  else if(collect[at]=='mp3')
    return 'mp3';
        else if(collect[at]=='pdf')
    return 'pdf';
            else if(collect[at]=='jpeg')
    return 'jpeg';
               else if(collect[at]=='jpg')
    return 'jpeg';
                   else if(collect[at]=='png')
    return 'png';
    else
    return 'file';
	},
    dropDown:function(ob)
    {
        console.log('ss');
      var div = document.createElement('div');
      div.setAttribute('class','dropDown');
      var loc = ob.getBoundingClientRect();
      div.style.left=loc.left+'px';
            div.style.top=loc.bottom+'px';
            div.innerHTML="THIG";
            document.getElementsByTagName('body')[0].appendChild(div);
    }
};
function travelTo(link,target)
{
    	window.location.href=link;
}