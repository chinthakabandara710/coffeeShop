<?php
if (isset($_GET["id"])) {

    $id = $_GET["id"];


    include "../includes/dbh.inc.php";


    $sql = "DELETE FROM table_reservation WHERE id = $id";
    $conn->query($sql);
}

header("location: /coffeeLover/staff.php");
exit;
