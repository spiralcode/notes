function notify(msg,status,ext)
{
    var div = document.createElement("div");
    document.getElementsByTagName('body')[0].appendChild(div);
    div.setAttribute("class","sudden_notify");
        div.setAttribute("id","sudden_notify");

    var page_h = window.innerHeight;
    var page_w = window.innerWidth;
var ob=$id('sudden_notify');
        
        //Displaying the div
        ob.style.display='block';
        ob.innerHTML='<div class="msg">'+msg+'</div>';
	ob_dimensions= ob.getBoundingClientRect();
        w=ob_dimensions.width;
        //Positioning the div in center of page
        ob.style.left=(page_w/2)-(w/2)+'px';
        ob.style.top=30+'px';
        if(status=="happy")
            {
        ob.style.background="#637A00";
        ob.style.color="#fff";
            }
            else
            {
         ob.style.background="#7A2E00";
         ob.style.color="#fff";
                }
                if(ext=='ext')
{
  $('#sudden_notify').delay(8000).fadeOut(1000);
}
else
 {
  $('#sudden_notify').delay(1000).fadeOut(1000);
 }
}