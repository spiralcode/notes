<?php
error_reporting(E_ERROR | E_PARSE);
function strip_html_tags( $text )
{
	// PHP's strip_tags() function will remove tags, but it
	// doesn't remove scripts, styles, and other unwanted
	// invisible text between tags.  Also, as a prelude to
	// tokenizing the text, we need to insure that when
	// block-level tags (such as <p> or <div>) are removed,
	// neighboring words aren't joined.
	$text = preg_replace(
		array(
			// Remove invisible content
			'@<head[^>]*?>.*?</head>@siu',
			'@<style[^>]*?>.*?</style>@siu',
			'@<script[^>]*?.*?</script>@siu',
			'@<object[^>]*?.*?</object>@siu',
			'@<embed[^>]*?.*?</embed>@siu',
			'@<applet[^>]*?.*?</applet>@siu',
			'@<noframes[^>]*?.*?</noframes>@siu',
			'@<noscript[^>]*?.*?</noscript>@siu',
			'@<noembed[^>]*?.*?</noembed>@siu',

			// Add line breaks before & after blocks
			'@<((br)|(hr))@iu',
			'@</?((address)|(blockquote)|(center)|(del))@iu',
			'@</?((div)|(h[1-9])|(ins)|(isindex)|(p)|(pre))@iu',
			'@</?((dir)|(dl)|(dt)|(dd)|(li)|(menu)|(ol)|(ul))@iu',
			'@</?((table)|(th)|(td)|(caption))@iu',
			'@</?((form)|(button)|(fieldset)|(legend)|(input))@iu',
			'@</?((label)|(select)|(optgroup)|(option)|(textarea))@iu',
			'@</?((frameset)|(frame)|(iframe))@iu',
		),
		array(
			' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ',
			"\n\$0", "\n\$0", "\n\$0", "\n\$0", "\n\$0", "\n\$0",
			"\n\$0", "\n\$0",
		),
		$text );

	// Remove all remaining tags and comments and return.
	return strip_tags( $text );
}

function stripwords($q)
{
$counter=0;
$wlist=array();
$wlist[0]='';
if(strlen($q)!=0)
{
$q=trim(strtolower($q));
for($i=0;$i<strlen($q);$i++)
{
	while(isset($q[$i])!=false&&$q[$i]!=' '&&$i<strlen($q)&&$q[$i]!='\n')
	{
	$wlist[$counter]=$wlist[$counter].$q[$i];
	$i++;
	}
	$counter++;
}
}
return $wlist;
}
function getpagetitle($text,$else)
{
preg_match("/\<title\>(.*)\<\/title\>/",$text,$title);
$ptitle= $title[1];
if($ptitle==''||$ptitle==null)
$ptitle=$else;
return mysql_escape_string($ptitle);
}

function fetchurls($text,$rooturl)
{
$len= strlen($text);
$arrindex=-1;
$urls='';
for($i=0;$i<$len;$i++)
{
	if($text[$i]=='h'&&$text[$i+1]=='r'&&$text[$i+2]=='e'&&$text[$i+3]=='f'&&$text[$i+4]=='='&&$text[$i+5]=='"')
	{
		$arrindex++;
		$start=$i+6;
		while($text[$start]!=' '&&$text[$start]!='\n'&&$start+5<$len&&$text[$start]!='"')
	{
		$urls[$arrindex]=$urls[$arrindex].$text[$start];
		$start++;
	}
	}	
}
universer($rooturl,$urls);
}
?>