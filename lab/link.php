<?php
/*** example usage ***/
$string="There are two links in this string one is this http://www.phpro.org and other is this https://google.com";
echo makelink( $string )."\n";

$string = "http://phpro.org";
echo makelink( $string )."\n";

// this is not a valid URL
$string = "www.phpro.org";
echo makelink( $string )."\n";

/**
*
* Function to make URLs into links
*
* @param string The url string
* @return string
*
**/
function makeLink($string){

/*** make sure there is an http:// on all URLs ***/
$string = preg_replace("/([^\w\/])(www\.[a-z0-9\-]+\.[a-z0-9\-]+)/i", "$1http://$2",$string);
/*** make all URLs links ***/
$string = preg_replace("/([\w]+:\/\/[\w-?&;#~=\.\/\@]+[\w\/])/i","<a target=\"_blank\" href=\"$1\">$1</a>",$string);
/*** make all emails hot links ***/
$string = preg_replace("/([\w-?&;#~=\.\/]+\@(\[?)[a-zA-Z0-9\-\.]+\.([a-zA-Z]{2,3}|[0-9]{1,3})(\]?))/i","<a href=\"mailto:$1\">$1</a>",$string);

return $string;
}

?>