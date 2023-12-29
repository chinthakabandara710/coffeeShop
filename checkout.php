
<?php
include('./includes/dbh.inc.php');

$a = $_GET['invoice'];
$b =  $_GET['cus'];
$c = $_GET['total'];




$sql = "INSERT INTO sales (invoice,customer,amount) VALUES (?,?,?)";

$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ./staff.php?err=failedstmt");
} else {
    mysqli_stmt_bind_param($stmt, "ssi", $a, $b, $c);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ./preview.php?cus=$b&total=$c&invoice=$a");
}
?>