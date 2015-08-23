<html>
<head>
    <script src="ajax_1_10_2.js"></script>
<title>You Have to Bring It Back</title>
<script>
    function fetch(count,offset)
    {
        console.log('s');
        $.get('links.php?limit='+count+','+offset,function(data,success)
    {
       console.log(data); 
    });
    }
    </script>
</head>
<body onload="fetch(0,10);">
 ss
</body>
</html>