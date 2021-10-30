<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!--Custom CSS-->
<link rel="stylesheet" href="scss/main.css">
<!--Font Awesome-->
<script src="https://kit.fontawesome.com/617ba34092.js" crossorigin="anonymous"></script>
<!-- Font Family Poppins -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;1,100;1,200&display=swap" rel="stylesheet"> 
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet">
<title>Inventory</title>
<!--Jquery-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>

<section class="global">
<div class="global__container">
<div class="global__sidenav">
<div class="inner-sidenav">
<div class="spacer">
<div class="profile">
<div class="profile-img">
<img src="img/jay.jpg" alt="">
</div>
<h4>Your Name</h4>
</div>
<ul class="menu">
<li><a href="" class="dashboard">Dashboard</a></li>
<li><a href="patient.php" class="patient">Patient</a></li>
<li><a href="reports.php" class="reports">Reports</a></li>
<li><a href="" class="trackMap">Track Map</a></li>
<li><a href="inventory.php" class="inventory">Inventory</a></li>
</ul>
</div>
<div class="social-media-links">
<i class="fab fa-facebook"></i>
<i class="fab fa-twitter"></i>
<i class="fab fa-instagram"></i>
</div>
</div>    
</div>
<div class="global__main-content">
<div class="inner-page-content">
<div class="col-sm-12">
<div class="inner-page-nav">
<div class="logo">
<img src="img/HIS logo blue.png" alt="">
</div>
<div class="settings">
<a><i class="fas fa-user-circle"></i></a> 
<a><i class="fas fa-ellipsis-h"></i></a> 
</div>
</div>
</div>
<div class="col-sm-12">
<div class="">
   <div class="inventory__container">
    <div class="inventory__table-toexpire-container">
        <h1>Medicine to Expire</h1>
        <table>
            <tbody>
                <tr>
                    <td>01</td>
                    <td>Medicine Name</td>
                    <td class="expired-text">Expires in 3 days</td>
                    <td class="warning-btn"><i class="fas fa-exclamation"></i></td>
                </tr>
                <tr>
                    <td>01</td>
                    <td>Medicine Name</td>
                    <td class="expired-text">Expires in 5 days</td>
                    <td class="warning-btn"><i class="fas fa-exclamation"></i></td>
                </tr>
            </tbody>
        </table>
    </div>
   
    <div class="inventory__table-expired-container">
        <h1>Expired Medicines</h1>
        <table>
            <tbody>
                <tr>
                    <td>01</td>
                    <td>Medicine Name</td>
                    <td class="expired-text">Expired</td>
                    <td class="delete-btn"><i class="fas fa-trash"></i></td>
                </tr>
                <tr>
                    <td>01</td>
                    <td>Medicine Name</td>
                    <td class="expired-text">Expired</td>
                    <td class="delete-btn"><i class="fas fa-trash"></i></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="inventory__table-main-container">
        <table>
            <tbody>
                <tr class="title">
                    <th>Medicine ID</th>
                    <th>Medicine Name</th>
                    <th>Category</th>
                    <th>No. of Stocks</th>
                    <th>Mfg. Date</th>
                    <th>Exp. Date</th>
                    <th class="add-row"></th>
                </tr>
                <tr>
                    <td>01</td>
                    <td>Medicine Name</td>
                    <td>Category</th>
                    <td>XXX</td>
                    <td>MM/DD/YYYY</td>
                    <td>MM/DD/YYYY</td>
                    <td class="add-btn"><i class="fas fa-plus"></i></td>
                </tr>
                <tr>
                    <td>01</td>
                    <td>Medicine Name</td>
                    <td>Category</th>
                    <td>XXX</td>
                    <td>MM/DD/YYYY</td>
                    <td>MM/DD/YYYY</td>
                    <td class="add-btn"><i class="fas fa-plus"></i></td>
                </tr>
                <tr>
                    <td>01</td>
                    <td>Medicine Name</td>
                    <td>Category</th>
                    <td>XXX</td>
                    <td>MM/DD/YYYY</td>
                    <td>MM/DD/YYYY</td>
                    <td class="add-btn"><i class="fas fa-plus"></i></td>
                </tr>
                <tr>
                    <td>01</td>
                    <td>Medicine Name</td>
                    <td>Category</th>
                    <td>XXX</td>
                    <td>MM/DD/YYYY</td>
                    <td>MM/DD/YYYY</td>
                    <td class="add-btn"><i class="fas fa-plus"></i></td>
                </tr>
                <tr>
                    <td>01</td>
                    <td>Medicine Name</td>
                    <td>Category</th>
                    <td>XXX</td>
                    <td>MM/DD/YYYY</td>
                    <td>MM/DD/YYYY</td>
                    <td class="add-btn"><i class="fas fa-plus"></i></td>
                </tr>
                <tr>
                    <td>01</td>
                    <td>Medicine Name</td>
                    <td>Category</th>
                    <td>XXX</td>
                    <td>MM/DD/YYYY</td>
                    <td>MM/DD/YYYY</td>
                    <td class="add-btn"><i class="fas fa-plus"></i></td>
                </tr>
            </tbody>
        </table>
    </div>
   </div>
</div>
</div>
</div>
</div>
</div>
</section>
</body>
</html>