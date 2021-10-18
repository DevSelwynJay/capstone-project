<?php
function send($ip,$phone,$message){
    $send  = json_decode(file_get_contents("http://$ip:8080?phone=$phone&message={$message}"));
    return $send->status == 200? true:false;
}

$res = send("192.168.1.13","09650717910","Sto Rosario HealthInformation System samplesample");
echo $res;
?>
