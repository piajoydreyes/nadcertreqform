<?php

require_once 'dbcon.inc.php';
require_once 'dbcon2.inc.php';

function emptyReqFormInput($fullname, $hospital_affiliation, $address, $mobile_number, $email_address)
{
    $result;
    if (empty($fullname) || empty($hospital_affiliation) || empty($address) || empty($mobile_number) || empty($email_address))
    {
        $result = true;
    }
    else
    {
        $result = false;
    }
    return $result;
}

function validateNumber($mobile_number)
{
    $result;
    if (!preg_match("/^[0-9]{11}$/", $mobile_number))
    {
        $result = true;
    }
    else
    {
        $result = false;
    }
    return $result;
}

function validateEmail($email_address)
{
    $result;
    if (!filter_var ($email_address, FILTER_VALIDATE_EMAIL))
    {
        $result = true;
    }
    else 
    {
        $result = false;
    }
    return $result;
}

// function submitRequest($conn, $ctrl_no, $fullname, $hospital_affiliation, $address, $mobile_number, $email_address, $user_id, $employee_no, $uad, $position, $unit, $tentative_resig_date, $final_resig_date, $certDesignation, $trainingCert, $trainingDate, $status)
// {
//     $sql = "INSERT INTO tbl_user (ctrl_no, fullname, hospital_affiliation, address, mobile_number, email_address) VALUES (?, ?, ?, ?, ?, ?) ;";
//     $stmt = mysqli_stmt_init($conn);

//     if (!mysqli_stmt_prepare($stmt, $sql))
//     {
//         header ("location: ../reqForm.php?error=stmtfailed");
//         exit();
//     }
//     else 
//     {
//         mysqli_stmt_bind_param($stmt, "ssssss", $ctrl_no, $fullname, $hospital_affiliation, $address, $mobile_number, $email_address);
//         mysqli_stmt_execute($stmt);

//         $last_id = $conn->insert_id;

//         if(!empty($user_id) || !empty($employee_no) || !empty($uad) || !empty($position) || !empty($unit) || !empty($tentative_resig_date) || !empty($final_resig_date))
//         {
//             $sql = "INSERT INTO tbl_phc_employee (user_id, employee_no, uad, position, unit, tentative_resig_date, final_resig_date) VALUES (?, ?, ?, ?, ?, ?, ?) ;";
//             $stmt = mysqli_stmt_init($conn);

//             if (mysqli_stmt_prepare($stmt, $sql))
//             {
//                 mysqli_stmt_bind_param($stmt, "issssss", $last_id, $employee_no, $uad, $position, $unit, $tentative_resig_date, $final_resig_date);
//                 mysqli_stmt_execute($stmt);
//             }
//         }

//         for($i=0; $i<count($_POST['reqno']); $i++)
//         {
//             $certDesignation = $_POST['certDesignation'][$i];
//             $trainingCert = $_POST['trainingCert'][$i];
//             $otherTrainingCert = $_POST['otherTrainingCert'][$i];
//             $trainingDate = $_POST['trainingDate'][$i];

//             $status = "Requested";

//             if(!empty($_POST['certDesignation']) || !empty($_POST['trainingCert']) || !empty($_POST['otherTrainingCert']) || !empty($_POST['trainingDate']))
//             {
//                 $sql = "INSERT INTO tbl_cert_req (user_id, ctrl_no, certDesignation, trainingCert, otherTrainingCert, trainingDate, status) VALUES (?, ?, ?, ?, ?, ?, ?) ;";
//                 $stmt = mysqli_stmt_init($conn);

//                 if (myqsli_stmt_prepare($stmt, $sql))
//                 {
//                     mysqli_stmt_bind_param($stmt, "issssss" , $last_id, $ctrl_no, $certDesignation, $trainingCert, $otherTrainingCert, $trainingDate, $status);
//                     mysqli_stmt_execute($stmt);
//                 }
//             }
//         }

//         mysqli_stmt_close($stmt);
        
//         header("location: ../reqConfirmation.php");
//         exit();
//     }
// }