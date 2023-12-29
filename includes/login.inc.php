<?php

include "./dbh.inc.php";
include "./validations.inc.php";


if (isset($_POST['login-btn'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $remember = $_POST['re-check'];


    if (inputsEmptyLogin($email, $password)) {
        header("location: ../login.php?err=empty_inputs");
    } else if (emailInvalid($email)) {

        header("location: ../login.php?err=invalid_email");
    } else if (passwordInvalid($password)) {

        header("location: ../login.php?err=invalid_password");
    } else {
        loginUser($conn, $email, $password, $remember);
    };
} else {
    
    header("location : ../login.php");
};

function  loginUser($conn, $email, $password, $remember)
{

    $sql = "SELECT * FROM users WHERE email = ?;";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../login.php?err=failedstmt");
    } else {
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);

        $data = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($data)) {
            $passHashed = $row['password'];
            $isPassOk = password_verify($password, $passHashed);
            if ($isPassOk) {


                if ($row['user_type'] === 'admin') {
                    header("location: ../profile.php?invoice=null");
                    //Session creating
                    session_start();

                    $_SESSION['user-email'] = $row['email'];
                    $_SESSION['user-fname'] = $row['fName'];
                    $_SESSION['user-lname'] = $row['lName'];
                    $_SESSION['user-mobile'] = $row['mobile'];

                    if (isset($remember)) {
                        setcookie("emailCookie", $email, time() + (3600 * 24 * 7), "/");
                        setcookie("passwordCookie", $password, time() + (3600 * 24 * 7), "/");
                    } else {
                        if (isset($_COOKIE["emailCookie"])) {
                            setcookie("emailCookie", "", time() - (3600 * 24 * 7), "/");
                        }
                        if (isset($_COOKIE["passwordCookie"])) {
                            setcookie("passwordCookie", "", time() - (3600 * 24 * 7), "/");
                        }
                    }
                } else if ($row['user_type'] === 'staff') {
                    header("location: ../staff.php");
                } else if ($row['user_type'] === 'customer') {

                    session_start();

                    $_SESSION['user-email'] = $row['email'];

                    function createRandomPassword()
                    {
                        $chars = "003232303232023232023456789";
                        srand((float)microtime() * 1000000);
                        $i = 0;
                        $pass = '';
                        while ($i <= 7) {

                            $num = rand() % 33;

                            $tmp = substr($chars, $num, 1);

                            $pass = $pass . $tmp;

                            $i++;
                        }
                        return $pass;
                    }
                    $finalcode = 'N-' . createRandomPassword();


                    $cusName = $row['fName'];
                    header("location: ../cart.php?invoice=$finalcode&name=$cusName");
                }
            } else {
                header("location: ../login.php?err=loginFailedPass");
                exit();
            }
        } else {
            header("location: ../login.php?err=loginFailedEmail");
            exit();
        }
    }
    mysqli_stmt_close($stmt);
}
