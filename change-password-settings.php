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
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;1,100;1,200&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet">
    <title>Change Password Settings</title>
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
                            <li><a href="dashboard-admin.html" class="dashboard">Dashboard</a></li>
                            <li><a href="patient.php" class="patient">Patient</a></li>
                            <li><a href="reports.php" class="reports">Reports</a></li>
                            <li><a href="track-map.html" class="trackMap">Track Map</a></li>
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


                    <div class="content">
                        <div class="text-content">
                            <div class="left-text">
                                <p>Settings</p>
                                <ul>
                                    <li><a href="#">Change Personal Information</a></li>
                                    <li><a href="#">Update Existing Email</a></li>
                                    <li><a href="#">Change Password</a></li>
                                </ul>
                            </div>
                            <div class="right-text">
                                <p>Change Password</p>
                                <label for="current-pass">Current Password</label>
                                <input type="password" name = "current-pass" id = "current-pass"><br>
                                <label for="new-pass">New Password</label>
                                <input type="password" name = "new-pass" id = "new-pass"><br>
                                <label for="confirm-pass">Confirm Password</label>
                                <input type="password" name = "confirm-pass" id = "confirm-pass">
                                <button class = "save-changes3">Save Changes</button>
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