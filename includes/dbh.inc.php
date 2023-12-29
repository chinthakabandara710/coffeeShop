<?php
$dbServer = "localhost";
$dbUser = "root";
$dbPwd = "";
$dbName = "coffeeshop";

$conn = mysqli_connect($dbServer, $dbUser, $dbPwd, $dbName);

// if($conn){
//     echo "succcess";
// } else{
//     echo "failed";

// }
if (!$conn) {
    die("Connection failed : " . mysqli_connect_error());
}
