<?php
//MEASLES
$con=null;
require '../DB_Connect.php';

if(!$con){
    die("Error".mysqli_error($con));
    exit();
}

//INFANT
$babyArr = array();
$number1 = array();
$results1 = array();
$ctr = 0;$cc=1;
while ($cc<8){
    $results1[$ctr] = mysqli_query($con, "SELECT event_id FROM vaccination_record WHERE patient_purok='$cc' AND patient_type='Infant' AND vaccine_name='MMR' group by patient_id");
    $number1[$ctr] = mysqli_num_rows($results1[$ctr]);
    $ctr++;$cc++;
}
$ctr=0;
while ($ctr<7) {
    $babyArr[$ctr] = $number1[$ctr];
    $ctr = $ctr + 1;
}
$babyJson= json_encode($babyArr);$number = array();
$results = array();
$ctr = 0;$cc=1;
$temp = '';
while ($cc<8){
    $results[$ctr] = mysqli_query($con, "SELECT vaccine_id FROM vaccination_record WHERE patient_purok='$cc' AND patient_type='Minor' AND vaccine_name='MMR' group by patient_id");
    $number[$ctr] = mysqli_num_rows($results[$ctr]);
    $ctr++;$cc++;
}
$ctr = 0;
while ($ctr<7) {
    $childArray[$ctr] = $number[$ctr];
    $ctr = $ctr + 1;
}
$minorJson = json_encode($childArray);

$arr = array(65,68,75,81,95,105,130);
$json = json_encode($arr);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!--Jquery-->
    <script src="../../js/jquery-3.6.0.js"></script>
    <!--Jquery UI css and js-->
    <link rel="stylesheet" href="../../jquery-ui/jquery-ui.css">
    <script src="../../jquery-ui/jquery-ui.js"></script>
    <script src="../../js/track2.js"></script>
    <style>
         *{
            font-family: "Poppins", sans-serif;
        }
        #speedChart {
            background-color: rgb(204, 209, 243);

        }
        .tab{
            display: flex;

        }
        .timestamp{
            font-size:1rem;
            margin: 0.7rem 0.7rem 0.7rem 0.7rem;
            padding: 0.5rem 1rem 0.5rem 1rem;
            border-radius:4px;
            background-color: #02a9f7;
            color: white;
            
        }
        .timestamp:hover{
            background-color: #03628f;
            transition: 0.3s ease-out;
            color: #FFFFFF;
            cursor: pointer;
        }
    </style>
</head>
<body>
<!--period to period button-->
<div class="tab">
    <div id="wk4" class="timestamp">Weekly</div>
    <div id="mo4" class="timestamp" >Monthly</div>
    <div id="yr4" class="timestamp" >Yearly</div>
    <div id="ov4" class="timestamp" >Overall</div>
</div>
<!--this is where the linechart goes-->
<div class="container" style="width: 100%; height: 100%">
    <canvas id="speedChart" style="padding: 10px; width: 100%; height: 80vh; background: white; border-radius: 5px; margin-top: 10px;"></canvas>
</div>
<script>
    document.getElementById("ov4").style.color = "#ffffff";
    document.getElementById("ov4").style.backgroundColor = "#363636";
    var speedCanvas = document.getElementById("speedChart");
    speedCanvas.fillStyle = 'lightGreen';
    Chart.defaults.color = "black";
    var mmrInfant = {
        label: "Infant",
        data: <?php  echo $babyJson?>,
        lineTension: 0.1,//curve of line
        fill: false,
        borderWidth: 5,
        borderColor: '#0B84A5',
        pointBackgroundColor: '#0B84A5',
        pointRadius: 7,
        pointBorderWidth: 2,
    };

    var mmrMinor = {
        label: "Minor",
        data: <?php echo $minorJson?>,
        lineTension: 0.1,
        borderWidth: 5,
        fill: false,
        borderColor: '#6F4E7C',
        pointBackgroundColor: '#6F4E7C',
        pointRadius: 7,
        pointBorderWidth: 2,
    };

    var speedData = {
        labels: ["Purok 1", "Purok 2", "Purok 3", "Purok 4", "Purok 5", "Purok 6", "Purok 7"],
        datasets: [mmrInfant,mmrMinor]
    };

    var chartOptions = {
        legend: {
            display: true,
            position: 'top',
            labels: {
                boxWidth: 100,
                fontColor: 'white'
            }
        }
    };

    var mmrlineChart = new Chart(speedCanvas, {
        type: 'line',
        data: speedData,
        options: chartOptions,
        hoverOffset: 3,// delay effect ng hover
        options: {
            scales: {
                x: {
                    grid:{
                        display:false
                    }
                },
                y: {
                    grid:{
                        color: "black"
                        //    display:false
                    }
                }
            },
            plugins: {
                title: {
                    font: {
                        size: 28
                    },
                    display: true,
                    text: 'Measles, Mumps, and Rubella (MMR) Graph'
                },
                legend: {
                    labels: {
                        // This more specific font property overrides the global property
                        font: {
                            size: 18,
                            family: 'Poppins',
                            color: 'black'
                        },
                        boxWidth: 20
                    }
                }
            }
        }
    });
</script>
</body>
</html>