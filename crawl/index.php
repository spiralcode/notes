<?php
include 'simple_html_dom.php';
$url="http://www.theguardian.com/news/datablog/2010/jul/16/data-plural-singular";
$html = file_get_html($url);

foreach($html->find('title') as $element) 
{
    $title=$element->plaintext;
}
$data=array("title"=>"$title");
$data_json=  json_encode($data);
echo $data_json;
?>
