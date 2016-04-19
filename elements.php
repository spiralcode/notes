<?php 
function mimeType($filename)
{
    $part = explode(".",$filename);
    $ext = $part[sizeof($part)-1];
    if($ext=='mp3')
    return "audio/mpeg";
    elseif($ext=="mp4")
    return "video/mp4";
    elseif($ext=="mp4a")
    return "audio/mp4";
        elseif($ext=="html")
    return "text/html";
            elseif($ext=="pdf")
    return "application/pdf";
             elseif($ext=="png")
    return "image/png";
             elseif($ext=="jpeg")
    return "image/jpeg";
            elseif($ext=="jpg")
    return "image/jpg";
             elseif($ext=="gif")
    return "image/gif";
      elseif($ext=="3gp")
    return "video/3gpp";
    else
    return "text/plain";
}
?>