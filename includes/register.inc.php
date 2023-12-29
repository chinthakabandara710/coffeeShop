<?php
require_once "./dbh.inc.php";
include "./validations.inc.php";


if (isset($_POST['register-btn'])) {
    $fname = $_POST['fName'];
    $lname = $_POST['lName'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];
    $re_password = $_POST['re-password'];
    $user_type = $_POST['type'];

    if (InputsEmpttyRegister($fname, $lname, $email, $mobile, $password, $re_password, $user_type)) {

        header("location: ../login.php?err=empty_inputs");
        // exit();
    } else if (nameInvalid($fname, $lname)) {
        header("location: ../login.php?err=invalid_name");
    } else if (emailInvalid($email)) {
        header("location: ../login.php?err=invalid_email");
    } else if (mobileInvalid($mobile)) {
        header("location: ../login.php?err=invalid_mobile");
    } else if (passwordInvalid($password)) {
        header("location: ../login.php?err=invalid_password");
    } else if (passNotMatch($password, $re_password)) {
        header("location: ../login.php?err=different_pass");
    } else if (emailOrMobieAvailable($conn, $email, $mobile)) {
        header("location: ../login.php?err=available_emailOrMobile");
    } else {
        echo "Succes";
        registerNewUser($conn, $fname, $lname, $email, $mobile, $password, $re_password, $user_type);
    }
} else {
    header("location : ../login.php");
}


function registerNewUser($conn, $fname, $lname, $email, $mobile, $password, $re_password, $user_type)
{
    $passHashed = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users(fName,lName,email,mobile,password,user_type) VALUES (?,?,?,?,?,?);";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../login.php?err=failedstmt");
    } else {
        mysqli_stmt_bind_param($stmt, "sssiss", $fname, $lname, $email, $mobile, $passHashed, $user_type);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        header("location: ../login.php?err=noErrors");
    }
};
