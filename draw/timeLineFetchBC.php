<?php
include '../connect.php';
include '../session_check.php';
class item
{
	var $id=0;
	var $content='';
	var $fY='';
    var $tY = '';
	public function setvalues($a,$b,$c,$d)
	{
		$this->id=$a;
		$this->content=$b;
		$this->fY=$c;	
        $this->tY=$d;
        //$this->tY=$e;
	}
};

$result =  array();
$q = mysqli_query($link,"select * from  timeLineBC where userid = $userid order by frm DESC")or die(mysqli_error($link));
while($re = mysqli_fetch_array($q))
{
    $it = new item();
    $it->setvalues($re['id'],$re['content'],$re['frm'],$re['till']);
    array_push($result,$it);
}
echo json_encode($result);
//var_dump($result);
?>