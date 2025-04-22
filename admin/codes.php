<?php

    session_start();
        
    require '../includes/dbcon.php'; 

    //admin signup 
    if (isset($_POST['submitReg'])) {
        $firstname = trim($_POST["firstname"]);
        $lastname = trim($_POST["lastname"]);
        $username = trim($_POST["username"]);
        $email = trim($_POST["regemail"]);
        $password = $_POST["password"];
        $confirmpass = $_POST["confirmpass"];
        $now = date('Y-m-d H:i:s');
    
        try {
            // Check if username exists
            $stmt = $connPDODBNADCERTDOC->prepare("SELECT 1 FROM tbl_admin WHERE username = :username");
            $stmt->execute([':username' => $username]);
    
            if ($stmt->fetch()) {
                $_SESSION['status'] = "Username exists. Login or create another username.";
                $_SESSION['status_code'] = "warning";
                header('Location: signup.php');
                exit();
            }
    
            // Password match check
            if ($password !== $confirmpass) {
                $_SESSION['status'] = "Passwords do not match!";
                $_SESSION['status_code'] = "error";
                header('Location: signup.php');
                exit();
            }
    
            // Hash and insert user
            $encPassword = password_hash($password, PASSWORD_DEFAULT);
    
            $stmt = $connPDODBNADCERTDOC->prepare("INSERT INTO tbl_admin (firstname, lastname, username, email, password, added_at)
                VALUES (:firstname, :lastname, :username, :email, :password, :added_at)");
    
            $stmt->execute([
                ':firstname' => $firstname,
                ':lastname' => $lastname,
                ':username' => $username,
                ':email' => $email,
                ':password' => $encPassword,
                ':added_at' => $now
            ]);
    
            $_SESSION['status'] = "You are now registered. Login to continue.";
            $_SESSION['status_code'] = "success";
            header('Location: login.php');
            exit();
    
        } catch (PDOException $e) {
            error_log("Registration error: " . $e->getMessage());
            $_SESSION['status'] = "Error registering!";
            $_SESSION['status_code'] = "error";
            header('Location: signup.php');
            exit();
        }
    }
    
    
    //admin login
    if (isset($_POST['submitLogin'])) {

        $unLogin = $_POST['username'];
        $passLogin = $_POST['password'];
    
        try {
            $query = "SELECT * FROM tbl_admin WHERE username = :username LIMIT 1";
            $stmt = $connPDODBNADCERTDOC->prepare($query);
            $stmt->bindParam(':username', $unLogin, PDO::PARAM_STR);
            $stmt->execute();
    
            if ($stmt->rowCount() > 0) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $verify = password_verify($passLogin, $row['password']);
    
                if ($verify) {
                    $_SESSION['uid'] = $row['admin_id'];
                    $_SESSION['fName'] = $row['firstname'];
                    $_SESSION['lName'] = $row['lastname'];
                    $_SESSION['uName'] = $row['username'];
                    $_SESSION['eMail'] = $row['email'];
                    header('Location: dashboard.php');
                    exit;

                } else {
                    $_SESSION['status'] = "Wrong Password.";
                    $_SESSION['status_code'] = "warning";
                    header('Location: login.php');
                    exit;
                }
            } else {
                $_SESSION['status'] = "Wrong Username.";
                $_SESSION['status_code'] = "warning";
                header('Location: login.php');
                exit;
            }
    
        } catch (PDOException $e) {
            $_SESSION['status'] = "Database error: " . $e->getMessage();
            $_SESSION['status_code'] = "error";
            header('Location: login.php');
            exit;
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