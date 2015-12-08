<?php
include 'session_check.php';
?>
<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Notes Go : Read Notes</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/skeleton.css">
         <link rel="stylesheet" href="mobstyle.css">
        <link rel="stylesheet" href="../raid.css"/>
 <link rel="stylesheet" href="../style/jquery-ui.css">
     <link rel="stylesheet" href="../raid.css"/>
<link rel="stylesheet" href="../style/jquery-ui.css">

<script src="js/vendor/modernizr-2.8.3.min.js"></script>
<script src="../lib/jquery-1.10.2.js"></script>
<script src="../lib/jquery-ui.js"></script>
<script src="../notey.js"></script>
<script src="../raid.js"></script>
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
var ir=0;
    function $id(id)
            {
                return document.getElementById(id);
            }
            function showResult(url)
{
$id('frameplace').innerHTML=' ';	
$id('spinner').style.display='block';
	var init=0;
	notey.get(url,function(data)
	{
        $id('spinner').style.display='none';
        var newob=document.createElement('div');
		$id('frameplace').appendChild(newob).setAttribute("id","error");
		$id('frameplace').appendChild(newob).setAttribute("class","nonote");
		var json=JSON.parse(data.responseText);
		if(json[0].status==0)
		{	
            var ele="Nothing found !";
            $id('error').innerHTML=ele;
		}
		else
		{     
               $id('frameplace').innerHTML='';
                while(typeof(json[init])!=='undefined')
		{
		/*Moment code starts*/
                var momentObject = moment(json[init].ftime);
				var hr = momentObject.format('hh');
				var min = momentObject.format('mm');
				var ap = momentObject.format('A');
				var date= momentObject.format('DD');
				var mnth= momentObject.format('MMMM');
				var year= momentObject.format('YYYY');
				var frmtime=hr+':'+min+' '+ap+' | '+date+' '+mnth+' '+year;
                                var searchFormat = date+'-'+mnth+'-'+year;
				var then = momentObject.format('D/M/YYYY HH:mm:ss');				
				var now=moment().format('D/M/YYYY HH:mm:ss');
				var millisec=moment(now,"D/M/YYYY HH:mm:ss").diff(moment(then,"D/M/YYYY HH:mm:ss"));
				var di = moment.duration(millisec);
                                var minutes=di.asMinutes();
				var hoursago=(Math.floor(di.asHours()));
				var days=Math.round(hoursago/24);
                                timeago="";
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
				
		var ele = json[init].content;
		var noteid=json[init].noteid;
		var newob=document.createElement('div');
		$id('frameplace').appendChild(newob).setAttribute("id",ir);
		$id('frameplace').appendChild(newob).setAttribute("class","note");
		var imlist=' ';
		var imlistindex=0;
		var imgexist=false;
		while(typeof(json[init].ilist[0][imlistindex])!=='undefined')
		{
	imlist+='<div class="imgspace"><a target="new" href="../image.php?id='+json[init].ilist[0][imlistindex]+'" target="_blank"><img src="../image.php?id='+json[init].ilist[0][imlistindex]+'&thumb&size=50x50"/></a></div>';
	imlistindex++;
		}
var image = 'data:image/png;base64,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';
$id(ir).innerHTML='<div title="Note Options" class="noteoptions" onclick="showOptions('+ir+')"></div><div class="timeslot"><span onclick="datesearch(\''+searchFormat+'\',\'init\');" style="cursor:pointer;" title="View notes of this date">'+frmtime+'</span></div><div class="contentslot">'+ele+'</div>'+imlist+'<div class="daysago">'+timeago+'</div>';
if(newob.getBoundingClientRect().height>200)
{
//Code for managing big over-sized notes
    }
var optEle=document.createElement('div');
$id('frameplace').appendChild(optEle);
var text = '<span onclick="deletenote(this);" data-noteid="'+noteid+'" data-divid="'+ir+'">Delete Note</span><span onclick="findPeople('+noteid+');">Extract people names</span>';
text='';
optEle.setAttribute('class','noteOptionSlider');
optEle.setAttribute('id',ir+'_opt');
optEle.innerHTML=text;ir++;
init++;}}
});}
            function datesearch(ob,init)
{
    
	if(init){
	showResult('../search.php?date='+ob);}
	else{
	showResult('../search.php?date='+ob.value);}	
}
            </script>
        <div class="topribbon"><h5>Notes <sup>v3</sup></h5></div>
        <div class="toolsBar" ><input type="text" id="keyinput" placeholder="Search for...">
      <input style="height:auto; margin: 0%;" value="Search" type="button" class="button-primary"  onclick="showResult('../gcow.php?q='+$id('keyinput').value);"/>
<!--<input onchange="datesearch(this);" id="datepicker" type="text" placeholder="01/01/2015">-->
        </div>
<script>
        $id('keyinput').addEventListener('keyup',function(e){if(e.keyCode==13){showResult('../gcow.php?q='+$id('keyinput').value);}});

    </script>
    <div class="spinner" id="spinner"></div>
        <div id="frameplace" class="login" align="center" ><h5 style="opacity: .5; text-align: right;">No Notes this day</h5>
</div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.3.min.js"><\/script>')</script>
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>
        <div class="footer"><p><a href="../book.php">Desktop</a> | <a href="home.php">Write Note</a> | <a href="logout.php">Logout</a></p></div>
 <script>
          /*  $(function() {
    $( "#datepicker" ).datepicker(
    		{
    	dateFormat: "dd-mm-yy"		
});
  });*/
    var thing = moment();
datesearch(thing.format('DD-M-YYYY'),true);
var currentDate = thing.format('DD-M-YYYY');

//Code for swipe
 var x = 0,xx=0;
            var y =0,yy=0;
            var t = 0,tt=0;
        document.getElementById('frameplace').addEventListener('touchstart',function(e)
    {
e.preventDefault();
        var ob = e.changedTouches[0];
        x = ob.pageX;
        y = ob.pageY;
        t = new Date().getTime();
    });
     document.getElementById('frameplace').addEventListener('touchend',function(e)
    {
e.preventDefault();

        tt = new Date().getTime();
        var ob = e.changedTouches[0];
        xx = ob.pageX;
        yy = ob.pageY;
        if(Math.abs(tt-t)<200)
            {
                var abs_x = Math.abs(xx-x);
                 var abs_y = Math.abs(yy-y);

        if(abs_x>abs_y)
            {
                //x movement is greater
                if(xx>x)
                    {
       
                 var new_date = moment(currentDate, "DD-MM-YYYY").add(-1,'days').format('DD-M-YYYY');
                 currentDate= new_date;
                    datesearch(currentDate,true);
                    $id('keyinput').value=currentDate;
                    

                 //right Swipe
                 

                    return 0;
                    }
                    else
                        {
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
                            //console.log("Down Swipe");
                            return 2;
                        }
                        else
                            {
                                //console.log("Up Swipe");
                                return 3;
                            }
                }
            }
    });
            </script>
    </body>
</html>
