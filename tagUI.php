<?php
$iid = $_GET['iid'];
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script src="notey.js"></script>
        <title></title>
        <style>
            #container
            {
background: rgb(205, 232, 245);
                width: 100%;
            }
            #container div
            {
                float: left;
            }
           #container #imgSpace
            {
                width: 50%;
                overflow: scroll;
background: rgba(216, 214, 224, 0.59);                overflow-y: scroll;


            }
            #options
            {
background: rgba(158, 158, 158, 0.31);                                               width: 50%;
                                               font-family: Arial,serif;

            }
            ul
            {
                               list-style-type: none;

            }
            ul li
            {
   margin: 5px;
background: rgba(75, 82, 145, 0.13);
color: darkblue;
border-radius: 5px;
padding: 8px;
box-shadow: 0px 0px 1px #092002;
            }
            ul li span
            {
                margin-right: 1%;
                right: 1%;
                font-size: 10px;
                color:red;
                position: absolute;
                cursor: pointer;
            }
                  ul li select
            {
  font-size: 15px;
background: rgba(169, 169, 178, 0.99);  
width: 100%;
            }
            </style>
    </head>
    <body>
<div id="container">
        <div id="imgSpace">
    <img src="image.php?id=<?php echo $iid; ?>&resize&factor=50"/>
</div>
    <div id="options">
        <ul id="growList">
            <li><select id="selPerson"></select></li>
        </ul>
    </div>
</div>
    </body>
    <script>
        var pList=new Array();
                var ind=0;        

        notey.get('personList.php',function (data)
            {
                var json = JSON.parse(data.responseText);
                var counter = 0; var attachString='<option value="0">Nobody</option>';
                while(typeof(json[counter])!='undefined')
                    {
                        attachString+='<option id='+json[counter].id+' value = '+json[counter].id+'>'+json[counter].name+'</option>';
                        counter++;
                    }
                    document.getElementById('selPerson').innerHTML=attachString;
                    
                    //Already added people list fetching
                    notey.get('tagEmbed.php?retrieve&iid=<?php echo $iid;?>',function(data)
                {
        var data = JSON.parse(data.responseText);
        var count = 0;       
while(data[count]!=null)
    {
  creatChild(data[count].name,data[count].id);    
  count++;
    }
                });
            });
             document.getElementById('selPerson').addEventListener('change',function(e){
 
                 var id = document.getElementById('selPerson').value;
                 var content = document.getElementById(id).innerHTML;
                 creatChild(content,id);
                                 saveList();

             },false);
             function saveList()
             {
                var li = pList.toString();
                notey.post('tagEmbed.php?iid=<?php echo $iid; ?>',{list:li},function(data){
                  // alert(data.responseText); 
                });
             }
             function creatChild(data,id)
             {
                var ele=document.createElement('li');
                 document.getElementById('growList').appendChild(ele);
                 ele.setAttribute('id','person_id'+id);
                 ele.innerHTML= data+'<span class="personOptions" title="Remove this tag" onclick= "removeTag(this)" data-name='+data+' data-id='+id+'>Remove tag</span>';
                pList.push(id);
                removeChild(id);

             }
             function removeChild(id)
             {
                 var ind=0;
                 while(typeof(document.getElementById('selPerson').getElementsByTagName('option')[ind])!=='undefined')
            {
          if(document.getElementsByTagName('option')[ind].id==id)
              {
                  document.getElementById('selPerson').getElementsByTagName('option')[ind].remove();
            }
                        ind++;

             }
             }
             function removeTag(ob)
             {
                 var id = ob.dataset.id;
                 var name = ob.dataset.name;
                 document.getElementById('person_id'+id).remove();
                 var opt = document.createElement('option');
                 document.getElementById('selPerson').appendChild(opt);
                 opt.innerHTML=name;
                 opt.setAttribute('value',id);
                 opt.setAttribute('id',id);
                 var len = pList.length;
        var trav = 0;         
        while(pList[trav]!=null)
            {
                if(pList[trav]==id)
                    {
                       pList[trav]=0;
            }                trav++;
}
saveList();
             }
             
             
             
             
                    </script>
</html>
