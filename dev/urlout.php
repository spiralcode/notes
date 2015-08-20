
<?php

$string="This is the URL, http://www.google.com/pioneer.php";
function getUrls($string) {
 $regex = '/https?\:\/\/[^\" ]+/i';
 preg_match_all($regex, $string, $matches);
 return ($matches[0]);
}
 
$urls = getUrls($string);
 
foreach ($urls as $a)
{
    echo $a."<br>";
}
?>