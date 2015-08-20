<?php
$string="This is the, https://note-runfree.rhcloud.com";
$pattern="@((https?://)?([-\\w]+\\.[-\\w\\.]+)+\\w(:\\d+)?(/([-\\w/_\\.]*(\\?\\S+)?)?)*)@";
$urls= preg_match_all($pattern, $string);
if(is_array($urls))
{
    echo "Yup";
}
foreach ($urls as $e)
{
    echo $e."<br>";
}
?>
