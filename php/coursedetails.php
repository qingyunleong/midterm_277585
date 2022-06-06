<?php

session_start();
if (!isset($_SESSION['sessionid'])) {
    echo "<script>alert('Session not available. Please login');</script>";
    echo "<script> window.location.replace('login.php')</script>";
}

include_once("dbconnect.php");

if (isset($_GET['subjectid'])) {

    $subjectid = $_GET['subjectid'];
    $sqlsubjects = "SELECT * FROM tbl_subjects INNER JOIN tbl_tutors ON tbl_subjects.tutor_id = tbl_tutors.tutor_id WHERE subject_id = '$subjectid'";

    $stmt = $conn->prepare($sqlsubjects);
    $stmt->execute();
    $number_of_result = $stmt->rowCount();

    if ($number_of_result > 0) {
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $rows = $stmt->fetchAll();
    } else {
        echo "<script>alert('Product not found.');</script>";
        echo "<script> window.location.replace('index.php')</script>";
    }
} else {
    echo "<script>alert('Page Error.');</script>";
    echo "<script> window.location.replace('index.php')</script>";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <script src="../js/menu.js" defer></script>
    <title>Welcome to My Tutor</title>
</head>

<body>
    <div class="w3-sidebar w3-bar-block w3-border-right" style="display:none" id="mySidebar">
        <button onclick="w3_close()" class="w3-bar-item w3-button w3-large"><i class="fa fa-remove w3-right"></i></button>

        <a href="course.php" class="w3-bar-item w3-button"><i class="fa fa-graduation-cap fa-fw w3-margin-right"></i>Courses</a>
        <a href="tutor.php" class="w3-bar-item w3-button"><i class="fa fa-institution fa-fw w3-margin-right"></i>Tutors</a>
        <a href="#" class="w3-bar-item w3-button"><i class="fa fa-book fa-fw w3-margin-right"></i>Subscription</a>
        <a href="profile.php" class="w3-bar-item w3-button"><i class="fa fa-user-circle fa-fw w3-margin-right"></i>Profile</a>
    </div>

    <div class="" style="background-color: #133764">
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
            <h3>Courses Details</h3>
        </div>
        <div class="w3-bar" style="background-color: #133764; color:white">
            <a href="index.php" class="w3-bar-item w3-button w3-right">Back</a>
        </div>
    </div>
    <br>

    <div style="max-width:1000px;margin:0 auto;">
        <?php
        foreach ($rows as $subjects) {
            $subjectid = $subjects['subject_id'];
            $subjectname = $subjects['subject_name'];
            $subjectdesc = $subjects['subject_description'];
            $subjectprice = number_format((float)$subjects['subject_price'], 2, '.', '');
            $subjectsession = $subjects['subject_sessions'];
            $subjectrating = $subjects['subject_rating'];

            $tutorid = $subjects['tutor_id'];
            $tutoremail = $subjects['tutor_email'];
            $tutorname = $subjects['tutor_name'];
        }

        echo "<div class='w3-row'><div class='w3-half w3-container'>
              <div class='w3-padding w3-center'><img class='w3-image resimg' src='../assets/courses/$subjectid.png'" .
            " onerror=this.onerror=null;this.src='../res/background.png'"
            . " style='width:70%'></div></div>";

        echo "<div class='w3-half w3-container'>
        <header class='w3-container' style='background-color: #133764 ; color:white'><h5><b>$subjectname</b></h5></header>";

        echo "<br><table style='width:100%; text-align: left;'><tr><td style='width:25%'><b>Description</b></td><td style='text-align: justify'>$subjectdesc</td></tr>
        <tr><td><b>Session</b></td><td>$subjectsession classes</td></tr>
        <tr><td><b>Price</b></td><td>RM $subjectprice</td></tr></table>";

        echo "<br><i class='fa fa-star fa-fw' style='font-size:23px'>$subjectrating</i><br>";
        echo "<br><hr>";

        echo "<br><h5><b>This courses will be teaching by</b></h5>";
        echo "<div class='w3-row'><div class='w3-quarter w3-container'>
              <div><a href='tutordetails.php?tutorid=$tutorid' style='text-decoration: none;'><img class='w3-image w3-circle resimg' src='../assets/tutors/$tutorid.jpg'" .
            " onerror=this.onerror=null;this.src='../res/background.png'"
            . " style='width:100%'></div></div></a><br>";

        echo "<div class='w3-threequarter w3-container'>
        <table style='width:100%; text-align: left;'><tr><td><b>Name</b></td><td>$tutorname</td></tr>
        <tr><td><b>Email</b></td><td>$tutoremail</td></tr></table></div><br>
        </div></div></div>";
        ?>

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