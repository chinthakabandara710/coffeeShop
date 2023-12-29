<?php
include('./includes/dbh.inc.php');
$id = $_GET['id'];
$a = $_GET['invoice'];
$b = $_GET['name'];

$sql = "DELETE FROM sales_order WHERE transaction_id=$id";

$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
	header("location: ./cart.php?err=failedstmt");
} else {
	
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);

	header("location: ./cart.php?invoice=$a&name=$b");
}


