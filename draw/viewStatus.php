<?php
include '../connect.php';
?>
<!doctype html>
<html>
<head>
        <meta name="viewport" content="width=device-width, initial-scale=1">

<title>View Status</title>
<script src = "https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js"></script>
<script src = "https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.min.js"></script>
<script src = "https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.js"></script>
<script src = "https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>
<style>
canvas
{
    width:400px;
    height:400px;
}
</style>
</head>
<body>
<?php
$id = $_GET['id'];
$mnthList = array();
$year = $_GET['year'];
$da = mysqli_query($link,"select count(id) as id,month(date) as mnth from view_count where id = $id and year(date)='$year' group by month(date)");
$totView=0;
while($data = mysqli_fetch_array($da))
{
    
    $cnt = $data['id'];
    $totView+=$cnt;
    $mnt = $data['mnth'];
    $mnthList[$mnt]=$cnt;
}
?>
<div style="font-size:1em; font-family:Arial;"><?PHP
echo $_GET['title']."<br><br>";
echo "Total View : ".$totView;
 ?></div>
<div id = "cnt" class="chart-container" style="position: relative; height:500; width:500;">
<script>
var x = window.innerWidth;
var y = window.innerHeight;
document.getElementById('cnt').style.width=400+"px";
document.getElementById('cnt').style.height=400+"px";

</script>
<canvas id="myChart" width="400" height="400"></canvas>
</div>
<script>
var ctx = document.getElementById("myChart").getContext('2d');
var myChart = new Chart(ctx, {
    
    type: 'line',
    data: {
        labels: ["January", "February", "March", "April", "May", "June","July","August","September","October","November","December"],
        datasets: [{
            label: 'Total Views',
            data: [<?php
            for($io=0;$io<12;$io++)
            {
                if(isset($mnthList[$io]))
                {
                    echo $mnthList[$io]."";

                }
                else
                {
                    echo "0";
                }
                echo ",";
            }
            echo ",";
             ?>],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        title: {
            display: true,
            text: 'Statistics of <?php echo $_GET['year']; ?> '
        },
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});/*
var myLineChart = new Chart(ctx, {
    type: 'line',
    data: {
        datasets: [{
            label: '# of Votes',
            data: [12, 19, 3, 5, 2, 3],
            borderWidth: 1
        }]
    },
    options: options
});
*/
</script>
</body>
</html>