<?php
include 'session_check.php';
?>
<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>notes Go : Read Notes</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/skeleton.css">
         <link rel="stylesheet" href="mobstyle.css">
        <link rel="stylesheet" href="../raid.css"/>
        <link rel="stylesheet" href="deviceGen.css"/>
 <link rel="stylesheet" href="../style/jquery-ui.css">
     <link rel="stylesheet" href="../raid.css"/>
<link rel="stylesheet" href="../style/jquery-ui.css">
<script src="js/vendor/modernizr-2.8.3.min.js"></script>
<script src="../lib/jquery-1.10.2.js"></script>
<script src="../lib/jquery-ui.js"></script>
<script src="../notey.js"></script>
<script src="../raid.js"></script>
<script src="../jss/general.js"></script>

<script src="../lib/moment.js"></script>
<style>
    input[type="text"]
    {
        height: auto;
        margin-bottom: 0%;
    }
    </style>
    </head>
    <body>
        <script>
//Notes Mobile
//GLOBAL ACTIVE DATE VARIABLE
var DATE = "0000-00-00 00:00:00";
//CURRENT NOTE VIEW MODES (KEYWORD SEARCH / DATE SEARCH  )
var ACTIVITY=""; 
var ir=0;
    function $id(id)
            {
                return document.getElementById(id);
            }
function showResult(url,app)
{
ACTIVITY = "KS"; //keyword Search
if(!app){
$id('frameplace').innerHTML=' ';
$id('spinner').style.display='block';

}
else
$id('loaderLinear').style.display="block";
	var init=0;
	notey.get(url,function(data)
	{
       $id('loaderLinear').style.display="none";
        $id('spinner').style.display='none';
        var newob=document.createElement('div');
		$id('frameplace').appendChild(newob).setAttribute("id","error");
		$id('frameplace').appendChild(newob).setAttribute("class","nonote");
		var json=JSON.parse(data.responseText);
		if(json[0].status==0)
		{
            var ele="No Notes";
            if(ACTIVITY!="DMND")
            $id('error').innerHTML=ele;
		}
		else
		{
               $id('frameplace').innerHTML='';
                while(typeof(json[init])!='undefined')
		{
            if(json[init].ftime!='undefined')
               DATE = json[init].ftime;
                var momentObject = moment(json[init].ftime);
				var hr = momentObject.format('hh');
				var min = momentObject.format('mm');
				var ap = momentObject.format('A');
				var date= momentObject.format('DD');
				var mnth= momentObject.format('MMMM');
				var year= momentObject.format('YYYY');
				var frmtime=hr+':'+min+' '+ap+' | '+date+' '+mnth+' '+year;
               var frmtime=moment(json[init].ftime).format('dddd, Do  MMMM YYYY ,HH:mm');
                 var searchFormat = date+'-'+mnth+'-'+year;
				var then = momentObject.format('D/M/YYYY HH:mm:ss');				
				var now=moment().format('D/M/YYYY HH:mm:ss');
				var millisec=moment(now,"D/M/YYYY HH:mm:ss").diff(moment(then,"D/M/YYYY HH:mm:ss"));
				var di = moment.duration(millisec);
               var minutes=di.asMinutes();
				var hoursago=(Math.floor(di.asHours()));
				var days=Math.round(hoursago/24);
                
                           var     timeago="";
                                if(minutes<15)
                                    {
                                        timeago="Now";
                                    }
                                    else if(minutes<60)
                                        {
                                            timeago="Some time before";
                                        }
                                        else if(minutes<120)
                                            {
                                                timeago= "1 hour before";
                                            }
                                            else if(minutes<(24*60))
                                            {
                                                timeago=Math.floor(minutes/60)+" hours before";
                                            }
                                            else if(minutes<(24*120))
                                            {
                                                timeago="A day before";
                                            }
                                            else if(minutes>(24*120))
                                                {
                                                    timeago=Math.floor(((minutes/60)/24))+" days before";
                                                }
				var timeAgo = document.createElement('div');
                timeAgo.innerHTML=timeago;
                timeAgo.setAttribute('class','daysago')
		var ele = json[init].content;
		var noteid=json[init].noteid;
		var newob=document.createElement('div');
        //note options
        var ntO = document.createElement('div');
        ntO.setAttribute('class','noteoptions');
        //time slot
        var tSl = document.createElement('div');
         tSl.setAttribute('class','timeslot');
        var tSs = document.createElement('span');
        tSs.setAttribute('onclick','datesearch("'+searchFormat+'","init")');
        tSs.innerHTML=frmtime;
        tSl.appendChild(tSs);
        //codeSlot
        var cS = document.createElement('div');
        cS.setAttribute('class','contentslot');
        cS.innerHTML=ele;
//FileSpace
var fS=document.createElement('div');
fS.setAttribute('class','imgspace');
var beg = 0;
while(json[init].ilist[0][beg]!=null)
{
    /**/
    console.log(json[init].ilist[0][beg]);
    /*notey.get('../fileInfo.php?id='+json[init].ilist[0][beg],function(data){
var decoded = JSON.parse(data.responseText);
var div = document.createElement('div');
div.setAttribute('class','file');
div.innerHTML=decoded[0].realFileName;
div.setAttribute('title',decoded[0].realFileName);
//div.style.background='url('+JSON.parse(icons).defaultfile+')';
div.style.backgroundSize='5em 5em';
div.style.backgroundRepeat='no-repeat';
div.setAttribute('data-id',decoded[0].id);
div.addEventListener('click',function(e){
  fileInfo(this);
});*/
var file = document.createElement('div');
var img = document.createElement('img');
img.src = "../image.php?thumb&size=50x50&id="+json[init].ilist[0][beg];
img.alt="file";
var cast = "window.open('../redirectToFile.php?id="+json[init].ilist[0][beg]+"','_blank')";
img.setAttribute('onclick',cast);
file.appendChild(img);
fS.appendChild(file);
        newob.appendChild(fS);
      beg++;
    /**/
}
            newob.appendChild(ntO);
            newob.appendChild(tSl);
           newob.appendChild(cS);
        newob.appendChild(timeAgo);      
if(beg!=0)
{ 
        newob.appendChild(fS);
}     
	newob.setAttribute('class','note');
    $id('frameplace').appendChild(newob);
     init++;
        }
    }
    
    });
}
            function datesearch(ob,init)
{
        ACTIVITY = "DS" //date Search
	if(init){
        //console.log(ob);
       DATE=moment(ob,'dd-m-yyyy').format('YYYY-MM-DD');
	showResult('../search.php?date='+ob,false);
}
	else{
       DATE=moment(ob.value,'dd-m-yyyy').format('YYYY-MM-DD');
	showResult('../search.php?date='+ob.value,false);
}	
}
            </script>
        <div class="topribbon"><h5 style="margin:.2em">notes <sup></sup></h5></div>
        <div class="toolsBar" ><input type="text" id="keyinput" placeholder="Search for...">
      <input style="height:auto; margin: 0%;" value="Search" type="button" class="button-primary"  onclick="showResult('../gcow.php?from=0&till=9&q='+$id('keyinput').value,false);"/>
<!--<input onchange="datesearch(this);" id="datepicker" type="text" placeholder="01/01/2015">-->
        </div>
<script>
        $id('keyinput').addEventListener('keyup',function(e){if(e.keyCode==13){showResult('../gcow.php?from=0&till=9&q='+$id('keyinput').value,false);}});
    </script>
       <div class="navigateDotsLeft">
            <div onclick="jmpPrevDateNavigate()";  class="navigateDotsJumpLeft">&lt;</div>
            <div title="Write Note"  onclick="window.location='home.php'" class="navigateDotsNextLeft" id="navigateDotsJumpLeft"></div>   
</div>
<div class="navigateDotsRight">
             <div onclick="jmpNextDateNavigate()" class="navigateDotsJumpRight">&gt;</div>
                <div title="Photos"  onclick="window.location='../imgSlide.php'" class="navigateDotsNextRightPhotos" id="navigateDotsNextRight"></div>    
                </div>
    <div class="spinner" id="spinner"></div>
 

        <div id="frameplace" class="login" align="center" ><h5 style="opacity: .5; text-align: right;"></h5>
</div>
<script>

</script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.3.min.js"><\/script>')</script>
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>
        <div id="loaderLinear" class="loaderLinear"></div>
        <div class="footer"><p><a href="../paper.php">Desktop</a> | <a href="home.php">Write Note</a> | <a href="logout.php">Logout</a></p></div>
 <script>
          /*  $(function() {
    $( "#datepicker" ).datepicker(
    		{
    	dateFormat: "dd-mm-yy"		
});
  });*/
  var frmOb = $id('frameplace').getBoundingClientRect();
    var thing = moment();
datesearch(thing.format('DD-M-YYYY'),true);
var currentDate = thing.format('DD-M-YYYY');

//Code for swipe
 var x = 0,xx=0;
 var y =0,yy=0;
  var t = 0,tt=0;
        document.getElementById('frameplace').addEventListener('touchstart',function(e)
    {
        var ob = e.changedTouches[0];
        x = ob.pageX;
        y = ob.pageY;
        t = new Date().getTime();
    });
    var slideCount = 0;
            document.getElementById('frameplace').addEventListener('touchmove',function(e)
{
            var ob = e.changedTouches[0];
            if(Math.abs(ob.pageX)>Math.abs(x)){
                slideCount++
                if(slideCount%100==0)
                $id('frameplace').style.opacity=1000/(Math.abs(ob.pageX)-Math.abs(x));
        }
});
/*
     document.getElementById('frameplace').addEventListener('touchend',function(e)
    {
        tt = new Date().getTime();
        var ob = e.changedTouches[0];
        xx = ob.pageX;
        yy = ob.pageY;
               var abs_x = Math.abs(xx-x);
              var abs_y = Math.abs(yy-y);
        if(Math.abs(tt-t)<300&&(abs_x>abs_y))
            {

        if(abs_x>abs_y&&abs_y<20)
            {
                //x movement is greater
                if(xx>x)
                    {
       e.preventDefault();
                 var new_date = moment(currentDate, "DD-MM-YYYY").add(-1,'days').format('DD-M-YYYY');
                 currentDate= new_date;
                    datesearch(currentDate,true);
                    $id('keyinput').value=currentDate;
                    

                 //right Swipe
                 

                    return 0;
                    }
                    else
                        {
                            e.preventDefault();
                          var new_date = moment(currentDate, "DD-MM-YYYY").add(1, 'days').format('DD-M-YYYY');
                 currentDate= new_date;
                 datesearch(currentDate,true);
                                     $id('keyinput').value=currentDate;
                    //left swipe
                            return 1;
                        }
            }
            else
                {
                    //y movement is greater
                    if(yy>y)
                        {
                           // console.logshowResult("Down Swipe");
                                             //   window.scrollBy(0, -abs_y);
                            return 2;
                        }
                        else
                            {
                              //  console.log("Up Swipe");
                //    window.scrollBy(0, abs_y);
                                return 3;
                            }
                }
            }
    });*/
    function nextDateNavigate()
    {
              var new_date = moment(currentDate, "DD-MM-YYYY").add(1,'days').format('DD-M-YYYY');
                 currentDate= new_date;
                    datesearch(currentDate,true);
                    $id('keyinput').value=currentDate;
    }
    function prevDateNavigate()
    {
           var new_date = moment(currentDate, "DD-MM-YYYY").add(-1, 'days').format('DD-M-YYYY');
                 currentDate= new_date;
                 datesearch(currentDate,true);
                                     $id('keyinput').value=currentDate;
    }
        function jmpNextDateNavigate()
    {
   	showResult('../search.php?jmp&crrnt='+DATE+'&inc=1');

    }
    function jmpPrevDateNavigate()
    {
         	showResult('../search.php?jmp&crrnt='+DATE+'&inc=0',false);

    }
    function appendNote(url)
{
$id('loaderLinear').style.display="block";
	var init=0;
	notey.get(url,function(data)
	{
       $id('loaderLinear').style.display="none";
        var newob=document.createElement('div');
		$id('frameplace').appendChild(newob).setAttribute("id","error");
		$id('frameplace').appendChild(newob).setAttribute("class","nonote");
		var json=JSON.parse(data.responseText);
		if(json[0].status==0)
		{
            var ele="No Notes";
            if(ACTIVITY!="DMND")
            $id('error').innerHTML=ele;
		}
		else
		{
             //  $id('frameplace').innerHTML='';
                while(typeof(json[init])!='undefined')
		{
            if(json[init].ftime!='undefined')
               DATE = json[init].ftime;
                var momentObject = moment(json[init].ftime);
				var hr = momentObject.format('hh');
				var min = momentObject.format('mm');
				var ap = momentObject.format('A');
				var date= momentObject.format('DD');
				var mnth= momentObject.format('MMMM');
				var year= momentObject.format('YYYY');
				var frmtime=hr+':'+min+' '+ap+' | '+date+' '+mnth+' '+year;
               var frmtime=moment(json[init].ftime).format('dddd, Do  MMMM YYYY ,HH:mm');
                 var searchFormat = date+'-'+mnth+'-'+year;
				var then = momentObject.format('D/M/YYYY HH:mm:ss');				
				var now=moment().format('D/M/YYYY HH:mm:ss');
				var millisec=moment(now,"D/M/YYYY HH:mm:ss").diff(moment(then,"D/M/YYYY HH:mm:ss"));
				var di = moment.duration(millisec);
               var minutes=di.asMinutes();
				var hoursago=(Math.floor(di.asHours()));
				var days=Math.round(hoursago/24);
                
                           var     timeago="";
                                if(minutes<15)
                                    {
                                        timeago="Now";
                                    }
                                    else if(minutes<60)
                                        {
                                            timeago="Some time before";
                                        }
                                        else if(minutes<120)
                                            {
                                                timeago= "1 hour before";
                                            }
                                            else if(minutes<(24*60))
                                            {
                                                timeago=Math.floor(minutes/60)+" hours before";
                                            }
                                            else if(minutes<(24*120))
                                            {
                                                timeago="A day before";
                                            }
                                            else if(minutes>(24*120))
                                                {
                                                    timeago=Math.floor(((minutes/60)/24))+" days before";
                                                }
				var timeAgo = document.createElement('div');
                timeAgo.innerHTML=timeago;
                timeAgo.setAttribute('class','daysago')
		var ele = json[init].content;
		var noteid=json[init].noteid;
		var newob=document.createElement('div');
        //note options
        var ntO = document.createElement('div');
        ntO.setAttribute('class','noteoptions');
        //time slot
        var tSl = document.createElement('div');
         tSl.setAttribute('class','timeslot');
        var tSs = document.createElement('span');
        tSs.setAttribute('onclick','datesearch("'+searchFormat+'","init")');
        tSs.innerHTML=frmtime;
        tSl.appendChild(tSs);
        //codeSlot
        var cS = document.createElement('div');
        cS.setAttribute('class','contentslot');
        cS.innerHTML=ele;
//FileSpace
var fS=document.createElement('div');
fS.setAttribute('class','imgspace');
var beg = 0;
while(json[init].ilist[0][beg]!=null)
{
var file = document.createElement('div');
var img = document.createElement('img');
img.src = "../image.php?thumb&size=50x50&id="+json[init].ilist[0][beg];
img.alt="file";
var cast = "window.open('../redirectToFile.php?id="+json[init].ilist[0][beg]+"','_blank')";
img.setAttribute('onclick',cast);
file.appendChild(img);
fS.appendChild(file);
        newob.appendChild(fS);
      beg++;
    /**/
}
            newob.appendChild(ntO);
            newob.appendChild(tSl);
           newob.appendChild(cS);
        newob.appendChild(timeAgo);      
if(beg!=0)
{ 
        newob.appendChild(fS);
}     
	newob.setAttribute('class','note');
    $id('frameplace').appendChild(newob);
     init++;
        }
    }
    
    });
    }
document.getElementById('frameplace').addEventListener('scroll',function(e){
if( document.getElementById('frameplace').scrollTop === (document.getElementById('frameplace').scrollHeight - document.getElementById('frameplace').offsetHeight))
{
if(ACTIVITY=="KS")
 scrollMonitor();
}
},true);

var scrollIndex=0;
function scrollMonitor()
{
scrollIndex+=10;
var till = scrollIndex+10;
appendNote('../gcow.php?from='+scrollIndex+'&till='+till+'&q='+$id('keyinput').value,true);
}
            </script>
    </body>
</html>
