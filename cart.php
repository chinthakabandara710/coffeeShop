<?php
$connect = mysqli_connect("localhost", "root", "", "coffeeshop");
$cusName = $_GET['name'];
?>
<?php

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

    <script src="https://kit.fontawesome.com/60aa556cea.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://kit.fontawesome.com/60aa556cea.css" crossorigin="anonymous">
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

    <div class="container-fluid ">

        <div class="col-md-12">
            <div class="customerDetail " style="width: 100%; margin-top:100px; padding-bottom: 4px; margin-right: 4px; font-size:5px;   background-color: rgb(21, 148, 36); color: white;">
                <h2 style="width: 100%; margin-left: 14px;">Hi , <?php echo $cusName ?></h2>
            </div>

            <div class="row">
                <div class="col-md-12" style="padding-left  :3%;">
                    <h2 class="text-center mt-5">Menu Items</h2>
                    <div class="col-md-12">
                        <div class="row">

                            <?php


                            $query = "SELECT * FROM cart_item";
                            $result = mysqli_query($connect, $query);

                            while ($row = mysqli_fetch_array($result)) {

                            ?>

                                <div class="col-md-2 m-5 d-flex justify-content-center">


                                    <form method="post" action="incoming.php">

                                        <input type="hidden" name="invoice" value="<?php echo $_GET['invoice']; ?>" />
                                        <input type="hidden" name="cusname" value="<?php echo $cusName ?>" />
                                        <img src="img/<?= $row['image'] ?>" style='height:150px'>
                                        <h4 class="text-center"><?= $row['name'] ?></h4>
                                        <h5 class="text-center">$<?= number_format($row['price'], 2) ?></h5>
                                        <input type="hidden" name="name" value="<?= $row['name'] ?>">
                                        <input type="hidden" name="price" value="<?= $row['price'] ?>">
                                        <input class="form-control" type="number" name="quantity" value="1" min="1" placeholder="Qty" autocomplete="off" required />

                                        <input style="width: 100%;" type="submit" name="add_to_cart" value="Add to Cart" class="btn btn-warning  btn-block my-2">

                                    </form>
                                </div>
                            <?php
                            }

                            ?>
                        </div>
                    </div>

                </div>
                <div class="d-flex justify-content-center">
                    <div class="col-md-5" #>
                        <table class="table table-bordered" id="resultTable" data-responsive="table">
                            <thead>
                                <tr>
                                    <th> Product Name </th>
                                    <th> Price </th>
                                    <th> Qty </th>
                                    <th> Amount </th>
                                    <th> Action </th>
                                </tr>
                            </thead>
                            <tbody>


                                <?php

                                $id = $_GET['invoice'];

                                $db_host        = 'localhost';
                                $db_user        = 'root';
                                $db_pass        = '';
                                $db_database    = 'coffeeshop';


                                $db = new PDO('mysql:host=' . $db_host . ';dbname=' . $db_database, $db_user, $db_pass);
                                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                                $result = $db->prepare("SELECT * FROM sales_order WHERE invoice= :userid");
                                $result->bindParam(':userid', $id);
                                $result->execute();
                                $total = 0;
                                $invoiceNum;
                                for ($i = 1; $row = $result->fetch(); $i++) {
                                    $total = $total + $row['amount'];
                                    $invoiceNum = $row['invoice'];

                                ?>
                                    <tr class="record">
                                        <td><?php echo $row['product_name']; ?></td>
                                        <td align="right"><?php echo $row['price']; ?></td>
                                        <td align="right"><?php echo $row['qty']; ?></td>
                                        <td align="right"><?php echo $row['amount']; ?></td>
                                        <td width="90"><a href="delete.php?id=<?php echo $row['transaction_id']; ?>&invoice=<?php echo $row['invoice']; ?>&name=<?php echo $cusName ?>"><button class="btn btn-mini btn-danger"><i class="icon icon-remove"></i> Cancel </button></a></td>

                                    </tr>
                                <?php
                                }
                                ?>
                                <tr>
                                    <td colspan="3"> Total Amount: </td>
                                    <td align="right"><?php echo   $total; ?></td>
                                    <td></td>
                                </tr>
                            </tbody>

                        </table>
                        <a href="./checkout.php?cus=<?php echo $cusName  ?>&total=<?php echo $total ?>&invoice=<?php echo  $invoiceNum ?>"><button style="width: 100%;" class="btn btn-success btn-large btn-block"><i class="fa fa-cart-shopping" aria-hidden="true"></i> Place the Order</button></a>


                    </div>
                </div>



            </div>


        </div>
    </div>


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