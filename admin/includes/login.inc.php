<?php

if (isset($_POST["submitLogin"]))
{
    $username = $_POST["username"];
    $password = $_POST["password"];

    require_once 'dbcon.inc.php';
    require_once 'functions.inc.php';

    if (emptyInputLogin($username, $password) !== false)
    {
        header ("location: ../login.php?error=emptyinput");
        exit();
    }

    loginAdmin($conn, $username, $password);
}
else
{
    header ("location: ../login.php");
    exit();
}