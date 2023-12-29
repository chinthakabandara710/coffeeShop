<?php
session_start();
if (!isset($_SESSION['user-email'])) {
    header("location: ./index.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
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

    <script language="javascript" type="text/javascript">
        <!-- Begin
        var timerID = null;
        var timerRunning = false;

        function stopclock() {
            if (timerRunning)
                clearTimeout(timerID);
            timerRunning = false;
        }

        function showtime() {
            var now = new Date();
            var hours = now.getHours();
            var minutes = now.getMinutes();
            var seconds = now.getSeconds()
            var timeValue = "" + ((hours > 12) ? hours - 12 : hours)
            if (timeValue == "0") timeValue = 12;
            timeValue += ((minutes < 10) ? ":0" : ":") + minutes
            timeValue += ((seconds < 10) ? ":0" : ":") + seconds
            timeValue += (hours >= 12) ? " PM" : " AM"
            document.clock.face.value = timeValue;
            timerID = setTimeout("showtime()", 1000);
            timerRunning = true;
        }

        function startclock() {
            stopclock();
            showtime();
        }

        window.onload = startclock;

        // End 
        -->
    </SCRIPT>

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
                    <li><a class="getstarted   btn btn-danger  btn-block my-2" href="./includes/logout.inc.php">LogOut</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav>

        </div>
    </header>


    <div class="container-fluid">
        <div class="row " style="margin:10%;">
            <div class="col align-self-end">
                <h3>Welcome, <span style="font-size:large; color:green;">
                        <?php
                        if (isset($_SESSION['user-email'])) {
                            echo $_SESSION['user-fname'];
                        }

                        ?>
                    </span>
                </h3>
            </div>
            <div class="col " style=" margin-left:70%;">
                <form name="clock">
                    <h4>Time &nbsp;<span><input style="width:100%; float:righ" type="submit" class="trans" name="face" value=""></span></h4>
                </form>
            </div>

            <br>
            <div class="col-md-12 mt-5">
                <h5>Search by Invoice Number</h5>

                <form action="./profile.php" method="get">
                    <input style="width:50%;" type="text" name="invoice" placeholder="Invoice Number" value="" class="form-control" placeholder="Qty" autocomplete="off"><br>
                    <Button type="submit" class="btn btn-primary" style="width: 123px; margin-top:-10px;"><i class="icon-plus-sign icon-large"></i> Search</button>

                </form>


            </div>
            <div class="container " id="content">

                <br>
                <center>
                    <h2>List of Sales</h2><br>

                    <table class="table table-bordered" border="1" cellpadding="4" cellspacing="2" style=" font-family: arial; font-size: 12px; padding: 20%; width:50%;">
                        <thead class="thead-dark">
                            <tr>
                                <th>Sales Id</th>
                                <th>Invoice</th>
                                <th>Customer Name</th>
                                <th class="justify-content-end">Total</th>
                                <th class="d-flex justify-content-end">Date / Time</th>

                            </tr>
                        </thead>
                        <tbody>

                            <?php

                            require_once "./includes/dbh.inc.php";

                            $invoiceVal = $_GET['invoice'];
                            $sql;
                            if ($invoiceVal === 'null' || $invoiceVal === '') {
                                $sql = "SELECT * FROM sales ORDER BY date DESC";
                            } else {
                                $sql = "SELECT * FROM sales WHERE invoice='$invoiceVal'";
                            }

                            $result = $conn->query($sql);


                            if (!$result) {
                                die("Invalid query : " . $conn->connect_error);
                            }

                            while ($row = $result->fetch_assoc()) {
                                echo "
                                    <tr>
                                        <td>$row[id]</td>
                                        <td>$row[invoice]</td>
                                        <td>$row[customer]</td>
                                        <td align='right'>$row[amount]</td>
                                        <td align='right'>$row[date]</td>
                                
                                    </tr>
                                    ";
                            }
                   


                            ?>

                        </tbody>
                    </table>
                </center>
            </div>




        </div>
    </div>




    <?php
    include("./main/footer.php") ?>

</body>

</html>