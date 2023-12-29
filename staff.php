<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coffee Lover</title>
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
        <div class="row profile">

            <br>
            <br>
            <div class="col">

                <a href="/coffeeLover/main/create.php"><button class="btn btn-primary btn-large"> Add new table Reservation</button></a>
                <br>
                <br>

            </div>
            <br>


            <div class="container my-5" id="content">

                <br>
                <center>
                    <h2>List of Reservation</h2><br>

                    <table class="table" border="1" cellpadding="4" cellspacing="2" style="font-family: arial; font-size: 12px;	text-align:left;" width="100%">
                        <thead class="thead-dark">
                            <tr>
                                <th>Table No:</th>
                                <th>Customer Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Diners</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Booked on</th>

                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php

                            require_once "./includes/dbh.inc.php";

                            $sql = "SELECT * FROM table_reservation";
                            $result = $conn->query($sql);

                            if (!$result) {
                                die("Invalid query : " . $conn->connect_error);
                            }

                            while ($row = $result->fetch_assoc()) {
                                echo "
                                    <tr>
                                        <td>$row[table_no]</td>
                                        <td>$row[name]</td>
                                        <td>$row[email]</td>
                                        <td>$row[phone]</td>
                                        <td>$row[diners]</td>
                                        <td>$row[date]</td>
                                        <td>$row[time]</td>
                                        <td>$row[created_at]</td>

                                        <td>
                                            <a class='btn btn-primary' href='/coffeeLover/main/edit.php?id=$row[id]' >Edit</a>
                                            <a class='btn btn-danger' href='/coffeeLover/main/delete.php?id=$row[id]'>Delete</a>
                                        </td>
                                    </tr>
                                    ";
                            }



                            ?>

                        </tbody>
                    </table>
                </center>
            </div>

            <div class="pull-right" style="margin-right:100px;">
            </div>




        </div>
    </div>




    <?php
    include("./main/footer.php") ?>

</body>




</html>