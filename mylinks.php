<html>
<head>
    <script src="ajax_1_10_2.js"></script>
<title>You Have to Bring It Back</title>
<style>
    .each
    {
position:relative;
        float: bottom;
        margin-top: : 1%;
        color:#ff0;
        background:#0f0;
        margin-top:1%;
        
    }
    </style>
<script>
    
    </script>
</head>
<body onload="fetch(10,0);">
    <div id="container">
<script>
    function fetch(count,offset)
    {
        $.get('links.php?limit='+count+','+offset,function(data,success)
    {
        console.log(data);
        var json=JSON.parse(data);
        var count=0;
        while(typeof(json[count].id))
            {
        var div = document.createElement('div');
document.getElementById('container').appendChild(div).setAttribute('class',"each");
document.getElementById('container').appendChild(div).setAttribute('id',count);

        document.getElementById(count).innerHTML=json[count].url;
        count++;
            }
    });
    }
    </script>
    </div>
</body>
</html>