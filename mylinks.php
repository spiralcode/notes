<html>
<head>
    <script src="ajax_1_10_2.js"></script>
      <script src="lib/jquery-ui.js"></script>

<title>You Have to Bring It Back</title>
<style>
    .each
    {
position:relative;
        margin-top:  1%;
        color:#ff0;
background-image: url(images/tile.png);
        margin-top:1%;
        min-height :50px;
        overflow-x:auto;
        width:100%;
    }
    .each h1
    {
        color:#485465;
        font-size: 20px;
        text-align: center;
        font-family: arial,serif;
    }
    .each .link
    {
        font-family: arial,serif;
        font-size: 15px;
        
    }
    </style>
<script>
    
    </script>
</head>
<body onload="fetch();">
    <div id="container">
<script>
    var count=10,offset=-10;
     $(window).scroll(function() { 
   if($(window).scrollTop() + $(window).height() != $(document).height()) {
       fetch();
   }
   });
    function fetch()
    {
     offset+=10;   
        $.get('links.php?limit='+count+','+offset,function(data,success)
    {
        var json=JSON.parse(data);
        var count=0;
        console.log(json[count].id);
        while(json[count].id!==null)
            {
        var div = document.createElement('div');
document.getElementById('container').appendChild(div).setAttribute('class',"each");
document.getElementById('container').appendChild(div).setAttribute('id',count);
if(json[count].url.length>30)
{
    var d_url= json[count].url.substr(0,30)+'...';
}
else
    {
        var d_url=json[count].url;
    }
            document.getElementById(count).innerHTML='<h1>This a title</h1><span class="link"><a target="_new" href="'+json[count].url+'">'+d_url+'</a><span>';
        count++;
}

            
    });
    }
    </script>
    </div>
</body>
</html>