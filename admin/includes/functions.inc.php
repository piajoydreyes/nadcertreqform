<?php

// require_once '../sessions.php';

function emptyInputSignup($firstname, $lastname, $username, $email, $password, $confirmpass)
{
    $result;
    if (empty($firstname) || empty($lastname) || empty($username) || empty($email) || empty($password) || empty($confirmpass))
    {
        $result = true;
    }
    else 
    {
        $result = false;
    }
    return $result;
}

function invalidUsername($username)
{
    $result;
    if (!preg_match("/^[a-zA-Z0-9]*$/", $username))
    {
        $result = true;
    }
    else 
    {
        $result = false;
    }
    return $result;
}

function invalidEmail($email)
{
    $result;
    if (!filter_var ($email, FILTER_VALIDATE_EMAIL))
    {
        $result = true;
    }
    else 
    {
        $result = false;
    }
    return $result;
}

function invalidPassword($password)
{
    $result;
    if (!preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,15}$/", $password))
    {
        $result = true;
    }
    else 
    {
        $result = false;
    }
    return $result;
}

function passwordMatch($password, $confirmpass)
{
    $result;
    if ($password !== $confirmpass)
    {
        $result = true;
    }
    else 
    {
        $result = false;
    }
    return $result;
}

function unExists($conn, $username, $email)
{
    $sql = "SELECT * FROM tbl_admin WHERE username = ? OR email = ?;";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) 
    {
        header ("location: ../signup.php?error=stmtfailed");
        exit();
    }
    
    mysqli_stmt_bind_param($stmt, "ss", $username, $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultData))
    {
        return $row;
    }
    else
    {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

function createUser($conn, $firstname, $lastname, $username, $email, $password)
{
    $sql = "INSERT INTO tbl_admin (firstname, lastname, username, email, password) VALUES (?, ?, ?, ?, ?)  ;";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) 
    {
        header ("location: ../signup.php?error=stmtfailed");
        exit();
    }
    
    $hashedPass = password_hash($password, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "sssss", $firstname, $lastname, $username, $email, $hashedPass);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header ("location: ../login.php");
    exit();
}

//login functions
function emptyInputLogin($username, $password)
{
    $result;
    if (empty($username) || empty($password))
    {
        $result = true;
    }
    else 
    {
        $result = false;
    }
    return $result;
}

function loginAdmin($conn, $username, $password)
{
   $unExists = unExists($conn, $username, $username);

   if ($unExists === false)
   {
    header ("location: ../login.php?error=wronglogin");
    exit();
   }

   $passHashed = $unExists["password"];
   $checkPass = password_verify($password, $passHashed);

   if ($checkPass === false)
   {
    header ("location: ../login.php?error=wrongpass");
    exit();
   }
   else if ($checkPass === true)
   {
        session_start();
        $_SESSION['uid'] = $unExists["userID"];
        $_SESSION['uname'] = $unExists["username"];
        header ("location: ../dashboard.php");
        exit();
   }
}