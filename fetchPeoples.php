<?php
	include 'session_check.php';
	include 'connect.php';
                $pList = array();
                class item
                {
                    public $name='';
                    public $id=0;
                    function item($id,$name)
                    {
                        $this->id=$id;
                        $this->name=$name;
                    }
                }
                
        if(isset($_GET['q'])&&$_GET['q']!='')
        {
        $q=$_GET['q'];
        	$query=mysqli_query($link,"select * from peoples where userid = $userid and name like '$q%' order by name asc ") or die(mysqli_error($link));
        while($row=mysqli_fetch_array($query))
			{
            $ob = new item($row['id'],  ucfirst($row['name']));
            array_push($pList, $ob);
			}
                        echo json_encode($pList);
        }
        elseif($_GET['relation'])
        {
                    $q=$_GET['relation'];
                    $rootQuery = mysqli_query($link,"select term from relations where grps = '$q' ")or die(mysqli_query($link));
                    while($data=mysqli_fetch_array($rootQuery))
                    {
                 $rel = $data['term']; if($q=='unsorted')
        	$query=mysqli_query($link,"select * from peoples where userid = $userid and (relation like '$rel' or relation like '')  order by name asc ") or die(mysqli_error($link));
                else
                $query=mysqli_query($link,"select * from peoples where userid = $userid and (relation like '$rel')  order by name asc ") or die(mysqli_error($link));
        while($row=mysqli_fetch_array($query))
			{
            $ob = new item($row['id'],  ucfirst($row['name']));
            array_push($pList, $ob);
			}
                    }
                        echo json_encode($pList);
        }
        else
        {
            $pList[0]=0;
            echo json_encode($pList);
        }
?>