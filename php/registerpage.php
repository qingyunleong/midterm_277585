<?php

if (isset($_POST['submit'])) {
    include_once("dbconnect.php");

    $email = $_POST["email"];
    $name = $_POST["name"];
    $address = $_POST["address"];
    $phone = $_POST["phone"];
    $password = sha1($_POST["password"]);

    $sqlregister = "INSERT INTO `tbl_users`(`user_name`, `user_email`, `user_password`, `user_address`, `user_phone`) 
    VALUES ('$name','$email','$password','$address','$phone')";
    try {
        $conn->exec($sqlregister);
        if (file_exists($_FILES["fileToUpload"]["tmp_name"]) || is_uploaded_file($_FILES["fileToUpload"]["tmp_name"])) {
            $idno = $conn->lastInsertId();
            uploadImage($idno);
            echo "<script>alert('Registration successful')</script>";
            echo "<script>window.location.replace('login.php')</script>";
        }
    } catch (PDOException $e) {
        echo "<script>alert('Registration failed')</script>";
        echo "<script>window.location.replace('registerpage.php')</script>";
    }
}

function uploadImage($id)
{
    $target_dir = "../res/images/";
    $target_file = $target_dir . $id . ".png";
    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
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
    <script src="../js/script.js"></script>
    <script src="../js/register.js"></script>
    <title>Register Page</title>
</head>

<body>

    <header class="w3-header w3-center">
        <div class="mySlides w3-display-container w3-center">
            <img src="../res/background.png" style="width:100%">
        </div>
        <div class="mySlides w3-display-container w3-center">
            <img src="../res/2.png" style="width:100%">
        </div>
        <div class="mySlides w3-display-container w3-center">
            <img src="../res/3.png" style="width:100%">
        </div>
    </header>

    <div style="display:flex; justify-content:center">
        <div class="w3-content w3-margin-top form-container-reg" style="max-width:1000px;">


            <form name="registerForm" action="registerpage.php" method="post" onsubmit="return confirmDialog()" enctype="multipart/form-data">

                <div class="w3-half">
                    <div class="w3-text-black">
                        <div class="w3-container">
                            <div style="display:flex; justify-content:center">
                                <div class="w3-container w3-padding w3-margin " style="width:600px; margin:auto; text-align:left">

                                    <div class="w3-display-container ">
                                        <img src="../res/signup-image.jpg" style="width:100%">
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                </div>

                <div class="w3-half">

                    <div class="w3-container w3-margin-bottom w3-padding-16">
                        <div class="w3-container">

                            <div class="a">
                                <p class=" w3-xxlarge"><b>Sign Up</b></p>
                            </div>

                            <p>
                            <div class="w3-container w3-border w3-center w3-padding">
                                <img class="w3-image w3-round w3-margin" src="../res/profile.png" style="width:50%; max-width:600px"><br>
                                <input type="file" onchange="previewFile()" name="fileToUpload" id="fileToUpload"><br>
                            </div>
                            </p>

                            <p>
                                <label><b>Name</b></label>
                                <input class="w3-input w3-round w3-border" type="name" name="name" id="idname" placeholder="Enter your name" required>
                            </p>
                            <p>
                                <label><b>Email</b></label>
                                <input class="w3-input w3-round w3-border" type="email" name="email" id="idemail" placeholder="Enter your email address" required>
                            </p>
                            <p>
                                <label><b>Phone Number</b></label>
                                <input class="w3-input w3-round w3-border" type="phone" name="phone" id="idphone" placeholder="Enter your phone number" required>
                            </p>
                            <p>
                                <label><b>Address</b></label>
                                <textarea class="w3-input w3-round w3-border" id="idaddress" name="address" rows="2" cols="50" width="100%" placeholder="Please enter your address" required></textarea>
                            </p>
                            <p>
                                <label><b>Password</b></label>
                                <input class="w3-input w3-round w3-border" type="password" name="password" id="idpassword" placeholder="Enter your password" required>
                            </p>
                            <p><input class="w3-button w3-round w3-border" style="background-color: #133764 ; color:white" type="submit" name="submit" id="idsubmit"></p>
                            <p>Already registered? <a href="login.php" style="text-decoration:none;"><u>Sign In here.</u></a>
                            <p>
                                <br>
                        </div>
                    </div>
                </div>
            </form>
        </div>
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