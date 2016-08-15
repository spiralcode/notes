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
	var $clue=0;
	var $fulltext=" ";
	public function setvalues($a,$b,$c,$d)
	{
		$this->id=$a;
		$this->matches=$b;
		$this->clue=$c;	
		$this->fulltext=$d;
		
	}
};

class oblink
{
            function oblink($id,$filename,$file_name,$folder,$time,$iconDefault)
    {
        $this->id=$id;
        $this->filename=$filename;
        $this->file_name=$file_name;
        $this->folder=$folder;
        $this->time=$time;
        $this->iconDefault=$iconDefault;
    }
};

$q = $_GET['q'];
$q=trim($q);
$q=mysql_escape_string($q);
$rarr=stripwords($q);

$query=mysqli_query($link,"select * from image where userid = $userid")or die(mysqli_error($conn));
while($row=mysqli_fetch_array($query))
{
	$imindex=0;
	$nid=$row['id'];
	$loadimage='';
	$mixedtext = $row['file_name'];
	$mixedtext=trim($mixedtext);
seekup($rarr,$mixedtext,$row['id']);
	}
//Function that searches for matches and feed that to the grad class
function seekup($words,$full,$id)
{
	$full=strtolower($full);
	global $a,$am,$q,$refid;
	$matches=0;
	$total_words=count($words);
	$clue=" ";
        $posIndex=0;
	foreach($words as $item)
	{
		$item=strtolower($item);	
		if(strpos($full,$item)!==false)
		{
		$pos=strpos($full,$item);
		//$clue=$clue.substr($full,$pos,20);
		$posIndex=$pos; 
         ++$matches;
		}
	}
	$word_matches=$matches;
	$matches_per=round(($matches/$total_words)*100);
		$matches_per=round(($matches));
	if($matches_per>0)
	{
	$a[$am]=new grad();
	$a[$am]->setvalues($id,$word_matches,$posIndex,$full);
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
$clue=$a[$u]->clue;
$eachnote[$noteindex++]=$id;
}

///GCOW TASK DONE

$index=0;
$ob=array();
$counter=0;
foreach($eachnote as $nid)
{
$query1=mysqli_query($link,"select * from image where id = $nid" )or die(mysqli_error($link));
if(mysqli_num_rows($query1)==0)
{
	$status=0;
	$eachnote[0]=array("status"=>"0");
}

while($data=mysqli_fetch_array($query1))
{
	 $parts = explode('.',$data['file_name']);
$ext = $parts[sizeof($parts)-1];
	//Icon fetch
	$cont = 0;
$iconQ = mysqli_query($conn,"select code from icons where title = '$ext' ") or die(mysqli_error($conn));
while($row=mysqli_fetch_array($iconQ))
{
	$iconCode = $row['code'];
	$cont++;
}
if($cont==0){
	$iconCode = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAIAAAACACAYAAADDPmHLAAAEZklEQVR4Xu3csW4UVxjF8bl3EU36gMIbIKUIioMgxhVSlBhRYCiootShd0nLC7jPAyRVDEZpEtmu4nWUBmqKNJHSpAR57mWMKCwLs1777pwzc/+WqLDnfHvOD9sykkPDW9UNhFKv/trX39yaTC5cL/W8Pp+TUzud7j7/o89Ml6xiAJZWVp/EGNddXtg8d+SU3nR/7u/tbv06z8eN4X0B8H7FWhEA4Mg/4xoRAODY5/HaECwUQM75v5yaF05fK0PIN0KMFz92U00IFgqgbfMv053N+04Allbu/BNjuDLrploQAKCT0H2myqF7O46iBgQA6FZPOT3uFPwY4+TT2hAAoFu8bQ8etE3z8kIIv9eGAADvAUx3tn7+4ta3V2tDAIAjAA4//c9CcJDy2l+7zzZnfRM5lL8HwDEAtSEAwAcA1IQAACcAqAUBAD4CoAYEAJgBYOwIAHAKAGNGAIBTAhgrAgDMAWCMCAAwJ4CxIQDAGQCMCQEAzghgLAgAcA4Ap0HQ5ube/s7Tp67/NwCAcwIYOgIAFAAwZAQAKARgqAgAUBDAEBEAoDCAoSEAwAIADAkBABYEYCgIALBAAENAAIAFA3BHAIAeADgjAEBPAGYhSCm/Tjmv9f1jYwD0CMARAQB6BuCGAAACAE4IACAC4IIAAEIADggAIAagRgAAAwBKBADo2k+5fRVS/P9wCOlbbC51v6nm8oduWNTPCQAgXXy+8EUgAMB8G8jf+x2Cpr27v731W4ljAFCixZ6f0SHY2NvefFQiFgAlWuz5GQA4R+FfLn/3MIbmk3M8otcP7X6B4Q/db2G/eTQUAL1OoA37amX1p+5X234PAO0OsnQAyKr3CAaAxw6yKwAgq94jGAAeO8iuAICseo9gAHjsILsCALLqPYIB4LGD7AoAyKr3CAaAxw6yKwAgq94jGAAeO8iuAICseo9gAHjsILsCALLqPYIB4LGD7AoAyKr3CAaAxw6yKwAgq94jGAAeO8iuAICseo9gAHjsILsCALLqPYIB4LGD7AoAyKr3CAaAxw6yKwAgq94jGAAeO8iuAICseo9gAHjsILsCALLqPYIB4LGD7AoAyKr3CAaAxw6yKwAgq94jGAAeO8iuAICseo9gAHjsILsCALLqPYIB4LGD7AoAyKr3CAaAxw6yKwAgq94jGAAeO8iuAICseo9gAHjsILsCALLqPYIB4LGD7AoAyKr3CAaAxw6yKwAgq94jGAAeO8iuAICseo9gAHjsILsCALLqPYIB4LGD7AoAyKr3CAaAxw6yKwAgq94jGAAeO8iuAICseo9gAHjsILsCALLqPYIB4LGD7AoAyKr3CAaAxw6yKwAgq94jGAAeO8iuAICseo9gAHjsILti0ABSSv+GHP6WtTeC4BTy55MYPzv6UlLKG3vbm49KvLxQ4iGHz1haWX0SY1wv9Tyec3IDAKhcBwAAwJeAmg14fgZYXr0dYliueZi+XntqDv6cbj9/ViKv2DeBJY7hGf038Bb9ZUsI4iTHOwAAAABJRU5ErkJggg==";
}
else
{
    $cont=0;
}
	
	    $ob[$counter]=new oblink($data['id'], $data['filename'],$data['file_name'],$data['group_id'],$data['time'],$iconCode);
		$counter++;
}
}
echo json_encode($ob);

?>