<?php
include 'session_check.php';
include 'connect.php';
error_reporting(E_ERROR | E_PARSE);

$id = $_GET['id'];
$query2=mysqli_query($link, "select * from image where id = $id")or die(mysqli_error($link));
{
	$imindex=0;
while($row=mysqli_fetch_array($query2))
{
$fileid=$row['id'];
$realFileName = $row['file_name'];
$root = $row['filename'];
}
}
$parts = explode('.',$realFileName);
$ext = $parts[sizeof($parts)-1];
$cont = 0;
$iconQ = mysqli_query($conn,"select code from icons where title = '$ext' ");
while($row=mysqli_fetch_array($iconQ))
{
	$iconCode = $row['code'];
	$cont++;
}
if($cont==0)
	$iconCode = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAIAAAACACAYAAADDPmHLAAAEZklEQVR4Xu3csW4UVxjF8bl3EU36gMIbIKUIioMgxhVSlBhRYCiootShd0nLC7jPAyRVDEZpEtmu4nWUBmqKNJHSpAR57mWMKCwLs1777pwzc/+WqLDnfHvOD9sykkPDW9UNhFKv/trX39yaTC5cL/W8Pp+TUzud7j7/o89Ml6xiAJZWVp/EGNddXtg8d+SU3nR/7u/tbv06z8eN4X0B8H7FWhEA4Mg/4xoRAODY5/HaECwUQM75v5yaF05fK0PIN0KMFz92U00IFgqgbfMv053N+04Allbu/BNjuDLrploQAKCT0H2myqF7O46iBgQA6FZPOT3uFPwY4+TT2hAAoFu8bQ8etE3z8kIIv9eGAADvAUx3tn7+4ta3V2tDAIAjAA4//c9CcJDy2l+7zzZnfRM5lL8HwDEAtSEAwAcA1IQAACcAqAUBAD4CoAYEAJgBYOwIAHAKAGNGAIBTAhgrAgDMAWCMCAAwJ4CxIQDAGQCMCQEAzghgLAgAcA4Ap0HQ5ube/s7Tp67/NwCAcwIYOgIAFAAwZAQAKARgqAgAUBDAEBEAoDCAoSEAwAIADAkBABYEYCgIALBAAENAAIAFA3BHAIAeADgjAEBPAGYhSCm/Tjmv9f1jYwD0CMARAQB6BuCGAAACAE4IACAC4IIAAEIADggAIAagRgAAAwBKBADo2k+5fRVS/P9wCOlbbC51v6nm8oduWNTPCQAgXXy+8EUgAMB8G8jf+x2Cpr27v731W4ljAFCixZ6f0SHY2NvefFQiFgAlWuz5GQA4R+FfLn/3MIbmk3M8otcP7X6B4Q/db2G/eTQUAL1OoA37amX1p+5X234PAO0OsnQAyKr3CAaAxw6yKwAgq94jGAAeO8iuAICseo9gAHjsILsCALLqPYIB4LGD7AoAyKr3CAaAxw6yKwAgq94jGAAeO8iuAICseo9gAHjsILsCALLqPYIB4LGD7AoAyKr3CAaAxw6yKwAgq94jGAAeO8iuAICseo9gAHjsILsCALLqPYIB4LGD7AoAyKr3CAaAxw6yKwAgq94jGAAeO8iuAICseo9gAHjsILsCALLqPYIB4LGD7AoAyKr3CAaAxw6yKwAgq94jGAAeO8iuAICseo9gAHjsILsCALLqPYIB4LGD7AoAyKr3CAaAxw6yKwAgq94jGAAeO8iuAICseo9gAHjsILsCALLqPYIB4LGD7AoAyKr3CAaAxw6yKwAgq94jGAAeO8iuAICseo9gAHjsILsCALLqPYIB4LGD7AoAyKr3CAaAxw6yKwAgq94jGAAeO8iuAICseo9gAHjsILsCALLqPYIB4LGD7AoAyKr3CAaAxw6yKwAgq94jGAAeO8iuAICseo9gAHjsILti0ABSSv+GHP6WtTeC4BTy55MYPzv6UlLKG3vbm49KvLxQ4iGHz1haWX0SY1wv9Tyec3IDAKhcBwAAwJeAmg14fgZYXr0dYliueZi+XntqDv6cbj9/ViKv2DeBJY7hGf038Bb9ZUsI4iTHOwAAAABJRU5ErkJggg==";

if($_SERVER['HTTP_HOST']!='localhost')
{
$target_dir="/var/lib/openshift/55a2abe1500446b24a00023d/app-root/data/";	
}   
else
{
$target_dir="media/";	
}
$size=filesize($target_dir.$root);
$img[0]=array("id"=>"$fileid","realFileName"=>"$realFileName","root"=>"$root","size" => "$size","iconDefault"=>"$iconCode");
echo json_encode($img);
?>

