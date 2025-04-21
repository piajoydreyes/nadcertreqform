<?php

if (isset($_POST["submitReg"]))
{

    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $username = $_POST["username"];
    $email = $_POST["regemail"];
    $password = $_POST["password"];
    $confirmpass = $_POST["confirmpass"];

    require_once 'functions.inc.php';
    require_once 'dbcon.inc.php';

    if (emptyInputSignup($firstname, $lastname, $username, $email, $password, $confirmpass) !== false)
    {
        header ("location: ../signup.php?error=emptyinput");
        exit();
    }
    if (invalidUsername($username) !== false) 
    {
        header ("location: ../signup.php?error=invalidun");
        exit();
    }
    if (invalidEmail($email) !== false) 
    {
        header ("location: ../signup.php?error=invalidemail");
        exit();
    }
    if (invalidPassword($password) !== false) 
    {
        header ("location: ../signup.php?error=invalidpass");
        exit();
    }
    if (passwordMatch($password, $confirmpass) !== false) 
    {
        header ("location: ../signup.php?error=passdontmatch");
        exit();
    }
    if (unExists($conn, $username, $email) !== false) 
    {
        header ("location: ../signup.php?error=usernametaken");
        exit();
    }

    createUser($conn, $firstname, $lastname, $username, $email, $password);

}
else 
{
    header ("location: ../signup.php");
}