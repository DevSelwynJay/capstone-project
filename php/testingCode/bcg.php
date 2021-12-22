<?php
//trial palang wala pa to
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
    $results1[$ctr] = mysqli_query($con, "SELECT event_id FROM vaccination_record WHERE patient_purok='$cc' AND patient_type='Infant' AND vaccine_name='BCG' ");
    $number1[$ctr] = mysqli_num_rows($results1[$ctr]);
    $ctr++;$cc++;
}

$ctr=0;
while ($ctr<7) {
    $babyArr[$ctr] = $number1[$ctr];
    $ctr = $ctr + 1;
}
$babyJson= json_encode($babyArr);

//minor
$childArray = array();
$number = array();
$results = array();
$ctr = 0;$cc=1;
$temp = '';
while ($cc<8){
    $results[$ctr] = mysqli_query($con, "SELECT event_id FROM vaccination_record WHERE patient_purok='$cc' AND patient_type='Minor'
                                            AND vaccine_name='BCG' ");
    $number[$ctr] = mysqli_num_rows($results[$ctr]);
    $ctr++;$cc++;
}

$ctr=0;
while ($ctr<7) {
    $childArray[$ctr] = $number[$ctr];
    $ctr = $ctr + 1;
}
$minorJson= json_encode($childArray);

//ADULT
$adultArr = array();
$number2 = array();
$results2 = array();
$ctr = 0;$cc=1;
while ($cc<8){
    $results2[$ctr] = mysqli_query($con, "SELECT event_id FROM vaccination_record WHERE patient_purok='$cc' AND patient_type='Adult'
                                            AND vaccine_name='BCG' ");
    $number2[$ctr] = mysqli_num_rows($results2[$ctr]);
    $ctr++;$cc++;
}
$ctr=0;
while ($ctr<7) {
    $adultArr[$ctr] = $number2[$ctr];
    $ctr = $ctr + 1;
}
$adultJson= json_encode($adultArr);

//SENIOR
$senArr = array();
$number3 = array();
$results3 = array();
$ctr = 0;$cc=1;
while ($cc<8){
    $results3[$ctr] = mysqli_query($con, "SELECT event_id FROM vaccination_record WHERE patient_purok='$cc' AND patient_type='Senior'
                                            AND vaccine_name='BCG' ");
    $number3[$ctr] = mysqli_num_rows($results3[$ctr]);
    $ctr++;$cc++;
}
$ctr=0;
while ($ctr<7) {
    $senArr[$ctr] = $number3[$ctr];
    $ctr = $ctr + 1;
}
$senJson= json_encode($senArr);

//PWD
$pwdArr = array();
$number4 = array();
$results4 = array();
$ctr = 0;$cc=1;
while ($cc<8){
    $results4[$ctr] = mysqli_query($con, "SELECT event_id FROM vaccination_record WHERE patient_purok='$cc' AND patient_type='PWD'
                                            AND vaccine_name='BCG' ");
    $number4[$ctr] = mysqli_num_rows($results4[$ctr]);
    $ctr++;$cc++;
}
$ctr=0;
while ($ctr<7) {
    $pwdArr[$ctr] = $number4[$ctr];
    $ctr = $ctr + 1;
}
$pwdJson= json_encode($pwdArr);

//PREGNANT
$pregArr = array();
$number5 = array();
$results5 = array();
$ctr = 0;$cc=1;
while ($cc<8){
    $results5[$ctr] = mysqli_query($con, "SELECT event_id FROM vaccination_record WHERE patient_purok='$cc' AND patient_type='Pregnant'
                                            AND vaccine_name='BCG' ");
    $number5[$ctr] = mysqli_num_rows($results5[$ctr]);
    $ctr++;$cc++;
}
$ctr=0;
while ($ctr<7) {
    $pregArr[$ctr] = $number5[$ctr];
    $ctr = $ctr + 1;
}
$pregJson= json_encode($pregArr);

$arr = array(65,68,75,81,95,105,130);
$json = json_encode($arr);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        #speedChart {
            background-color: rgb(204, 209, 243);
        }
        .tab {
            overflow: hidden;
            border: 1px solid #ccc;
            background-color: #f1f1f1;
        }

        /* Style the buttons inside the tab */
        .tab button {
            background-color: inherit;
            float: left;
            border: none;
            outline: none;
            cursor: pointer;
            padding: 14px 16px;
            transition: 0.3s;
            font-size: 17px;
        }

        /* Change background color of buttons on hover */
        .tab button:hover {
            background-color: #ddd;
        }

    </style>
</head>
<body>

<div class="container" style="width: 100%; height: 100%">
    <canvas id="speedChart" style="width: 100%; height: 65vh; background: #222; border: 1px solid #555652; margin-top: 10px;"></canvas>
</div>
<script>

    var speedCanvas = document.getElementById("speedChart");
    speedCanvas.fillStyle = 'lightGreen';
    Chart.defaults.color = "#ffffff";
    var infant = {
        label: "Infant",
        data: <?php  echo $babyJson?>,
        lineTension: 0.1,//curve of line
        fill: false,
        borderWidth: 1,
        borderColor: 'red'
    };

    var minor = {
        label: "Minor",
        data: <?php echo $minorJson; ?>,
        lineTension: 0.1,
        borderWidth: 1,
        fill: false,
        borderColor: 'lightGreen'
    };

    var adult = {
        label: "Adult",
        data: <?php  echo $adultJson?>,
        lineTension: 0.1,
        fill: false,
        borderWidth: 1,
        borderColor: 'yellow'
    };
    var senior = {
        label: "Senior",
        data: <?php echo $senJson?>,
        lineTension: 0.1,
        fill: false,
        borderWidth: 1,
        borderColor: 'lightBlue'
    };
    var pwd = {
        label: "PWD",
        data: <?php echo $pwdJson?>,
        lineTension: 0.1,
        fill: false,
        borderWidth: 1,
        borderColor: 'white'
    };
    var pregnant = {
        label: "Pregnant",
        data: <?php echo $pregJson?>,
        lineTension: 0.1,
        fill: false,
        borderWidth: 1,
        borderColor: 'pink'
    };

    var speedData = {
        labels: ["Purok 1", "Purok 2", "Purok 3", "Purok 4", "Purok 5", "Purok 6", "Purok 7"],
        datasets: [infant,minor,adult,senior,pwd,pregnant]
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

    var lineChart = new Chart(speedCanvas, {
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
                        color: "gray"
                        //    display:false
                    }
                }
            },
            plugins: {
                title: {
                    font: {
                        size: 18
                    },
                    display: true,
                    text: 'BCG Graph'
                },
                legend: {
                    labels: {
                        // This more specific font property overrides the global property
                        font: {
                            size: 14,
                            family: 'Helvetica Neue',
                            color: 'black'
                        }
                    }
                }
            }
        }
    });
</script>
</body>
</html>