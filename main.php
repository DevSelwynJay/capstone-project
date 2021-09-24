<?php
session_start();
if(!isset($_SESSION['email'])){
    header("location:index.php",true);
    exit();
}
echo $_SESSION['account_type'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Main</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--JS-->
    <!--JQuery API-->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

    <!--User-defined JS-->
    <script>
        function logout(){
            window.location.href = "php/sessionDestroy.php";
        }
    </script>

</head>
<body>
    <button id="logout-btn" onclick="logout()">Logout</button>
</body>
</html>