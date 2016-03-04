<html>
<head>
    <script src="ajax_1_10_2.js"></script>
      <script src="lib/jquery-ui.js"></script>
<link rel="stylesheet" href="notify.css">

<title>You Have to Bring It Back</title>
<style>
    .each
    {
position:relative;
        margin-top:  1%;
        color:#ff0;
/*background-image: url(images/tile.png);*/
background: rgb(179, 179, 179);
        margin-top:1%;
        min-height :120px;
        overflow-x:auto;
        width:100%;
        cursor:pointer;
        
    }
    .each:hover
    {
        box-shadow: 1px 1px 1px #485465;
    }
    .each h1
    {
        color:#485465;
        font-size: 20px;
        text-align: center;
        font-family: arial,serif;
        text-shadow: 1px 1px 1px white;
        font-size: 15px;
    }
    .each .link
    {
        position: absolute;
        font-family: arial,serif;
        font-size: 12px;
        text-align: center;
        bottom: 0px;
        margin-top: 1%;
                text-shadow: 1px 1px 1px #485465;

    }
    .each p
    {
        font-family: Arial,Serif;
        font-size: 13px;
        text-align: justify;
        margin: 5%;
        color:#fff;
        text-shadow: 1px 1px 1px #485465;
        
    }
    p
    {
            font-family: Arial,Serif;
        font-size: 13px;
        text-align: justify;
        margin: 5%;
        color:#f00;
        text-shadow: 1px 1px 1px #485465;
    }
                body
            {
                background: #fff;
            }

    </style>
<script>
    
    </script>
</head>
<body onload="fetch();">
    <div class="opBar"><center><input placeholder="search for..." type="text" id="q"><input onclick="" type="button" value="search"></center></div>
    <div id="container">
        <div class="spinner" id="spinner"></div>
            <p  style="display:none;" id="nothing">All the URL's or links to pages which you include in a Note appears here.</p>
<script>
    var results=0;
    var count=9,offset=-9;
    var div_count=0;
     $(window).scroll(function() { 
   if($(window).scrollTop() + $(window).height() != $(document).height()) {
       fetch();
   }
   });
    function fetch()
    {
     offset+=9;   
        $.get('links.php?limit='+count+','+offset,function(data,success)
    {
        var json=JSON.parse(data);
        var count=0;
  while(json[count]!=='undefined')
  {results++;
 var div = document.createElement('div');
 div.setAttribute('onclick','goto("'+json[count].url+'")');
  div.setAttribute('title','Click to navigate to, '+json[count].title);

  if(json[count].url.length>30)
{
    var d_url= json[count].url.substr(0,30)+'...';
    }
else
    { 
        var d_url=json[count].url;
    }
var ob=document.getElementById('container').appendChild(div);
ob.setAttribute('class',"each");
ob.setAttribute('id',div_count);
        var title = document.createElement('h1');
        title.setAttribute("id",div_count+"_title");
        ob.appendChild(title);
        var desc = document.createElement('p');
        desc.innerHTML=json[count].description;
                ob.appendChild(desc);

        title.innerHTML=json[count].title;
        var span=document.createElement('span');
         div.appendChild(span).innerHTML='<a target="_new" href="'+json[count].url+'">'+d_url+'</a>';
        div.appendChild(span).setAttribute('class','link');
        div.appendChild(span).setAttribute('id',div_count+'_title');

        count++;
        div_count++;
} 
if(results==0)
    {
        document.getElementById('nothing').style.display='block';
    }
});}
function goto(url) {
  var win = window.open(url, '_blank');
  win.focus();
}

    </script>
    </div>
</body>
</html>