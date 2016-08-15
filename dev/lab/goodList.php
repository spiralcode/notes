<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>List Notes</title>
        <style>
            ul
            {
                background: aliceblue;
            }
            ul li
            {
                width: 500px;
               background: cadetblue;
               list-style-type: none;
margin: 1px;
            }
            ul li:focus
            {
                background:yellowgreen;
            }
            </style>
    </head>
    <body>
 <ul id="mainList">
     <li tabindex="1">1 option</li>
          <li tabindex="1">2 option</li>
     <li tabindex="1">3 option</li>
     <li tabindex="1">4 option</li>
     <li tabindex="1">5 option</li>
 </ul>
        <script>
            var sel=0;
            var count=document.getElementById('mainList').childElementCount;
                     document.getElementById('mainList').addEventListener('click',function(e){
                                     document.getElementById('mainList').addEventListener('keydown',function(e){
             if(e.keyCode===40)
                 {
              document.getElementById('mainList').getElementsByTagName('li')[sel++].focus();
            if(sel==(count))      
            { sel= 0; }
                 }
                     if(e.keyCode===38)
                 {
              document.getElementById('mainList').getElementsByTagName('li')[--sel].focus();
            if(sel<=0)      
            { sel= count; }
                 } 
                 }
            ,true);
            },false); 
function swap()
{
            document.getElementById('mainList').getElementsByTagName('li')[0]=document.getElementById('mainList').getElementsByTagName('li')[1];
}
            </script>
            <button onclick="swap();">Check</button>
    </body>
</html>
