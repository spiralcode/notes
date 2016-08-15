<?php
include('session_check.php');
include('connect.php');
include('ease.php');


$bigstring=' ';
if(isset($_GET['noteid']))
{
    $noteid=$_GET['noteid'];
    $query=mysqli_query($link,"select content from events where userid = $userid and id = $noteid")or die(mysqli_error($link));
}
else
{
    $query=mysqli_query($link,"select content from events where userid = $userid")or die(mysqli_error($link));
}
error_reporting(E_ERROR | E_PARSE);
/*
Big Binder
*/


while($row=mysqli_fetch_array($query))
{
    $bigstring=$row['content'].' '.$bigstring;
}
$ad = wordsout($bigstring);

isword($ad);
function wordsout($sample)
{
$wordcase=array();
$word_index=$index=0;
$sample_l = strlen($sample);
for($i=0;$i<$sample_l;$i++)
{
    if(preg_match('/[a-z]|[A-Z]/', $sample[$i]))
    {
    $index = $i;
    while($index<strlen($sample)&&preg_match('/[a-z]|[A-Z]/', $sample[$index]))
    {
     $wordcase[$word_index]=$wordcase[$word_index].$sample[$index]; 
        $i=$index;
        $index++;
        if(!isset($sample[$index]))
        {
                break;
        }
    }
}
 if(!preg_match('/[a-z]|[A-Z]/', $sample[$i])){
    $word_index++;
    }
    }
   return $wordcase;
}

function isword($wordlist)
{
 $conn=globe('conn');
  $userid=globe('userid');
$wi=0;
$nw=0;
$dic_matches=array();
$notWords=array();
    foreach($wordlist as $word)
    {

    $qry="select * from entries where word like '$word'";
    $run = mysqli_query($conn, $qry) or die(mysqli_error($conn));
    if(mysqli_num_rows($run)>0)
    {
        $dic_matches[$wi++]=$word;
    }
    elseif(strlen($word)>1)
    {
        $word = strtolower($word);
        $query = mysqli_query($conn,"select name from peoples where userid = '$userid' and name = '$word' ") or die(mysqli_error($link));
        if(mysqli_num_rows($query)<1)
        $notWords[$nw++]=$word;
    }
    }
    
    json_output($dic_matches,$notWords);
}
function json_output($dicwords,$nondic)
{
$moment=json_encode(array_values(array_unique($nondic)));
echo $moment;

}