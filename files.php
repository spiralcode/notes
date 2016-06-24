<?php
include 'connect.php';
include 'session_check.php';
include 'ease.php';
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
$ob=array();
$counter=0;
if(!isset($_GET['folder']))
$query=  mysqli_query($link, "select * from image where userid = $userid ORDER BY  time DESC ")or die(mysqli_error($link));
else {
    $fold = $_GET['folder'];
$query=  mysqli_query($link, "select * from image where userid = $userid and group_id = $fold ORDER BY  time DESC ")or die(mysqli_error($link));
}
while($data=  mysqli_fetch_array($query))
{
    $id=$data['id'];
    $filename=$data['filename'];
    $file_name=$data['file_name'];
    $folder=$data['group_id'];
    $time= $data['time'];
    
    
    // ICON fetch
    $parts = explode('.',$file_name);
$ext = $parts[sizeof($parts)-1];
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
    $ob[$counter]=new oblink($id, $filename,$file_name,$folder,$time,$iconCode);
$counter++;
}
echo json_encode($ob);
?>
