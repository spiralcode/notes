function notify(msg,status)
{
    
    var page_h = window.innerHeight;
    var page_w = window.innerWidth;
	var ob=$id('sudden_notify');
        
        //Displaying the div
        ob.style.display='block';
        ob.innerHTML=msg;
	ob_dimensions= ob.getBoundingClientRect();
        w=ob_dimensions.width;
        console.log(w);
        //Positioning the div in center of page
        ob.style.left=(page_w/2)-(w/2)+'px';
        ob.style.top=20+'px';
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
        $('#sudden_notify').delay(1000).fadeOut(1000);
}