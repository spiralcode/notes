<?php
include 'session_check.php';
include("connect.php");
include("fun.php");

//Global Variable
$a=array();
$eachnote=array();
$am=0; 
$imgs=array();

$refid=0;
//
class grad
{
	var $id=0;
	var $matches=0;
	var $clue=" ";
	var $fulltext=" ";
	public function setvalues($a,$b,$c,$d)
	{
		$this->id=$a;
		$this->matches=$b;
		$this->clue=$c;	
		$this->fulltext=$d;
		
	}
};

$q = $_GET['q'];
$q=trim($q);
$q=mysql_escape_string($q);
$rarr=stripwords($q);

$query=mysqli_query($link,"select * from events")or die(mysql_error());
while($row=mysqli_fetch_array($query))
{
	$imindex=0;
	$nid=$row['id'];
	$loadimage='';
	$mixedtext = $row['content']." ".$row['ftime'];
	$mixedtext=trim($mixedtext);
seekup($rarr,$mixedtext,$row['id']);
	}
function seekup($words,$full,$id)
{
	$full=strtolower($full);
	global $a,$am,$q,$refid;
	$matches=0;
	$total_words=count($words);
	$clue=" ";
	foreach($words as $item)
	{
		$item=strtolower($item);		
		if(strpos($full,$item)!==false)
		{
		$pos=strpos($full,$item);
		$clue=$clue.substr($full,$pos,20)."<b>...</b>";
		++$matches;
		}
	}
	$word_matches=$matches;
	$matches_per=round(($matches/$total_words)*100);
	if($matches_per>0)
	{
	$a[$am]=new grad();
	$a[$am]->setvalues($id,$word_matches,$clue,$full);
	$am++;
	}
}
$temp=new grad();
for($var=0;$var<$am-1;$var++)
{
for($d=$var+1;$d<$am;$d++)
	if(($a[$d]->matches)>($a[$var]->matches))
	{
		$temp=$a[$var];
		$a[$var]=$a[$d];
		$a[$d]=$temp;		
	}
}

$limit=0;
$noteindex=0;
for($u=0;$u<$am;$u++)
{
$limit++;
$match=$a[$u]->matches;
$id=$a[$u]->id;
$ftext=$a[$u]->fulltext;
$eachnote[$noteindex++]=$id;
}

///GCOW TASK DONE

$noteitem=array();
$imgs=array();
$index=0;
foreach($eachnote as $nid)
{
$query=mysqli_query($link,"select * from events where id = $nid" )or die(mysqli_error($link));
if(mysqli_num_rows($query)==0)
{
	$status=0;
	$eachnote[0]=array("status"=>"0");
}
else
{
}
//Note Feeding stuffs begin here....


while($data=mysqli_fetch_array($query))
{
	$status=1;

	$imindex=0;
	$nid=$data['id'];
	$loadimage='';
	$query2=mysqli_query($link, "select id from image where noteid = $nid and userid = $userid")or die(mysqli_error($link));
	{
		while($row=mysqli_fetch_array($query2))
		{
			$fileid=$row['id'];
			$imgs[$imindex++]=$fileid;
		}
	}
	$content=$data['content'];
	$time=$data['time'];
	$geo=$data['setglocation'];
	$ftime=$data['ftime'];
	$ilist=$loadimage;
	$noteitem[$index++]=array("status"=>"$status","content"=>"$content","time"=>"$time","geo"=>"$geo","ilist"=>array($imgs),"ftime"=>"$ftime");
	$imindex=0;
	$imgs='';
}
}
if($index!=0)
$json=json_encode($noteitem);
else 
{
	$noteitem[0]=array("status"=>"0");
}	
$json=json_encode($noteitem);

echo($json);


?>
