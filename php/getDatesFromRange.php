<?php
session_start();
$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];
$interval_days = $_POST['interval_days'];
/**
 * Generate an array of string dates between 2 dates
 *
 * @param string $start Start date
 * @param string $end End date
 * @param string $format Output format (Default: Y-m-d)
 *
 * @return array
 */
function getDatesFromRange($start, $end, $interval=0,$format = 'Y-m-d') {
    $array = array();
    $interval = new DateInterval('P'.$interval.'D');

    $realEnd = new DateTime($end);
    $realEnd->add($interval);

    $period = new DatePeriod(new DateTime($start), $interval, $realEnd);

    foreach($period as $date) {
        $array[] = $date->format($format);
    }

    return $array;
}

//echo json_encode(getDatesFromRange('2021-02-01','2021-03-25',interval: 1));
echo json_encode(getDatesFromRange($start_date,$end_date,$interval_days+1));
?>