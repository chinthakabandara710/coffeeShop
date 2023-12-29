<?php

include('./includes/dbh.inc.php');
$a = $_POST['invoice'];
$b = $_POST['name'];
$c = $_POST['price'];
$d = $_POST['quantity'];
$e = $c * $d;
$f = $_POST['cusname'];


$sql = "INSERT INTO sales_order (invoice,product_name,price,qty,amount) VALUES (?,?,?,?,?)";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {

    header("location: ./cart.php?err=failedstmt");
} else {
    mysqli_stmt_bind_param($stmt, "ssiii", $a, $b, $c, $d, $e);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ./cart.php?invoice=$a&name=$f");
}
