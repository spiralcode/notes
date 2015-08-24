<?php
include 'simple_html_dom.php';
include '../ease.php';
error_reporting(0);

$url=get('url');
$html = file_get_html($url);
foreach($html->find('title') as $element) 
{
    $title=$element->plaintext;
}
foreach($html->find('meta') as $element) 
{
    $stuff=$element->name;
    if($stuff=='og:description')
    {
        $desc_fb=$element->content;
        break;
    }
}
$data=array("title"=>"$title","desc"=>"$desc_fb");
$data_json=  json_encode($data);
echo $data_json;
?>
