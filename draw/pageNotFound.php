<?php
//include '../session_check.php';
include '../connect.php';
session_start();

?>
<html>
<head>
  <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
          <link rel="stylesheet" href="notesGen.css">
          <title>Page not found !</title>
<style>
#docShow
{
    text-align:center;
}
</style>

  </head>
  <body>
    <div id="docShow">
<img src = "tornPage.png"/> <div style="margin:1em; font-size: 1.5em;">The page you requested doesn't exist.</div>
<div style="margin:1em; font-size: 1em;">Either the page is <span style="color:red;">removed</span> or you might have enterd a <span style="color:red;">wrong URL</span>, make sure its right.</div> 
</span>
</div>
</div>
  </body>
  </html>