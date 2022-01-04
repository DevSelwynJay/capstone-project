<?php
session_start();
if($_SESSION['is_link']){
    echo 1;
}
else{
    echo 0;
}