<?php

session_start();
if (!isset($_SESSION['sessionid'])) {
    echo "<script>alert('Session not available. Please login');</script>";
    echo "<script> window.location.replace('login.php')</script>";
}

$results_per_page = 10;
if (isset($_GET['pageno'])) {
    $pageno = (int)$_GET['pageno'];
    $page_first_result = ($pageno - 1) * $results_per_page;
} else {
    $pageno = 1;
    $page_first_result = 0;
}

include_once("dbconnect.php");

$sqlsubjects = "SELECT * FROM tbl_subjects";
$stmt = $conn->prepare($sqlsubjects);
$stmt->execute();
$number_of_result = $stmt->rowCount();
$number_of_page = ceil($number_of_result / $results_per_page);
$sqlsubjects = $sqlsubjects . " LIMIT $page_first_result , $results_per_page";
$stmt = $conn->prepare($sqlsubjects);
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
$rows = $stmt->fetchAll();


function truncate($string, $length, $dots = "...")
{
    return (strlen($string) > $length) ? substr($string, 0, $length - strlen($dots)) . $dots : $string;
}
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
            <h3>Courses</h3>
        </div>
    </div>
    <br>

    <div style="max-width:1000px;margin:0 auto;">

        <div class="w3-grid-template">
            <?php
            $i = 0;
            foreach ($rows as $subjects) {
                $i++;
                $subjectid = $subjects['subject_id'];
                $subjectname = truncate($subjects['subject_name'], 15);
                $subjectdesc = $subjects['subject_description'];
                $subjectprice = number_format((float)$subjects['subject_price'], 2, '.', '');
                $tutorid = $subjects['tutor_id'];
                $subjectsession = $subjects['subject_sessions'];
                $subjectrating = $subjects['subject_rating'];

                echo "<div class='w3-card w3-round' style='margin:4px'>";
                echo "<br><a href='coursedetails.php?subjectid=$subjectid' style='text-decoration: none;'> <center><img class='w3-image w3-circle' src='../assets/courses/$subjectid.png'" .
                    " onerror=this.onerror=null;this.src='../res/background.png'"
                    . " style='width:70%;height:170px'></a>";
                echo "<div class='w3-container'><p><h5><b>$subjectname</b></h5>
                      <i class='fa fa-star fa-fw'></i>$subjectrating<p>
                      <div class='w3-container w3-leftbar w3-light-grey'>RM $subjectprice</div>
                      <div class='w3-container w3-leftbar w3-light-grey'>$subjectsession classes</div>
                      </p></div>
                </div>";
            }
            ?>
        </div>

        <br>
        <?php
        $num = 1;
        if ($pageno == 1) {
            $num = 1;
        } else if ($pageno == 2) {
            $num = ($num) + 10;
        } else {
            $num = $pageno * 10 - 9;
        }
        echo "<div class='w3-container w3-row'>";
        echo "<center>";
        for ($page = 1; $page <= $number_of_page; $page++) {
            echo '<a href = "index.php?pageno=' . $page . '" style=
            "text-decoration: none">&nbsp&nbsp' . $page . ' </a>';
        }
        echo " ( " . $pageno . " )";
        echo "</center>";
        echo "</div>";
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