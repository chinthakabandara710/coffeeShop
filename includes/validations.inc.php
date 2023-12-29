<?php

$value = true;
function InputsEmpttyRegister($fname,$lname,$email,$mobile,$password,$re_password,$user_type){
    $value =true;

    if(empty($fname) || empty($lname) ||empty($email) ||empty($mobile) ||empty($password) ||empty($re_password)|| empty($user_type)){
        $value = true;
    }else{
        $value = false;
    };
    return $value;
}

function inputsEmptyLogin($email,$password){
    $value =true;

    if(empty($email) ||empty($password)){
        $value = true;
    }else{
        $value = false;
    };
    return $value;
}

function nameInvalid($fname,$lname){
    $value =true;
    if(!preg_match("/^[a-zA-Z]+$/",$fname)){
         $value =  true;
    }else if(!preg_match("/^[a-zA-Z]+$/",$lname)){
         $value = true;
    }else{
        $value = false;
    }
    
    return $value;
}
function emailInvalid($email){
    $value =true;
    if(!preg_match("/^[a-zA-Z\d\@.]+\.[a-zA-Z\d]{2,}$/",$email)){
        $value = true;
    }else{
        $value = false;
    };
    
    return $value;
}
function mobileInvalid($mobile){
    $value =true;
    if(!preg_match("/^[0][\d]{9}$/",$mobile)){
        $value = true;
    }else{
        $value = false;
    };
    
    return $value;
}
function passwordInvalid($password){
    $value =true;
    if(!preg_match("/^.{5,}$/",$password)){
        $value = true;
    }else{
        $value = false;
    };
    
    return $value;
}
function passNotMatch($password,$re_password){
    $value =true;
    if($password !== $re_password){
        $value = true;
    }else{
        $value = false;
    };    
    return $value;
}
function emailOrMobieAvailable($conn,$email,$mobile){
    $value =true;
    $sql = "SELECT * FROM users WHERE email = ? OR mobile = ?;";
    $stmt = mysqli_stmt_init($conn);
    
    if(!mysqli_stmt_prepare($stmt,$sql)){        
        header("Location: ../index.php?err=failedstmt");
        exit();
    }else{
        mysqli_stmt_bind_param($stmt,"si",$email,$mobile);
        mysqli_stmt_execute($stmt);
        $data = mysqli_stmt_get_result($stmt);
        if (!mysqli_fetch_assoc($data)) {
            $value = false;
        }else{
            $value = true;
        }
    }
    
    mysqli_stmt_close($stmt);
    return $value;
}



?>