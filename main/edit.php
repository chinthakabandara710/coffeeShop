<?php

include "../includes/dbh.inc.php";

$tId = "";
$name = "";
$email = "";
$phone = "";
$diners = "";
$dob = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (!isset($_GET["id"])) {
        header("location: /coffeeLover/staff.php");
        exit;
    }

    $id = $_GET["id"];

    $sql = "SELECT * FROM table_reservation WHERE id=$id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location: /coffeeLover/staff.php");
        exit;
    }

    $tId = $row["table_no"];
    $name = $row["name"];
    $email = $row["email"];
    $phone = $row["phone"];
    $diners = $row["diners"];
    $date = $row["date"];
    $time = $row["time"];
} else {

    $tId = $_POST["t_No"];
    $id = $_POST["id"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $diners = $_POST["diners"];
    $date = $_POST["date"];
    $time = $_POST["time"];

    do {

        if (empty($id) || empty($tId) || empty($name) || empty($email) || empty($phone) || empty($diners) || empty($date) || empty($time)) {
            $errorMessage = "All feileds are required";
            break;
        }

        $sql = "UPDATE table_reservation " .
            "SET table_No = '$tId' ,name = '$name' , email = '$email' , phone = ' $phone ', diners = ' $diners ', date = ' $date ', time = ' $time ' " .
            " WHERE id = $id ";

        $result = $conn->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query : " . $conn->error;
            break;
        }

        $successMessage = "Client updated correctly";
        header("location: /coffeeLover/staff.php");
        exit;
    } while (false);
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signature Cuisine</title>

    <meta content="" name="description">
    <meta content="" name="keywords">
    <link href="../assets/img/favicon.png" rel="icon">
    <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">


    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">


    <link href="../assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">


</head>

<body>
    <header id="header" class="fixed-top ">
        <div class="container d-flex align-items-center">

            <a class="me-auto" href="index.html"> <img src="/coffeeLover/assets/img/logo.png" class="logo" alt=""></a>

            <nav id="navbar" class="navbar navbar-dark ">
                <ul>
                    <li><a class="nav-link scrollto active" href="/coffeeLover/index.php">Home</a></li>
                    <li><a class="nav-link scrollto" href="/coffeeLover/aboutUs.php">About</a></li>
                    <li><a class="nav-link scrollto" href="/coffeeLover/services.php">Services</a></li>
                    <li><a class="nav-link scrollto" href="/coffeeLover/gallery.php">Gallery</a></li>
                    <li><a class="nav-link scrollto" href="/coffeeLover/contact.php">Contact</a></li>
                    <li><a class="getstarted   btn btn-danger  btn-block my-2" href="../includes/logout.inc.php">LogOut</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav>

        </div>
    </header>

    <div class="container borader my-5 pt-5">
        <h2>Edit Table Reservation Details</h2>

        <?php

        if (!empty($errorMessage)) {
            echo "
            <div class='alert alert-danger alert-dismissible fade show' role='alert'>
            <strong>$errorMessage</strong>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
              <span aria-hidden='true'>&times;</span>
            </button>
          </div>";
        }

        ?>

        <form class="row" method="post">

            <input name="id" type="hidden" value="<?php echo $id ?>">

            <label>Table number</label>
            <input type="number" class="form-control" name="t_No" value="<?php echo $tId ?>" min="1" max="10" placeholder="Qty" autocomplete="off" required />
            <label>Customer Name</label>
            <input type="text" name="name" class="form-control" autocomplete="off" value="<?php echo $name ?>" />
            <label>Customer Email</label>
            <input type="email" name="email" class="form-control" value="<?php echo $email ?>" />
            <label>Tele Phone</label>
            <input type="text" name="phone" class="form-control" autocomplete="off" value="<?php echo $phone ?>" />
            <label>Number of Diners</label>
            <input type="text" name="diners" class="form-control" autocomplete="off" value="<?php echo $diners ?>" />
            <label>Date </label>
            <input type="date" name="date" class="date form-control" value="<?php echo $date ?>" />
            <label>Time </label>
            <input type="time" name="time" class="date form-control" value="<?php echo $time ?>" />
            <br>
            <?php
            if (!empty($successMessage)) {
                echo "
            <div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>$successMessage</strong>
            <button type='button' class=' ml-10 close' data-dismiss='alert' aria-label='Close' >
              <span aria-hidden='true'>&times;</span>
            </button>
          </div>";
            }

            ?>
            <button type="submit" class="form-control btn btn-success mt-3">Update</button>
            <a href="/coffeeLover/staff.php" role="button" class="form-control btn btn-danger mt-3">Cancel</a>
        </form>
    </div>

    <?php
    include("./footer.php")
    ?>

</body>

</html>