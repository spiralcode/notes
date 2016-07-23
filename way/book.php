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
            var ele="No Notes this day!";
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
	imlist+='<div class="imgspace"><a href="image.php?id='+json[init].ilist[0][imlistindex]+'" target="_blank"><img src="image.php?id='+json[init].ilist[0][imlistindex]+'&thumb&size=50x50"/></a></div>';
	imlistindex++;
		}

$id(ir).innerHTML='<div title="Note Options" class="noteoptions" onclick="showOptions('+ir+')"></div><div class="timeslot"><span onclick="datesearch(\''+searchFormat+'\',\'init\');" style="cursor:pointer;" title="View notes of this date">'+frmtime+'</span></div><div class="contentslot">'+ele+'</div>'+imlist+'';
if(newob.getBoundingClientRect().height>200)
{
//Code for managing big over-sized notes
    }
    var timeAgo = document.createElement('div');
    timeAgo.setAttribute('class','daysago');
    timeAgo.innerHTML=timeago;
    newob.appendChild(timeAgo);
    
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
        <div class="topribbon"><h5 style="margin:.2em">notes <sup></sup></h5></div>
        <div class="toolsBar" ><input type="text" id="keyinput" placeholder="Search for...">
      <input style="height:auto; margin: 0%;" value="Search" type="button" class="button-primary"  onclick="showResult('../gcow.php?q='+$id('keyinput').value);"/>
<!--<input onchange="datesearch(this);" id="datepicker" type="text" placeholder="01/01/2015">-->
        </div>
<script>
        $id('keyinput').addEventListener('keyup',function(e){if(e.keyCode==13){showResult('../gcow.php?q='+$id('keyinput').value);}});

    </script>
    <div class="spinner" id="spinner"></div>
        <div id="frameplace" class="login" align="center" ><h5 style="opacity: .5; text-align: right;"></h5>
</div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.3.min.js"><\/script>')</script>
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>
        <div class="footer"><p><a href="../paper.php">Desktop</a> | <a href="home.php">Write Note</a> | <a href="logout.php">Logout</a></p></div>
 <script>
          /*  $(function() {
    $( "#datepicker" ).datepicker(
    		{
    	dateFormat: "dd-mm-yy"		
});
  });*/
  var frmOb = $id('frameplace').getBoundingClientRect();
  console.log(frmOb.bottom);
  console.log(window.innerHeight);
    var thing = moment();
datesearch(thing.format('DD-M-YYYY'),true);
var currentDate = thing.format('DD-M-YYYY');

//Code for swipe
 var x = 0,xx=0;
            var y =0,yy=0;
            var t = 0,tt=0;
               var Dscroll=100;
                                                var Uscroll=100;
        document.getElementById('frameplace').addEventListener('touchstart',function(e)
    {
        var ob = e.changedTouches[0];
        x = ob.pageX;
        y = ob.pageY;
        t = new Date().getTime();
    });
     document.getElementById('frameplace').addEventListener('touchend',function(e)
    {
        tt = new Date().getTime();
        var ob = e.changedTouches[0];
        xx = ob.pageX;
        yy = ob.pageY;
                 var abs_x = Math.abs(xx-x);
                 var abs_y = Math.abs(yy-y);
        if((Math.abs(tt-t)<500)&&abs_x>abs_y+50)
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
      
            
    });
            </script>
    </body>
</html>
