<?php

session_start();
if (!isset($_SESSION['sessionid'])) {
    echo "<script>alert('Session not available. Please login');</script>";
    echo "<script> window.location.replace('login.php')</script>";
}

include_once("dbconnect.php");

$sqluser = "SELECT * FROM tbl_users";
$stmt = $conn->prepare($sqluser);
$stmt->execute();
$stmt = $conn->prepare($sqluser);
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
$rows = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Raleway'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <script src="../js/menu.js" defer></script>

    <title>Welcome to MyTutor</title>
</head>

<body>
    <div class="w3-sidebar w3-bar-block w3-border-right" style="display:none" id="mySidebar">
        <button onclick="w3_close()" class="w3-bar-item w3-button w3-large"><i class="fa fa-remove w3-right"></i></button>

        <a href="index.php" class="w3-bar-item w3-button"><i class="fa fa-graduation-cap fa-fw w3-margin-right"></i>Courses</a>
        <a href="tutor.php" class="w3-bar-item w3-button"><i class="fa fa-institution fa-fw w3-margin-right"></i>Tutors</a>
        <a href="#" class="w3-bar-item w3-button"><i class="fa fa-book fa-fw w3-margin-right"></i>Subscription</a>
        <a href="profile.php" class="w3-bar-item w3-button"><i class="fa fa-user-circle fa-fw w3-margin-right"></i>Profile</a>
    </div>

    <div style="background-color: #133764">
        <button class="w3-button w3-xlarge" style="background-color: #133764" onclick="w3_open()">☰</button>

        <div class="mySlides w3-display-container w3-center">
            <img src="../res/background.png" style="width:100%">
        </div>
        <div class="mySlides w3-display-container w3-center">
            <img src="../res/2.png" style="width:100%">
        </div>
        <div class="mySlides w3-display-container w3-center">
            <img src="../res/3.png" style="width:100%">
        </div>
    </div>
    <br>

    <div style="max-width:1100px; margin:0 auto; background-color: #133764; color:white">
        <div class="w3-container">
            <h3>Profile</h3>
        </div>
    </div>
    <br>

    <div style="max-width:1000px;margin:0 auto;">
        <?php
        $i = 0;
        foreach ($rows as $user) {
            $i++;
            $userid = $user['user_id'];
            $username = $user['user_name'];
            $useremail = $user['user_email'];
            $useraddress = $user['user_address'];
            $userphone = $user['user_phone'];
            $userregdate = $user['user_regdate'];

            echo "<div class='w3-card w3-round' style='margin:4px'>";

            echo "<div class='w3-padding w3-center'><img class='w3-image resimg' src='../res/images/$userid.png'" .
                " onerror=this.onerror=null;this.src='../res/background.png'"
                . " style='width:25%'></div>";

            echo "<br><table style='width:50%; text-align: left; margin-left: auto; margin-right: auto'>

            <tr><td style='width:30%'><b>Name</b></td><td style='text-align: left'>
            <div class='w3-panel w3-border-left w3-pale-yellow w3-border-black'><p>$username</p></div></td></tr>

            <tr><td style='width:30%'><b>Email</b></td><td style='text-align: left'>
            <div class='w3-panel w3-border-left w3-pale-yellow w3-border-black'><p>$useremail</p></div></td></tr>

            <tr><td style='width:30%'><b>Address</b></td><td style='text-align: left'>
            <div class='w3-panel w3-border-left w3-pale-yellow w3-border-black'><p>$useraddress</p></div></td></tr>

            <tr><td style='width:30%'><b>Phone Number</b></td><td style='text-align: left'>
            <div class='w3-panel w3-border-left w3-pale-yellow w3-border-black'><p>$userphone</p></div></td></tr>
            
            </table></div>";
        }
        ?>
        <br>
    </div>

    <footer class="w3-footer w3-center" style="background-color: #133764 ; color:white">
        <p>Find me on social media.</p>

        <a href="https://www.facebook.com/qingyunleong" target="_blank"><i class="fa fa-facebook-official w3-hover-opacity"></i></a>
        <a href="https://www.instagram.com/qingyunleong" target="_blank"><i class="fa fa-instagram w3-hover-opacity"></i></a>
        <a href="https://github.com/qingyunleong" target="_blank"><i class="fa fa-git w3-hover-opacity"></i></a>
        <p>Copyright MyTutor&copy; <span>|</span> <a href="privacypolicy.php">Privacy Policy</a> <span>|</span> <a href="termandcondition.php">Terms and Conditions</a> </p>
    </footer>

    <script>
        var myIndex = 0;
        header();

        function header() {
            var i;
            var x = document.getElementsByClassName("mySlides");
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            }
            myIndex++;
            if (myIndex > x.length) {
                myIndex = 1
            }
            x[myIndex - 1].style.display = "block";
            setTimeout(header, 3500);
        }
    </script>

</body>

</html>