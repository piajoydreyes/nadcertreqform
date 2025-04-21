<?php

    session_start();

    require_once 'includes/dbcon.inc.php';

    if(!$_SESSION['uid'])
    {
        header('Location: index.php');
    }
    
// if ($_SESSION['uid'])
// {
//     header('Location: dashboard.php');
//     // die();
// }
// else {
//     header('Location: login.php');
//     // die();
// }
