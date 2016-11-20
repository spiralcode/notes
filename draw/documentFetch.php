<?php
include '../connect.php';
include '../session_check.php';
class item
{
	var $id=0;
	var $content='';
	var $date='';
    var $title = '';

	public function setvalues($a,$b,$c,$d)
	{
		$this->id=$a;
		$this->content=$b;
		$this->date=$c;
        $this->title=$d;	
	}
};
$result =  array();
if($_GET['filter']=="All"||$_GET['filter']=="all")
$q = mysqli_query($link,"select * from  draw where userid = $userid")or die(mysqli_error($link));
else
{
	$filter = $_GET['filter'];
	$q = mysqli_query($link,"select * from  draw where category = '$filter' and  userid = $userid")or die(mysqli_error($link));

}
while($re = mysqli_fetch_array($q))
{
    $it = new item();
    $it->setvalues($re['id'],$re['content'],$re['date'],$re['title']);
    array_push($result,$it);
}
echo json_encode($result);
//var_dump($result);
?>