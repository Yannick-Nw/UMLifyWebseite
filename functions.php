<?php
function check_empty(){
    if (empty($_POST["username"]) || empty($_POST["email"]) || empty($_POST["password1"]) || empty($_POST["password2"])) {
        return true;
    }
    return false;
}

function invalidEmail($email){
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    }
    else{
        return false;
    }
}

function invalidUsername($username){
    if(!preg_match("/^[a-zA-Z0-9]*$/", $username)){
        return true;
    }else{
        return false;
    }
}

function UserReg($username){
    require("dbaccess.php");
    $sql = "SELECT * FROM accounts WHERE USERNAME = ?";
    $stmt = mysqli_stmt_init($mysqli);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $results = mysqli_stmt_get_result($stmt);
    if(mysqli_fetch_assoc($results)){
        return true;
    }
    else{
        return false;
    }
    mysqli_stmt_close($stmt);
}

function EmailReg($email){
    require("dbaccess.php");
    $sql = "SELECT * FROM accounts WHERE EMAIL = ?";
    $stmt = mysqli_stmt_init($mysqli);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $results = mysqli_stmt_get_result($stmt);
    if(mysqli_fetch_assoc($results)){
        return true;
    }
    else{
        return false;
    }
    mysqli_stmt_close($stmt);
}
?>