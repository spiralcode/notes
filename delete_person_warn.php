<?php
include 'ease.php';
$pid = get('pid');
$name=get('name');
?>
<!DOCTYPE html>
<html>
    <head>
        <script src="notify.js"></script>
<link rel="stylesheet" href="notify.css">
<link rel="stylesheet" href="style.css">

        <script src="ajax_1_10_2.js"></script>
        <style>
            body
            {
                background:none;
            }
        h1
        {
            font-size: 16px;
            
        }
        </style>
<script>
    function $id(ob)
    {
        return document.getElementById(ob);
    }
    function Yesdelete()
    {
        $.post("delete_person.php",{
            pid:<?php echo $pid ?>
        },function(data,success)
        {
            if(data==1)
                {
                    notify('<?php echo $name; ?> is removed from known people list.','happy');
                   window.location.href='peoples.php';

        }
        else
            {
                alert(data);
            }}
    );
    }
    function goBack()
{
	window.location.href='person_info.php?pid=<?php echo $pid; ?>';
}
    </script>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <div align="center">
            <h1>Are you sure ?</h1>
        <p>Do you want to remove <?php echo $name; ?> from your know people list ?</p><br>
        <button onclick="Yesdelete();">Yes I want to</button> <button onclick="goBack()">No, go back</button>
        </div>
<div class="sudden_notify" id = "sudden_notify">Saved</div>

    </body>
</html>
