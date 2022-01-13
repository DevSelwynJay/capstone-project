<?php
//trial palang wala pa to
$con=null;
require '../DB_Connect.php';

if(!$con){
    die("Error".mysqli_error($con));
    exit();
}

//minor
$childArray = array();
$number = array();
$results = array();
$ctr = 0;$cc=1;
$temp = '';
while ($cc<8){
    $results[$ctr] = mysqli_query($con, "SELECT event_id FROM vaccination_record WHERE patient_purok='$cc' AND patient_type='Minor'
                                            AND vaccine_sub_category LIKE '%Covid%' group by patient_id");
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
                                            AND vaccine_sub_category LIKE '%Covid%' group by patient_id");
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
                                            AND vaccine_sub_category LIKE '%Covid%' group by patient_id");
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
                                            AND vaccine_sub_category LIKE '%Covid%' group by patient_id");
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
                                            AND vaccine_sub_category LIKE '%Covid%' group by patient_id");
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
    <div id="wk5" class="timestamp">Weekly</div>
    <div id="mo5" class="timestamp" >Monthly</div>
    <div id="yr5" class="timestamp" >Yearly</div>
    <div id="ov5" class="timestamp" >Overall</div>
</div>
<!--this is where the linechart goes-->
<div class="container" style="width: 100%; height: 100%">
    <canvas id="speedChart" style="padding: 10px; width: 100%; height: 80vh; background: white; border-radius: 5px; margin-top: 10px;"></canvas>
</div>
<script>
    document.getElementById("ov5").style.color = "#ffffff";
    document.getElementById("ov5").style.backgroundColor = "#363636";
    var speedCanvas = document.getElementById("speedChart");
    speedCanvas.fillStyle = 'lightGreen';
    Chart.defaults.color = "black";

    var covminor = {
        label: "Minor",
        data: <?php echo $minorJson; ?>,
        lineTension: 0.1,
        borderWidth: 5,
        fill: false,
        borderColor: '#6F4E7C',
        pointBackgroundColor: '#6F4E7C',
        pointRadius: 7,
        pointBorderWidth: 2,
    };

    var covadult = {
        label: "Adult",
        data: <?php  echo $adultJson?>,
        lineTension: 0.1,
        fill: false,
        borderWidth: 5,
        borderColor: '#F6C85F',
        pointBackgroundColor: '#F6C85F',
        pointRadius: 7,
        pointBorderWidth: 2,
    };
    var covsenior = {
        label: "Senior",
        data: <?php echo $senJson?>,
        lineTension: 0.1,
        fill: false,
        borderWidth: 5,
        borderColor: '#9DD866',
        pointBackgroundColor: '#9DD866',
        pointRadius: 7,
        pointBorderWidth: 2,
    };
    var covpwd = {
        label: "PWD",
        data: <?php echo $pwdJson?>,
        lineTension: 0.1,
        fill: false,
        borderWidth: 5,
        borderColor: '#CA472F',
        pointBackgroundColor: '#CA472F',
        pointRadius: 7,
        pointBorderWidth: 2,
    };
    var covpregnant = {
        label: "Pregnant",
        data: <?php echo $pregJson?>,
        lineTension: 0.1,
        fill: false,
        borderWidth: 5,
        borderColor: '#FFA056',
        pointBackgroundColor: '#FFA056',
        pointRadius: 7,
        pointBorderWidth: 2,
    };

    var speedData = {
        labels: ["Purok 1", "Purok 2", "Purok 3", "Purok 4", "Purok 5", "Purok 6", "Purok 7"],
        datasets: [covminor,covadult,covsenior,covpwd,covpregnant]
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

    var covlineChart = new Chart(speedCanvas, {
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
                    text: 'Covid-19 Vaccine Graph'
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