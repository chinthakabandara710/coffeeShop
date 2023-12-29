<?php
session_start();
if (isset($_SESSION['user-email'])) {
    header("location: ./profile.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Coffee Lover</title>

    <meta content="" name="description">
    <meta content="" name="keywords">
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">


    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">


    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">

</head>
</head>

<body>
    <?php
    include("./main/nav.php") ?>


    <div class="container ">
        <div id="loginInfo" class="row">

            <?php
            if (isset($_GET['err'])) {
                if ($_GET['err'] === 'empty_inputs') {
                    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>All the input must be filled !   <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button></div>";
                } else if ($_GET['err'] === 'invalid_name') {
                    echo "<div class='alert alert-danger' alert-dismissible fade show' role='alert'>Both names must be written in letters! <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button></div>";
                } else if ($_GET['err'] === 'invalid_email') {
                    echo "<div class='alert alert-danger' alert-dismissible fade show' role='alert'>Proper email must be inputed ! <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button></div>";
                } else if ($_GET['err'] === 'invalid_mobile') {
                    echo "<div class='alert alert-danger' alert-dismissible fade show' role='alert'>Mobile number must be 10 digits long! <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button></div>";
                } else if ($_GET['err'] === 'invalid_password') {
                    echo "<div class='alert alert-danger' alert-dismissible fade show' role='alert'>Password must be at least 5 charactors long! <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button></div>";
                } else if ($_GET['err'] === 'different_pass') {
                    echo "<div class='alert alert-danger' alert-dismissible fade show' role='alert'>Re enterd password must be same! <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button></div>";
                } else if ($_GET['err'] === 'available_emailOrMobile') {
                    echo "<div class='alert alert-danger' alert-dismissible fade show' role='alert'>Email or mobile number already exits ! <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button></div>";
                } else if ($_GET['err'] === 'failedstmt') {
                    echo "<div class='alert alert-danger' alert-dismissible fade show' role='alert'>Failed to execute the query ! <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button></div>";
                } else if ($_GET['err'] === 'noErrors') {
                    echo "<div class='alert alert-success' alert-dismissible fade show' role='alert'>Successfully registerd ! <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button></div>";
                } else if ($_GET['err'] === 'loginFailedEmail') {
                    echo "<div class='alert alert-danger' alert-dismissible fade show' role='alert'>Wrong email entered ! <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button></div>";
                } else if ($_GET['err'] === 'loginFailedPass') {
                    echo "<div class='alert alert-danger' alert-dismissible fade show' role='alert'>Wrong password enterd ! <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button></div>";
                }
            }

            ?>
            <div class="col-6">
                <div class="forms">
                    <form action="includes/login.inc.php" class="login" method="post">
                        <h2 class="formTopic">Login</h2><br>
                        <input class="form-control" type="text" name="email" placeholder="Enter your Email" value="<?php if (isset($_COOKIE['emailCookie'])) {
                                                                                                                        echo $_COOKIE['emailCookie'];
                                                                                                                    } ?>"><br>
                        <input class="form-control" type="password" name="password" placeholder="Enter your Password" value="<?php if (isset($_COOKIE['passwordCookie'])) {
                                                                                                                                    echo $_COOKIE['passwordCookie'];
                                                                                                                                } ?>"><br>
                        <div class="rem">
                            <input type="checkbox" name="re-check" id="re-check" <?php if (isset($_COOKIE['emailCookie'])) {
                                                                                        echo "checked";
                                                                                    } ?>>
                            <label class="form-label" for="re-check">Remember Me</label>
                        </div>
                        <button type="submit" class="btn btn-outline-dark mb-3" name="login-btn">Login</button>
                    </form>
                </div>

            </div>
            <div class="col-6">

                <div class="forms">
                    <form action="includes/register.inc.php" class="register" method="post">
                        <h2 class="formTopic">Register</h2><br>
                        <input type="text" class="form-control" name="fName" placeholder="Enter your First Name"><br>
                        <input type="text" class="form-control" name="lName" placeholder="Enter your Last Name"><br>
                        <input type="text" class="form-control" name="email" placeholder="Enter your Email"><br>
                        <input type="text" class="form-control" name="mobile" placeholder="Enter your Mobile"><br>
                        <input type="password" class="form-control" name="password" placeholder="Enter your Password"><br>
                        <input type="password" class="form-control" name="re-password" placeholder="Re-enter your Password"><br>
                        
                        <select name="type" class="form-control" required>

                            <option value="admin">Admin</option>
                            <option value="staff">Staff</option>

                            <option value="customer">Customer</option>

                        </select>
                        <button type="submit" class="btn btn-outline-dark mb-3" name="register-btn">Register</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <?php
    if (isset($_POST['upload'])) {
        //     echo "<pre>";
        //     print_r($_FILES['files']);
        //     echo "</pre>";

        foreach ($_FILES['files']['name'] as $index => $name) {
            if (move_uploaded_file($_FILES['files']['tmp_name'][$index], 'uploads/' . $name)) {
                echo "Successfully uploaded " . $name . "<br>";
            } else {
                echo "Error occured!";
            }
        }
    }

    if (isset($_GET['delete'])) {
        echo "Successfully deleted " . $_GET['delete'];
    }

    ?>


    <?php
    include("./main/footer.php") ?>

    <div id="preloader"></div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>


    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <script src="assets/js/main.js"></script>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>

</html>
