<?php

    include ('sessions.php');

    //admin signup 
    if (isset($_POST['submitReg']))
    {
        $firstname = $_POST["firstname"];
        $lastname = $_POST["lastname"];
        $username = $_POST["username"];
        $email = $_POST["regemail"];
        $password = $_POST["password"];
        $confirmpass = $_POST["confirmpass"];

        $unCheck = mysqli_query($conn, "SELECT * FROM tbl_admin WHERE username = '$username' ");

        if (mysqli_num_rows($unCheck) > 0)
        {
            $_SESSION['status'] = "Username exist. Login or Create another username.";
            $_SESSION['status_code'] = "warning";
            header('Location: signup.php');
        }
        else
        {
             if($password === $confirmpass)
             {
                $encPassword = password_hash($password, PASSWORD_DEFAULT);

                $query = "INSERT INTO tbl_admin (firstname, lastname, username, email, password) VALUES ('$firstname', '$lastname', '$username', '$email', '$encPassword' ) ";

                if (mysqli_query ($conn, $query))
                {
                    $_SESSION['status'] = "You are now registered. Login to continue.";
                    $_SESSION['status_code'] = "success";
                    header('Location: login.php');
                }
                else
                {
                    $_SESSION['status'] = "Error Registering!";
                    $_SESSION['status_code'] = "error";
                    header('Location: signup.php');
                }
             }
             else
                {
                    $_SESSION['status'] = "Password to do not match!";
                    $_SESSION['status_code'] = "error";
                    header('Location: signup.php');
                }
        }
    }

    
    //admin login
    if(isset($_POST['submitLogin']))
    {
        $unLogin = $_POST['username'];
        $passLogin = $_POST['password'];

        $query_run = mysqli_query($conn, "SELECT * FROM tbl_admin WHERE username = '$unLogin' ");

        if(mysqli_num_rows($query_run) > 0)
        {
            $row = mysqli_fetch_assoc($query_run);
            $verify = password_verify($passLogin, $row['password']);

            if($verify == 1)
            {

                $_SESSION['fName'] = $row['firstname'];
                $_SESSION['lName'] = $row['lastname'];
                $_SESSION['uName'] = $row['username'];
                $_SESSION['eMail'] = $row['email'];
                header('Location: dashboard.php');
            }
            else
            {
                $_SESSION['status'] = "Wrong Password.";
                $_SESSION['status_code'] = "warning";
                header('Location: login.php');
            }
        }
        else
        {
            $_SESSION['status'] = "Wrong Username.";
            $_SESSION['status_code'] = "warning";
            header('Location: login.php');
        }
    }


    //admin sign out
    if(isset($_POST['adminLogoutBtn']))
    {
        session_destroy();
        unset($_SESSION['uid']);
        header('Location: index.php');
    }
?>