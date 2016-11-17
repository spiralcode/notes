<?php
include '../connect.php';
include '../session_check.php';
class item
{
	var $id=0;
	var $content='';
	var $date='';
    var $only = '';
    var $epoch='';
	public function setvalues($a,$b,$c,$d,$e)
	{
		$this->id=$a;
		$this->content=$b;
		$this->date=$c;	
        $this->only=$d;
        $this->epoch=$e;
	}
};

$result =  array();
$q = mysqli_query($link,"select * from  timeLine where userid = $userid order by epoch ASC")or die(mysqli_error($link));
while($re = mysqli_fetch_array($q))
{
    $it = new item();
    $it->setvalues($re['id'],$re['content'],$re['date'],$re['onlyYear'],$re['epoch']);
    array_push($result,$it);
}
echo json_encode($result);
//var_dump($result);
?>