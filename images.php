<?php
include 'connect.php';
include 'session_check.php';
$query = mysqli_query($link, "select id,noteid from image where userid = $userid")or die(mysqli_error($link));
?>
<table cellspacing="10">
<tr>
    <?php
    $row_count=0;
    while($row=mysqli_fetch_array($query))
    {
        echo "Something";
    }
    ?>
</table>
