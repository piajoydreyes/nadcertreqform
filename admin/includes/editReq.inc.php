<?php
include('dbcon.inc.php');

if(isset($_POST['editReqBtn']))
{
    $ctrl_no = $_POST['editDocReqID'];
    $processingOfficer = $_POST['processingOfficer'];
    $status = $_POST['status'];
    $remarks = $_POST['remarks'];
    $releaseDate = $_POST['releaseDate'];

    
    $query = "UPDATE tbl_cert_req SET processingOfficer = '$processingOfficer', status = '$status', remarks = '$remarks', releaseDate = '$releaseDate' WHERE ctrl_no = '$ctrl_no' ";
    $query_run = mysqli_query($conn, $query);

    if ($query_run)
    {
        
        header('Location: ../requests.php');
        
        $description = $_POST['description'];
        $quantity = $_POST['quantity'];
        $unitPrice = $_POST['unitPrice'];
        $totalPrice = $_POST['totalPrice'];
        $adminID = $_POST['admin_id'];
        $userID  = $_POST['user_id'];

        if(!empty($_POST['description']) || !empty($_POST['quantity']) || !empty($_POST['unitPrice']) || !empty($_POST['totalPrice']) || !empty($_POST['adminID']) || !empty($_POST['userID']))
        {
            $query2 = "INSERT INTO tbl_cert_payment (ctrl_no, description, quantity, unitPrice, totalPrice, admin_id, user_id) VALUES ('$ctrl_no', '$description', '$quantity', '$unitPrice', '$totalPrice', '$adminID', '$userID') ";
            $query_run2 = mysqli_query($conn, $query2);
    
            if($query_run2)
            {
                header('Location: ../requests.php');
                exit();
            }
        }
        
    }
}