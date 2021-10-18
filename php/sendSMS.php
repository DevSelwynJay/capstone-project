<?php
function send($ip,$phone,$message){
    $send  = json_decode(file_get_contents("http://{$ip}:8080?phone={$phone}&message={$message}"));
    return $send->status == 200? true:false;
}

$res = send("192.168.1.2","09650717910","Sto");

echo $res;
?>
