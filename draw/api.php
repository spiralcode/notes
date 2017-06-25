<?php
include '../connect.php';
$task = $_GET['task'];
if($task=='alldocs')
{
    class grad
{
	var $id=0;
	var $title=" ";
	public function setvalues($a,$b)
	{
		$this->id=$a;
		$this->title=$b;
	}
};
    $result = array();
    $q = mysqli_query($link,"select * from draw order by title ASC") or die(mysqli_error());
    while($datum = mysqli_fetch_array($q))
    {
        $ddd = new grad();
        $ddd->setvalues($datum['id'],$datum['title']);
        array_push($result,$ddd);
    }
    echo json_encode($result);
}
?>